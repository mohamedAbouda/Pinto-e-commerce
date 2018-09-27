
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Pinto | The World's Most Comfortable Underwears</title>
    <link rel="stylesheet" href="{{ asset('assets/site/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/site/css/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/site/css/owl.carousel.min.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/site/img/favicon.ico') }}" />
    <link rel="stylesheet" href="{{ asset('assets/site/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/site/css/bootstrap-slider.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/site/css/custom.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/4.4.1/collection/icon/icon.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script>
    window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
    ]) !!};
    </script>
    {{ Html::style('assets/panel-assets/css/sweetalert.css') }}
    @yield('stylesheets')
    <style>
    .spinner-container {
        position: fixed;
        background-color: #0009;
        width: 100%;
        height: 110%;
        z-index: 10000;
        top: 0;
    }

    @keyframes spinner {
        to {transform: rotate(360deg);}
    }
    .spinner {
        content: '';
        box-sizing: border-box;
        position: relative;
        top: 37%;
        left: 46%;
        height: 150px;
        width: 150px;
        margin-top: -15px;
        margin-left: -15px;
        border-radius: 50%;
        border: 1px solid #ccc;
        border-top-color: #07d;
        animation: spinner .6s linear infinite;
    }
    </style>
</head>

<body>
    <!--push menu cart -->
    @include('layouts.site.parts.cart')
    <!-- End cart -->

    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">SEARCH HERE</h4>
                </div>
                <div class="modal-body">
                    <div class="input-group">
                        <form method="get" class="searchform" action="/search" role="search">
                            <input type="hidden" name="type" value="product">
                            <input type="text" name="q" class="form-control control-search">
                            <span class="input-group-btn">
                                <button class="btn btn-default button_search" type="button"><i data-toggle="dropdown" class="fa fa-search"></i></button>
                            </span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END  Modal content-->
    <header id="header" class="header-v1">
        <div class="sticky-header text-center hidden-xs hidden-sm">
            <div class="text">
                <span class="u-line">Free shipping and returns</span> on all orders above $200
            </div>
        </div>
        <div class="topbar">
            <div class="container container-40">
                <div class="topbar-left">
                    <div class="topbar-option">
                        <div class="topbar-account">
                            <?php if (!Auth::guard('client')->check()): ?>
                                <a href="{{ route('web.login') }}"><i class="icon-user f-15"></i></a>
                            <?php else: ?>
                                <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="icon-user f-15"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('web.logout') }}">Log out</a>
                                    </li>
                                </ul>
                            <?php endif; ?>
                        </div>
                        <div class="topbar-wishlist">
                            <a href="{{ route('web.wishlist.index') }}">
                                <i class="icon-heart f-15"></i>
                                <?php if (isset($wishlist) && !$wishlist->isEmpty()): ?>
                                    <span class="count wishlist-count">{{ $wishlist->count() }}</span>
                                <?php endif; ?>
                            </a>
                        </div>
                        <div class="topbar-language dropdown">
                            <a id="label1" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <span>EN</span>
                                <span class="fa fa-caret-down f-10"></span>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="label1">
                                <li><a href="#">English</a></li>
                                <li><a href="#">Arabic</a></li>
                            </ul>
                        </div>
                    </div>
                    <!--end topbar-option-->
                </div>
                <!--end topbar-left-->
                <div class="logo hidden-xs hidden-sm">
                    <a href="{{ url('/') }}" class="logo" title="home-logo"><img src="{{ asset('assets/site/img/logo1.png') }}" alt="logo" class="img-reponsive"/></a>
                </div>
                <!--end logo-->
                <div class="topbar-right">
                    <div class="topbar-option">
                        <div class="topbar-currency dropdown">
                            <a id="label2" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">

                                <span>USD</span>
                                <span class="fa fa-caret-down f-10"></span>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="label2">
                                <li><a href="#">USD</a></li>
                                <li><a href="#">EGP</a></li>
                            </ul>
                        </div>
                        <div class="topbar-search">
                            <div class="search-popup dropdown" data-toggle="modal" data-target="#myModal">
                                <a href="#"><i class="icon-magnifier f-15"></i></a>
                            </div>
                        </div>
                        <div class="topbar-cart">
                            <a href="#" class="icon-cart">
                                <i class="icon-basket f-15"></i>
                                <?php if ($cart->count()): ?>
                                    <span class="count cart-count">{{ $cart->count() }}</span>
                                <?php endif; ?>
                            </a>
                        </div>
                    </div>
                    <!--end topbar-option-->
                </div>
                <!--end topbar-right-->
            </div>
        </div>
        <div class="header-top">
            <div class="container container-40">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="logo-mobile hidden-lg hidden-md">
                            <a href="" title="home-logo"><img src="{{ asset('assets/site/img/cosre.png') }}" alt="logo" class="img-reponsive"></a>
                        </div>
                        <!--end logo-->
                        <button type="button" class="navbar-toggle icon-mobile" data-toggle="collapse" data-target="#myNavbar">
                            <span class="icon-menu"></span>
                        </button>
                        <nav class="navbar main-menu">
                            <div class="collapse navbar-collapse" id="myNavbar">
                                <ul class="nav navbar-nav js-menubar">
                                    <li class="level1 active dropdown">
                                        <a href="{{ url('/') }}">Home</a>
                                    </li>
                                    <li class="level1 dropdown hassub">
                                        <a href="{{ route('web.products.shop') }}">Shop</a>
                                        <?php if (!$categories->isEmpty()): ?>
                                            <span class="plus js-plus-icon"></span>
                                            <div class="menu-level-1 dropdown-menu">
                                                <ul class="level1">
                                                    @foreach($categories as $category)
                                                    <li class="level2 col-3">
                                                        <a href="products.html">{{ $category->name }}</a>
                                                        <ul class="menu-level-2">
                                                            @foreach($category->subCategories as $sub_category)
                                                            <li class="level3">
                                                                <a href="products.html">
                                                                    {{ $sub_category->name }}
                                                                </a>
                                                            </li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                                <div class="clearfix"></div>
                                            </div>
                                        <?php endif; ?>
                                    </li>
                                    <li class="level1 dropdown">
                                        <a href="{{ route('web.products.shop' ,['sort' => 'top_deals']) }}">Top Deals</a>
                                    </li>
                                    <li class="level1 dropdown">
                                        <a href="{{ route('web.about') }}">About</a>
                                    </li>
                                    <li class="level1 dropdown">
                                        <a href="#">Blog</a>
                                    </li>
                                    <li class="level1 dropdown">
                                        <a href="{{ route('web.contact') }}">Contact Us</a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div id="app">
        <div class="spinner-container" v-show="loading_screen" style="display:none;"><div class="spinner"></div></div>
        @yield('content')
    </div>

    <footer>
        <div class="container container-42">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                    <div class="menu-footer">
                        <ul>
                            <li><a href="#">Shipping</a></li>
                            <li><a href="terms.html">Terms & Conditions</a></li>
                            <li><a href="privacy-policy.html">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                    <div class="newletter-form">
                        <h3 class="footer-title text-center">Newsletter</h3>
                        <form action="#">
                            <input type="text" name="s" placeholder="Email Adress..." class="form-control">
                            <button type="submit" class="btn btn-submit">
                                <i class="fa fa-angle-right"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                    <div class="social">
                        <a href="{{ $contact_details && $contact_details->twitter ? $contact_details->twitter : '#' }}" title="twitter" target="_blank" rel="noopener noreferrer">
                            <i class="fa fa-twitter"></i>
                        </a>
                        <a href="{{ $contact_details && $contact_details->facebook ? $contact_details->facebook : '#' }}" title="facebook" target="_blank" rel="noopener noreferrer">
                            <i class="fa fa-facebook"></i>
                        </a>
                        <a href="{{ $contact_details && $contact_details->google ? $contact_details->google : '#' }}" title="google plus" target="_blank" rel="noopener noreferrer">
                            <i class="fa fa-google-plus"></i>
                        </a>
                        <a href="{{ $contact_details && $contact_details->instagram ? $contact_details->instagram : '#' }}" title="instagram" target="_blank" rel="noopener noreferrer">
                            <i class="fa fa-instagram"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <a href="#" class="scroll_top">SCROLL TO TOP<span></span></a>

    @yield('pre-scripts')
    <script src="{{ asset('assets/site/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/site/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/site/js/owl.carousel.min.js') }}"></script>
    <!-- <script src="{{ asset('assets/site/js/bootstrap-slider.min.js') }}"></script> -->
    <script src="{{ asset('assets/site/js/slick.min.js') }}"></script>
    <script src="{{ asset('assets/site/js/masonry.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/site/js/main.js') }}"></script>
    {{ Html::script('assets/panel-assets/js/sweetalert.min.js') }}
    @include('sweet::alert')
    @yield('scripts')
    <script type="text/javascript">
    function wishlist(id) {
        var id = id;
        $.ajax({
            type: "POST",
            url: "{{ route('web.wishlist.add') }}",
            data: {
                _token: "{{ csrf_token() }}",
                id: id
            },
            dataType: 'json',
            success: function(data) {
                if (data.error != undefined) {
                    return swal("Error", data.error, "error");
                }
                if (data.message != undefined) {
                    return swal("Done", data.message, "success");
                }
                $('#wishListCount').text(data[1]);
            }
        });
    }
    function addCart(id) {
        var id = id;
        var qty = $('#qty').val();
        var color = $('#color').val();
        var size = $('#size').val();
        if(qty < 1){
            qty = 1;
        }
        $('.spinner-container').show();

        $.ajax({
            type: "POST",
            url: "{{ route('web.cart.addToCart') }}",
            data: {
                _token: "{{ csrf_token() }}",
                id : id,
                qty : qty,
                color : color,
                size : size,
            },
            success: function(data) {
                if(data['message'] == 'Not Available Amount.'){
                    swal("Sorry", "Product not available", "error");
                }else{
                    swal("Success", "Product added to your cart", "success");
                }
            }
        }).done(function(data) {
            $('.spinner-container').hide();
        });
    }
    </script>
    <script type="text/javascript">
    $(document).ready(function(){
        $('.cart-js-plus').on("click", function(e) {
            var input = $(this).siblings('.cart-js-number');
            var quantity = parseInt(input.val(), 10);
            input.val(quantity + 1);
        });
        $('.cart-js-minus').on("click", function(e) {
            var input = $(this).siblings('.cart-js-number');
            var quantity = parseInt(input.val(), 10);
            if (quantity > 0) {
                input.val(quantity - 1);
            }
        });
    });
    </script>
</body>
</html>
