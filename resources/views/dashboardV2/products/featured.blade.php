<form action="{{ route('dashboard.products.change.featured.status') }}" style="display: inline-block" method="post">
{{ csrf_field() }}

@if(Auth::guard('merchant')->check())

@if(in_array($product->featured, [0,1,4,5]))
<input type="hidden" name="product_id" value="{{ $product->id }}">
<input type="hidden" name="featured" value="2">
<button class="btn btn-primary btn-sm">{{ trans('web.dashboard_products_featured_send') }}</button>
@elseif($product->featured == 2)
<input type="hidden" name="product_id" value="{{ $product->id }}">
<input type="hidden" name="featured" value="1">
<button class="btn btn-danger btn-sm">{{ trans('web.dashboard_products_featured_frsc') }}</button>
@else
<input type="hidden" name="product_id" value="{{ $product->id }}">
<input type="hidden" name="featured" value="1">
<button class="btn btn-danger btn-sm">{{ trans('web.dashboard_products_featured_fp') }}</button>
@endif

@else

@if(in_array($product->featured, [0,1,4,5]))
<input type="hidden" name="product_id" value="{{ $product->id }}">
<input type="hidden" name="featured" value="3">
<button class="btn btn-primary btn-sm">{{ trans('web.dashboard_products_featured_make') }} </button>
@elseif($product->featured == 2)
<input type="hidden" name="product_id" value="{{ $product->id }}">
<input type="hidden" name="featured" value="1">
<button class="btn btn-danger btn-sm">{{ trans('web.dashboard_products_featured_featured_req') }}</button>
@else
<input type="hidden" name="product_id" value="{{ $product->id }}">
<input type="hidden" name="featured" value="1">
<button class="btn btn-danger btn-sm">{{ trans('web.dashboard_products_featured_featured_prod') }}</button>
@endif

@endif
</form>
