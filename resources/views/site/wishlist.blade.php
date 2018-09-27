@extends('layouts.site.app')

@section('content')
<div class="main-content space-padding-tb-70">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1">
				<div>
					<div class="text-center">
						<h3>Wishlist</h3>
					</div>

					<div class="table-responsive custom-table space-padding-tb-60">
						<table class="table" style="width: 100%;">
							<thead>
								<tr>
									<th>#</th>
									<th>Image</th>
									<th>Product</th>
									<th>Unit Price</th>
									<th></th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								@foreach($wishlist as $item)
								<tr>
									<td>1</td>
									<td><img src="{{ $item->product->cover_image_url }}" class="img-responsive" width="80" height="80"></td>
									<td>{{ $item->product->name }}</td>
									<td>${{ $item->product->discount ? $item->product->price - ($item->product->discount->discount * $item->product->price) : $item->product->price }}</td>
									<td>
										<a class="edit-cart" title="edit cart" onclick="addCart({{ $item->product_id }})"><i class="icon-basket"></i> Add to Cart </a>
									</td>
									<td>
										{{ Form::open(['route' => 'web.wishlist.delete']) }}
										<button type="submit" class="btn" style="background-color: transparent;outline:none;" name="id" value="{{ $item->id }}"><i class="icon-trash"></i></button>
										{{ Form::close() }}
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end main content-->
@stop
