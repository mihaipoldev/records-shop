<div class="modal-dialog">
	<div class="modal-content animated fadeIn">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">
				<span aria-hidden="true">×</span><span class="sr-only">Close</span>
			</button>

			{{--<i class="fa fa-user modal-icon"></i>--}}
			<h4 class="modal-title">
				Checkout
			</h4>
		</div>

		<div class="modal-body">
			<h4>Your total: ${{ $cart->totalPrice }}</h4>

			<form method="post" action="">
				<div class="row">
					<div class="col-xs-12">
						<div class="form-group">
							<label>Name:</label>
							<input name="name" class="form-control" required/>
						</div>
					</div>

					<div class="col-xs-12">
						<div class="form-group">
							<label>Address:</label>
							<input name="address" class="form-control" required/>
						</div>
					</div>

					<div class="col-xs-12">
						<div class="form-group">
							<label>Card Holder Name:</label>
							<input name="card-name" class="form-control" required/>
						</div>
					</div>

					<div class="col-xs-12">
						<div class="form-group">
							<label>Card Number:</label>
							<input name="card-number" class="form-control" required/>
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							<label>Expiration Month:</label>
							<input name="card-expiry-month" class="form-control" required/>
						</div>
					</div>

					<div class="col-xs-6">
						<div class="form-group">
							<label>Expiration Year:</label>
							<input name="card-expiry-year" class="form-control" required/>
						</div>
					</div>

					<div class="col-xs-12">
						<div class="form-group">
							<label>CVC:</label>
							<input name="card-cvc" class="form-control" required/>
						</div>
					</div>
				</div>
			</form>
		</div>

		<div class="modal-footer">
			<a href="{{ route('checkout') }}" type="button" class="btn btn-success">checkout</a>
			<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
		</div>
	</div>
</div>