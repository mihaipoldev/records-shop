<div class="audio-player">
    <div id="info">
        <span id="artist"></span>-<span id="title"></span>
    </div>
    <div class="player-controls">
        <div class="btn-player" id="prev">
            <i class="fa fa-fast-backward"></i>
        </div>
        <div class="btn-player" id="play" data-url="{{ route('record.analyzer') }}" data-token="{{csrf_token()}}">
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
    </div>
    <div class="clearfix"></div>
    <div id="progress-bar">
        <span id="progress"></span>
    </div>
    <div id="time">
        <span id="elapsed"></span>:
        <span id="total"></span>
    </div>
    <div class="clearfix"></div>
    <ul id="playlist">
        <li data-url="{{ URL::to('audio/mihai-pol-goneta.mp3') }}">Goneta</li>
        <li data-url="{{ URL::to('audio/mihai-pol-science-friction.mp3') }}">Science Friction</li>
    </ul>
    <canvas id="analyser_render"></canvas>
</div>