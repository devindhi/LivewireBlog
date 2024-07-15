<?php

namespace App\Services;

use App\Exceptions\GeneralJsonException;
use App\Models\Comment;
use App\Repositories\CommentRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Helpers\DecodeJwt;
use App\Repositories\BlogRepo;

class CommentService
{
    private $commentRepo;
    private $jwtHelper;
    private $blogRepo;
    

    public function __construct(CommentRepo $commentRepo,BlogRepo $blogRepo, DecodeJwt $jwtHelper)
    {
        $this->commentRepo = $commentRepo;
        $this->jwtHelper = $jwtHelper;
        $this->blogRepo = $blogRepo;
    }

    public function storeComment(Request $request, $blogId)
    {
        Log::info('in create comment');
        $blog = $this-> blogRepo->findById($blogId);

        if (!$blog) {
            throw new GeneralJsonException(
               "Blog not found", 404);
        }

        $token = (string) $request->bearerToken(); // Get token from Authorization header
        $userDetails = $this->jwtHelper->decodeJwtToken($token);

        // Validate the comment
        $validatedData = $request->validate([
            'comment' => 'required|string',
        ]);
        $validatedData['username'] = $userDetails['name'] ?? null;
        $validatedData['user_id'] = $userDetails['id'] ?? null;
        $validatedData['blog_id'] = $blogId;

        
        $comment = $this->commentRepo->createComment($validatedData);
        Log::info("Comment added by user: ", ['data' => $validatedData]);

        return $comment;
    }


    public function deleteComment($id)
    {
        $comment = $this->commentRepo->findById($id);
        if (!$comment) {
            throw new GeneralJsonException(
               "Comment not found", 404);
        }
        $blogId = $comment->blog_id;
        $this->commentRepo->delete($comment);

        return $blogId;
    }
   
}
