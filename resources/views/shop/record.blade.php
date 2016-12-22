@extends('layouts.master')

@section('title')
    Shop
@endsection

@section('main')
    <main>
        <div class="container">
            <section class="row">
                <div class="col-sm-4 image-column">
                    <figure>
                        <img src="{{ asset('img/records/mihai-pol-goneta/artwork.jpg') }}" alt="artwork"/>
                    </figure>
                </div>
                <div class="col-sm-8 content">
                    <h3>{{ $record->artists[0]->name }} - {{ $record->title }}</h3>
                    <p><small>label:</small> {{ $record->label->name }}</p>
                    <p><small>release date:</small>{{ $record->date }}</p>
                    @include('includes.player', ['record'=>$record])
                </div>
            </section>
        </div>
    </main>
@endsection

@section('extra_js')
    <script src="{{ URL::to('js/wavesurfer.js') }}"></script>
    <script src="{{ URL::to('js/audioPlayer.js') }}"></script>

    <script>
    </script>
@endsection