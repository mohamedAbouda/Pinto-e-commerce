<!--  top-header  -->
<div class="top-header">
    <div class="container">
        <div class="col-md-6">
            <div class="top-header-left">
                <ul>
                    <li>
                        <div class="dropdown">
                            <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
                                <img src="{{ asset('assets/site/images/eng-flg.jpg') }}" alt="eng-flg" /> English
                                <i class="fas fa-angle-down" aria-hidden="true"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="#">English</a>
                                </li>
                                <li>
                                    <a href="#">Arabic</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    @if(Auth::guard('client')->check())
                    @else
                    <li>
                        <span><a href="#login" data-toggle="modal" data-target="#login" style="color:#fff">Login</a> </span>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
        <div class="col-md-6">
            <div class="top-header-right">
                <ul>
                    <li>
                        <a href="{{ route('web.store.locations') }}" style="color:white;">
                            <i class="icon-location-pin icons" aria-hidden="true"></i> Store Location
                        </a>
                    </li>
                    <li>
                        <i class="icon-note icons" aria-hidden="true"></i>
                        <a href="track-order.html" style="color:#fff">Track Your Order</a>
                    </li>
                    <li>
                        @if(Auth::guard('client')->check())
                        <div class="dropdown">
                            <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"> <i class="icon-settings icons" aria-hidden="true"></i> Setting</a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ route('web.logout') }}">Log Out</a>
                                </li>
                                <li>
                                    <a href="{{ route('web.active.orders') }}">Active Orders</a>
                                </li>
                                <li>
                                    <a href="{{ route('web.history.orders') }}">History Orders</a>
                                </li>
                            </ul>
                        </div>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!--  /top-header  -->
