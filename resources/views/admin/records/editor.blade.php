@extends('admin.layouts.master')

@section('title') Index @endsection

@section('inspinia_style')
	<link href="{{ asset( 'libs/inspinia/css/plugins/iCheck/custom.css') }}" rel="stylesheet"/>
	<link href="{{ asset( 'libs/select2/select2.css') }}" rel="stylesheet"/>
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
						<form method="post" action="{{ route('ajax.admin.record.save', ['record_id' => $record->id]) }}">
							<div class="row row-10">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">Name:</label>
										<input class="form-control" type="text" name="name" placeholder="Name" required
										       value="{{ old('name') ? old('name') : $record->name ? $record->name : '' }}">
									</div>

									<div class="form-group">
										<label class="control-label">Label:</label>

										<div>
											@if($record->label)
												<span id="label-text" style="display: inline-block; height: 20px; line-height: 20px;">
													{{ $record->label }}
												</span>

												<input id="label-input" type="hidden" name="label_id" value="{{ $record->label->id }}"/>
											@else
												No Label Selected
											@endif

											<a class="pull-right ajax-modal-btn" data-url="{{ route('ajax.record.labels', ['record_id' => $record]) }}" data-toggle="modal" data-target="#modal">
												<i class="fa fa-cog" style="font-size: 20px; color: #555"></i>
											</a>
										</div>

									</div>

									<div class="form-group">
										<label class="control-label">Release Date:</label>
										<input class="form-control" type="date" name="release_date" required
										       value="{{ old('release_date') ? old('release_date') : $record->release_date ? $record->release_date : '' }}">
									</div>

									<div class="row row-5">
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
									</div>
								</div>

								{{-- ATANTION!!!!!! cand e new record nu se poate adauga imagine --}}
								<div class="col-md-6">
									<figure class="record-artwork">
										<img id="record-image" class="form-image" src="{{ asset($record->image ? $record->image : '/uploads/no-image.png') }}" style="width: 100%;"/>

										<div id="ceva">

										</div>
										<input id="record-image-input" class="hidden" type="file" data-url="{{ route('ajax.admin.record.save.image', ['record_id' => $record->id]) }}"/>
										<label for="record-image-input" class="change-btn">Change</label>

										<div class="background"></div>
									</figure>
								</div>

								<div class="col-md-12">
									<div id="artists-form-group" class="form-group clearfix">
										<label class="control-label">Artists:</label>

										<div id="artists-display">
											@foreach($record->artists as $artist)
												<div class="artist-selection" data-artist-id="{{ $artist->id }}">
													<span>{{ $artist->name }}</span>
													<i class="fa fa-cog artist-edit" data-url="{{ route('ajax.record.artist.editor', ['artist_id' => $artist->id]) }}" data-toggle="modal"
													   data-target="#artists-modal"></i>
													<i class="fa fa-remove artist-remove" data-delete-url="{{ route('ajax.record.artist.delete', ['artist_id' => $artist->id]) }}"></i>
													<input class="artist-input" type="hidden" name="artists[]" value="{{ $artist->id }}"/>
												</div>
											@endforeach
										</div>

										<a id="manage-artists-btn" class="pull-right clearfix" data-url="{{ route('ajax.record.artists') }}" data-toggle="modal" data-target="#artists-modal">
											<i class="fa fa-cog" style="font-size: 20px; color: #555"></i>
										</a>
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

								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label">Description:</label>
										<textarea class="form-control" name="description" rows="5" placeholder="Description"
										          required>{{ old('description') ? old('description') : $record->description ? $record->description : '' }}</textarea>
									</div>
								</div>


								{{ csrf_field() }}

								<div class="col-md-12">
									<button class="btn btn-primary pull-right" type="submit">Save changes</button>
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
							<form method="post" action="{{ route('ajax.admin.track.save.many', ['record_id' => $record->id]) }}" autocomplete="off" enctype="multipart/form-data">
								@foreach($record->tracks as $index => $track)
									@include('admin.records.tracks.editor2', ['track' => $track, 'index' => $index])
								@endforeach

								<div id="new-track"></div>

								<a id="add_track" href="{{ route('ajax.admin.track.add', ['record_id' => $record->id]) }}" class="btn btn-warning">Add new track</a>

								{{ csrf_field() }}

								<div class="form-group clearfix m-b-sm">
									<div class="col-sm-4 col-sm-offset-8 clearfix">
										<button class="btn btn-primary pull-right" type="submit">Save changes</button>
									</div>
								</div>
							</form>
						@endif

					</div>
				</div>
			</div>
		</div>
	</main>
	<img src="" id="img"/>

	<form id="theform" method="post" action="{{ route('save.image') }}">
		<input type="hidden" id="theinput" name="src" value=""/>
		{{ csrf_field() }}
	</form>

	@include('admin.records.artists.modal')
	@include('admin.modals.modal')
