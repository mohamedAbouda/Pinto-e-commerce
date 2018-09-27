@extends('layouts.site.app')

@section('content')
<div class="container container-42">
	<ul class="breadcrumb">
		<li><a href="{{ url('/') }}">Home</a></li>
		<?php if ($product->subcategory): ?>
			<?php if ($product->subcategory->category): ?>
				<li>
					<a href="{{ route('web.products.shop' ,['section_id' => $product->subcategory->category->id]) }}">
						{{ $product->subcategory->category->name }}
					</a>
				</li>
			<?php endif; ?>
			<li>
				<a href="{{ route('web.products.shop' ,['sub_category_id' => $product->subcategory->id]) }}">
					{{ $product->subcategory->name }}
				</a>
			</li>
		<?php endif; ?>
		<li class="active">
			<a href="#">{{ $product->name }}
			</a>
		</li>
	</ul>
</div>
<div class="container">
	<div class="single-product-detail product-bundle space-50">
		<div class="row">
			<div class="col-xs-12 col-sm-5 col-md-6">
				<div class="product-images">
					<div class="main-img js-product-slider">
						@foreach($product->images as $image)
						<?php if ($image->image): ?>
							<a class="hover-images effect">
								<img src="{{ $image->image_url }}" alt="photo" class="img-reponsive">
							</a>
						<?php endif; ?>
						@endforeach
					</div>
				</div>
				<div class="multiple-img-list-ver2 js-click-product">
					@foreach($product->images as $image)
					<?php if ($image->image): ?>
						<div class="product-col">
							<div class="img active">
								<img src="{{ $image->image_url }}" alt="images" class="img-responsive">
							</div>
						</div>
					<?php endif; ?>
					@endforeach
				</div>
			</div>
			<div class="col-xs-12 col-sm-7 col-md-6">
				<div class="single-product-info">
					<div class="rating-star">
						<div class="icon-rating">
							<?php for($i = 1 ; $i <= $product->rate ; $i++): ?>
								<span class="star star-5"></span>
							<?php endfor; ?>
						</div>
						<span class="review">
							<?php if ($product->reviews): ?>
								({{ $product->reviews->count() }} customer review)
							<?php endif; ?>
						</span>
					</div>
					<h3 class="product-title space-pm">
						<a>
							{{ $product->name }}
						</a>
					</h3>
					<div class="product-price">
						<span>${{ $product->price }}</span>
					</div>
					<p class="product-desc">
						{{ $product->short_description }}
					</p>
					<div class="form-group">
						<label for="color">Color</label>
						<select class="form-control" id="color">
							<option selected disabled>Choose an option</option>
							@foreach($colors as $color)
							<?php if ($color): ?>
								<option value="{{ $color }}">{{ $color }}</option>
							<?php endif; ?>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label for="size">Size</label>
						<select class="form-control" id="size">
							<option selected disabled>Choose an option</option>
							@foreach($sizes as $size)
							<?php if ($size): ?>
								<option value="{{ $size }}">{{ $size }}</option>
							<?php endif; ?>
							@endforeach
						</select>
					</div>
					<div class="action">
						<div class="quantity">
							<button type="button" class="quantity-left-minus btn btn-number js-minus" data-type="minus" data-field="">
								<span class="minus-icon">-</span>
							</button>
							<input type="text" name="number" value="1" id="qty" class="qty product_quantity_number js-number">
							<button type="button" class="quantity-right-plus btn btn-number js-plus" data-type="plus" data-field="">
								<span class="plus-icon">+</span>
							</button>
						</div>
						<a class="link-ver1 add-cart" onclick="addCart({{ $product->id }})">Add To Cart</a>
						<a class="link-ver1 wish" onclick="wishlist({{ $product->id }});"><i class="icon-heart f-15"></i></a>
						<div class="clearfix"></div>
					</div>
					<div class="share-social">
						<span>Share :</span>
						<a href="#"><i class="fa fa-twitter"></i></a>
						<a href="#"><i class="fa fa-facebook"></i></a>
						<a href="#"><i class="fa fa-google-plus"></i></a>
						<a href="#"><i class="fa fa-pinterest-p"></i></a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--single-product-detail-->
