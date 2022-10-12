@extends('user.layouts.master')
@section('title', 'show All Posts')


@section('content')

    <div class="container">
        <div class="row">
            <div class="col align-self-start mb-3">
                <h1> All Post page (Admin Page)</h1>
            </div>
            @if (Session::has('danger') || Session::has('success'))
                <div class="alert alert-{{ Session::has('danger') ? 'danger' : 'success' }} alert-dismissible fade show"
                    role="alert">
                    {{ Session::get('success') ?? Session::get('danger') }}
                </div>
            @endif
            <div class="col align-self-end mb-3">
                <button type="button" class="btn btn-success float-end addNewPost"> Add New </button>
            </div>
            <div class="col-md-12 mb-3">
                <form action="{{ route('posts.store') }}" method="post" class="ajaxform_with_reset">
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

            <div class="col-md-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Post</th>
                            <th scope="col">Created_at</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($allPosts as $singlePost)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $singlePost->title }}</td>
                                <td>
                                    {!! Str::words(
                                        $singlePost->post,
                                        20,
                                        '<a class="btn btn-secondary btn-sm float-end " href="/posts/' . $singlePost->id . '">Read more</a>',
                                    ) !!}
                                </td>
                                <td>{{ $singlePost->created_at }}</td>
                                <td><a class="btn btn-success float-end mt-2" href="{{ route('posts.hide', $singlePost->id) }}">Hide</a></td>
                            </tr>
                        @empty
                            <h4 class="text-danger"> No Post Available!</h4>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-start">
                    {!! $allPosts->links() !!}
                </div>
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
