<!DOCTYPE html>
<html class=" ">
<head>
  <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
  <meta charset="utf-8" />
  <title>@yield('title')</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <meta content="" name="description" />
  <meta content="" name="author" />

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{csrf_token()}}">

  <link rel="shortcut icon" href="{{url('assets/dashboard')}}/images/favicon.png" type="image/x-icon" />    <!-- Favicon -->
  <link rel="apple-touch-icon-precomposed" href="{{url('assets/dashboard')}}/images/apple-touch-icon-57-precomposed.png">	<!-- For iPhone -->
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{url('assets/dashboard')}}/images/apple-touch-icon-114-precomposed.png">    <!-- For iPhone 4 Retina display -->
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{url('assets/dashboard')}}/images/apple-touch-icon-72-precomposed.png">    <!-- For iPad -->
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{url('assets/dashboard')}}/images/apple-touch-icon-144-precomposed.png">    <!-- For iPad Retina display -->




  <!-- CORE CSS FRAMEWORK - START -->
  <link href="{{url('assets/dashboard')}}/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen"/>
  <link href="{{url('assets/dashboard')}}/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
  <link href="{{url('assets/dashboard')}}/plugins/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
  <link href="{{url('assets/dashboard')}}/fonts/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
  <link href="{{url('assets/dashboard')}}/css/animate.min.css" rel="stylesheet" type="text/css"/>
  <link href="{{url('assets/dashboard')}}/plugins/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" type="text/css"/>
  <!-- CORE CSS FRAMEWORK - END -->

  <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - START -->
  <link href="{{url('assets/dashboard')}}/plugins/datatables/css/jquery.dataTables.css" rel="stylesheet" type="text/css" media="screen"/>
  <link href="{{url('assets/dashboard')}}/plugins/datatables/extensions/TableTools/css/dataTables.tableTools.min.css" rel="stylesheet" type="text/css" media="screen"/>
  <link href="{{url('assets/dashboard')}}/plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet" type="text/css" media="screen"/>
  <link href="{{url('assets/dashboard')}}/plugins/datatables/extensions/Responsive/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet" type="text/css" media="screen"/>
  <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - END -->


  <!-- CORE CSS TEMPLATE - START -->
  <link href="{{url('assets/dashboard')}}/css/style.css" rel="stylesheet" type="text/css"/>
  <link href="{{url('assets/dashboard')}}/css/responsive.css" rel="stylesheet" type="text/css"/>
  <!-- CORE CSS TEMPLATE - END -->
  <!-- Loader style -->
  <style media="screen">
  #loading {
      width: 100%;
      height: 100%;
      position: fixed;
      top: 0;
      left: 0;
      background-color: rgba(0,0,0,.5);
      -webkit-transition: all .5s ease;
      /*z-index: 1000;*/
      z-index: 1200 !important;
      display:none;
  }
  #loading span{
      position: absolute;
      margin: auto;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
  }



  @keyframes spinner {
      to {transform: rotate(360deg);}
  }

  .spinner:before {
      content: '';
      box-sizing: border-box;
      position: absolute;
      margin: auto;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      width: 100px;
      height: 100px;
      /*margin-top: -15px;
      margin-left: -15px;*/
      border-radius: 50%;
      border: 1px solid #ccc;
      border-top-color: #07d;
      animation: spinner .6s linear infinite;
  }
  </style>
  <!-- Loader style End -->
  @yield('stylesheets')
</head>
<!-- END HEAD -->

<!-- BEGIN BODY -->
<body class=" "><!-- START TOPBAR -->

    <!-- Loader -->
    <div id="loading">
        <span class="spinner"></span>
    </div>
    <!-- Loader end -->