</div>
<div class="container container-fullwidth">
	<div class="single-product-tab ver2">
		<ul class="nav nav-tabs text-center">
			<li class="active"><a data-toggle="pill" href="#desc">Description</a></li>
			<li><a data-toggle="pill" href="#info">Additional Information</a></li>
			<li><a data-toggle="pill" href="#review">Reviews (1)</a></li>
		</ul>
		<div class="tab-content">
			<div id="desc" class="tab-pane fade in active">
				<div class="tab-variable">
					<div class="col-xs-12 col-sm-6 col-md-6 column-1">
						<div class="product-images">
							<img src="{{ asset('assets/site/img/detail/MeUndies_SS17-1309_M-mb.png') }}" alt="photo" class="img-reponsive">
						</div>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-6 column-2">
						<div class="product-info-ver2 center text-center">
							<h3 class="product-title space-pm ver2 space-pm swith">Quilted Details and Steel Eyelets</h3>
							<p class="product-desc center">Cortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
				<!--end tab-group-->
				<div class="tab-variable-col">
					<div class="col-xs-12 col-md-4">
						<div class="product-info-ver2 v3">
							<h3 class="product-title space-pm"><a href="#">Pocket at chest</a></h3>
							<p class="product-desc left ">Cortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
						</div>
						<div class="product-info-ver2 v3">
							<h3 class="product-title space-pm"><a href="#">Relaxed fit</a></h3>
							<p class="product-desc left ">Cortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
						</div>
					</div>
					<div class="col-xs-12 col-md-4">
						<div class="product-images">
							<img src="{{ asset('assets/site/img/detail/variable_3.jpg') }}" alt="photo" class="product-images-middle img-reponsive">
						</div>
					</div>
					<div class="col-xs-12 col-md-4">
						<div class="product-info-ver2  v3   right">
							<h3 class="product-title space-pm ver3">100% Cotton</h3>
							<p class="product-desc right ">Cortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
						</div>
						<div class="product-info-ver2 v3 right">
							<h3 class="product-title space-pm ver3">Hidden button dow</h3>
							<p class="product-desc right ">Cortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
				<!--end tab-group-->
				<div class="tab-variable">
					<div class="col-xs-12 col-sm-6 col-md-6 column-2">
						<div class="product-info-ver2 center text-center">
							<h3 class="product-title space-pm ver2 space-pm swith">From Athletic To Casual</h3>
							<p class="product-desc center">Cortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
						</div>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-6 column-1">
						<div class="product-images">
							<img src="{{ asset('assets/site/img/detail/BirdsDownUnder-Boxer-2705.png') }}" alt="photo" class="img-reponsive">
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
				<!--end tab-group-->
			</div>
			<div id="info" class="tab-pane fade in">
				<p class="p-center space-padding-tb-30">Constructed in cotton sweat fabric, this lovely piece, lacus eu mattis auctor, dolor lectus venenatis nulla, at tristique eros sem vel ante. Sed leo enim, iaculis ornare tristique non, vulputate sit amet ante. Mauris placerat eleifend leo.</p>
			</div>
			<div id="review" class="tab-pane fade in ">
				<p class="p-center space-padding-tb-30">Constructed in cotton sweat fabric, this lovely piece, lacus eu mattis auctor, dolor lectus venenatis nulla, at tristique eros sem vel ante. Sed leo enim, iaculis ornare tristique non, vulputate sit amet ante. Mauris placerat eleifend leo.</p>
			</div>
		</div>
	</div>
