@extends('layouts.master')

@section('title')
    Shop
@endsection

@section('main')
    <main>
        <div class="container">
            <section class="row content">
                <div class="col-xs-6 col-xs-offset-3">
                    <h3>{{ $record->title }}</h3>
                </div>
                <div class="col-xs-6 col-xs-offset-3">
                    @include('includes.player')
                </div>
            </section>
        </div>
    </main>
@endsection
