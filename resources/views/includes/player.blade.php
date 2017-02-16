<div class="audio-player left-player">
	<div>
		<h3>
			{{ $record }}
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
			<li data-url="{{ URL::to($track->audio) }}"
			    data-track="{{ $track->title }}"
			    data-side="{{ $track->side }}"
			    data-artist="{{ $track->record->artists->first() }}">
				<div class="item {{ !$index ? 'active' : '' }}">{{ $track }}</div>
			</li>
		@endforeach
	</ul>

	<span id="save">
		save
	</span>

	<img src="" id="img"/>
	{{--<canvas id="analyser_render"></canvas>--}}
</div>


@section('player_js')
	<script src="{{ URL::to('js/wavesurfer.js') }}"></script>
	<script src="{{ URL::to('js/audioPlayer.js') }}"></script>

	<script>
		$(function() {
			$('#save').on('click', function(){
				putImage()
				console.log('ss');
			})
		});

		function putImage()
		{
			var canvas1 = $('canvas');
			if (canvas1[0].getContext) {
				var ctx = canvas1[0].getContext("2d");
				var myImage = canvas1[0].toDataURL("image/png").replace("image/png", "image/octet-stream");
			}
			var imageElement = document.getElementById("img");
			imageElement.src = myImage;

		}
	</script>
@endsection