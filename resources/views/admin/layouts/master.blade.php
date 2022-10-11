<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    @include('admin.includes.header')
    @stack('style')
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        @include('admin.includes.topbar')
        @include('admin.includes.sidebar')

        @yield('content')

        @include('admin.includes.footer')
    </div>

    @include('admin.includes.scripts')
    @stack('javascripts')
</body>

</html>
