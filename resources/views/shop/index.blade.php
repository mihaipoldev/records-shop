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

            @foreach($records as $record)
                <div class="col-md-4">
                    @include('shop.list.normal', ['record' => $record])
                </div>
            @endforeach

        </section>
    </main>
@endsection

@section('player')
    @include ('includes.player', ['record' => \App\Models\Record::all()[0]])
@endsection
