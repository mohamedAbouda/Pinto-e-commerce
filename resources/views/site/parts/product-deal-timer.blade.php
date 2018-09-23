<!-- .pro-text -->
<div class="pro-text text-center">
    <!-- .pro-img -->
    <div class="pro-img">
        <img src="{{ $product->cover_image_url }}" alt="{{ $product->name }}">
    </div>
    <!-- /.pro-img -->
    <div class="text-text">
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
    <!-- clockdiv -->
    <div id="clockdiv" class="count-down" data-end-date='{{ $product->discount->activation_end }}'>
        <h4>Hurry Up! Offer ends in:</h4>
        <div>
            <span class="days">14</span>
            <div class="smalltext">Days</div>
        </div>
        <div>
            <span class="hours">23</span>
            <div class="smalltext">Hours</div>
        </div>
        <div>
            <span class="minutes">59</span>
            <div class="smalltext">Minutes</div>
        </div>
        <div>
            <span class="seconds">47</span>
            <div class="smalltext">Seconds</div>
        </div>
    </div>
    <!-- /clockdiv -->
</div>
<!-- /.pro-text -->
