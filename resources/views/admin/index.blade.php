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
		<table class="table table-striped table-hover table-bordered" data-page-size="15">
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
							{{ $product->displayArtists() }}
						</td>

						<td>
							{{ $product->label->name . ' [' . $product->catalog . ']' }}
						</td>

						<td>
							{{ date('d F Y', strtotime($product->release_date)) }}
						</td>

						<td>
							&euro; {{ $product->price }}
						</td>

						<td>
							@if($product->stock > 0)
								<span style="color: green">{{ $product->stock }}</span>
							@else
								<span style="color: red">out of stock</span>
							@endif
						</td>

						<td>
							<a href="{{ route('admin.record.editor', ['record_id' => $product->id]) }}">
								<i class="fa fa-edit"></i>
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
	</main>
@endsection

@section('scripts')
@endsection