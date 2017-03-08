<div class="panel panel-default">
	<div class="panel-heading">
		<h4 class="panel-title">
			<a data-toggle="collapse" data-parent="#accordion" href="#track{{ $index }}">{{ $track->name ? $track->name : 'Track' . $index }}</a>
		</h4>
	</div>

	<div id="track{{ $index }}" class="panel-collapse collapse" style="padding: 10px;">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class=control-label">Name:</label>
					<input class="form-control" type="text" name="tracks[{{ $track->id }}][name]" placeholder="Name" required
					       value="{{ old('tracks[' . $track->id . '][name]') ? old('tracks[' . $track->id . '][name]') : $track->name ? $track->name : '' }}">
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label">Side:</label>
					<input class="form-control" type="text" name="tracks[{{ $track->id }}][side]" placeholder="Side" required
					       value="{{ old('tracks[' . $track->id . '[side]') ? old('track_' . $track->id . '[side]') : $track->side ? $track->side : '' }}">
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label">Length:</label>
					<input class="form-control" type="text" name="tracks[{{ $track->id }}][length]" placeholder="Length"
					       value="{{ old('tracks[' . $track->id . '][length]') ? old('tracks[' . $track->id . '][length]') : $track->length ? $track->length : '' }}">
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label">BPM:</label>
					<input class="form-control" type="text" name="tracks[{{ $track->id }}][bpm]" placeholder="BPM"
					       value="{{ old('tracks[' . $track->id . '][bpm]') ? old('tracks[' . $track->id . '][bpm]') : $track->bpm ? $track->bpm : '' }}">
				</div>
			</div>

			<div class="col-md-12">
				<div class="form-group">
					<label class="control-label">Player</label>

					{{--@include('only-player')--}}

					{{--{{ dd(public_path() . '/' . $record->image) }}--}}

					@if(file_exists(public_path() . '/' . $track->audio))
						<div id="wave{{ $track->id }}" class="waveform" data-url="{{ URL::to($track->audio) }}" data-id="{{ $track->id }}">

						</div>
						@if(!$track->wave)
							<span class="save" data-id="{{ $track->id }}">SAVE</span>
						@endif
					@else
						NO AUDIO
					@endif

					<input class="dropzone" type="file" name="tracks_{{ $track->id }}_audio"/>
				</div>
			</div>

			<div class="col-md-6">
				SELECT ARTISTS
			</div>
			{{--poate fac ceva in gen (dadsada X), (sdasda (remix) X) + --}}
		</div>
	</div>
</div>