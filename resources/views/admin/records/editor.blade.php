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
			<div class="col-lg-12">
				<div class="tabs-container">
					<ul class="nav nav-tabs">
						<li>
							<a data-toggle="tab" href="#tab-1">Record info</a>
						</li>

						<li class="active">
							<a data-toggle="tab" href="#tracks">Tracks</a>
						</li>

						<li class="">
							<a data-toggle="tab" href="#tab-3">Images</a>
						</li>
					</ul>


					<div class="tab-content">
						<div id="tab-1" class="tab-pane">
							<div class="panel-body">
								<form class="form-horizontal">
									<div class="form-group">
										<label class="col-sm-2 control-label">Name:</label>
										<div class="col-sm-10">
											<input class="form-control" type="text" name="name" placeholder="Name" required
											       value="{{ old('name') ? old('name') : $record->name ? $record->name : '' }}">
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">Release Date:</label>
										<div class="col-sm-10">
											<input class="form-control" type="date" name="release_date" required
											       value="{{ old('release_date') ? old('release_date') : $record->release_date ? $record->release_date : '' }}">
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">Label:</label>
										<div class="col-sm-10">
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

									<div class="form-group">
										<label class="col-sm-2 control-label">Catalog:</label>
										<div class="col-sm-10">
											<input class="form-control" type="text" name="catalog" placeholder="Catalog" required
											       value="{{ old('catalog') ? old('catalog') : $record->catalog ? $record->catalog : '' }}">
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">Format:</label>
										<div class="col-sm-10">
											<input class="form-control" type="text" name="format" placeholder="Format" required
											       value="{{ old('format') ? old('format') : $record->format ? $record->format : '' }}">
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">Price:</label>
										<div class="col-sm-10">
											<input class="form-control" type="number" name="price" placeholder="Price" required
											       value="{{ old('price') ? old('price') : $record->price ? $record->price : '' }}">
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">Stock:</label>
										<div class="col-sm-10">
											<input class="form-control" type="number" name="stock" placeholder="Stock" required
											       value="{{ old('stock') ? old('stock') : $record->stock ? $record->stock : '' }}">
										</div>
									</div>

									<div class="form-group">
										<div class="col-sm-10 col-sm-offset-2">
											<label class="i-checks">
												<ins class="icheckbox_square-green">
													<input type="checkbox" name="online" {{ old('online') ? 'checked' : ($record->online ? 'checked' : '') }}/>
												</ins>
												Online
											</label>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-2 control-label">Description:</label>
										<div class="col-sm-10">
											<textarea class="form-control" name="description" rows="5" placeholder="Description"
											          required>{{ old('description') ? old('description') : $record->description ? $record->description : '' }}</textarea>
										</div>
									</div>

									@if($record->image)
										<img class="form-image" src="{{ asset($record->image) }}" style="width: 100px;"/>
									@else
										<img class="form-image" src="{{ asset('/uploads/no-image.png') }}" style="width: 100px;"/>
									@endif
								</form>
							</div>
						</div>

						<div id="tracks" class="tab-pane active">
							<div class="panel-body">
								@if(sizeof($record->tracks))
									@foreach($record->tracks as $index => $track)
										<form class="form-horizontal dropzone" method="post" action="" autocomplete="off" enctype="multipart/form-data">
											Track {{ $index + 1 }}

											<div class="form-group">
												<label class="col-sm-2 control-label">Name:</label>
												<div class="col-sm-10">
													<input class="form-control" type="text" name="t{{ $track->id }}_name" placeholder="Name" required
													       value="{{ old('t_' . $track->id . '_name') ? old('t_' . $track->id . '_name') : $track->name ? $track->name : '' }}">
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-2 control-label">Side:</label>
												<div class="col-sm-10">
													<input class="form-control" type="text" name="t{{ $track->id }}_side" placeholder="Side" required
													       value="{{ old('t_' . $track->id . '_side') ? old('t_' . $track->id . '_side') : $track->side ? $track->side : '' }}">
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-2 control-label">Format:</label>
												<div class="col-sm-10">
													<input class="form-control" type="text" name="t{{ $track->id }}_format" placeholder="Format" required
													       value="{{ old('t_' . $track->id . '_format') ? old('t_' . $track->id . '_format') : $track->format ? $track->format : '' }}">
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-2 control-label">Length:</label>
												<div class="col-sm-10">
													<input class="form-control" type="text" name="t{{ $track->id }}_length" placeholder="Length" required
													       value="{{ old('t_' . $track->id . '_length') ? old('t_' . $track->id . '_length') : $track->length ? $track->length : '' }}">
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-2 control-label">BPM:</label>
												<div class="col-sm-10">
													<input class="form-control" type="text" name="t{{ $track->id }}_bpm" placeholder="BPM" required
													       value="{{ old('t_' . $track->id . '_bpm') ? old('t_' . $track->id . '_bpm') : $track->bpm ? $track->bpm : '' }}">
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-2 control-label">BPM:</label>
												<div class="col-sm-10">
													<input class="form-control" type="text" name="t{{ $track->id }}_bpm" placeholder="BPM" required
													       value="{{ old('t_' . $track->id . '_bpm') ? old('t_' . $track->id . '_bpm') : $track->bpm ? $track->bpm : '' }}">
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-2 control-label">Player</label>
												<div class="col-sm-10">

													{{--@include('only-player')--}}

													{{--{{ dd(public_path() . '/' . $record->image) }}--}}

													@if(file_exists(public_path() . '/' . $track->audio))
														AUDIO
													@else
														NO AUDIO
													@endif

													<input type="file" name="t_{{ $track->id }}_audio"/>
												</div>
											</div>

											<div class="col-sm-10 col-sm-offset-2">
												SELECT ARTISTS
											</div>
											{{--poate fac ceva in gen (dadsada X), (sdasda (remix) X) + --}}

											<div class="form-group">
												<div class="col-sm-4 col-sm-offset-8">
													<button class="btn btn-primary pull-right" type="submit">Save changes</button>
												</div>
											</div>


											<div class="hr-line-dashed"></div>
										</form>
									@endforeach
								@endif
							</div>
						</div>

						<div id="tab-3" class="tab-pane">
							<div class="panel-body">
								<div class="table-responsive">
									<table class="table table-bordered table-stripped">
										<thead>
											<tr>
												<th>
													Image preview
												</th>
												<th>
													Image url
												</th>
												<th>
													Sort order
												</th>
												<th>
													Actions
												</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>
													{{--<img src="img/gallery/2s.jpg">--}}
												</td>
												<td>
													<input type="text" class="form-control" disabled value="http://mydomain.com/images/image1.png">
												</td>
												<td>
													<input type="text" class="form-control" value="1">
												</td>
												<td>
													<button class="btn btn-white"><i class="fa fa-trash"></i></button>
												</td>
											</tr>
										</tbody>
									</table>
								</div>

							</div>
						</div>
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
		$(document).ready(function() {
			$('.i-checks').iCheck({
				checkboxClass: 'icheckbox_square-green',
				radioClass: 'iradio_square-green',
			});
		});
		var Dropzone = require("dropzone");
	</script>
@endsection