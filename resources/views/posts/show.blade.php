@extends('user.layouts.master')
@section('title', 'Posts')


@section('content')

    <div class="container">
        <div class="row">
            <div class="col align-self-start mb-3">
                <h1> Post Details </h1>
            </div>
            @if (Session::has('danger') || Session::has('success'))
                <div class="alert alert-{{ Session::has('danger') ? 'danger' : 'success' }} alert-dismissible fade show"
                    role="alert">
                    {{ Session::get('success') ?? Session::get('danger') }}
                </div>
            @endif
            <div class="col align-self-end mb-3">
                @if (Auth::id() == $post->user_id || Auth::user()->role == 'admin')
                    <a class="btn btn-success float-end" href="{{ route('posts.edit', $post->id) }}"> Edit </a>
                @endif
            </div>
            <div class="col-md-12 shadow p-3 mb-5 bg-body rounded">
                <h3>{{ $post->title }}</h3>
                <p>{{ $post->post }}</p>
            </div>
            <div class="col-md-12">
                <form action="{{ route('comments.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <div class="col-md-12 shadow p-3 mb-5 bg-body rounded">
                        <h3>Add a comment</h3>
                        <div class="mb-3 shadow p-2 bg-body rounded">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                        </div>
                        <div class="mb-3 mb-3 shadow  bg-body rounded">
                            <textarea class="form-control" id="comment" name="comment" rows="5" style="height:100%;"
                                placeholder=" Comment..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-success btn-lg my-4">Submit Comment</button>
                    </div>
                </form>
            </div>

            <div class="row">
                @if ($post->comments)
                    @foreach ($post->comments as $comment)
                        @if ($comment->status == 0)
                            <div class="col-md-11">
                                <p class="fw-normal">
                                    <span class="mb-4 fw-bold">{{ $comment->name }}</span>
                                    <br>
                                    <span class="my-4">{{ date('M-d-y', strtotime($comment->created_at)) }} </span>
                                    <br>
                                    <span>{{ $comment->comment }} </span>
                                </p>
                            </div>
                            @if (Auth::id() == $post->user_id || Auth::user()->role == 'admin')
                                <div class="col-md-1">
                                    <a class="btn btn-success float-end mt-2"
                                        href="{{ route('comments.edit', $comment->id) }}">Hide</a>
                                </div>
                            @endif
                        @endif
                    @endforeach
                @endif
            </div>

        </div>
    </div>


@endsection

@push('javascripts')
@endpush
