<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal">
		<span aria-hidden="true">×</span><span class="sr-only">Close</span>
	</button>

	<i class="fa fa-users modal-icon"></i>
	<h4 class="modal-title">
		Manage Artists for {{ $track }}
	</h4>
</div>

<div class="modal-body">
	<div class="row row-5 m-b-sm">
		<div class="col-md-4">
			<a id="artist-add-btn" data-url="{{ route('ajax.record.artist.editor') }}" class="btn btn-primary btn-sm">
				<i class='fa fa-plus'></i> Add
			</a>
		</div>

		<div class="col-md-8">
			<form id="artist-list-form" method="get" action="">
				<div class="input-group">
					<input type="text" name="keyword" placeholder="Search" class="input-sm form-control" value="">

					<span class="input-group-btn">
			            <button type="submit" class="btn btn-sm btn-primary"> Go!</button>
					</span>
				</div>
			</form>
		</div>
	</div>

	@if($artists->count())
		<div class="table-wrapper">
			<table class="table table-hover list-track" data-track-id="{{ $track->id }}">
				<tr>
					<th>Name</th>
					<th class="text-center">Select</th>
					<th class="text-center">Edit</th>
					<th class="text-center">Delete</th>
				</tr>

				@foreach($artists as $artist)
					<tr data-artist-id="{{ $artist->id }}" data-track-id="{{ $track->id }}">
						<td>
							{{ $artist }}
							@if(date('Y-m-d H:i:s', strtotime($artist->updated_at)) > date('Y-m-d H:i:s', strtotime('-60 minutes')))
								<span style="color: orange">new</span>
							@endif
						</td>

						<td class="text-center">
							<a class="track-artist-select-btn" data-artist-id="{{ $artist->id }}" data-artist-name="{{ $artist->name }}"
							   data-edit-url="{{ route('ajax.record.artist.editor', ['artist_id' => $artist->id]) }}"
							   data-delete-url="{{ route('ajax.record.artist.delete', ['artist_id' => $artist->id]) }}">
								<i class="fa fa-square-o"></i>
								<i class="fa fa-check-square-o"></i>
							</a>
						</td>

						<td class="text-center">
							<a class="artist-editor-btn" data-url="{{ route('ajax.record.artist.editor', ['artist_id' => $artist->id]) }}"
							   data-toggle="tooltip" data-html="true" title="<i class='fa fa-edit'> Edit Artist">
								<i class="fa fa-edit"></i>
							</a>
						</td>

						<td class="text-center">
							<a class="artist-delete-btn" data-url="{{ route('ajax.record.artist.delete', ['artist_id' => $artist->id]) }}"
							   data-toggle="tooltip" data-html="true" title="<i class='fa fa-remove'></i> Delete Artist">
								<i class="fa fa-remove"></i>
							</a>
						</td>
					</tr>
				@endforeach
			</table>
		</div>
	@else
		<div>
			<h4>No artists found!</h4>
		</div>
	@endif
</div>

<div class="modal-footer">
	<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
</div>


