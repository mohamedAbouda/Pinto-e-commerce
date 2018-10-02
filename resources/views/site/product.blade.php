@extends('layouts.site.app')

@section('meta')
<!--  Essential META Tags -->
<meta property="og:title" content="{{ $product->name }}">
<meta property="og:description" content="{{ $product->short_description }}">
<meta property="og:image" content="{{ $product->cover_image_url }}">
<meta property="og:url" content="{{ route('web.products.show' ,$product->id) }}">
<meta name="twitter:card" content="summary_large_image">

<!--  Non-Essential, But Recommended -->
<meta property="og:site_name" content="Pinto | The World's Most Comfortable Underwears">
<meta name="twitter:image:alt" content="{{ $product->name }}">
@stop

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
			<a>{{ $product->name }}
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
						<span>${{ $product->discount ? $product->price - ($product->discount->discount * $product->price / 100) : $product->price }}</span>
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
						<a href="https://twitter.com/intent/tweet?text=<?=urlencode('Checkout this awesome product ' . $product->name);?>&url={{ route('web.products.show' ,$product->id) }}&via=Pinto"><i class="fa fa-twitter"></i></a>
						<a href="https://www.facebook.com/sharer/sharer.php?u=<?=urlencode('Checkout this awesome product ' . $product->name);?>"><i class="fa fa-facebook"></i></a>
						<a href="https://plus.google.com/share?url=<?=urlencode('Checkout this awesome product ' . $product->name);?>"><i class="fa fa-google-plus"></i></a>
						<a href="https://pinterest.com/pin/create/button/?url={{ route('web.products.show' ,$product->id) }}&media={{ $product->cover_image_url }}&description=<?=urlencode('Checkout this awesome product ' . $product->name);?>"><i class="fa fa-pinterest-p"></i></a>
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
				<?php if ($product->description_section_1_image): ?>
					<div class="tab-variable">
						<div class="col-xs-12 col-sm-6 col-md-6 column-1">
							<div class="product-images">
								<img src="{{ $product->description_section_1_image_url }}" alt="photo" class="img-reponsive">
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6 column-2">
							<div class="product-info-ver2 center text-center">
								<h3 class="product-title space-pm ver2 space-pm swith">
									{{ $product->description_section_1_head }}
								</h3>
								<p class="product-desc center">
									{{ $product->description_section_1_text }}
								</p>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
					<!--end tab-group-->
				<?php endif; ?>
				<?php if ($product->description_section_2_image): ?>
					<div class="tab-variable-col">
						<div class="col-xs-12 col-md-4">
							<div class="product-info-ver2 v3">
								<h3 class="product-title space-pm">
									{{ $product->description_section_2_head_1 }}
								</h3>
								<p class="product-desc left">
									{{ $product->description_section_2_text_1 }}
								</p>
							</div>
							<div class="product-info-ver2 v3">
								<h3 class="product-title space-pm">
									{{ $product->description_section_2_head_2 }}
								</h3>
								<p class="product-desc left">
									{{ $product->description_section_2_text_2 }}
								</p>
							</div>
						</div>
						<div class="col-xs-12 col-md-4">
							<div class="product-images">
								<img src="{{ $product->description_section_2_image_url }}" alt="photo" class="product-images-middle img-reponsive" style="border-radius: 50%;">
							</div>
						</div>
						<div class="col-xs-12 col-md-4">
							<div class="product-info-ver2 v3 right">
								<h3 class="product-title space-pm ver3">
									{{ $product->description_section_2_head_3 }}
								</h3>
								<p class="product-desc right ">
									{{ $product->description_section_2_text_3 }}
								</p>
							</div>
							<div class="product-info-ver2 v3 right">
								<h3 class="product-title space-pm ver3">
									{{ $product->description_section_2_head_4 }}
								</h3>
								<p class="product-desc right">
									{{ $product->description_section_2_text_4 }}
								</p>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
					<!--end tab-group-->
				<?php endif; ?>
				<?php if ($product->description_section_3_image): ?>
					<div class="tab-variable">
						<div class="col-xs-12 col-sm-6 col-md-6 column-2">
							<div class="product-info-ver2 center text-center">
								<h3 class="product-title space-pm ver2 space-pm swith">
									{{ $product->description_section_3_head }}
								</h3>
								<p class="product-desc center">
									{{ $product->description_section_3_text }}
								</p>
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6 column-1">
							<div class="product-images">
								<img src="{{ $product->description_section_3_image_url }}" alt="photo" class="img-reponsive">
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
					<!--end tab-group-->
				<?php endif; ?>
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
			@foreach($related_products as $product)
			<div class="product-item">
				<div class="product-images">
					<a href="{{ route('web.products.show' ,$product->id) }}" class="hover-images effect"><img src="{{ $product->cover_image_url }}" alt="products" class="img-reponsive"></a>
					<a class="btn-add-wishlist ver2" onclick="wishlist({{ $product->id }})"><i class="icon-heart"></i></a>
					<a class="btn-quickview">QUICK VIEW</a>
				</div>
				<div class="product-info-ver2">
					<h3 class="product-title space-pm"><a href="{{ route('web.products.show' ,$product->id) }}">{{ $product->name }}</a></h3>
					<div class="product-after-switch">
						<div class="product-price">${{ $product->discount ? $product->price - ($product->discount->discount * $product->price / 100) : $product->price }}</div>
						<div class="product-after-button">
							<a class="addcart" onclick="addCart({{ $product->id }})">ADD TO CART</a>
						</div>
					</div>
					<div class="rating-star">
						<?php for($i = 1 ; $i <= $product->rate ; $i++): ?>
							<span class="star star-5"></span>
						<?php endfor; ?>
					</div>
					<div class="product-price">${{ $product->discount ? $product->price - ($product->discount->discount * $product->price / 100) : $product->price }}</div>
				</div>
			</div>
			@endforeach
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
