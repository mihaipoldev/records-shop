<div class="modal-dialog ">
	<div class="modal-content animated fadeIn">
		<form class="color-form" method="post" action="{{ route('record.colors.save', ['record_id' => $record->id]) }}">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">×</span><span class="sr-only">Close</span>
				</button>

				<i class="fa fa-television modal-icon"></i>
				<h4 class="modal-title">
					Chose Color
				</h4>
			</div>

			<div class="modal-body">
				<div class="m-b-lg">
					<h3 class="m-b-md">Wave Color:</h3>

					<div class="m-b-sm" id="wave-color" data-color="{{ ($record->color and $record->color->wave) ? $record->color->wave : '#555' }}" style="width: 100%; height: 40px;"></div>

					<div class="text-left">
						<div class="colors">
							@foreach($colors['wave'] as $color)
								<span class="cp cp-circle {{ ($record->color and $record->color->wave == \App\Helpers\Helper::toHex($color)) ? 'active' : '' }}" data-type="wave" style="background-color: {{ $color }}"></span>
							@endforeach
						</div>
					</div>
				</div>

				<hr>

				<div class="clearfix m-b-lg">
					<h3 class="m-b-md">Background Color:</h3>

					<div id="background-gradient" class="m-b-sm"
					     style="width: 100%; height: 50px; background: linear-gradient(135deg, {{ ($record->color and $record->color->background_left) ? $record->color->background_right : '#eee' }} 0%, {{ ($record->color and $record->color->background_right) ? $record->color->background_right : '#ddd' }} 100%);"
					     data-background-left="{{ ($record->color and $record->color->background_left) ? $record->color->background_right : '#eee' }}"
					     data-background-right="{{ ($record->color and $record->color->background_right) ? $record->color->background_right : '#ddd' }}"></div>

					<div class="colors pull-left">
						@foreach($colors['background'] as $color)
							<span class="cp cp-circle {{ ($record->color and $record->color->background_left == \App\Helpers\Helper::toHex($color)) ? 'active' : '' }}"
							      style="background-color: {{ $color }}" data-type="background" data-pos="left"></span>
						@endforeach
					</div>

					<div class="colors pull-right">
						@foreach($colors['background'] as $color)
							<span class="cp cp-circle {{ ($record->color and $record->color->background_right == \App\Helpers\Helper::toHex($color)) ? 'active' : '' }}"
							      data-type="background"  data-pos="right">
								<ins style="background-color: {{ $color }}"></ins>
							</span>

								{{--<span class="color-p {{ ($record->color and $record->color->background_right == \App\Helpers\Helper::toHex($color)) ? 'active' : '' }}">--}}
									{{--<ins style="background-color: {{ $color }}"></ins>--}}
								{{--</span>--}}
						@endforeach
					</div>
				</div>

				<input type="hidden" name="wave" value="{{ $record->color ? $record->color->wave : '' }}"/>
				<input type="hidden" name="background-left" value="{{ $record->color ? $record->color->background_left : '' }}"/>
				<input type="hidden" name="background-right" value="{{ $record->color ? $record->color->background_right : '' }}"/>
			</div>

			<div class="modal-footer">
				<button class="btn btn-warning"><i class="fa fa-eye"></i></button>
				<button type="submit" class="btn btn-primary form-submit-btn">Save Changes</button>
				<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
			</div>

			{{ csrf_field() }}
		</form>
	</div>
</div>
