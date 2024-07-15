<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\blog;
use App\Models\comment;
use App\Services\BlogService;;

use Illuminate\Support\Facades\Http;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class blogController extends Controller
{
    protected $blogService;

    public function __construct(BlogService $blogService)
    {
        $this->blogService = $blogService;
    }


    function home()
    {
        Log::info('home');
        return view('Home');
    }


    //creation of a blog
    public function store(Request $request)
    {
        Log::info('is in controller');


        $blog = $this->blogService->createBlog($request);
        return response()->json([
            'success' => true,
            'message' => 'Blog created successfully',
            'data' => $blog
        ], 201);
    }



    public function show(Request $request)
    {
        Log::info('Entering show method');

        $result = $this->blogService->getAllBlogs($request);

        return $result;
    }


    public function update(Request $request, $id)
    {
        $updated = $this->blogService->updateBlog($request, $id);
        return response()->json([
            'success' => true,
            'message' => 'Blog updated successfully'
        ]);
    }

    
    public function edit(Request $request, $id)
    {

        $blog = $this->blogService->retriewBlogdata($id, $request);
        return view('edit', compact('blog', 'id'));
    }


    // view blog related comments
    public function view(Request $request, $id)
    {
        Log::info('Entering view method with ID: ' . $id);

        try {
            // Retrieve the data from the blog service
            $data = $this->blogService->viewBlogWithComments($id, $request);

            // Return the view with the data
            if ($request->wantsJson()) {
                return response()->json($data);
            }
            return view('blog', $data);
        } catch (\Exception $e) {
            Log::error('Error in view method: ' . $e->getMessage());
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No blog found',
                    'error' => $e->getMessage()
                ], 500);
            }
            return response()->json(['error' => 'Failed to load blog'], 500);
        }
    }



    public function delete(Request $request, $id)
    {
        Log::info($id);


        $deleted = $this->blogService->deleteBlog( $id);

        return response()->json([
            'success' => true,
            'message' => 'Blog deleted successfully'
        ]);
    }
}
