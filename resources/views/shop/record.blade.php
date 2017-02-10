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
                            <img src="{{ asset($record->image_path) }}"/>
                        {{--<img src="{{ asset('img/records/mihai-pol-goneta/artwork.jpg') }}" alt="artwork"/>--}}
                    </figure>
                </div>
                <div class="col-sm-8 content">
                    <h2>{{ $record->name }} EP</h2>
                    <div class="info-wrapper">
                        <p>
                            <small>artists:</small>
                            @foreach($record->artists as $artist)
                                <a href="#">{{ $record->artists[0]->name }}</a>,
                            @endforeach
                        </p>
                        <p>
                            <small>label:</small>
                            <a href="#label-releases">{{ $record->label->name }}</a>
                        </p>
                        <p>
                            <small>catalog:</small>
                            {{ $record->catalog }}
                        </p>
                        <p>
                            <small>release date:</small>
                            {{ date('d.m.Y', strtotime($record->release_date)) }}
                        </p>
                        <p>
                            <small>format:</small>
                            {{ $record->format }}
                        </p>
                    </div>

                    {{--@include('includes.player', ['record'=>$record])--}}
                    <div class="audio-player">
                        <div class="tracklist-wrapper">
                            <h3 class="title">Track list</h3>
                            <ul id="playlist">
                                @foreach($record->tracks as $index => $track)
                                    <li data-url="{{ URL::to('audio/' . $track->audio_path) }}" data-track="{{ $track->title }}" data-side="{{ $track->side }}">
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

        <section class="other-releases" id="label-releases" name="label-releases">
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
                                @include('shop.list.normal', ['record' => $labelRecord])
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>

        @foreach($record->artists as $artist)
            <section class="other-releases" id="artist-{{ $artist }}">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3>Other releases from <b>{{ $artist->name }}</b></h3>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($artist->records as $artistRecord)
                            @if($artistRecord->id != $record->id)
                                <div class="col-md-3">
                                    @include('shop.list.normal', ['record' => $artistRecord])
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </section>
        @endforeach
    </main>
@endsection

@section('player')
    @include ('includes.player', ['record' => $record])
@endsection