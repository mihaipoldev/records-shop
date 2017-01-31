{{--{{ dd($record) }}--}}

<div class="audio-player left-player">
    <div>
        <h3>
            {{ $record->title }}
        </h3>

        <h4>
            <span class="side"></span>
            <a class="track"></a>
            <small>by</small>
            <a class="artist"></a>
        </h4>

        <div class="left-bottom pull-right">
            <span style="display: inline-block; margin-right: 5px; color: forestgreen">
                <em>in stock</em>
            </span>
            <a href="#" class="btn-add pull-right">&euro; {{ $record->label_id }} <i class="fa fa-cart-plus"></i> </a>
        </div>
    </div>
    <div id="waveform"></div>
    <div class="clearfix"></div>
    <div class="controls">
        <div class="btn-player" id="prev">
            <i class="fa fa-fast-backward"></i>
        </div>
        <div class="btn-player" id="play" data-url="media/mihai-pol-goneta.mp3">
            <i class="fa fa-play fa-2x"></i>
        </div>
        <div class="btn-player hidden" id="pause">
            <i class="fa fa-pause fa-2x"></i>
        </div>
        <div class="btn-player" id="next">
            <i class="fa fa-fast-forward"></i>
        </div>
        <div class="btn-player" id="stop">
            <i class="fa fa-stop"></i>
        </div>
        <div class="volume-tool-wrapper">
            <i class="fa fa-volume-down"></i>
            <div class="volume-wrapper">
                <span id="volume" style="width: 30%"></span>
            </div>
            {{--<i class="fa fa-volume-up"></i>--}}
        </div>

        <div id="vol"></div>
    </div>
    <div id="time">
        <span id="current-time"></span>:
        <span id="total"></span>
    </div>
    <div class="clearfix"></div>
    <ul id="playlist">
        @foreach($record->tracks as $index => $track)
            <li data-url="{{ URL::to('audio/' . $track->audio_path) }}"
                data-track="{{ $track->title }}"
                data-side="{{ $track->side }}"
                data-artist="{{ $track->record->artists->first()->name }}">

                <div class="item {{ !$index ? 'active' : '' }}">{{ $track->title }}</div>
            </li>
        @endforeach
    </ul>
    {{--<canvas id="analyser_render"></canvas>--}}
</div>


@section('player_js')
    <script src="{{ URL::to('js/wavesurfer.js') }}"></script>
    <script src="{{ URL::to('js/audioPlayer.js') }}"></script>
@endsection