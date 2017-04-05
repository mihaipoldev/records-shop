@extends('admin.layouts.master')

@section('title') Record Editor @endsection

@section('inspinia_style')
	<link href="{{ asset( 'libs/inspinia/css/plugins/iCheck/custom.css') }}" rel="stylesheet"/>
	<link href="{{ asset( 'libs/select2/select2.css') }}" rel="stylesheet"/>
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
						@include('admin.records.form')
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
						@include('admin.records.tracks.items')
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
	{{--<script src="{{ asset( 'libs/dropzone/dropzone.js' ) }}"></script>--}}
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
@endsection