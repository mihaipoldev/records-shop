@extends('layouts.master-columns')

@section('title')
    Shop
@endsection

@section('main')
    <main>
        <section class="item">
            {{--<div class="container">--}}
            <div class="row">
                <div class="col-sm-4 image-column">
                    <figure>
                        @if(Storage::disk('local')->has('records/' . strtolower($record->title)))
                            <img src="{{ route('record.image', ['title' => strtolower($record->title)]) }}"/>
                        @endif
                        {{--<img src="{{ asset('img/records/mihai-pol-goneta/artwork.jpg') }}" alt="artwork"/>--}}
                    </figure>
                </div>
                <div class="col-sm-8 content">
                    <h2>{{ $record->title }} EP</h2>
                    <div class="info-wrapper">
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
                    </div>

                    {{--@include('includes.player', ['record'=>$record])--}}
                    <div class="audio-player">
                        <div class="tracklist-wrapper">
                            <h3 class="title">Track list</h3>
                            <ul id="playlist">
                                @foreach($record->tracks as $index => $track)
                                    <li data-url="{{ URL::to('audio/' . $track->audio_path) }}">
                                        <div class="item {{ !$index ? 'active' : '' }}"><span>{{ $track->side }}:</span> {{ $track->title }}</div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <hr>
                    <div class="chart-wrapper">
                        <div class="pull-right">
                            {{--<div style="position: relative; display: inline-block; height: 5px; width: 100px; background: #aaa;">--}}
                            {{--<span style="position: absolute; top:0;display: block; height: 100%; width: 40%; background: #50734b;"></span>--}}
                            {{--</div>>--}}
                            <div class="btn-wrapper">
                                <a href="#" class="btn btn-primary pull-right">Add to cart</a>
                            </div>
                            <div class="stock-percentage clearfix">
                                <h3 class="price"><b>&euro; 10.5</b></h3>
                                <span class="stock-bar active"></span>
                                <span class="stock-bar active"></span>
                                <span class="stock-bar active"></span>
                                <span class="stock-bar active"></span>
                                <span class="stock-bar"></span>
                                <span class="stock-bar"></span>
                                <span class="stock-bar"></span>
                                <span class="stock-bar"></span>
                                <span class="stock-bar"></span>
                                <span class="stock-bar"></span>
                                <span class="info"><b>IN STOCK</b></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--</div>--}}
        </section>

        <section class="other-releases">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h3>Other releases from <b>{{ $record->label->name }}</b></h3>
                    </div>
                </div>
                <div class="row">
                    @foreach($record->label->records as $labelRecord)
                        @if($labelRecord->id != $record->id)
                            <div class="col-md-3">
                                <div class="record-wrapper">
                                    <figure>
                                        <a href="#">
                                            @if(Storage::disk('local')->has('records/' . strtolower($record->title)))
                                                <img src="{{ route('record.image', ['title' => strtolower($record->title)]) }}"/>
                                            @endif
                                            <span class="image-opacity"></span>
                                        </a>
                                    </figure>
                                    <div class="details">


                                        <small class="text-muted">
                                            @foreach($record->artists as $index => $artist)
                                                @if($index != 0)
                                                    ,
                                                @endif
                                                {{ $artist->name }}
                                            @endforeach
                                        </small>
                                        <a href="{{ route('record', ['id'=>$record->id]) }}" class="product-name"> {{ $record->title }}</a>

                                        <a href="#" class="btn pull-right" style="padding: 0 10px; height: 20px; line-height: 20px;">Add to chart <i class="fa fa-long-arrow-right"></i> </a>

                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
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