<div class='page-topbar '>
  <div class='logo-area'></div>
  <div class='quick-area'>
    <div class='pull-left'>
      <ul class="info-menu left-links list-inline list-unstyled">
        <li class="sidebar-toggle-wrap">
          <a href="#" data-toggle="sidebar" class="sidebar_toggle">
            <i class="fa fa-bars"></i>
          </a>
        </li>

        <li class="notify-toggle-wrapper">
            <a href="#" data-toggle="dropdown" class="toggle">
                <i class="fa fa-bell"></i>
                @if($new_notifications !== 0)
                <span class="badge badge-orange">{{ $new_notifications }}</span>
                @endif
            </a>
            <ul class="dropdown-menu notifications animated fadeIn">
                <li class="total">
                    <span class="small">
                        You have <strong>{{ $new_notifications }}</strong> new notifications.
                        <a href="javascript:;" class="pull-right">Mark all as Read</a>
                    </span>
                </li>
                <li class="list">
                    <ul class="dropdown-menu-list list-unstyled ps-scrollbar">
                        @foreach($notifications as $notification)
                            @if($notification->order)
                            <li class="{{ $notification->seen === 1 ? 'read available' : 'unread away' }}"> <!-- available: success, warning, info, error -->
                                <a href="javascript:;">
                                    <div class="notice-icon">
                                        <i class="fa fa-check"></i>
                                        <span class="name">
                                            <strong>{{ $notification->order->name }} has submitted an order</strong>
                                            <span class="time small">{{ \Carbon\Carbon::parse($notification->order->created_at)->diffForHumans(\Carbon\Carbon::now()) }}</span>
                                        </span>
                                    </div>
                                </a>
                            </li>
                            @endif
                        @endforeach
                    </ul>
                </li>
                <li class="external">
                    <a href="javascript:;">
                        <span>Read All Notifications</span>
                    </a>
                </li>
            </ul>
        </li>
      </ul>
    </div>
    <div class='pull-right'>
      <ul class="info-menu right-links list-inline list-unstyled">
        <li class="profile">
          <a href="#" data-toggle="dropdown" class="toggle">
            <!-- <img src="data/profile/profile-ecommerce.jpg" alt="user-image" class="img-circle img-inline"> -->
            <span>{{ Auth::user()->name }} <i class="fa fa-angle-down"></i></span>
          </a>
          <ul class="dropdown-menu profile animated fadeIn">
            <li>
              <a href="#settings">
                <i class="fa fa-wrench"></i>
                Settings
              </a>
            </li>
            <li>
              <a href="#profile">
                <i class="fa fa-user"></i>
                Profile
              </a>
            </li>
            <li>
              <a href="#help">
                <i class="fa fa-info"></i>
                Help
              </a>
            </li>
            <li class="last">
              <a href="{{ route('dashboard.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa fa-lock"></i>
                Logout
              </a>
              <form id="logout-form" action="{{ route('dashboard.logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
              </form>
            </li>
          </ul>
        </li>
        <li class="chat-toggle-wrapper">
          <a href="#" data-toggle="chatbar" class="toggle_chat">
            <i class="fa fa-comments"></i>
            <span class="badge badge-warning">9</span>
            <i class="fa fa-times"></i>
          </a>
        </li>
      </ul>
    </div>
  </div>

