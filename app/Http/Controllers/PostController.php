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

    public function showAllPosts(Request $request) // only Admin can access 
    {
        if (Auth::user()->role != "admin") {
            return redirect()->back()->with('danger', "Access Not Allowed!");
        }
        $action = '';
        $month = date('m');
        $year = date('Y');

        if ($request->has('action')) {
            $action = $request->action;
            $month = $request->month;
        }

        $allPosts = $this->postService->getAllPosts($month, $year, $action);
        $monthYear['month'] = $this->postService->month;
        $monthYear['year'] = $this->postService->year;
        return view('admin.all-posts', compact('allPosts', 'monthYear'));
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
        $validatedData = $this->validate($request, [
            'title' => 'required|string|max:255',
            'post' => 'required|string|max:1000'
        ]);

        $result  = $this->postService->savePost($validatedData);

        if ($result) {
            $data = ResponseService::SuccessResponse();
        } else {
            $data = ResponseService::ErrorResponse();
        }
        return response()->json($data['message']);
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
        $post  = $this->postService->getById($id);
        $post->status = '0';
        $result = $post->save();

        if ($result) {
            $data = ResponseService::SuccessResponse();
        } else {
            $data = ResponseService::ErrorResponse();
        }
        return redirect()->back()->with($data['status'], $data['message']);
    }

    public function edit($id)
    {
        $post  = $this->postService->getById($id);
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
            $data = ResponseService::SuccessResponse();
        } else {
            $data = ResponseService::ErrorResponse();
        }
        return response()->json($data['message']);
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
