@extends('layouts.site.app')

@section('content')
<div class="page-heading">
    <div class="banner-heading">
        <img src="{{ asset('assets/site/img/headerbg_2.jpg') }}" alt="" class="img-reponsive">
        <div class="heading-content text-center">
            <div class="container container-42">
                <h1 class="page-title white">Shop</h1>
                <ul class="breadcrumb white">
                    <li><a href="{{ url('/') }}">home</a></li>
                    <li><a href="">Shop All Products</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="nav nav-tabs nav-justified nav-filter white">
        <ul class="owl-carousel owl-theme js-owl-category">
            <li class="{{ request()->get('section_id') ? '' : 'active' }}"><a href="{{ route('web.products.shop') }}">All</a></li>
            @foreach($categories as $category)
            <li class="{{ request()->get('section_id') == $category->id ? 'active' : '' }}"><a href="{{ route('web.products.shop' ,['section_id' => $category->id]) }}">{{ $category->name }}</a></li>
            @endforeach
        </ul>
    </div>
</div>
<div class="wrap-filter">
    <div class="wrap-filter-box wrap-filter-number">
        <span class="total-count">Showing @{{ pagination.from }}-@{{ pagination.to }} of @{{ pagination.total }} products</span>
    </div>
    <div class="wrap-filter-box text-center view-mode">
        <a class="col" onClick="return false;"><span class="icon-grid-img"></span></a>
    </div>

    <div class="wrap-filter-box text-center js-filter">
        <a class="filter-title"><i class="icon-equalizer"></i></a>
        <search-filter url="{{ route('web.products.ajax.search.parameters') }}"></search-filter>
    </div>
    <div class="wrap-filter-box text-center view-mode">
        <a class="list" onClick="return false;"><span class="icon-list-img"></span></a>
    </div>
    <div class="wrap-filter-box wrap-filter-sorting">
        <button class="dropdown-toggle" type="button" data-toggle="dropdown" id="menu2">
            Sort by @{{ sort_by_placeholder_text }}
        </button>
        <ul class="dropdown-menu" role="menu" aria-labelledby="menu2">
            <li @click="load(1,{sort : 'newest'});sort_by_placeholder_text='newest'">
                <a>
                    newest
                </a>
            </li>
            <li @click="load(1,{sort : 'popularity'});sort_by_placeholder_text='popularity'">
                <a>
                    popularity
                </a>
            </li>
            <li @click="load(1,{sort : 'price_low_high'});sort_by_placeholder_text='price low to high'">
                <a>
                    price low to high
                </a>
            </li>
            <li @click="load(1,{sort : 'price_high_low'});sort_by_placeholder_text='price high to low'">
                <a>
                    price high to low
                </a>
            </li>
            <li @click="load(1,{sort : 'top_deals'});sort_by_placeholder_text='top deals'">
                <a>
                    top deals
                </a>
            </li>
        </ul>
    </div>
    <div class="clearfix"></div>
</div>

<div class="container container-42 shop-sidebar">
    <div class="row">
        <div class="col-md-3 col-sm-3 collection-sidebar">
            <div class="product-standard filter-product">
                <search-parameters url="{{ route('web.products.ajax.search.parameters') }}"></search-parameters>
                <div class="sidebar-banner">
                    <a href=""><img src="{{ asset('assets/site/img/sidebar-banner.jpg') }}" alt="" class="img-reponsive"></a>
                </div>
            </div>
        </div>
        <div class="col-md-9 col-sm-9 collection-list">
            <div class="product-standard product-grid">
                <div class="tab-content">
                    <div id="all" class="tab-pane fade in active">

                        <grid url="{{ route('web.products.shop' ,$_GET) }}" product_url="{{ route('web.products.show','zzz') }}" :products="products" :pagination="pagination" v-show="grid_style"></grid>
                        <pagination :limit="1"></pagination>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('scripts')
<script type="text/javascript">
window.toggleExpansion = function(elm) {
    if (!elm) {
        elm = this;
    }
    $(elm).toggleClass('minus');
    $(elm).parent().find(".filter-menu").slideToggle(function() {
        $(this).next().stop(true).toggleClass('open', $(this).is(":visible"));
    });
};
</script>
{{ Html::script('assets/site/js/products/search.js') }}
@stop
