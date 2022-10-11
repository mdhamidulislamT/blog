


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>
    @include('user.includes.header')
    @stack('style')

  </head>
  <body>
    <div class="wrapper">
        @include('user.includes.navbar')

        @yield('content')
    </div>

    @include('user.includes.scripts')
    @stack('javascripts')
</body>












