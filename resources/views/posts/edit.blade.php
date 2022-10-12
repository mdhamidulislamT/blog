@extends('user.layouts.master')
@section('title', 'home')


@section('content')

    <div class="container">
        <div class="row">
            <div class="col align-self-start mb-3">
                <h1> Edit Post </h1>
            </div>
            @if (Session::has('danger') || Session::has('success'))
                <div class="alert alert-{{ Session::has('danger') ? 'danger' : 'success' }} alert-dismissible fade show"
                    role="alert">
                    {{ Session::get('success') ?? Session::get('danger') }}
                </div>
            @endif
            <div class="col align-self-end mb-3">
                <a href="{{ route('posts.index') }}" class="btn btn-success float-end"> All Post page </a>
            </div>
            <div class="col-md-12 mb-3">
                <form action="{{ route('posts.update', $post->id) }}" method="post" class="ajaxform">
                    @csrf
                    @method('put')
                    <div class="mb-3">
                        <label for="title" class="form-label"> Title </label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                            name="title" placeholder="title here" value="{{ $post->title }}">
                    </div>
                    <div class="mb-3">
                        <label for="post" class="form-label"> Post </label>
                        <textarea class="form-control @error('post') is-invalid @enderror" id="post" name="post" rows="5"
                            style="height:100%;" placeholder=" write your post here..."> {{ $post->post }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg float-end ajaxbtn">Submit</button>
                </form>
            </div>

        </div>
    </div>


@endsection

@push('javascripts')
@endpush
