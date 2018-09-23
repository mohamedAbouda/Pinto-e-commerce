@extends('layouts.site.app')
@section('content')
<section class="header-outer3">
    @include('site.index.parts.slider')
</section>
<section class="banner">
    @include('site.index.parts.banners')
</section>
<!-- deal-outer -->
<section class="deal-section deal-section2">
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <div class="title">
                    <h2 class="red-category" style="border-color:#b11e22">
                        Featured products
                    </h2>
                </div>
                <div class="electonics">
                    <div class="col-md-12">
                        <div class="row">
                            <!-- tab-content -->
                            <div class="tab-content grid-shop">
                                <!-- tab-pane -->
                                <div id="featured-products" class="tab-pane fade in active">
                                    <div class="owl-demo-outer">
                                        <!-- #owl-demo -->
                                        <div id="owl-demo36" class="deals-wk2">
                                            @foreach($featured as $product)
                                            @if ($loop->first || ($loop->iteration - 1) % 4 == 0)
                                            <div class="item">
                                                @endif
                                                <div class="col-xs-12 col-sm-3 col-md-3">
                                                    @include('site/parts/product')
                                                </div>
                                                @if ($loop->last || $loop->iteration % 4 == 0)
                                            </div>
                                            @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <!-- /tab-pane -->
                            </div>
                            <!-- /tab-content -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php if ($sections->has(0)): ?>
            <?php
            $section_index = 0;
            $section = $sections->get($section_index);
            ?>
            @include('site.index.parts.section')

            @if($banners_middle && $banner = $banners_middle->first())
            <div class="row">
                <div class="col-md-12">
                    <div class="half-banner">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-9 col-md-offset-3">
                                <a href="{{ $banner->url }}" class="banner">
                                    <img src="{{ $banner->image_url }}" alt="{{ $banner->url }}">
                                    <!-- asset('assets/site/images/add-banner-large4.jpg') -->
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        <?php endif; ?>

        <?php if ($sections->has(1)): ?>
            <?php
            $section_index = 1;
            $section = $sections->get($section_index);
            ?>
            @include('site.index.parts.section')

            @if($banners_middle && $banner = $banners_middle->last())
            <div class="row">
                <div class="col-md-12">
                    <div class="half-banner">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-9 col-md-offset-3">
                                <a href="{{ $banner->url }}" class="banner">
                                    <img src="{{ $banner->image_url }}" alt="{{ $banner->url }}">
                                    <!-- asset('assets/site/images/add-banner-large4.jpg') -->
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        <?php endif; ?>

        <?php if ($sections->has(2)): ?>
            <?php
            $section_index = 2;
            $section = $sections->get($section_index);
            ?>
            @include('site.index.parts.section')
        <?php endif; ?>

        <div class="row">
            <!-- free-shipping -->
            <div class="free-shipping">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-3" style="border-right:1px solid #b11e22;padding-top:15px;">
                        <div class="icon-shipping">
                            <i class="icon-rocket icons"></i>
                        </div>
                        <div class="shipping-text">
                            <h4>free shipping </h4>
                            <p>Free Shipping On All Order</p>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3" style="border-right:1px solid #b11e22;padding-top:15px;">
                        <div class="icon-shipping">
                            <i class="icon-earphones-alt icons"></i>
                        </div>
                        <div class="shipping-text">
                            <h4>online support 24/7</h4>
                            <p>Technical Support 24/7</p>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3" style="border-right:1px solid #b11e22;padding-top:15px;">
                        <div class="icon-shipping">
                            <i class="icon-refresh icons"></i>
                        </div>
                        <div class="shipping-text">
                            <h4>MONEY BACK GUARANTEE </h4>
                            <p>30 Day Money Back</p>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3" style="padding-top:15px;">
                        <div class="icon-shipping">
                            <i class="icon-badge icons"></i>
                        </div>
                        <div class="shipping-text">
                            <h4>MEMBER DISCOUNT</h4>
                            <p>Upto 40% Discount</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /free-shipping -->
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script type="text/javascript">
    CountDown();
</script>
@stop
