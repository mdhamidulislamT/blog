@extends('user.layouts.master')
@section('title', 'home')


@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-5">
                <h1>Home Page After Logged in</h1>
            </div>
            <div class="col align-self-start mb-3">
                <h1> All Post page </h1>
            </div>
            <div class="col align-self-end mb-3">
                <a href="" class="btn btn-success float-end"> Add New </a>
            </div>
            <div class="col-md-12">
                <div class="shadow p-3 mb-5 bg-body rounded">
                    <h3>What is Lorem Ipsum?</h3>
                    <p>Lorem Ipsum is simply dummy text Lorem Ipsum is simply dummy text Lorem Ipsum is simply dummy text
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                        industry's standard dummy text ever since the 1500s....</p>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('javascripts')
@endpush
