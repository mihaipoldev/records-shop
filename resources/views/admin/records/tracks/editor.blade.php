<div class="panel panel-default">
	<div class="panel-heading">
		<h4 class="panel-title">
			<a data-toggle="collapse" data-parent="#accordion" href="#track{{ $index }}">{{ $track->name ? $track->name : 'Track' . $track->id }}</a>
		</h4>
	</div>

	<div id="track{{ $index }}" class="panel-collapse collapse" style="padding: 10px;">
{{--		<form method="post" action="{{ route('ajax.admin.track.save', ['track_id' => $track->id]) }}" autocomplete="off" enctype="multipart/form-data">--}}
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class=control-label">Name:</label>
						<input class="form-control" type="text" name="tracks[{{ $track->id }}][name]" placeholder="Name" required
						       value="{{ old('track_' . $track->id . '[name]') ? old('track_' . $track->id . '[name]') : $track->name ? $track->name : '' }}">
					</div>
				</div>

				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label">Side:</label>
						<input class="form-control" type="text" name="tracks[{{ $track->id }}][side]" placeholder="Side" required
						       value="{{ old('track_' . $track->id . '[side]') ? old('track_' . $track->id . '[side]') : $track->side ? $track->side : '' }}">
					</div>
				</div>

				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label">Length:</label>
						<input class="form-control" type="text" name="tracks[{{ $track->id }}][length]" placeholder="Length"
						       value="{{ old('t_' . $track->id . '[length]') ? old('t_' . $track->id . '[length]') : $track->length ? $track->length : '' }}">
					</div>
				</div>

				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label">BPM:</label>
						<input class="form-control" type="text" name="tracks[{{ $track->id }}][bpm]" placeholder="BPM"
						       value="{{ old('track_' . $track->id . '[bpm]') ? old('track_' . $track->id . '[bpm]') : $track->bpm ? $track->bpm : '' }}">
					</div>
				</div>

				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label">Player</label>

						{{--@include('only-player')--}}

						{{--{{ dd(public_path() . '/' . $record->image) }}--}}

						@if(file_exists(public_path() . '/' . $track->audio))
							AUDIO
						@else
							NO AUDIO
						@endif

						<input class="dropzone" type="file" name="t_{{ $track->id }}_audio"/>
					</div>
				</div>

				<div class="col-md-6">
					SELECT ARTISTS
				</div>
				{{--poate fac ceva in gen (dadsada X), (sdasda (remix) X) + --}}

				{{--<div class="form-group">--}}
					{{--<div class="col-sm-4 col-sm-offset-8">--}}
						{{--<button class="btn btn-primary pull-right" type="submit">Save changes</button>--}}
					{{--</div>--}}
				{{--</div>--}}
			</div>
		</form>
	</div>
</div>