<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Basic page needs
    ============================================ -->
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="keywords" content="boostrap, responsive, html5, css3, jquery, theme, multicolor, parallax, retina, business" />
    <meta name="author" content="Magentech">
    <meta name="robots" content="index, follow" />

    <!-- Mobile specific metas
    ============================================ -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Favicon
    ============================================ -->

    <link rel="shortcut icon" href="ico/favicon.png') }}">

    <!-- Google web fonts
    ============================================ -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700|Roboto:400,500,700,900' rel='stylesheet' type='text/css'>

    <!-- Libs CSS
    ============================================ -->
    <link rel="stylesheet" href="{{ asset('assets/web/css/bootstrap/css/bootstrap.min.css') }}">
    <link href="{{ asset('assets/web/css/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/web/js/datetimepicker/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/web/js/owl-carousel/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/web/css/themecss/lib.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/web/js/jquery-ui/jquery-ui.min.css') }}" rel="stylesheet">

    <!-- Theme CSS
    ============================================ -->
    <link href="{{ asset('assets/web/css/themecss/so_megamenu.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/web/css/themecss/so-categories.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/web/css/themecss/so-listing-tabs.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/web/css/themecss/slider.css') }}" rel="stylesheet">
    <link id="color_scheme" href="{{ asset('assets/web/css/home7.css') }}" rel="stylesheet">
   
    <link href="{{ asset('assets/web/css/responsive.css') }}" rel="stylesheet">

    @yield('stylesheets')
    
</head>

