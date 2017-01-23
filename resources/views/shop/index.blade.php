@extends('layouts.master-columns')

@section('title')
    Shop
@endsection

@section('main')
    <main>
        {{--Records--}}
        <section class="row row-5 records">

            <div class="col-xs-12">
                <h3>All Records</h3>
            </div>

            @foreach(\App\Models\Record::all() as $record)
                <div class="col-md-4">
                    <div class="record-wrapper">
                        <figure>
                            <a href="#">
                                @if(Storage::disk('local')->has('records/' . strtolower($record->title)))
                                    <img src="{{ route('record.image', ['title' => strtolower($record->title)]) }}"/>
                                @endif
                                <span class="image-opacity"></span>
                            </a>
                            <div class="play-wrapper">
                                <a href="#"><i class="fa fa-play-circle"></i></a>
                            </div>
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
                            {{--<i class="fa fa-circle"></i>--}}
                            <div class="left-bottom">
                                <span style="display: inline-block; margin-right: 5px; color: forestgreen">
                                    <em>in stock</em>
                                </span>
                                <a href="#" class="btn-add pull-right">&euro; {{ $record->label_id }} <i class="fa fa-cart-plus"></i> </a>
                            </div>

                            {{--<a href="{{ route('record', ['id'=>$record->id]) }}">--}}
                            {{--@foreach($record->artists as $index => $artist)--}}
                            {{--@if($index != 0)--}}
                            {{--,--}}
                            {{--@endif--}}
                            {{--{{ $artist->name }}--}}
                            {{--@endforeach--}}
                            {{--– {{ $record->title }}</a>--}}
                        </div>
                    </div>
                </div>
            @endforeach
        </section>
    </main>
@endsection
