<div class="modal inmodal in" id="new-artist" role="dialog" aria-hidden="true">
	<form action="{{ route('ajax.admin.artist.save') }}" method="POST" class="modal-dialog new-artist-from">
		<div class="modal-content animated bounceInRight">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
				<i class="fa fa-address-book modal-icon"></i>
				<h4 class="modal-title">New Artist</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label>Name:</label>
							<input class="form-control" name="name" value=""/>
						</div>
					</div>

					<div class="col-md-12">
						<div class="form-group">
							<label class="i-checks">
								<ins class="icheckbox_square-green">
									<input id="is-band" type="checkbox" name="is_band"/>
								</ins>
								Is Band
							</label>
						</div>
					</div>

					<div id="artist-is-band" class="hidden">
						<div class="col-md-12">
							<div class="form-group clearfix">
								<label class="control-label">Artists:</label>
								<select id="select-artists-for-band" name="artists-band[]" style="width: 100%; z-index: 9999;" multiple>
									@foreach(\App\Models\Artist::orderBy('name')->get() as $artist)
										<option value="{{ $artist->id }}">{{ $artist }}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Save changes</button>
				<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
			</div>

			{{ csrf_field() }}
		</div>
	</form>
</div>