</div>
<!--single-product-tab-->
<div class="information">
	<ul>
		<li class="info-center text-center"><span>SKU :</span>
			<a>{{ $product->sku }}</a>
		</li>
		<li class="info-center bd-rl text-center"><span>Category :</span>
			<?php if ($product->subcategory && $product->subcategory->category): ?>
				<a href="{{ route('web.products.shop' ,['section_id' => $product->subcategory->category->id]) }}">
					{{ $product->subcategory->category->name }}
				</a>
			<?php endif; ?>
		</li>
		<li class="info-center text-center"><span>Tags :</span>

		</li>
	</ul>
</div>
<div class="product-related">
	<div class="container container-42">
		<h3 class="title text-center">Related Products</h3>
		<div class="owl-carousel owl-theme js-owl-product">
			<div class="product-item">
				<div class="product-images">
					<a href="#" class="hover-images effect"><img src="{{ asset('assets/site/img/products/product_01.png') }}" alt="products" class="img-reponsive"></a>
					<a href="#" class="btn-add-wishlist ver2"><i class="icon-heart"></i></a>
					<a href="#" class="btn-quickview">QUICK VIEW</a>
				</div>
				<div class="product-info-ver2">
					<h3 class="product-title space-pm"><a href="#">Tia Slides in Brandy</a></h3>
					<div class="product-after-switch">
						<div class="product-price">$295.00</div>
						<div class="product-after-button">
							<a href="#" class="addcart">ADD TO CART</a>
						</div>
					</div>
					<div class="rating-star">
						<span class="star star-5"></span>
						<span class="star star-4"></span>
						<span class="star star-3"></span>
						<span class="star star-2"></span>
						<span class="star star-1"></span>
					</div>
					<div class="product-price">$292.00</div>
				</div>
			</div>
			<div class="product-item">
				<div class="product-images">
					<a href="#" class="hover-images effect"><img src="{{ asset('assets/site/img/products/product_02.png') }}" alt="photo" class="img-reponsive">
						<div class="ribbon-sale ver2"><span>sale</span></div>
					</a>
					<a href="#" class="btn-add-wishlist ver2"><i class="icon-heart"></i></a>
					<a href="#" class="btn-quickview">QUICK VIEW</a>
				</div>
				<div class="product-info-ver2">
					<h3 class="product-title space-pm"><a href="#">Alabama Tee</a></h3>
					<div class="product-after-switch">
						<div class="product-price">$295.00</div>
						<div class="product-after-button">
							<a href="#" class="addcart">ADD TO CART</a>
						</div>
					</div>
					<div class="rating-star">
						<span class="star star-5"></span>
						<span class="star star-4"></span>
						<span class="star star-3"></span>
						<span class="star star-2"></span>
						<span class="star star-1"></span>
					</div>
					<div class="product-price">$292.00</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop

@section('scripts')
<script type="text/javascript">
function checkQty(id) {
	var id = id;
	var qty = $('.qty').val();
	$('.spinner-container').show();

	$.ajax({
		type: "POST",
		url: "{{ route('web.check.product.quantity') }}",
		data: {
			_token: "{{ csrf_token() }}",
			id: id,
			qty:qty,
		},
		success: function(data) {
			if(data == 'stockSumNotAvailable'){
				swal("Sorry", "Product not available", "error");
			}
		}
	}).done(function(data) {
		$('.spinner-container').hide();
	});
}

$(document).ready(function(){
	var quantitiy = 0;
	$('.js-plus').on("click", function(e) {
		e.preventDefault();
		var quantity = parseInt($('.js-number').val(), 10);
		$('.js-number').val(quantity + 1);
		checkQty({{ $product->id }});
	});
	$('.js-minus').on("click", function(e) {
		e.preventDefault();
		var quantity = parseInt($('.js-number').val(), 10);
		if (quantity > 0) {
			$('.js-number').val(quantity - 1);
			checkQty({{ $product->id }});
		}
	});
});

</script>
@stop
