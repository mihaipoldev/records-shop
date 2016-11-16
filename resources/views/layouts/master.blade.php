<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title')</title>
        <link rel="stylesheet" href="{{ asset('libs/bootstrap-3.3.7/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('libs/font-awesome-4.7.0/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <script src="{{ asset('libs/jquery.min.js') }}"></script>
    </head>
    <body>
        @include('includes.header')
        @yield('main')
        @include('includes.footer')


        <script src="{{ asset('libs/bootstrap-3.3.7/bootstrap.min.js') }}"></script>

        @yield('extra_js')
    </body>
</html>