<body class="common-home res layout-home7">
   
    <div id="wrapper" class="wrapper-full banners-effect-7">
        <!-- Header Container  -->
        <header id="header" class=" variantleft type_7">
            <!-- Header Top -->
            <div class="header-top compact-hidden">
                <div class="container">
                    <div class="row">
                        <div class="header-top-left  col-lg-4  hidden-sm col-md-5 hidden-xs">

                        </div>
                        <div class="header-top-right collapsed-block col-lg-8 col-sm-12 col-md-7 col-xs-12 ">
                            <h5 class="tabBlockTitle visible-xs">More<a class="expander " href="#TabBlock-1"><i class="fa fa-angle-down"></i></a></h5>
                            <div class="tabBlock" id="TabBlock-1">
                                <ul class="top-link list-inline">

                                    @if(!Auth::user())
                                    <li>
                                        <a href="{{ route('web.register') }}">
                                            <i class="fa fa-user"></i> Register
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('web.login') }}">
                                            <i class="fa fa-pencil-square-o"></i> Login
                                        </a>
                                    </li>
                                    @else
                                    <li class="account" id="my_account">
                                        <a href="#" title="My Account" class="btn btn-xs dropdown-toggle" data-toggle="dropdown"> <span >My Account</span> <span class="fa fa-angle-down"></span></a>
                                        <ul class="dropdown-menu ">
                                            <li><a href="{{ route('web.logout') }}"><i class="fa fa-pencil-square-o"></i> Logout</a></li>
                                        </ul>
                                    </li>
                                    @endif
                                    <!-- <li class="account" id="my_account">
                                    <a href="#" title="My Account" class="btn btn-xs dropdown-toggle" data-toggle="dropdown"> <span >My Account</span> <span class="fa fa-angle-down"></span></a>
                                    <ul class="dropdown-menu ">
                                    <li><a href="register.html"><i class="fa fa-user"></i> Register</a></li>
                                    <li><a href="login.html"><i class="fa fa-pencil-square-o"></i> Login</a></li>
                                </ul>
                            </li> -->

                            <li class="cart">
                                <a href="{{ route('web.cart.index') }}" class="" title="Cart ({{ \Cart::instance('default')->content()->count() }})">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span>Cart (<span class="cart-header-count">{{ \Cart::instance('default')->count() }}</span>)</span>
                                </a>
                            </li>
                            <li class="wishlist ">
                                <a href="{{ route('web.wishlist.index') }}" id="wishlist-total" class="top-link-wishlist" title="Wish List ({{ \Cart::instance('wishlist')->content()->count() }})">
                                    <span>Wish List (<span class="wishlist-header-count">{{ \Cart::instance('wishlist')->content()->count() }}</span>)</span>
                                </a>
                            </li>
                            <li class="checkout hidden"><a href="checkout.html" class="top-link-checkout" title="Checkout"><span >Checkout</span></a></li>
                            <li class="login hidden"><a href="cart.html" title="Shopping Cart"><span >Shopping Cart</span></a></li>

                            <!-- <li class="form-group languages-block ">
                                <form action="index.html" method="post" enctype="multipart/form-data" id="bt-language">
                                    <a class="btn btn-xs dropdown-toggle" data-toggle="dropdown">
                                        <img src="{{ asset('assets/web/image/demo/flags/gb.png') }}" alt="English" title="English">
                                        <span class="">English</span>
                                        <span class="fa fa-angle-down"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="index.html"><img class="image_flag" src="{{ asset('assets/web/image/demo/flags/gb.png') }}" alt="English" title="English" /> English </a></li>
                                        <li> <a href="index.html"> <img class="image_flag" src="{{ asset('assets/web/image/demo/flags/lb.png') }}" alt="Arabic" title="Arabic" /> Arabic </a> </li>
                                    </ul>
                                </form>
                            </li>
                            <li class="form-group currency currencies-block">
                                <form action="index.html" method="post" enctype="multipart/form-data" id="currency">
                                    <a class="btn btn-xs dropdown-toggle" data-toggle="dropdown">
                                        <span class="icon icon-credit "></span> USD <span class="fa fa-angle-down"></span>
                                    </a>
                                    <ul class="dropdown-menu btn-xs">
                                        <li> <a href="#">(€)&nbsp;Euro</a></li>
                                        <li> <a href="#">(£)&nbsp;Pounds	</a></li>
                                        <li> <a href="#">($)&nbsp;USD	</a></li>
                                    </ul>
                                </form>
                            </li> -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- //Header Top -->
    <!-- Header center -->
    <div class="header-center">
        <div class="container">
            <div class="row">
                <!-- Logo -->
                <div class="navbar-logo col-md-3 col-sm-4 col-xs-12">
                    <a href="{{ asset('assets/web/image/logo.png') }}" title="Your Store" alt="Your Store" /></a>
                </div>
                <!-- //End Logo -->
                <div class="header-center-right col-md-9 col-sm-8 col-xs-12">
                    <!-- Cart Pro-->
                    <div class="block-cart">
                        <!--cart-->
                        <div class="shopping_cart pull-right">
                            <div id="cart" class=" btn-group btn-shopping-cart">
                                <a data-loading-text="Loading..." class="btn-group top_cart dropdown-toggle" data-toggle="dropdown">
                                    <div class="shopcart">
                                        <span class="handle pull-left"></span>
                                        <span class="total-shopping-cart cart-total-full">
                                            <span class="cart-dropdown-count">
                                                {{ \Cart::instance('default')->count() }}
                                            </span>
                                            item(s) - $
                                            <span class="cart-dropdown-total-price">
                                                {{ \Cart::instance('default')->subtotal() }}
                                            </span>
                                        </span>
                                    </div>
                                </a>
                                <ul class="tab-content content dropdown-menu pull-right shoppingcart-box" role="menu">
                                    <li>
                                        <table class="table table-striped">
                                            <tbody>
                                                @foreach(\Cart::instance('default')->content() as $row)
                                                <tr>
                                                    <td class="text-center" style="width:70px">
                                                        <a href="product.html">
                                                            <img src="{{ url('storage/app/'.$row->options->obj->image) }}" style="width:70px" alt="{{ $row->name }}" title="{{ $row->name }}" class="preview">
                                                        </a>
                                                    </td>
                                                    <td class="text-left">
                                                        <a class="cart_product_name" href="{{ route('web.products.show',$row->id) }}">
                                                            {{ $row->name }}
                                                        </a>
                                                    </td>
                                                    <td class="text-center"> x{{ $row->qty }} </td>
                                                    <td class="text-center"> ${{ $row->price }} </td>
                                                    <td class="text-right">
                                                        <a onclick="cart.remove(this , '{{ $row->rowId }}' , '{{ route('web.cart.delete') }}');" class="fa fa-times fa-delete"></a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </li>
                                    <li>
                                        <div>
                                            <table class="table table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <td class="text-left"><strong>Total</strong>
                                                        </td>
                                                        <td class="text-right">
                                                            $<span class="cart-dropdown-total-price">{{ \Cart::instance('default')->subtotal() }}</span>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <p class="text-center"> <a class="btn view-cart" href="{{ route('web.cart.index') }}"><i class="fa fa-shopping-cart"></i>View Cart</a>&nbsp;&nbsp;&nbsp; <a class="btn btn-mega checkout-cart" href="{{ route('web.cart.checkout') }}"><i class="fa fa-share"></i>Checkout</a> </p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!--//cart-->
                    </div>
                    <!-- //End Cart Pro -->
                    <!-- Phone -->
                    <div class="phone-contact hidden-xs">
                        <div class="inner-info">
                            <h2>Hotline:</h2><p>25685</p>
                        </div>
                    </div>
                   
                    <!-- //End Phone -->
                </div>
            </div>
        </div>
    </div>
    <!-- //Header center -->
    <!-- Header Bottom -->
    <div class="header-bottom compact-hidden">
        <div class="container">
            <div class="rows">
                <div class="header-bottom-inner">
                    <div class="header-bottom-menu col-md-8 col-sm-2 col-xs-2">
                        <div class="responsive so-megamenu  megamenu-style-dev">
                            <nav class="navbar-default">
                                <div class=" container-megamenu  horizontal">
                                    <div class="navbar-header">
                                        <button type="button" id="show-megamenu" data-toggle="collapse" class="navbar-toggle">
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                        </button>
                                    </div>

                                    <div class="megamenu-wrapper ">
                                        <span id="remove-megamenu" class="fa fa-times"></span>
                                        <div class="megamenu-pattern">
                                            <div class="container">
                                                <ul class="megamenu " data-transition="slide" data-animationtime="250">
                                        
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </nav>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-10 col-xs-10 header_search">
                        <div id="sosearchpro" class="search-pro">
                            <form method="GET" action="{{ route('web.products.index') }}">
                                <div id="search0" class="search input-group">
                                    <div class="select_category filter_type  icon-select">
                                        <select class="no-border" name="catId" style="padding-left:5px;padding-top:4px;">
                                           {{--  @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach --}}
                                        </select>
                                    </div>

                                    <input class="autosearch-input form-control" type="text" value="" size="50" autocomplete="off" placeholder="Search" name="search">
                                    <span class="input-group-btn">
                                        <button type="submit" class="button-search btn btn-primary"><i class="fa fa-search"></i></button>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- //Header Container  -->
