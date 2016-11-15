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
                    <div class="col-xs-12 col-sm-6 col-md-4">
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
                                <a href="{{ route('record', ['id'=>$record->id]) }}">
                                    @foreach($record->artists as $index => $artist)
                                        @if($index != 0)
                                            ,
                                        @endif
                                        {{ $artist->name }}
                                    @endforeach
                                    – {{ $record->title }}</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </section>

        </div>
    </main>
@endsection
