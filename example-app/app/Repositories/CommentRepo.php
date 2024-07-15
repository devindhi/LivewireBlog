<?php
namespace App\Repositories;

use App\Models\comment;

class CommentRepo{
    

    public function createComment($data){
        $comment = Comment::create($data);
    }

    public function delete(Comment $comment)
    {
        return $comment->delete();
    }

    public function findByBlogId($blogId)
    {
        $comments = comment::where('blog_id', $blogId)->get();
    
        // Check if there are any comments
        if ($comments->isEmpty()) {
            return [];
        }
    
        return $comments;
    }

    public function findById($id)
    {
        return Comment::find($id);
    }

    
    
}