@extends('user.layouts.master')
@section('title', 'Login')

@push('style')
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Lato&display=swap");

        body {
            background-color: #2a2c3b;
            font-family: "Lato", sans-serif;
        }

        .login-content {
            max-width: 450px;
            width: 100%;
            height: 550px;
            z-index: 1;
            position: absolute;
            /* top: 50%; */
            left: 50%;
            margin-left: -200px;
            /* margin-top: -286px; */
            border-radius: 8px;
            background: #2f3242;
        }

        .logo {
            width: 128px;
            height: 128px;
            margin: 5px;
        }

        .text-logo {
            text-align: center;
            font-weight: bold;
            font-size: 25px;
            color: white;
        }

        .form-control {
            width: 18rem;
            height: 3rem;
            left: 65px;
            position: relative;
            border-radius: 5px;
            background-color: #ccffee;
        }

        .btn {
            font-size: 22px;
            background-color: #0278ae;
            border: none;
            width: 18rem;
            height: 3rem;
            border-radius: 5px;
        }

        .btn:hover {
            background-color: blue;
        }

        .nomember {
            background-color: #e4dede;
            padding: 10px;
            padding-top: 20px;
            border-radius: 0px 0px 5px 5px;
            color: white;
            background: #2f3242;
        }

        .nomember a {
            text-decoration: none;
            color: rgb(158, 163, 240);
        }

        .forgot {
            position: relative;
            right: -20%;
        }

        .forgot a {
            text-decoration: none;
            font-size: 14px;
            color: rgb(158, 163, 240);
        }

        .copyright {
            color: white;
            padding: 15px;
        }

        /*support google chrome*/
        .form-control::-webkit-input-placeholder {
            color: #00000036;
        }

        /*support mozilla*/
        .form-control:-moz-input-placeholder {
            color: red;
        }

        /*support internet explorer*/
        .form-control:-ms-input-placeholder {
            color: red;
        }
    </style>
@endpush

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="card login-content shadow-lg border-0">
                    <div class="card-body">
                        
                        <h3 class="text-logo">Sign In</h3>
                        <br>
                        @isset($errors)
                            @if ($error = $errors->first('email'))
                                <div class="alert alert-danger">
                                    {{ $error }}
                                </div>
                            @endif
                        @endisset
                        <form class="text-center" method="POST" action="{{ route('login') }}">
                            @csrf
                            <input class="form-control border-0" type="email" name="email" id="email"
                                value="{{ old('email') }}" required autofocus placeholder="Email">
                            <br>
                            <input class="form-control border-0" type="password" id="password" name="password"
                                value="admin" required autocomplete="current-password" placeholder="Password">
                            <br>
                            <button class="btn btn-primary btn-sm border-0" type="submit" name="submit">Sign In</button>
                            {{-- <p class="forgot"><a href="">Forgot Password?</a></p> --}}
                        </form>
                    </div>
                    <div class="nomember">
                        <p class="text-center">Not a member? <a href="{{ url('register') }}">Create an Account</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('javascripts')
@endpush