</div>
<!-- END TOPBAR -->
<!-- START CONTAINER -->
<div class="page-container row-fluid">

  <!-- SIDEBAR - START -->
  <div class="page-sidebar ">

    <!-- MAIN MENU - START -->
    <div class="page-sidebar-wrapper" id="main-menu-wrapper">

      <!-- USER INFO - START -->
      <div class="profile-info row">

        <!-- <div class="profile-image col-md-4 col-sm-4 col-xs-4"> -->
          <!-- <a href="ui-profile.html">
            <img src="data/profile/profile-ecommerce.jpg" class="img-responsive img-circle">
          </a> -->
        <!-- </div> -->

        <div class="profile-details col-md-8 col-sm-8 col-xs-8">

          <h3>
            <a href="ui-profile.html">{{Auth::user()->name}}</a>

            <!-- Available statuses: online, idle, busy, away and offline -->
            <span class="profile-status online"></span>
          </h3>

          <p class="profile-title">Store Manager</p>

        </div>

      </div>
      <!-- USER INFO - END -->



      <ul class='wraplist'>


        <li class="">
          <a href="{{route('dashboard.index')}}">
            <i class="fa fa-dashboard"></i>
            <span class="title">Dashboard</span>
          </a>
        </li>

        @if(Auth::guard('admin')->check() || (session()->has('company') && session()->get('company')->can('can_add_staff_members') && Auth::check() && Auth::user()->roles()->first() && Auth::user()->roles()->first()->name == 'superAdmin')))
        <li class="">
            <a href="javascript:;">
                <i class="fa fa-folder-open"></i>
                <span class="title">Admins</span>
                <span class="arrow "></span>
            </a>
            <ul class="sub-menu" >
                <li>
                    <a class="" href="{{route('dashboard.admins.index')}}" >All Admins</a>
                </li>
                <li>
                    <a class="" href="{{route('dashboard.admins.create')}}" >Add Admin</a>
                </li>
            </ul>
        </li>
        @endif

        <li class="">
          <a href="javascript:;">
            <i class="fa fa-folder-open"></i>
            <span class="title">The Slider</span>
            <span class="arrow "></span>
          </a>
          <ul class="sub-menu" >
            <li>
              <a class="" href="{{route('dashboard.slides.index')}}" >All Slides</a>
            </li>
            <li>
              <a class="" href="{{route('dashboard.slides.create')}}" >Add Slide</a>
            </li>
          </ul>
        </li>

        <li class="">
            <a href="javascript:;">
                <i class="fa fa-sitemap"></i>
                <span class="title">Categories</span>
                <span class="arrow "></span>
            </a>
            <ul class="sub-menu">
                <li>
                    <a href="{{route('dashboard.categories.index')}}" >All Categories</a>
                </li>
                <li>
                    <a href="{{route('dashboard.categories.create')}}" >Create Category</a>
                </li>
            </ul>
        </li>
        <li class="">
            <a href="javascript:;">
                <i class="fa fa-sitemap"></i>
                <span class="title">Sub-categories</span>
                <span class="arrow "></span>
            </a>
            <ul class="sub-menu">
                <li>
                    <a href="{{route('dashboard.subCategories.index')}}" >All Sub-categories</a>
                </li>
                <li>
                    <a href="{{route('dashboard.subCategories.create')}}" >Create Sub-category</a>
                </li>
            </ul>
        </li>

        <li class="">
            <a href="javascript:;">
                <i class="fa fa-sitemap"></i>
                <span class="title">Collections</span>
                <span class="arrow "></span>
            </a>
            <ul class="sub-menu">
                <li>
                    <a href="{{route('dashboard.collection.index')}}" >All Collections</a>
                </li>
                <li>
                    <a href="{{route('dashboard.collection.create')}}" >Create a collection</a>
                </li>
            </ul>
        </li>

        <li class="">
            <a href="{{ route('dashboard.orders.index') }}">
                <i class="fa fa-book"></i>
                <span class="title">Orders</span>
            </a
        </li>


        <li class="">
            <a href="javascript:;">
                <i class="fa fa-book"></i>
                <span class="title">Discounts</span>
                <span class="arrow "></span>
            </a>
            <ul class="sub-menu">
                <li>
                    <a href="{{route('dashboard.deal.index')}}" >All Discounts</a>
                </li>
                <li>
                    <a href="{{route('dashboard.deal.create')}}" >Create a discount</a>
                </li>
            </ul>
        </li>

        <li class="">
          <a href="javascript:;">
            <i class="fa fa-folder-open"></i>
            <span class="title">Sizes</span>
            <span class="arrow "></span>
          </a>
          <ul class="sub-menu" >
            <li>
              <a class="" href="{{route('dashboard.sizes.index')}}" >All Sizes</a>
            </li>
            <li>
              <a class="" href="{{route('dashboard.sizes.create')}}" >Add Size</a>
            </li>
          </ul>
        </li>

        <li class="">
          <a href="javascript:;">
            <i class="fa fa-folder-open"></i>
            <span class="title">Colors</span>
            <span class="arrow "></span>
          </a>
          <ul class="sub-menu" >
            <li>
              <a class="" href="{{route('dashboard.colors.index')}}" >All Colors</a>
            </li>
            <li>
              <a class="" href="{{route('dashboard.colors.create')}}" >Add Color</a>
            </li>
          </ul>
        </li>

        <li class="">
          <a href="javascript:;">
            <i class="fa fa-cubes"></i>
            <span class="title">Brands</span>
            <span class="arrow "></span>
          </a>
          <ul class="sub-menu" >
            <li>
              <a class="" href="{{route('dashboard.brands.index')}}" >All brands</a>
            </li>
            <li>
              <a class="" href="{{route('dashboard.brands.create')}}" >Add brand</a>
            </li>
          </ul>
        </li>

        <li class="">
          <a href="javascript:;">
            <i class="fa fa-cubes"></i>
            <span class="title">Products</span>
            <span class="arrow "></span>
          </a>
          <ul class="sub-menu" >
            <li>
              <a class="" href="{{route('dashboard.products.index')}}" >All Products</a>
            </li>
            <li>
              <a class="" href="{{route('dashboard.products.create')}}" >Add Product</a>
            </li>
          </ul>
        </li>

        <li class="">
          <a href="{{route('dashboard.reports.index')}}">
            <i class="fa fa-book"></i>
            <span class="title">Reports</span>
          </a>
        </li>

        <li class="">
          <a href="{{route('dashboard.inventory.index')}}">
            <i class="fa fa-folder-open"></i>
            <span class="title">Inventory</span>
          </a>
        </li>

        <li class="">
            <a href="javascript:;">
                <i class="fa fa-gift"></i>
                <span class="title">Gift Cards</span>
                <span class="arrow "></span>
            </a>
            <ul class="sub-menu">
                <li>
                    <a href="{{route('dashboard.gifts.index')}}" >All</a>
                </li>
                <li>
                    <a href="{{route('dashboard.gifts.create')}}" >Create Gift Card</a>
                </li>
            </ul>
        </li>

        <li class="">
            <a href="javascript:;">
                <i class="fa fa-gift"></i>
                <span class="title">Pages</span>
                <span class="arrow "></span>
            </a>
            <ul class="sub-menu">
                <li>
                    <a href="{{route('dashboard.pages.index')}}" >All</a>
                </li>
                <li>
                    <a href="{{route('dashboard.pages.create')}}" >Create Page</a>
                </li>
            </ul>
        </li>

           <li class="">
            <a href="javascript:;">
                <i class="fa fa-gift"></i>
                <span class="title">Coupons</span>
                <span class="arrow "></span>
            </a>
            <ul class="sub-menu">
                <li>
                    <a href="{{route('dashboard.coupons.index')}}" >All</a>
                </li>
                <li>
                    <a href="{{route('dashboard.coupons.create')}}" >Create Coupon</a>
                </li>
            </ul>
        </li>

        <li class="">
          <a href="javascript:;">
            <i class="fa fa-folder-open"></i>
            <span class="title">Customers</span>
            <span class="arrow "></span>
          </a>
          <ul class="sub-menu" >
            <li>
              <a class="" href="{{route('dashboard.customers.index')}}" >All Customers</a>
            </li>
            <li>
              <a class="" href="{{route('dashboard.customers.create')}}" >Add Customer</a>
            </li>
            <li>
              <a class="" href="{{route('dashboard.customers.import')}}" >Import Customers</a>
            </li>
          </ul>
        </li>

        <li class="">
          <a href="javascript:;">
            <i class="fa fa-folder-open"></i>
            <span class="title">Delivery Options</span>
            <span class="arrow "></span>
          </a>
          <ul class="sub-menu" >
            <li>
              <a class="" href="{{route('dashboard.delivery_options.index')}}" >All Delivery Options</a>
            </li>
            <li>
              <a class="" href="{{route('dashboard.delivery_options.create')}}" >Add Delivery Option</a>
            </li>
          </ul>
        </li>

        <li class="">
          <a href="{{route('dashboard.payment_methods.index')}}">
            <i class="fa fa-folder-open"></i>
            <span class="title">Payment Methods</span>
          </a>
        </li>

        <li class="">
          <a href="{{route('dashboard.banners.index')}}">
            <i class="fa fa-folder-open"></i>
            <span class="title">Banners</span>
            <!-- <span class="arrow "></span> -->
          </a>
          <!-- <ul class="sub-menu" >
            <li>
              <a class="" href="{{route('dashboard.banners.index')}}" >All Banners</a>
            </li>
            <li>
              <a class="" href="{{route('dashboard.banners.create')}}" >Add Banner</a>
            </li>
          </ul> -->
        </li>

        <li class="">
          <a href="{{route('dashboard.subscribers.index')}}">
            <i class="fa fa-users"></i>
            <span class="title">Subscribers</span>
          </a>
        </li>

        <li class="">
          <a href="{{route('dashboard.setting.index')}}">
            <i class="fa fa-cogs"></i>
            <span class="title">Settings</span>
          </a>
        </li>

        <li class="">
          <a href="{{route('dashboard.setting.manageMenu')}}">
            <i class="fa fa-cogs"></i>
            <span class="title">Manage header menu</span>
          </a>
        </li>

        <li class="">
          <a href="{{route('dashboard.about.index')}}">
            <i class="fa fa-cogs"></i>
            <span class="title">About</span>
          </a>
        </li>

        <!-- <li class="">
          <a href="javascript:;">
            <i class="fa fa-folder-open"></i>
            <span class="title">SocialMedia</span>
            <span class="arrow "></span>
          </a>
          <ul class="sub-menu" >
            <li>
              <a class="" href="{{route('dashboard.socialmedias.index')}}" >All SocialMedias</a>
            </li>
            <li>
              <a class="" href="{{route('dashboard.socialmedias.create')}}" >Add SocialMedia</a>
            </li>
          </ul>
        </li> -->

      </ul>

    </div>
    <!-- MAIN MENU - END -->



    <div class="project-info">

      <div class="block1">
        <div class="data">
          <span class='title'>Orders</span>
          <span class='total'>545</span>
        </div>
        <div class="graph">
          <span class="sidebar_orders">...</span>
        </div>
      </div>

      <div class="block2">
        <div class="data">
          <span class='title'>Customers</span>
          <span class='total'>3146</span>
        </div>
        <div class="graph">
          <span class="sidebar_visitors">...</span>
        </div>
      </div>

    </div>



  </div>
  <!--  SIDEBAR - END -->
  <!-- START CONTENT -->
  <section id="main-content" class=" ">
    <section class="wrapper main-wrapper" style=''>

      <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
        <div class="page-title">

          {{--<div class="pull-left">
            <h1 class="title">Categories</h1>
          </div>--}}

          <div class="pull-right hidden-xs">
            @yield('path')
          </div>

        </div>
      </div>
      <div class="clearfix"></div>

      @include('alerts.error')
      @include('alerts.info')
      @include('alerts.success')

      <div class="col-lg-12">
        @yield('content')
      </div>




    </section>
  </section>
  <!-- END CONTENT -->
  <div class="page-chatapi hideit">

    <div class="search-bar">
      <input type="text" placeholder="Search" class="form-control">
    </div>

    <div class="chat-wrapper">
      <h4 class="group-head">Groups</h4>
      <ul class="group-list list-unstyled">
        <li class="group-row">
          <div class="group-status available">
            <i class="fa fa-circle"></i>
          </div>
          <div class="group-info">
            <h4><a href="#">Work</a></h4>
          </div>
        </li>
        <li class="group-row">
          <div class="group-status away">
            <i class="fa fa-circle"></i>
          </div>
          <div class="group-info">
            <h4><a href="#">Friends</a></h4>
          </div>
        </li>

      </ul>


      <h4 class="group-head">Favourites</h4>
      <ul class="contact-list">

        <li class="user-row" id='chat_user_1' data-user-id='1'>
          <div class="user-img">
            <a href="#"><img src="data/profile/avatar-1.png" alt=""></a>
          </div>
          <div class="user-info">
            <h4><a href="#">Clarine Vassar</a></h4>
            <span class="status available" data-status="available"> Available</span>
          </div>
          <div class="user-status available">
            <i class="fa fa-circle"></i>
          </div>
        </li>
        <li class="user-row" id='chat_user_2' data-user-id='2'>
          <div class="user-img">
            <a href="#"><img src="data/profile/avatar-2.png" alt=""></a>
          </div>
          <div class="user-info">
            <h4><a href="#">Brooks Latshaw</a></h4>
            <span class="status away" data-status="away"> Away</span>
          </div>
          <div class="user-status away">
            <i class="fa fa-circle"></i>
          </div>
        </li>
        <li class="user-row" id='chat_user_3' data-user-id='3'>
          <div class="user-img">
            <a href="#"><img src="data/profile/avatar-3.png" alt=""></a>
          </div>
          <div class="user-info">
            <h4><a href="#">Clementina Brodeur</a></h4>
            <span class="status busy" data-status="busy"> Busy</span>
          </div>
          <div class="user-status busy">
            <i class="fa fa-circle"></i>
          </div>
        </li>

      </ul>


      <h4 class="group-head">More Contacts</h4>
      <ul class="contact-list">

        <li class="user-row" id='chat_user_4' data-user-id='4'>
          <div class="user-img">
            <a href="#"><img src="data/profile/avatar-4.png" alt=""></a>
          </div>
          <div class="user-info">
            <h4><a href="#">Carri Busey</a></h4>
            <span class="status offline" data-status="offline"> Offline</span>
          </div>
          <div class="user-status offline">
            <i class="fa fa-circle"></i>
          </div>
        </li>
        <li class="user-row" id='chat_user_5' data-user-id='5'>
          <div class="user-img">
            <a href="#"><img src="data/profile/avatar-5.png" alt=""></a>
          </div>
          <div class="user-info">
            <h4><a href="#">Melissa Dock</a></h4>
            <span class="status offline" data-status="offline"> Offline</span>
          </div>
          <div class="user-status offline">
            <i class="fa fa-circle"></i>
          </div>
        </li>
        <li class="user-row" id='chat_user_6' data-user-id='6'>
          <div class="user-img">
            <a href="#"><img src="data/profile/avatar-1.png" alt=""></a>
          </div>
          <div class="user-info">
            <h4><a href="#">Verdell Rea</a></h4>
            <span class="status available" data-status="available"> Available</span>
          </div>
          <div class="user-status available">
            <i class="fa fa-circle"></i>
          </div>
        </li>
        <li class="user-row" id='chat_user_7' data-user-id='7'>
          <div class="user-img">
            <a href="#"><img src="data/profile/avatar-2.png" alt=""></a>
          </div>
          <div class="user-info">
            <h4><a href="#">Linette Lheureux</a></h4>
            <span class="status busy" data-status="busy"> Busy</span>
          </div>
          <div class="user-status busy">
            <i class="fa fa-circle"></i>
          </div>
        </li>
        <li class="user-row" id='chat_user_8' data-user-id='8'>
          <div class="user-img">
            <a href="#"><img src="data/profile/avatar-3.png" alt=""></a>
          </div>
          <div class="user-info">
            <h4><a href="#">Araceli Boatright</a></h4>
            <span class="status away" data-status="away"> Away</span>
          </div>
          <div class="user-status away">
            <i class="fa fa-circle"></i>
          </div>
        </li>
        <li class="user-row" id='chat_user_9' data-user-id='9'>
          <div class="user-img">
            <a href="#"><img src="data/profile/avatar-4.png" alt=""></a>
          </div>
          <div class="user-info">
            <h4><a href="#">Clay Peskin</a></h4>
            <span class="status busy" data-status="busy"> Busy</span>
          </div>
          <div class="user-status busy">
            <i class="fa fa-circle"></i>
          </div>
        </li>
        <li class="user-row" id='chat_user_10' data-user-id='10'>
          <div class="user-img">
            <a href="#"><img src="data/profile/avatar-5.png" alt=""></a>
          </div>
          <div class="user-info">
            <h4><a href="#">Loni Tindall</a></h4>
            <span class="status away" data-status="away"> Away</span>
          </div>
          <div class="user-status away">
            <i class="fa fa-circle"></i>
          </div>
        </li>
        <li class="user-row" id='chat_user_11' data-user-id='11'>
          <div class="user-img">
            <a href="#"><img src="data/profile/avatar-1.png" alt=""></a>
          </div>
          <div class="user-info">
            <h4><a href="#">Tanisha Kimbro</a></h4>
            <span class="status idle" data-status="idle"> Idle</span>
          </div>
          <div class="user-status idle">
            <i class="fa fa-circle"></i>
          </div>
        </li>
        <li class="user-row" id='chat_user_12' data-user-id='12'>
          <div class="user-img">
            <a href="#"><img src="data/profile/avatar-2.png" alt=""></a>
          </div>
          <div class="user-info">
            <h4><a href="#">Jovita Tisdale</a></h4>
            <span class="status idle" data-status="idle"> Idle</span>
          </div>
          <div class="user-status idle">
            <i class="fa fa-circle"></i>
          </div>
        </li>

      </ul>
    </div>

  </div>


  <div class="chatapi-windows ">


  </div>    </div>
