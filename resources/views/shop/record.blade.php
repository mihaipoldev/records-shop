@extends('layouts.master')

@section('title')
    Shop
@endsection

@section('main')
    <main>
        <section class="item">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4 image-column">
                        <figure>
                            <img src="{{ asset('img/records/mihai-pol-goneta/artwork.jpg') }}" alt="artwork"/>
                        </figure>
                    </div>
                    <div class="col-sm-8 content">
                        <h2>{{ $record->title }}</h2>
                        <p>
                            <small>artists:</small>
                            @foreach($record->artists as $artist)
                                {{ $record->artists[0]->name }},
                            @endforeach
                        </p>
                        <p>
                            <small>label:</small> {{ $record->label->name }}</p>
                        <p>
                            <small>catalog:</small>
                            [CAP001]!
                        </p>
                        <p>
                            <small>release date:</small>
                            20/10/2016
                        </p>
                        <p>
                            <small>format:</small>
                            12"
                        </p>
                        @include('includes.player', ['record'=>$record])
                        <hr>
                        <div>
                            <div class="pull-right">
                                <span>In stock</span>
                                <div style="position: relative; display: inline-block; height: 5px; width: 100px; background: #aaa;">
                                    <span style="position: absolute; top:0;display: block; height: 100%; width: 40%; background: #50734b;"></span>
                                </div>
                                <h3 style="display: inline-block">&euro; 10,5</h3>
                                <a href="#" class="btn btn-primary">Add to cart</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="other-releases">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h3>Other releases from <b>{{ $record->label->name }}</b></h3>
                    </div>
                </div>
            </div>
        </section>


    </main>
@endsection

@section('extra_js')
    <script src="{{ URL::to('js/wavesurfer.js') }}"></script>
    <script src="{{ URL::to('js/audioPlayer.js') }}"></script>

    <script>
    </script>
@endsection