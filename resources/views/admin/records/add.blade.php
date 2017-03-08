@extends('admin.layouts.master')

@section('title') Index @endsection

@section('inspinia_style')
	<link href="{{ asset('libs/inspinia/css/plugins/morris/morris-0.4.3.min.css') }}" rel="stylesheet">
@endsection

@section('head_js')
@endsection

@section('content')
	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-lg-10">
			<h2>Product edit</h2>
			<ol class="breadcrumb">
				<li>
					<a href="index.html">Home</a>
				</li>
				<li>
					<a>E-commerce</a>
				</li>
				<li class="active">
					<strong>Product edit</strong>
				</li>
			</ol>
		</div>
	</div>

	<main class="wrapper wrapper-content">
		<div class="row">
			<div class="col-lg-12">
				<div class="tabs-container">
					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#tab-1"> Record info</a></li>
						<li class=""><a data-toggle="tab" href="#tab-2"> Data</a></li>
						<li class=""><a data-toggle="tab" href="#tab-3"> Images</a></li>
					</ul>
					<div class="tab-content">

						<div id="tab-1" class="tab-pane active">
							<div class="panel-body">
								<fieldset class="form-horizontal">
									<div class="form-group">
										<label class="col-sm-2 control-label">Name:</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" placeholder="Name">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Stats:</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" placeholder="Stats">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Price:</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" placeholder="Price">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Label:</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" placeholder="Label">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Catalog:</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" placeholder="Catalog">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Format:</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" placeholder="Format">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Release Date:</label>
										<div class="col-sm-10">
											<input type="date" class="form-control">
										</div>
									</div>
								</fieldset>
							</div>
						</div>

						<div id="tab-2" class="tab-pane">
							<div class="panel-body">
								<fieldset class="form-horizontal">
									<div class="form-group"><label class="col-sm-2 control-label">Quantity:</label>
										<div class="col-sm-10"><input type="text" class="form-control" placeholder="Quantity"></div>
									</div>
								</fieldset>
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
													<img src="img/gallery/2s.jpg">
												</td>
												<td>
													<input type="text" class="form-control" disabled value="http://mydomain.com/images/image1.png">
												</td>
												<td>
													<input type="text" class="form-control" value="1">
												</td>
												<td>
													<button class="btn btn-white"><i class="fa fa-trash"></i> </button>
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
@endsection