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
			<h2>Index</h2>
			<ol class="breadcrumb">
				<li>
					<a href="index.html">Index</a>
				</li>
				<li class="active">
					<strong>Dashboard</strong>
				</li>
			</ol>
		</div>
	</div>

	<main class="wrapper wrapper-content">

		<div class="ibox-content m-b-sm border-bottom">
			<div class="row">
				<div class="col-sm-4">
					<div class="form-group">
						<label class="control-label" for="product_name">Product Name</label>
						<input type="text" id="product_name" name="product_name" value="" placeholder="Product Name" class="form-control">
					</div>
				</div>
				<div class="col-sm-2">
					<div class="form-group">
						<label class="control-label" for="price">Price</label>
						<input type="text" id="price" name="price" value="" placeholder="Price" class="form-control">
					</div>
				</div>
				<div class="col-sm-2">
					<div class="form-group">
						<label class="control-label" for="quantity">Quantity</label>
						<input type="text" id="quantity" name="quantity" value="" placeholder="Quantity" class="form-control">
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<label class="control-label" for="status">Status</label>
						<select name="status" id="status" class="form-control">
							<option value="1" selected>Enabled</option>
							<option value="0">Disabled</option>
						</select>
					</div>
				</div>
			</div>

		</div>

		<div class="row">
			<div class="col-lg-12">
				<div class="ibox">
					<div class="ibox-content">

						<table class="table table-striped" data-page-size="15">
							<thead>
								<tr>

									<th>#</th>
									<th>Name</th>
									<th>Artists</th>
									<th>Label</th>
									<th>Release Date</th>
									<th>Price</th>
									<th>Quantity</th>
									<th>Edit</th>
									<th>Delete</th>

								</tr>
							</thead>
							<tbody>

								@foreach($products as $key => $product)
									<tr>
										<td>
											{{ $key + 1 }}
										</td>
										<td>
											{{ $product->name }}
										</td>
										<td>
											{{ 'art' . $product->catalog }}
										</td>
										<td>
											{{ $product->label->name . ' [' . $product->catalog . ']' }}
										</td>
										<td>
											{{ date('Y-m-d', strtotime($product->release_date)) }}
										</td>
										<td>
											&euro; {{ $product->price }}
										</td>
										<td>
											@if($product->quantity > 0)
												<span style="color: green">{{ $product->quantity }}</span>
											@else
												<span style="color: red">out of stock</span>
											@endif
										</td>


										<td>
											<a href="">
												<span data-toggle="tooltip" data-html="true" title="<i class='fa fa-info-circle'> {{ trans( 'messages.edit' ) }}">
													<i class="fa fa-edit"></i>
												</span>
											</a>
										</td>

										<td>
											<a href="" style="color: #953b39;">
												<span data-toggle="tooltip" data-html="true" title="<i class='fa fa-info-circle'> {{ trans( 'messages.delete' ) }}">
													<i class="fa fa-trash"></i>
												</span>
											</a>
										</td>
									</tr>
								@endforeach
							</tbody>
							<tfoot>
								<tr>
									<td colspan="6">
										<ul class="pagination pull-right"></ul>
									</td>
								</tr>
							</tfoot>
						</table>

					</div>
				</div>
			</div>
		</div>



	</main>
@endsection

@section('scripts')
@endsection