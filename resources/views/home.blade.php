@extends('user.layouts.master')
@section('title', 'home')


@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-5">
                <h1>Home Page</h1>
            </div>
            <div class="col align-self-start mb-3">
                <h1> All Post page </h1>
            </div>
            <div class="col align-self-end mb-3">
                <a href="{{ route('posts.create') }}" class="btn btn-success float-end"> Add New </a>
            </div>
        </div>
    </div>


@endsection

@push('javascripts')
@endpush
