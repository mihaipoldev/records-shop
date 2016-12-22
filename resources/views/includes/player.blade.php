<div id="audio-player">
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
        <input id="volume" type="range" min="0" max="10" value="5" style="display: inline-block; width: 150px;"/>
        <div id="vol"></div>
    </div>
    <div class="clearfix"></div>
    <div id="waveform"></div>
    <div id="time">
        <span id="current-time"></span>:
        <span id="total"></span>
    </div>
    <div class="clearfix"></div>
    <ul id="playlist">
        @foreach($record->tracks as $track)
            <li data-url="{{ URL::to('audio/' . $track->audio_path) }}">
                <div class="item">{{ $track->title }}</div>
            </li>
        @endforeach
    </ul>
    <canvas id="analyser_render"></canvas>
</div>