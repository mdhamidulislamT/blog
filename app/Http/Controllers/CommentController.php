<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'post_id' => 'required',
            'name' => 'required|string|max:50',
            'comment' => 'required|string|max:500'
        ]);

        $comment = new Comment();

        $comment->post_id = $request->post_id;
        $comment->name = $request->name;
        $comment->comment = $request->comment;
        $comment->user_id = Auth::user()->id;
        $result = $comment->save();

        if ($result) {
            $status = "success";
            $message = "Added New Comment!";
        } else {
            $status = "danger";
            $message = "Error! Please try again!";
        }
        return redirect()->back()->with($status, $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
            $comment  = Comment::findOrFail($id);
            $comment->status = 1;
            $result = $comment->save();

            if ($result) {
                $status = "success";
                $message = " Comment hid from post";
            } else {
                $status = "danger";
                $message = "Error! Please try again!";
            }
            return redirect()->back()->with($status, $message);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
