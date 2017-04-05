<div class="modal-dialog">
	<div class="modal-content animated fadeIn">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">
				<span aria-hidden="true">×</span><span class="sr-only">Close</span>
			</button>

			{{--<i class="fa fa-user modal-icon"></i>--}}
			<h4 class="modal-title">
				Shopping Cart
			</h4>
		</div>

		<div class="modal-body">
			@if(Session::has('cart'))
				<ul class="list-group">
					@foreach($cart->items as $record)
						<li class="list-group-item">
							<span class="badge">{{ $record['qty'] }}</span>
							<strong>{{ $record['item'] }}</strong>
							<span class="label label-success">{{ $record['price'] }}</span>

							<div class="btn-group">
								<button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown">
									Action
									<span class="caret"></span>
								</button>

								<ul class="dropdown-menu">
									<li><a href="">reduce by 1</a></li>
									<li><a href="">reduce All</a></li>
								</ul>
							</div>
						</li>
					@endforeach
				</ul>

				<strong>Total price: {{ $cart->totalPrice }}</strong>
				<hr>

			@else

				<strong>no items</strong>
			@endif
		</div>

		<div class="modal-footer">
			<a class="ajax-open-btn btn btn-success" data-url="{{ route('checkout') }}" data-target="#ajax-modal">checkout</a>
			<button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
		</div>
	</div>
</div>