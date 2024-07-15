<?php
namespace App\Repositories;

use App\Models\blog;
use Illuminate\Support\Facades\Log;

class BlogRepo{

    public function createBlog($validatedData){
        return $blog = Blog::create($validatedData);

    }

    public function getAll()
    {

        Log::info("in repo");
        return Blog::all();
    }

    
    public function deleteBlog(Blog $blog){


        return $blog->delete();
       
    }

    public function findById($id)
    {
        return Blog::find($id);
    }

    public function save(Blog $blog)
    {
        return $blog->save();
    }
    public function delete(Blog $blog)
    {
        return $blog->delete();
    }

}