<!-- END CONTAINER -->
<!-- LOAD FILES AT PAGE END FOR FASTER LOADING -->


<!-- CORE JS FRAMEWORK - START -->
{{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>--}}
<script src="{{url('assets/dashboard')}}/js/jquery-1.11.2.min.js" type="text/javascript"></script>
<script src="{{url('assets/dashboard')}}/js/jquery.easing.min.js" type="text/javascript"></script>
<script src="{{url('assets/dashboard')}}/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="{{url('assets/dashboard')}}/plugins/pace/pace.min.js" type="text/javascript"></script>
<script src="{{url('assets/dashboard')}}/plugins/perfect-scrollbar/perfect-scrollbar.min.js" type="text/javascript"></script>
<script src="{{url('assets/dashboard')}}/plugins/viewport/viewportchecker.js" type="text/javascript"></script>
<!-- CORE JS FRAMEWORK - END -->


<!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - START -->
<script src="{{url('assets/dashboard')}}/plugins/datatables/js/jquery.dataTables.min.js" type="text/javascript"></script><script src="{{url('assets/dashboard')}}/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js" type="text/javascript"></script><script src="{{url('assets/dashboard')}}/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js" type="text/javascript"></script><script src="{{url('assets/dashboard')}}/plugins/datatables/extensions/Responsive/bootstrap/3/dataTables.bootstrap.js" type="text/javascript"></script><!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - END -->


<!-- CORE TEMPLATE JS - START -->
<script src="{{url('assets/dashboard')}}/js/scripts.js" type="text/javascript"></script>
<!-- END CORE TEMPLATE JS - END -->

<!-- Sidebar Graph - START -->
<script src="{{url('assets/dashboard')}}/plugins/sparkline-chart/jquery.sparkline.min.js" type="text/javascript"></script>
<script src="{{url('assets/dashboard')}}/js/chart-sparkline.js" type="text/javascript"></script>
<!-- Sidebar Graph - END -->

@yield('scripts')

<!-- General section box modal start -->
<div class="modal" id="section-settings" tabindex="-1" role="dialog" aria-labelledby="ultraModal-Label" aria-hidden="true">
  <div class="modal-dialog animated bounceInDown">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Section Settings</h4>
      </div>
      <div class="modal-body">

        Body goes here...

      </div>
      <div class="modal-footer">
        <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
        <button class="btn btn-success" type="button">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!-- modal end -->
</body>
</html>
