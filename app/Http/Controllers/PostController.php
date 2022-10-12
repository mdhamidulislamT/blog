<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function showAllPosts()
    {
        $counter['active'] = Post::where('status', 0)->count();
        $counter['inactive'] = Post::where('status', 0)->count();
        $brands = Post::select('id', 'title', 'post', 'created_at')->paginate(5);
        
        return view('admin.posts.all-posts', compact('brands', 'counter'));
    }


    public function index()
    {
        $posts  = Post::where('status', 1)->with('comments')->paginate(6);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $this->validate($request, [
            'title' => 'required|string|max:255',
            'post' => 'required|string|max:1000'
        ]);

        $post = new Post();

        $post->title = $request->title;
        $post->post = $request->post;
        $post->user_id = Auth::user()->id;
        $result = $post->save();

        if ($result) {
            $status = "success";
            $message = "Post Created successfully!";
        } else {
            $status = "danger";
            $message = "Error! Please try again!";
        }
        return response()->json('Post Created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post  = Post::findOrFail($id);
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post  = Post::findOrFail($id);
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $this->validate($request, [
            'title' => 'required|string|max:255',
            'post' => 'required|string|max:1000'
        ]);

        $post  = Post::findOrFail($id);
        $post->title = $request->title;
        $post->post = $request->post;
        $post->user_id = Auth::user()->id;
        $result = $post->save();

        if ($result) {
            $status = "success";
            $message = "Post Updated successfully!";
        } else {
            $status = "danger";
            $message = "Error! Please try again!";
        }
        return response()->json('Post Updated successfully!');
        //return redirect()->route('posts.index')->with($status, $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
