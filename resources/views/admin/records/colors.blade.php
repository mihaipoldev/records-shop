<div class="modal-dialog">
	<div class="modal-content animated fadeIn">
		<form method="post" action="">
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
				<div class="form-group">
					{{--<div class="plates">--}}
						{{--<div class="color-plate" style="background-color: #3DADEE">--}}
							{{--<div class="text">#3DADEE</div>--}}
						{{--</div>--}}

						{{--<div class="color-plate" style="background-color: #A6CE41">--}}
							{{--<div class="text">#A6CE41</div>--}}
						{{--</div>--}}

						{{--<div class="color-plate" style="background-color: #E3E433">--}}
							{{--<div class="text">#E3E433</div>--}}
						{{--</div>--}}

						{{--<div class="color-plate" style="background-color: #4B494F">--}}
							{{--<div class="text">#4B494F</div>--}}
						{{--</div>--}}

						{{--<div class="color-plate" style="background-color: #FAFAFA">--}}
							{{--<div class="text">#FAFAFA</div>--}}
						{{--</div>--}}
					{{--</div>--}}

					<div class="row row-5">
						<div class="col-md-1 text-ce">
							<div style="width: 100%; height: 80px; margin-top: 10px; background-color: #3DADEE">
								{{--<div class="text">#FAFAFA</div>--}}
							</div>
						</div>

						<div class="col-md-10">
							<div style="width: 100%; height: 100px; background: linear-gradient(135deg, #3DADEE 0%, #A6CE41 100%);">

							</div>
						</div>

						<div class="col-md-1">
							<div style="width: 100%; height: 80px; margin-top: 10px; background-color: #A6CE41">
								{{--<div class="text">#FAFAFA</div>--}}
							</div>
						</div>
					</div>



					<div class="row">
						<div class="col-md-4 text-center">
								<label>Background 1: </label>
								<div>
									<div class="color-plate color-plate-sm" style="background-color: #4B494F">
										{{--<div class="text">#FAFAFA</div>--}}
									</div>
								</div>
						</div>

						<div class="col-md-4 text-center">
								<label>Background 2: </label>
								<div>
									<div class="color-plate color-plate-sm" style="background-color: #E3E433">
										{{--<div class="text">#FAFAFA</div>--}}
									</div>
								</div>
						</div>

						<div class="col-md-4 text-center">
							<label>Background 2: </label>
							<div>
								<div class="color-plate color-plate-sm" style="background-color: #3DADEE">
									{{--<div class="text">#FAFAFA</div>--}}
								</div>
							</div>

						</div>
					</div>


				</div>
				<div id="wave-color" style="width: 100%; height: 40px;" ></div>
			</div>

			<div class="modal-footer">
				<button type="submit" class="btn btn-primary form-submit-btn">Save</button>
				<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
			</div>

			{{ csrf_field() }}
		</form>
	</div>
</div>