</div>
<section class="top-md-menu top-home3">
    <div class="container">
        <div class="col-sm-3 col-xs-12">
            <div class="logo">
                <h6><a href="{{ route('index') }}">
                    <img src="{{ asset('assets/site/images/logo.png') }}" alt="logo" width="80%" class="img-responsive" style="margin:0 auto;" />
                </a></h6>
            </div>
        </div>
        <div class="col-sm-6 text-center col-xs-12 col-md-6 header-stuffs ">
            <!-- Search box Start -->
            <form class="form-horizontal" action="{{ route('web.products.search') }}" method="GET">
                <div class="input-group navbar-search input-group-lg ">
                    <input type="text" class="form-control" name="search" placeholder="Search Products" style="font-size: 14px;" value="{{ request()->get('search') }}">
                    <span class="input-group-btn">
                        <button class="btn navbar-serach-btn" type="submit" style="background-color: rgb(177, 30, 34) !important; color:white;">
                            <i class="fas fa-search"></i>
                        </button>
                    </span>
                </div>
            </form>
            <!-- Search box End -->
        </div>
        <div class="col-sm-3 col-xs-12 col-md-3 header-stuffs">
            <!-- cart-menu -->
            <div class="cart-menu">
                <ul>
                    <li>
                        <a href="{{ route('web.compare.index') }}"><span class="icon icon-Restart"></span></a>
                        <span class="subno" id="compareCount">
                            @if(Session::get('compareSession'))
                            {{ count(Session::get('compareSession')) }}
                            @else
                            0
                            @endif
                        </span>
                        <strong>Comapre</strong>
                    </li>
                    <li>
                        <a href="{{ route('web.wishlist.index') }}"><i class="icon-heart icons" aria-hidden="true"></i></a>
                        <span class="subno" id="wishListCount">
                            @if(Auth::guard('client')->check())
                            {{ $wishListCount }}
                            @else
                            0
                            @endif
                        </span>
                        <strong>Your Wishlist</strong>
                    </li>
                    <li class="dropdown">
                        <a href="cart.html" data-toggle="dropdown" data-hover="dropdown"><i class="icon-basket-loaded icons" aria-hidden="true"></i></a>
                        <span class="subno" id="cartCountTotalAjax">{{ $CartCount }}</span>
                        <strong>Your Cart</strong>
                        <div class="dropdown-menu  cart-outer">
                            <div id="cart-content-ajax">
                                @foreach($cartGlobal as $cartglobal)
                                <div class="cart-content cartContent{{ $cartglobal->rowId }}" >
                                    <div class="col-sm-4 col-md-4">
                                        <img src="{{ $cartglobal->options->obj->cover_image_url }}" >
                                    </div>
                                    <div class="col-sm-8 col-md-8">
                                        <div class="pro-text">
                                            <a href="#">{{ $cartglobal->name }} </a>
                                            <div class="close" onclick="removeCartItem('{{ $cartglobal->rowId }}')">x</div>
                                            <strong>{{ $cartglobal->qty }} × {{ $cartglobal->price }} EGP</strong>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="total">
                                <div class="col-md-6 text-left">
                                    <strong>Total :</strong>
                                </div>
                                <div class="col-md-6 text-right">
                                    <strong id="cartSubTotalAjax">{{ $cartSubTotal }}</strong>
                                </div>
                            </div>
                            <a href="{{ route('web.cart.index') }}" class="cart-btn">VIEW CART </a>
                            <a href="{{ route('web.cart.checkout') }}" class="cart-btn">CHECKOUT</a>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- cart-menu End -->
        </div>
    </div>
    <div class="main-menu menu2">
        <div class="container">
            <!--  nav  -->
            <nav class="navbar navbar-inverse navbar-default">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" data-hover="dropdown" data-animations=" fadeInLeft fadeInUp fadeInRight">
                    <ul class="nav navbar-nav">
                        <li class="all-departments dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span> Shop By Department</span> <i class="fas fa-bars" aria-hidden="true"></i> </a>
                            <ul class="dropdown-menu dropdownhover-bottom" role="menu">
                                @foreach($categories as $section)
                                @if($section->subCategories->isEmpty())
                                <li>
                                    <a href="shop-grid.html">
                                        <i class="{{ $section->icon ? $section->icon : 'fas fa-bars' }}" aria-hidden="true" style="float:none;"></i>
                                        {{ $section->name }}
                                        <!-- <sup class="bg-red">hot!</sup> -->
                                    </a>
                                </li>
                                @else
                                @endif
                                <li class="dropdown">
                                    <a href="{{ route('web.products.search' ,['section_id' => $section->id]) }}">
                                        <i class="{{ $section->icon ? $section->icon : 'fas fa-bars' }}" aria-hidden="true" style="float:none;"></i>
                                        {{ $section->name }}
                                        <i class="fas fa-angle-right" aria-hidden="true"></i>
                                    </a>
                                    <ul class="dropdown-menu right">
                                        @foreach($section->subCategories as $sub_category)
                                        <li>
                                            <a href="{{ route('web.products.search' ,['sub_category_id' => $sub_category->id]) }}">
                                                {{ $sub_category->name }}
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="{{ route('index') }}"><span>Home</span> </a>
                        </li>
                        <li>
                            <a href="{{ route('web.products.search') }}"><span>Shop</span></a>
                        </li>
                        <li class="dropdown">
                            <a href="shop-grid.html" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span>Categories</span> <i class="fas fa-angle-down" aria-hidden="true"></i></a>
                            <div class="dropdown-menu dropdownhover-bottom mega-menu" role="menu">
                                <div class="col-sm-8 col-md-8">
                                    @foreach($categories as $section)
                                    <ul>
                                        <li>
                                            <a href="{{ route('web.products.search' ,['section_id' => $section->id]) }}">
                                                <strong>{{ $section->name }}</strong>
                                            </a>
                                        </li>
                                        @if(!$section->subCategories->isEmpty())
                                        @foreach($section->subCategories as $sub_category)
                                        <li>
                                            <a href="{{ route('web.products.search' ,['sub_category_id' => $sub_category->id]) }}">
                                                {{ $sub_category->name }}
                                            </a>
                                        </li>
                                        @endforeach
                                        @endif
                                    </ul>
                                    @endforeach
                                </div>
                            </div>
                        </li>
                        <li>
                            <a href="{{ route('web.products.search' ,['sort' => 'top_deals']) }}"><span> Top deals</span></a>
                        </li>
                        <li>
                            <a href="{{ route('web.contact') }}"><span>contact</span></a>
                        </li>
                    </ul>
                    <!-- /.navbar-collapse -->
                </div>
            </nav>
            <!-- /nav end -->
        </div>
    </div>
</section>
<!-- header-outer -->

<!-- /header-outer -->
</header>
