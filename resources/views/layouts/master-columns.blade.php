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
    <body @yield('body_color')>

        @include('includes.header')
        <div class="container main-content">
            <div class="row">
                <div class="col-sm-9">
                    @yield('main')
                </div>
                <div class="col-sm-3 position-relative">
                    <div class="affix right-side-fixed">
                        <div class="player-wrapper">
                            <div class="player">
                                @yield('player')
                            </div>
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

        <script>
            jQuery( document ).ready( function(){
                setFooterPosition();
                setRightSideWidth();

                window.addEventListener( 'resize', setFooterPosition );
                window.addEventListener( 'resize', setRightSideWidth );

                function setFooterPosition(){
                    /* window - header - footer */
                    var contentMinHeight = $( window ).height() - 50 - 122,
                            mainHeight = $( 'main' ).height();

                    if( contentMinHeight > mainHeight ){
                        $( 'footer' ).addClass( 'to-bottom' );
                    }
                }

                function setRightSideWidth(){
                    $columnWidth = parseInt($('.position-relative').css('width').substring(0, $('.position-relative').css('width').length - 2)) - 20;
                    $('.right-side-fixed').css('width', $columnWidth + 'px');
                }
            } );
        </script>

        @yield('player_js')
        @yield('extra_js')
    </body>
</html>
