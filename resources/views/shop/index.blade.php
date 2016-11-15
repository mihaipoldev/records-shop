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
                                    <img src="{{ asset('img/suolo.jpg') }}"/>
                                    <span class="image-opacity"></span>
                                </a>
                            </figure>
                            <div class="details">
                                <a href="#">
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

                <div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="record-wrapper">
                        <figure>
                            <a href="#">
                                <img src="{{ asset('img/lisiere_collectif.jpg') }}" style="width: 100%;"/>
                                <span class="image-opacity"></span>
                            </a>
                        </figure>
                        <div class="details">
                            <a href="#">Lisiere Collectif – Mulenv008 ( Vinyl Only )</a>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="record-wrapper">
                        <figure>
                            <a href="#">
                                <img src="{{ asset('img/tc80.jpg') }}" style="width: 100%;"/>
                                <span class="image-opacity"></span>
                            </a>
                        </figure>
                        <div class="details">
                            <a href="#">Tc80 – Mulenv008 ( Vinyl Only )</a>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </main>
@endsection
