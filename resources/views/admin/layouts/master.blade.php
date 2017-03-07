<!DOCTYPE html>
<html>

	<head>

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<title>Admin | @yield('title')</title>

		<link href="{{ asset('libs/inspinia/css/bootstrap.min.css') }}" rel="stylesheet">
		<link href="{{ asset('libs/inspinia/font-awesome/css/font-awesome.css') }}" rel="stylesheet">

		@yield('inspinia_style')

		<link href="{{ asset('libs/inspinia/css/animate.css') }}" rel="stylesheet">
		<link href="{{ asset('libs/inspinia/css/style.css') }}" rel="stylesheet">
		<link href="{{ asset('css/admin-style.css') }}" rel="stylesheet">

		<link href="{{ asset( 'libs/inspinia/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css') }}" rel="stylesheet"/>
		@yield('styles')

		@yield('head_js')
	</head>

	<body>
		<div id="wrapper">

			<nav class="navbar-default navbar-static-side" role="navigation">
				<div class="sidebar-collapse">
					<ul class="nav metismenu" id="side-menu">
						<li class="nav-header">
							<div class="dropdown profile-element">
								<a data-toggle="dropdown" class="dropdown-toggle" href="#">
									<span class="clear">
										<span class="block m-t-xs"> <strong class="font-bold">Mihai Pol</strong></span>
									</span>
								</a>
							</div>
						</li>


						<li>
							<a href="#">
								<i class="fa fa-caret-down"></i>
								<span class="nav-label">Products</span>
							</a>
							<ul class="nav nav-second-level">
								<li>
									<a href="{{ route('admin.index') }}">
										<i class="fa fa-line-chart"></i> <span class="nav-label">Index</span>
									</a>
								</li>

								<li>
									<a href="{{ route('admin.records.add') }}">
										<i class="fa fa-line-chart"></i> <span class="nav-label">Add Product</span>
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</nav>

			<div id="page-wrapper" class="gray-bg">
				<div class="row border-bottom">
					@yield('top_header')

				</div>

				@yield('content')

				{{--<div style="height: 400px;"></div>--}}

			</div>
		</div>



		<script src="{{ asset( 'libs/inspinia/js/jquery-2.1.1.js' ) }}"></script>
		<script src="{{ asset( 'libs/inspinia/js/bootstrap.min.js' ) }}"></script>
		<script src="{{ asset( 'libs/inspinia/js/plugins/metisMenu/jquery.metisMenu.js' ) }}"></script>
		<script src="{{ asset( 'libs/inspinia/js/plugins/slimscroll/jquery.slimscroll.min.js' ) }}"></script>
		<script src="{{ asset( 'libs/inspinia/js/inspinia.js' ) }}"></script>
		<script src="{{ asset( 'libs/inspinia/js/plugins/pace/pace.min.js' ) }}"></script>
		<script src="{{ asset( 'js/admin.js' ) }}"></script>

		@yield('scripts')
	</body>

</html>