<header>
	<nav class="navbar">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>

						<a class="navbar-brand" href="{{ route('record.list') }}">Brand</a>
					</div>

					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav navbar-right">
							<li>
								<a class="ajax-open-btn" data-url="{{ route('record.shopping-cart') }}" data-toggle="modal" data-target="#ajax-modal">
									<i class="fa fa-shopping-cart"></i> Shopping cart
									<span class="badge">{{ Session::has('cart') ? Session::get('cart')->totalQty : '' }}</span>
								</a>
							</li>

							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
									<i class="fa fa-user"></i>
									User Account
									<span class="caret"></span>
								</a>

								<ul class="dropdown-menu">
									<li><a href="#">Login & Register</a></li>
									<li><a href="#">My Account</a></li>
									<li><a href="#">Logout</a></li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</nav>
</header>