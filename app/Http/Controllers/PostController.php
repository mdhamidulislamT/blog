<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\ResponseService;

class PostController extends Controller
{

    protected $postService;
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function showAllPosts() // only Admin can access 
    {
        if (Auth::user()->role != "admin") {
            return redirect()->back()->with('danger', "Access Not Allowed!");
        }
        $allPosts = $this->postService->getAllPosts();
        return view('admin.all-posts', compact('allPosts'));
    }


    public function index()
    {
        $posts  = $this->postService->getAllPostwithComments();
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
            $message = ResponseService::SuccessResponse();
        } else {
            $message = ResponseService::ErrorResponse();
        }
        return response()->json($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post  = $this->postService->getById($id);
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function postHide($id)
    {
        $post  = Post::findOrFail($id);
        $post->status = 1;
        $result = $post->save();

        if ($result) {
            $message = ResponseService::SuccessResponse();
        } else {
            $message = ResponseService::ErrorResponse();
        }
        return redirect()->back()->with(ResponseService::getStatus(), $message);
    }

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
            $message = ResponseService::SuccessResponse();
        } else {
            $message = ResponseService::ErrorResponse();
        }
        return response()->json($message);
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
