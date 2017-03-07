@extends('admin.layouts.master')

@section('title') Index @endsection

@section('inspinia_style')
	<link href="{{ asset( 'libs/inspinia/css/plugins/iCheck/custom.css') }}" rel="stylesheet"/>
@endsection

@section('head_js')
@endsection

@section('content')
	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-lg-10">
			<h2>Add Record</h2>
			<ol class="breadcrumb">
				<li>
					<a href="index.html">Admin</a>
				</li>
				<li>
					<a>Records</a>
				</li>
				<li class="active">
					<strong>Add Record</strong>
				</li>
			</ol>
		</div>
	</div>


	<main class="wrapper wrapper-content">
		<div class="row">
			<div class="col-lg-6">
				<div class="ibox">
					<div class="ibox-title basic-box">
						<h5><i class="fa fa-info-circle"></i> Basic</h5>

						<div class="ibox-tools">
							<a class="collapse-link">
								<i class="fa fa-chevron-up"></i>
							</a>

							<a class="fullscreen-link">
								<i class="fa fa-expand"></i>
							</a>
						</div>
					</div>

					<div class="ibox-content">
						<form method="post" action="">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">Name:</label>
										<input class="form-control" type="text" name="name" placeholder="Name" required
										       value="{{ old('name') ? old('name') : $record->name ? $record->name : '' }}">
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">Release Date:</label>
										<input class="form-control" type="date" name="release_date" required
										       value="{{ old('release_date') ? old('release_date') : $record->release_date ? $record->release_date : '' }}">
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">Label:</label>
										<select class="form-control" name="label" required>
											<option selected value disabled>--- select a label ---</option>
											@foreach(\App\Models\Label::orderBy('name')->get() as $label)
												<option value="{{ $label->id }}" {{ (old('label') and old('label') == $label->id) ? 'selected' : $record->label ? $record->label->id == $label->id ? 'selected' : '' : '' }}>
													{{ $label }}
												</option>
											@endforeach
										</select>
										<a href="#addNewLabel">new label</a>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">Catalog:</label>
										<input class="form-control" type="text" name="catalog" placeholder="Catalog" required
										       value="{{ old('catalog') ? old('catalog') : $record->catalog ? $record->catalog : '' }}">
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">Format:</label>
										<input class="form-control" type="text" name="format" placeholder="Format" required
										       value="{{ old('format') ? old('format') : $record->format ? $record->format : '' }}">
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">Price:</label>
										<input class="form-control" type="number" name="price" placeholder="Price" required
										       value="{{ old('price') ? old('price') : $record->price ? $record->price : '' }}">
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">Stock:</label>
										<input class="form-control" type="number" name="stock" placeholder="Stock" required
										       value="{{ old('stock') ? old('stock') : $record->stock ? $record->stock : '' }}">
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">Description:</label>
										<textarea class="form-control" name="description" rows="5" placeholder="Description"
										          required>{{ old('description') ? old('description') : $record->description ? $record->description : '' }}</textarea>
									</div>
								</div>

								<div class="col-md-6">
									@if($record->image)
										<img class="form-image" src="{{ asset($record->image) }}" style="width: 100px;"/>
									@else
										<img class="form-image" src="{{ asset('/uploads/no-image.png') }}" style="width: 100px;"/>
									@endif
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>

			<div class="col-lg-6">
				<div class="ibox">
					<div class="ibox-title basic-box">
						<h5><i class="fa fa-info-circle"></i> Tracks</h5>

						<div class="ibox-tools">
							<a class="collapse-link">
								<i class="fa fa-chevron-up"></i>
							</a>

							<a class="fullscreen-link">
								<i class="fa fa-expand"></i>
							</a>
						</div>
					</div>

					<div class="ibox-content">
						@if(sizeof($record->tracks))
							@foreach($record->tracks as $index => $track)
								@include('admin.records.tracks.editor', ['track' => $track, 'index' => $index])
							@endforeach
						@endif

						<div id="new-track"></div>

						<a id="add_track" href="{{ route('ajax.admin.track.add', ['record_id' => $record->id]) }}" class="btn btn-warning">Add new track</a>
					</div>
				</div>
			</div>
		</div>
	</main>
@endsection

@section('scripts')
	<script src="{{ asset( 'libs/inspinia/js/plugins/iCheck/icheck.min.js' ) }}"></script>
	<script src="{{ asset( 'libs/dropzone/dropzone.js' ) }}"></script>
	<script>
		//		$(document).ready(function() {
		//			$('.i-checks').iCheck({
		//				checkboxClass: 'icheckbox_square-green',
		//				radioClass: 'iradio_square-green',
		//			});
		//		});
		//		var Dropzone = require("dropzone");
	</script>
@endsection