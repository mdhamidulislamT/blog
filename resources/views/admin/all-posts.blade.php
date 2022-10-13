@extends('user.layouts.master')
@section('title', 'show All Posts')


@section('content')

    <div class="container">
        <div class="row">
            <div class="col align-self-start mb-3">
                <h1> Admin Panel </h1>
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


                {{-- <form id="search_form" action="{{ url('admin/products') }}" method="get">
                    <div class="input-group m-0" style="width: 150px;">
                        <input type="text" name="search_query" class="form-control float-right" placeholder="Search">
                        <input type="hidden" name="deleted" value="{{ request()->get('deleted') }}"
                            class="form-control float-right" placeholder="Search">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form> --}}



                <ul class="pagination">
                    <form action="{{ route('admin.showAllPosts') }}" method="GET">
                        <input type="hidden" name="month" value="{{ $monthYear['month'] }}">
                        <input type="hidden" name="year" value="{{ $monthYear['year'] }}">
                        <input type="hidden" name="action" value="Previous">
                        <li class="page-item">
                            <button class="page-link" aria-label="Previous" type="submit">
                                <span aria-hidden="true" class="fs-2">&laquo;</span>
                            </button>
                        </li>
                    </form>
                    @php
                        $monthArray = ['January', 'February', 'March', 'April', 'May', 'June', 'July ', 'August', 'September', 'October', 'November', 'December'];
                    @endphp
                    <li class="page-item"><a class="page-link fs-2" href="#"> {{ $monthArray[($monthYear['month']-1)] }} </a></li>
                    <form action="{{ route('admin.showAllPosts') }}" method="GET">
                        <input type="hidden" name="month" value="{{ $monthYear['month'] }}">
                        <input type="hidden" name="year" value="{{ $monthYear['year'] }}">
                        <input type="hidden" name="action" value="Next">
                        <li class="page-item">
                            <button class="page-link" aria-label="Next" type="submit">
                                <span aria-hidden="true" class="fs-2">&raquo;</span>
                            </button>
                        </li>
                    </form>
                </ul>



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
                                <th scope="row">{{ $singlePost->id }}</th>
                                <td>{{ $singlePost->title }}</td>
                                <td>
                                    {!! Str::words(
                                        $singlePost->post,
                                        20,
                                        '<a class="btn btn-secondary btn-sm float-end " href="/posts/' . $singlePost->id . '">Read more</a>',
                                    ) !!}
                                </td>
                                <td>{{ $singlePost->created_at }}</td>
                                <td><a class="btn btn-success float-end mt-2"
                                        href="{{ route('posts.hide', $singlePost->id) }}">Hide</a></td>
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