@endsection

@section('scripts')

	<script src="{{ asset( 'libs/inspinia/js/plugins/iCheck/icheck.min.js' ) }}"></script>
	<script src="{{ asset( 'libs/dropzone/dropzone.js' ) }}"></script>
	<script src="{{ asset( 'libs/select2/select2.js' ) }}"></script>



	<script src="{{ URL::to('js/wavesurfer.js') }}"></script>
	{{--<script src="{{ URL::to('js/audioPlayer.js') }}"></script>--}}
	<script type="text/javascript">
		if($.ui && $.ui.dialog && $.ui.dialog.prototype._allowInteraction) {
			var ui_dialog_interaction = $.ui.dialog.prototype._allowInteraction;
			$.ui.dialog.prototype._allowInteraction = function(e) {
				if($(e.target).closest('.select2-dropdown').length) return true;
				return ui_dialog_interaction.apply(this, arguments);
			};
		}

		$.fn.modal.Constructor.prototype.enforceFocus = function() {
		};
		$('#select-artists').select2();
		$('#select-artists-for-band').select2();

	</script>
	<script>
		$(function() {



//			$('body').on('submit', 'form.new-artist-from', function(event){
//				event.preventDefault();
//
//				var url = $(this).attr('action');
//
//				$.ajax({
//					type: "POST",
//					url: url,
//					success: function(result) {
//						$('#new-artist').modal('toggle');
//					}
//				});
//			})


			$('.i-checks').iCheck({
				checkboxClass: 'icheckbox_square-green',
				radioClass: 'iradio_square-green',
			})
					.on('ifToggled', function(event) {
						jQuery(this).trigger('change');
					});


			$('body').on('change', 'input#is-band', function(event) {
				if($(this).parent().hasClass('checked')) {
					$('#artist-is-band').addClass('hidden');
				}
				else {
					console.log('ssss');
					$('#artist-is-band').removeClass('hidden');
				}
			});

//			var wavesurfer = WaveSurfer.create({
//				container: '#waveform',
//				height: 40,
//				waveColor: color,
//				progressColor: color1,
//				cursorColor: '#555',
//			});


			$('.save').on('click', function(event) {
				event.preventDefault();
				var $element = $('#wave' + $(this).data('id'));
				initWavesurfer2($element);
				setTimeout(function() {
					putImage($element);
				}, 1500);

				setTimeout(function() {
					$('#theinput').val($('#img').attr('src'));
					$('#theform').submit();
				}, 2200);
			})
		});


		function initWavesurfer2($element) {
			var url = $element.data('url');

			wavesurfer = WaveSurfer.create({
				container: '#' + $element.attr('id'),
				height: 40,
				waveColor: '#bbb',
				progressColor: '#777',
				cursorColor: '#555',
			});

			wavesurfer.load(url);
//			$activeTrack = $element;

		}
		function putImage($element) {
			var canvas1 = $element.find('canvas');
			if(canvas1[0].getContext) {
				var ctx = canvas1[0].getContext("2d");
				var myImage = canvas1[0].toDataURL("image/png").replace("image/png", "image/octet-stream");
			}
			var imageElement = document.getElementById("img");
			imageElement.src = myImage;

		}
	</script>

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