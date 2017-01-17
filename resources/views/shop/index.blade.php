@extends('layouts.master')

@section('title')
    Shop
@endsection

@section('main')
    <main>
        <div class="container">

            {{--Records--}}
            <section class="row records">

                <div class="col-xs-12">
                    <h3>All Records</h3>
                </div>

                @foreach(\App\Models\Record::all() as $record)
                    <div class="col-md-2">
                        <div class="ibox">
                            <div class="ibox-content product-box record-wrapper">
                                <div class="product-imitation" style="padding: 0;">
                                    <figure>
                                        <a href="#">
                                            @if(Storage::disk('local')->has('records/' . strtolower($record->title)))
                                                <img src="{{ route('record.image', ['title' => strtolower($record->title)]) }}"/>
                                            @endif
                                            <span class="image-opacity"></span>
                                        </a>
                                    </figure>
                                </div>
                                <a href="{{ route('record', ['id'=>$record->id]) }}">
                                    <div class="product-desc">
                                        <span class="product-price">
                                            {{ $record->price }}
                                        </span>
                                        <small class="text-muted">
                                            @foreach($record->artists as $index => $artist)
                                                @if($index != 0)
                                                    ,
                                                @endif
                                                {{ $artist->name }}
                                            @endforeach
                                        </small>
                                        <a href="#" class="product-name"> {{ $record->title }}</a>


                                        {{--<div class="small m-t-xs">--}}
                                        {{--Many desktop publishing packages and web page editors now.--}}
                                        {{--</div>--}}
                                        <div class="m-t text-righ">
                                            <a href="#" class="btn btn-xs btn-outline btn-primary">Add to chart <i class="fa fa-long-arrow-right"></i> </a>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach


                {{--<div class="col-xs-12 col-sm-6 col-md-4">--}}
                    {{--<div class="record-wrapper">--}}
                        {{--<figure>--}}
                            {{--<a href="#">--}}
                                {{--@if(Storage::disk('local')->has('records/' . strtolower($record->title)))--}}
                                    {{--<img src="{{ route('record.image', ['title' => strtolower($record->title)]) }}"/>--}}
                                {{--@endif--}}
                                {{--<span class="image-opacity"></span>--}}
                            {{--</a>--}}
                        {{--</figure>--}}
                        {{--<div class="details">--}}
                            {{--<a href="{{ route('record', ['id'=>$record->id]) }}">--}}
                                {{--@foreach($record->artists as $index => $artist)--}}
                                    {{--@if($index != 0)--}}
                                        {{--,--}}
                                    {{--@endif--}}
                                    {{--{{ $artist->name }}--}}
                                {{--@endforeach--}}
                                {{--– {{ $record->title }}</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--@endforeach--}}
            </section>

        </div>
    </main>
@endsection
