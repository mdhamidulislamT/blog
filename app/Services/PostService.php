<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostService
{
    protected $data;
    public function getAllPosts()
    {
        return Post::where('status', 1)->paginate(6);
    }

    public function getAllPostwithComments()
    {
        return Post::where('status', 1)->with('comments')->paginate(6);
    }

    public function getById($id = 0)
    {
        return Post::findOrFail($id);
    }

    public function savePost($requestData)
    {
        $requestData['user_id'] = Auth::user()->id;;
        
        return Post::create($requestData);
    }



}
