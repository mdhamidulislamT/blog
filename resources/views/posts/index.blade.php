@extends('user.layouts.master')
@section('title', 'Posts')


@section('content')

    <div class="container">
        <div class="row">
            <div class="col align-self-start mb-3">
                <h1> All Post page </h1>
            </div>
            @if (Session::has('danger') || Session::has('success'))
                <div class="alert alert-{{ Session::has('danger') ? 'danger' : 'success' }} alert-dismissible fade show"
                    role="alert">
                    {{ Session::get('success') ?? Session::get('danger') }}
                </div>
            @endif
            <div class="col align-self-end mb-3">
                <a href="{{ route('posts.create') }}" class="btn btn-success float-end"> Add New 22</a>
                <button type="button" class="btn btn-success float-end addNewPost"> Add New </button>
            </div>
            <div class="col-md-12 mb-3">

                <form action="{{ route('posts.store') }}" method="post" 
                    class="ajaxform_with_reset">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label"> Title </label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="title here">
                    </div>
                    <div class="mb-3">
                        <label for="post" class="form-label"> Post </label>
                        <textarea class="form-control" id="post" name="post" rows="3" placeholder=" write your post here..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg float-end ajaxbtn">Submit</button>
                </form>

            </div>

            @forelse ($posts as $post)
                <div class="col-md-12 shadow p-3 mb-5 bg-body rounded">
                    <div class="">
                        <h3>{{ $post->title }}</h3>
                        {!! Str::words(
                            $post->post,
                            50,
                            '<a class="btn btn-secondary float-end " href="/posts/' . $post->id . '">Read more</a>',
                        ) !!}

                        {{--  @if (strlen($post->post) > 220)

                            <p> {{ substr($post->post, 0, 220) }} <span class="dots{{ $post->id }}">....</span>

                                <button type="button" class="btn btn-secondary float-end readMoreLink{{ $post->id }}"
                                    onclick="readMore({{ $post->id }})">Read More</button>

                                <span class="readMoreContentDesc{{ $post->id }}"
                                    style="display:none;">{{ substr($post->post, 220, strlen($post->post) - 220) }}</span>
                            </p>

                            <button type="button" class="btn btn-secondary float-end readLessLink{{ $post->id }}"
                                style="display:none;" onclick="readLess({{ $post->id }})">Less</button>
                        @else
                            {{ $post->post }}
                        @endif --}}


                    </div>
                </div>
            @empty
                <h4 class="text-danger"> No Post Available!</h4>
            @endforelse

            <div class="d-flex justify-content-end">
                {!! $posts->links() !!}
            </div>


        </div>
    </div>


@endsection

@push('javascripts')
    <script>
        function readMore(id) {
            $(".dots" + id).hide();
            $(".readMoreLink" + id).hide();
            $(".readMoreContentDesc" + id).slideDown();
            $(".readLessLink" + id).show();
        }

        function readLess(id) {
            $(".dots" + id).show();
            $(".readMoreLink" + id).show();
            $(".readMoreContentDesc" + id).slideUp();
            $(".readLessLink" + id).hide();
        }

        $(document).ready(function() {

            $(document).on('click', '.addNewPost', function() {
                $("#creatPostForm").removeClass('d-none');
            })

        })
    </script>
@endpush
