<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title')</title>

        <link href="{{ asset('libs/inspinia/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('libs/inspinia/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">

        <link href="{{ asset('libs/inspinia/css/animate.css') }}" rel="stylesheet">
        <link href="{{ asset('libs/inspinia/css/style.css') }}" rel="stylesheet">

        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    </head>
    <body>

        @include('includes.header')
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    @yield('main')
                </div>
                <div class="col-sm-3 fixed">
                    <div class="player-wrapper">
                        <div class="player">
                            @include ('includes.player')
                        </div>
                    </div>

                </div>
            </div>
        </div>
        @include('includes.footer')


        <script src="{{ asset('libs/inspinia/js/jquery-2.1.1.js') }}"></script>
        <script src="{{ asset('libs/inspinia/js/bootstrap.min.js') }}"></script>
        {{--<script src="{{ asset('libs/inspinia/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>--}}
        {{--<script src="{{ asset('libs/inspinia/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>--}}

        {{--<script src="{{ asset('libs/inspinia/js/inspinia.js') }}"></script>--}}
        {{--<script src="{{ asset('libs/inspinia/js/plugins/pace/pace.min.js') }}"></script>--}}

        @yield('extra_js')
    </body>
</html>
