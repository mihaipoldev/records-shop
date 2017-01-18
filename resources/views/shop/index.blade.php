@extends('layouts.master')

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