<!-- Main Container  -->
<main id="content" class="page-main">
    @include('web.alert.any')
    @include('alerts.info')
    @yield('content')
</main >
<!-- //Main Container -->

<script type="text/javascript"><!--
var $typeheader = 'header-home7';
//-->
</script>
<!-- Footer Container -->
<footer class="footer-container typefooter-1">
    <!-- Footer Top -->
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="module social_block col-md-3 col-sm-12 col-xs-12" >
                        <ul class="social-block ">
                            <li class="facebook">
                                <a class="_blank" href="#" target="_blank">
                                    <i class="fa fa-facebook"></i>
                                </a>
                            </li>
                            <li class="twitter">
                                <a class="_blank" href="#" target="_blank">
                                    <i class="fa fa-twitter"></i>
                                </a>
                            </li>
                            <li class="pinterest">
                                <a class="_blank" href="#" target="_blank">
                                    <i class="fa fa-pinterest"></i>
                                </a>
                            </li>
                            <li class="tubmlr">
                                <a class="_blank" href="#" target="_blank">
                                    <i class="fa fa-tumblr"></i>
                                </a>
                            </li>
                            <li class="google_plus">
                                <a class="_blank" href="#" target="_blank">
                                    <i class="fa  fa-google-plus"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="module news-letter col-md-9 col-sm-12 col-xs-12">
                        <div class="newsletter">
                            <div class="title-block">
                                <div class="page-heading">SIGN UP FOR OUR NEWSLETTER</div>
                                <div class="pre-text">
                                    <!-- Duis at ante non massa consectetur iaculis id non tellus -->
                                </div>
                            </div>
                            <div class="block_content">
                                {{ Form::open(['route' => 'web.subscribe' , 'class' => 'btn-group form-inline signup']) }}
                                <div class="form-group required send-mail">
                                    <div class="input-box">
                                        <input type="email" placeholder="Your email address..." value="" class="form-control" id="txtemail" name="subemail" size="55">
                                    </div>
                                    <div class="subcribe">
                                        <button class="btn btn-default btn-lg" type="submit">
                                            Subscribe
                                        </button>
                                    </div>
                                </div>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Center -->
    <div class="footer-center">
        <div class="container content">
            <div class="row">
                <!-- Box Info -->
                <div class="col-md-3 col-sm-6 col-xs-12 collapsed-block footer-links box-footer">
                    <div class="module ">
                        <div class="content-block-footer">
                            <div class="footer-logo">
                                <a href="#" title="Your Store" alt="Your Store" /></a>
                            </div>
                            <p>
                                
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Box Accout -->
                <!-- <div class="col-md-3 col-sm-6 box-account box-footer">
                    <div class="module clearfix">
                        <h3 class="modtitle">My Account</h3>
                        <div class="modcontent">
                            <ul class="menu">
                                <li><a href="#">Brands</a></li>
                                <li><a href="#">Gift Certificates</a></li>
                                <li><a href="#">Affiliates</a></li>
                                <li><a href="#">Specials</a></li>
                            </ul>
                        </div>
                    </div>
                </div> -->
                <!-- Box Infomation -->
                <!-- <div class="col-md-3 col-sm-6 box-information box-footer"> -->
                <div class="col-md-6 col-sm-6 box-information box-footer">
                    <div class="module clearfix">
                        <h3 class="modtitle">Information</h3>
                        <div class="modcontent">
                            <ul class="menu">
                                <li><a href="{{ route('web.aboutUs') }}">About Us</a></li>
                                <li><a href="{{ route('web.contactUs') }}">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Box About -->
                <div class="col-md-3  col-sm-6 collapsed-block box-footer">
                    <div class="module ">
                        <h3 class="modtitle">About Us</h3>
                        <div class="modcontent">
                            <ul class="contact-address">
                                <li><span class="fa fa-home"></span> My Company, 42 avenue des Champs</li>
                                <li><span class="fa fa-envelope"></span> Email: <a href="#"> sales@yourcompany.com </a></li>
                                <li><span class="fa fa-phone">&nbsp;</span> Phone 1:0123456789</li>
                            </ul>
                            <ul class="payment-method">
                                <li><a title="Payment Method" href="#"><img src="{{ asset('assets/web/image/demo/cms/payment/payment-1.png') }}" alt="Payment"></a></li>
                                <li><a title="Payment Method" href="#"><img src="{{ asset('assets/web/image/demo/cms/payment/payment-2.png') }}" alt="Payment"></a></li>
                                <!-- <li><a title="Payment Method" href="#"><img src="{{ asset('assets/web/image/demo/cms/payment/payment-3.png') }}" alt="Payment"></a></li>
                                <li><a title="Payment Method" href="#"><img src="{{ asset('assets/web/image/demo/cms/payment/payment-4.png') }}" alt="Payment"></a></li>
                                <li><a title="Payment Method" href="#"><img src="{{ asset('assets/web/image/demo/cms/payment/payment-5.png') }}" alt="Payment"></a></li> -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- FOOTER BOTTOM -->
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                   Maxshop © 2016 - 2016. MAGENTECH Store. All Rights Reserved.
                </div>
                <div class="back-to-top"><i class="fa fa-angle-up"></i><span> Top </span></div>
            </div>
        </div>
    </div>
