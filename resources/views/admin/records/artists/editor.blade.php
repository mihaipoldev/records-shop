<form id="artist-editor-form" method="post" action="{{ route('ajax.record.artist.save', $artist ? ['artist_id' => $artist->id] : []) }}">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">
			<span aria-hidden="true">×</span><span class="sr-only">Close</span>
		</button>

		<i class="fa fa-user modal-icon"></i>
		<h4 class="modal-title">
			{{ $artist ? 'Edit Artist' : 'Add Artist' }}
		</h4>
	</div>

	<div class="modal-body">
		<div class="row row-5">
			<div class="col-sm-6">
				<div class="form-group">
					<label>Name</label>
					<input class="form-control" name="name" placeholder="Name" value="{{ $artist ? $artist->name : '' }}"/>
				</div>
			</div>

			<div class="col-sm-6">
				<div class="form-group is-company">
					<label class="i-checks">
						<ins class="icheckbox_square-green">
							<input type="checkbox" name="is_band" {{ ($artist and $artist->is_band) ? 'checked' : '' }}/>
						</ins>
						Is Band?
					</label>
				</div>
			</div>
		</div>

		<div id="is-band-check" {{ $artist ? $artist->is_band ? '' : 'class=hidden' : 'class=hidden'  }}>
			<div class="row row-5" style="max-height: 400px; overflow-y: auto;">
				@foreach(\App\Models\Artist::orderBy('name')->get() as $loopArtist)
					<div class="col-sm-3">
						<div class="form-group">
							<label class="i-checks">
								<ins class="icheckbox_square-green">
									<input type="checkbox" name="band-artists[]" value="{{ $loopArtist->id }}" {{ ($artist and $artist->artists()->where('artist_id', $loopArtist->id)->first()) ? 'checked' : '' }}/>
								</ins>
								{{ $loopArtist }}
							</label>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</div>

	<div class="modal-footer">
		<a id="artist-list-btn" data-url="{{ route('ajax.record.artists') }}" class="btn btn-white pull-left">
			<i class="fa fa-arrow-left"></i>
			Artists
		</a>

		<button type="submit" class="btn btn-primary form-submit-btn">{{ $artist ? 'Save Artist' : 'Add Artist' }}</button>

		<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
	</div>

	{{ csrf_field() }}
</form>