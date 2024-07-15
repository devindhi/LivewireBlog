<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Services\CommentService;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;

class commentController extends Controller
{

    protected $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function store(Request $request, $blogId)
    {
      
            Log::info('In comments controller');
            
            $this->commentService->storeComment($request, $blogId);

            return response()->json([
                'message' => 'Comment added successfully!',
                'blog_id' => $blogId
            ], 201);
       
    }


   
    public function delete($id)
    {
     
          
            $blogId = $this->commentService->deleteComment($id);
            return response()->json([
                'message' => 'Comment deleted successfully',
                'blog_id' => $blogId
            ]);
       
}
}
