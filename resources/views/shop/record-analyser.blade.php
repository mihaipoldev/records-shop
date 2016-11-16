@extends('layouts.master')

@section('title')
    Shop
@endsection

@section('main')
    <main>
        <div class="container">
            <section class="row content">
                <div class="col-xs-12 clearfix parent">
                    <div class="top">
                        @foreach($array as $item)
                            <span class="child" style="display:inline-block; background: #eeeeee; width: 2px; height: {{ $item/2.5 }}px;"></span>
                        @endforeach
                    </div>
                    <div class="bottom">
                        @foreach($array as $item)
                            <span class="child" style="display:inline-block; background: rgba(158, 154, 158, 0.31); width: 2px; height: {{ $item/5 }}px;"></span>
                        @endforeach
                    </div>
                </div>
            </section>
        </div>
    </main>
@endsection

@section('extra_js')
    {{--<script src="{{ URL::to('js/audioPlayer.js') }}"></script>--}}
@endsection