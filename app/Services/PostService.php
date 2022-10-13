<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostService
{
    protected $data;
    public $month;
    public $year;
    public function getAllPosts($month, $year, $action)
    {
        //return Post::where('status', 1)->paginate(6);


        if ($action) {
            if ($action === "Previous") {
                $this->month = $month <= 1 ? 12 : ($month - 1);
                $this->year = $this->month == 12 ? ($year-1) : $year;
            } else {
                $this->month = $month >= 12 ? 1 : ($month + 1);
                $this->year = $this->month == 1 ? ($year+1) : $year;
            } 
        } else {
            $this->month = $month;
            $this->year = $year;
        }

        return Post::whereMonth('created_at', $this->month)
            ->whereYear('created_at', $this->year)
            ->where('status', 1)
            ->paginate(6);
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