</footer>
<!-- //end Footer Container -->

</div>

<!-- Preloading Screen -->
<div id="loader-wrapper">
    <div id="loader"></div>
    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>
</div>
<!-- End Preloading Screen -->

<!-- Include Libs & Plugins
============================================ -->
<!-- Placed at the end of the document so the pages load faster -->
<script type="text/javascript" src="{{ asset('assets/web/js/jquery-2.2.4.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/web/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/web/js/owl-carousel/owl.carousel.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/web/js/themejs/libs.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/web/js/unveil/jquery.unveil.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/web/js/countdown/jquery.countdown.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/web/js/dcjqaccordion/jquery.dcjqaccordion.2.8.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/web/js/datetimepicker/moment.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/web/js/datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/web/js/jquery-ui/jquery-ui.min.js') }}"></script>


<!-- Theme files
============================================ -->
<script type="text/javascript" src="{{ asset('assets/web/js/themejs/application.js') }}"></script>
<!-- <script type="text/javascript" src="{{ asset('assets/web/js/themejs/toppanel.js') }}"></script> -->
<script type="text/javascript" src="{{ asset('assets/web/js/themejs/so_megamenu.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/web/js/themejs/addtocart.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/web/js/themejs/accordion.js') }}"></script>
@yield('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $.ajax({
            url: '{{ route("web.visits.count") }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            dataType: 'json'
        });
    });
</script>
</html>
