<form id="item-editor-form" method="post" action="{{ route('ajax.record.label.save', ['label_id' => $label->id]) }}">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">
			<span aria-hidden="true">×</span><span class="sr-only">Close</span>
		</button>

		<i class="fa fa-user modal-icon"></i>
		<h4 class="modal-title">
			{{ $label->draft ? 'Add Label' : 'Edit Label' }}
		</h4>
	</div>

	<div class="modal-body">
		<div class="row row-5">
			<div class="col-sm-6">
				<div class="form-group">
					<label>Name</label>
					<input class="form-control" name="name" placeholder="Name" value="{{ $label->name }}"/>
				</div>
			</div>
		</div>
	</div>

	<div class="modal-footer">
		<a class="btn btn-white pull-left ajax-modal-btn" data-url="{{ route('ajax.record.labels') }}">
			<i class="fa fa-arrow-left"></i>
			Labels
		</a>

		<button type="submit" class="btn btn-primary form-submit-btn">Save Artist</button>

		<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
	</div>

	{{ csrf_field() }}
</form>