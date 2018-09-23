@extends('layouts.site.app')

@section('content')
<section class="grid-shop">
    <!-- .grid-shop -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('web.home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Library</li>
                </ol>
            </div>
            <div class="col-sm-3 col-md-3">

                <search-parameters url="{{ route('web.products.ajax.search.parameters') }}"></search-parameters>

                <div class="weight">
                    <div class="title">
                        <h2>Compare products</h2>
                    </div>
                    <div class="ads-lft">
                        <p>You have no item to compare. </p>

                        @foreach($banners_side as $banner)
                        <a href="{{ $banner->url }}" class="banner">
                            <img src="{{ $banner->image_url }}" alt="{{ $banner->url }}" width="100%">
                        </a>
                        @endforeach
                        <!-- <img src="{{ asset('assets/site/images/add-banner2.jpg') }}" alt="add-banner2"/> -->
                    </div>
                </div>
                <div class="weight">
                    <div class="title">
                        <h2>BEST PRODUCTS</h2>
                    </div>
                    <div class="toprating-box">
                        <ul>
                            <li>
                                <div class="e-product">
                                    <div class="pro-img"> <img src="{{ asset('assets/site/images/products/5.jpg') }}" alt="2"> </div>
                                    <div class="pro-text-outer"> <span>Macbook, Laptop</span>
                                        <a href="single-product.html">
                                            <h4> Apple Macbook Retina 23’ </h4>
                                        </a>
                                        <p class="wk-price">$290.00 </p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-9 col-md-9">
                <div class="col-md-12 grid-banner">
                    <!-- <img src="{{ asset('assets/site/images/Grid-banner.png') }}" alt="Grid-banner" />  -->
                    @if($banner_top)
                    <a href="{{ $banner_top->url }}" class="banner">
                        <img src="{{ $banner_top->image_url }}" alt="{{ $banner_top->url }}">
                        <!-- asset('assets/site/images/add-banner-large4.jpg') -->
                    </a>
                    @endif
                </div>
                <div class="grid-spr">
                    <div class="col-sm-6 col-md-6">
                        <a href="shop-grid.html" :class="{'grid-view-icon' : grid_style , 'list-view-icon' : !grid_style}" @click.prevent="grid_style=true"><i class="fa fa-th-large" aria-hidden="true"></i></a>
                        <a href="shop-list.html" :class="{'grid-view-icon' : !grid_style , 'list-view-icon' : grid_style}" @click.prevent="grid_style=false"><i class="fa fa-list" aria-hidden="true"></i></a>
                        <div class="select-option">
                            <a class="btn btn-default btn-select options2">
                                <input type="hidden" class="btn-select-input" id="1" name="1" value="" />
                                <span class="btn-select-value">Select an Item</span>
                                <span class="btn-select-arrow fa fa-angle-down"></span>
                                <ul>
                                    <li class="{{ request()->get('sort' ,'newest') == 'newest' ? 'selected' : '' }}" @click="load(1,{sort : 'newest'})">Newest</li>
                                    <li class="{{ request()->get('sort') == 'popularity' ? 'selected' : '' }}" @click="load(1,{sort : 'popularity'})">Popularity</li>
                                    <li class="{{ request()->get('sort') == 'price_low_high' ? 'selected' : '' }}" @click="load(1,{sort : 'price_low_high'})">Price low to high</li>
                                    <li class="{{ request()->get('sort') == 'price_high_low' ? 'selected' : '' }}" @click="load(1,{sort : 'price_high_low'})">Price high to low</li>
                                    <li class="{{ request()->get('sort') == 'top_deals' ? 'selected' : '' }}" @click="load(1,{sort : 'top_deals'})">Top deals</li>
                                </ul>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 text-right"></div>
                </div>

                <grid url="{{ route('web.products.ajax.search' ,$_GET) }}" product_url="{{ route('web.show.product','zzz') }}" :products="products" :pagination="pagination" v-show="grid_style"></grid>
                <list url="{{ route('web.products.ajax.search' ,$_GET) }}" product_url="{{ route('web.show.product','zzz') }}" :products="products" :pagination="pagination" v-show="!grid_style"></list>

                <div class="col-xs-12">
                    <div class="grid-spr pag">
                        <pagination :limit="1"></pagination>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.grid-shop -->
</section>
@stop

@section('stylesheets')
<!--  Filter Price -->
<link rel="stylesheet" href="{{ asset('assets/site/css/slider.css') }}">
<style media="screen">
.product-categories>ul>li>a.active , .brands>ul>li>a.active{
    color: #b11e22;
}

a.grid-view-icon:hover ,a.grid-view-icon:focus{
    background: #B11E22;
    color: rgb(255, 255, 255);
}

.grid-shop .pro-text-outer:hover .add-btn2 {
    background: #333E48;
    border: 1px solid rgb(51, 62, 72);
    color: rgb(255, 255, 255);
}
.grid-shop .pro-text-outer .add-btn2:hover {
    background: #B11E22;
    border: 1px solid #B11E22;
    color: #fff;
}
.size a.active {
    border: 1px solid #b11e22;color: #fff;background: #b11e22;
}
.color a.active {
    border: 1px solid #b11e22;;
}
</style>
@stop

@section('scripts')
<script src="{{ asset('assets/site/js/filter-price.js') }}"></script>
<script src="{{ asset('assets/site/js/products/search.js') }}"></script>

<script type="text/javascript">
</script>
@stop
