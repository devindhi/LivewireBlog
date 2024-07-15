<?php

namespace App\Services;

use App\Exceptions\GeneralJsonException;
use App\Helpers\DecodeJwt;
use App\Repositories\BlogRepo;
use App\Repositories\CommentRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class BlogService
{
    protected $blogRepo;
    protected $commentRepo;
    private $jwtHelper;

    public function __construct(BlogRepo $blogRepo, CommentRepo $commentRepo,  DecodeJwt $jwtHelper)
    {
        $this->commentRepo = $commentRepo;
        $this->blogRepo = $blogRepo;
        $this->jwtHelper = $jwtHelper;
    }

    public function createBlog(Request $request)
    {

        $token = (string) $request->bearerToken();
      
            $userDetails = $this->jwtHelper->decodeJwtToken($token);

            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'image' => 'nullable|image|max:4048', // image is being uploaded, max is 2 MB
            ]);


            $validatedData['username'] = $userDetails['name'] ?? null;
            $validatedData['user_id'] = $userDetails['id'] ?? null;

            
            $imagePath = null;
            if ($request->hasFile('image')) {
                $path = $request->file('image');
                $extension = $path->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $path->move(public_path('images'), $filename);
                $imagePath = 'images/' . $filename;
            }

            $validatedData['image'] = $imagePath;

           
            $blog = $this->blogRepo->createBlog($validatedData);

            Log::info("Blog created by user: " . ($blog ? json_encode($blog) : 'null'));

            return $blog;
        
    }



    public function updateBlog(Request $request, $id)
    {

            $blog = $this->blogRepo->findById($id);
            if (!$blog) {
                throw new GeneralJsonException("Blog not found", 404);
            } else {

                if ($request->has('title')) {
                    $blog->title = $request->input('title');
                }

                if ($request->has('content')) {
                    $blog->content = $request->input('content');
                }

                if ($request->hasFile('image')) {
                    $path = $request->file('image');
                    $extension = $path->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $path->move(public_path('images'), $filename);
                    $blog->image = 'images/' . $filename;
                }

                $this->blogRepo->save($blog);

                return response()->json($blog, 200);
            
        } 
    }



    public function deleteBlog($blogId)
    {
       
        // Retrieve the blog using the provided ID
        $blog = $this->blogRepo->findById($blogId);
        if (!$blog) {
            throw new GeneralJsonException("Blog not found", 404);
        }

        // Delete the blog
        return $this->blogRepo->delete($blog);


    }


    public function retriewBlogdata($id)
    {
    
        $blog = $this->blogRepo->findById($id);
        return $blog;
    }


    public function viewBlogWithComments($id, Request $request)
    {
        $token = (string) $request->bearerToken();
        $userDetails = $this->jwtHelper->decodeJwtToken($token);
            $userId = $userDetails['id'] ?? null;
            $hasAuth = true;  // Authentication is present
   
        Log::info($id);
        $blog = $this->blogRepo->findById($id);
        if (!$blog) {
            throw new GeneralJsonException("Not Found",400);
        }
        $comments = $this->commentRepo->findByBlogId($id);

        return [
            'blog' => $blog,
            'comments' => $comments,
            'userId' => $userId,
            'hasAuthToken' => $hasAuth
        ];
    }



    public function getAllBlogs()
    {
     
            $blogs = $this->blogRepo->getAll();
            return $blogs;
       
    }
}
