<!-- .pro-text -->
<div class="pro-text text-center">
    <!-- .pro-img -->
    <div class="pro-img">
        <img src="{{ $product->cover_image_url }}" alt="{{ $product->name }}">
        @if($product->discount)
        <sup class="sale-tag">
            sale!
        </sup>
        @endif
        @if($product->featured == 1)
        <sup class="sale-tag" style="right: 5px;left:inherit;">
            Hot!
        </sup>
        @endif
        <!-- .hover-icon -->
        <div class="hover-icon">
            <a onclick="wishlist({{ $product->id }})"><span class="icon icon-Heart"></span></a>
            <a href="{{ route('web.show.product' ,$product->id) }}"><span class="icon icon-Search"></span></a>
            <a onclick="addCompare({{ $product->id }})"><span class="icon icon-Restart"></span></a>
        </div>
        <!-- /.hover-icon -->
    </div>
    <!-- /.pro-img -->
    <div class="pro-text-outer">
        <span>
            {{ $product->subCategory->name }}
        </span>
        <a href="{{ route('web.show.product' ,$product->id) }}">
            <h4>
                {{ $product->name }}
            </h4>
        </a>
        <p class="wk-price">
            ${{ $product->discount ? $product->price - ($product->discount->percentage * $product->price / 100) : $product->price }}
        </p>
    </div>
</div>
<!-- /.pro-text -->
