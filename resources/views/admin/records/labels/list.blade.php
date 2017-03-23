<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal">
		<span aria-hidden="true">×</span><span class="sr-only">Close</span>
	</button>

	<i class="fa fa-users modal-icon"></i>
	<h4 class="modal-title">
		Manage Labels
	</h4>
</div>

<div class="modal-body">
	<div class="row row-5 m-b-sm">
		<div class="col-md-4">
			<a class="btn btn-primary btn-sm ajax-modal-btn" data-url="{{ route('ajax.record.label.editor') }}">
				<i class='fa fa-plus'></i> Add
			</a>
		</div>

		<div class="col-md-8">
			<form id="item-list-form" method="get" action="">
				<div class="input-group">
					<input type="text" name="keyword" placeholder="Search" class="input-sm form-control" value="">

					<span class="input-group-btn">
			            <button type="submit" class="btn btn-sm btn-primary"> Go!</button>
					</span>
				</div>
			</form>
		</div>
	</div>

	@if($labels->count())
		<div class="table-wrapper">
			<table class="table table-hover list">
				<tr>
					<th>Name</th>
					<th class="text-center">Select</th>
					<th class="text-center">Edit</th>
					<th class="text-center">Delete</th>
				</tr>

				@foreach($labels as $label)
					<tr {{ ($record and $record->label->id == $label->id) ? 'class=active' : '' }} data-item-id="{{ $label->id }}">
						<td>
							{{ $label->name }}
							@if(date('Y-m-d H:i:s', strtotime($label->updated_at)) > date('Y-m-d H:i:s', strtotime('-60 minutes')))
								<span style="color: orange">new</span>
							@endif
						</td>

						<td class="text-center">
							<a class="label-select-btn" data-item-id="{{ $label->id }}" data-item-name="{{ $label->name }}"
							   data-edit-url=""
							   data-delete-url="">
								<i class="fa fa-square-o"></i>
								<i class="fa fa-check-square-o"></i>
							</a>
						</td>

						<td class="text-center">
							<a class="ajax-modal-btn" data-url="{{ route('ajax.record.label.editor', ['label_id' => $label->id]) }}">
								<i class="fa fa-edit"></i>
							</a>
						</td>

						<td class="text-center">
							<a class="item-delete-btn" data-url="">
								<i class="fa fa-remove"></i>
							</a>
						</td>
					</tr>
				@endforeach
			</table>
		</div>
	@else
		<div>
			<h4>No labels found!</h4>
		</div>
	@endif
</div>

<div class="modal-footer">
	<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
</div>


