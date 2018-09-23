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
                </ul>
            </div>
            <div class='pull-right'>
                <ul class="info-menu right-links list-inline list-unstyled">
                    <li class="profile">
                        <a href="#" data-toggle="dropdown" class="toggle">
                            <!-- <img src="data/profile/profile-ecommerce.jpg" alt="user-image" class="img-circle img-inline"> -->
                            <span>{{ Auth::guard('admin')->user()->name }} <i class="fa fa-angle-down"></i></span>
                        </a>
                        <ul class="dropdown-menu profile animated fadeIn">
                            <li class="last">
                                <a href="{{ route('superadmin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fa fa-lock"></i>
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('superadmin.logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
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
                    <div class="profile-details col-md-8 col-sm-8 col-xs-8">
                        <h3>
                            <a href="ui-profile.html">{{Auth::guard('admin')->user()->name}}</a>
                            <!-- Available statuses: online, idle, busy, away and offline -->
                            <span class="profile-status online"></span>
                        </h3>
                        <p class="profile-title">Store Manager</p>
                    </div>
                </div>
                <!-- USER INFO - END -->
                <ul class='wraplist'>
                    <li class="">
                        <a href="{{route('superadmin.index')}}">
                            <i class="fa fa-dashboard"></i>
                            <span class="title">Dashboard</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="javascript:;">
                            <i class="fa fa-users"></i>
                            <span class="title">Companies</span>
                            <span class="arrow "></span>
                        </a>
                        <ul class="sub-menu" >
                            <li>
                                <a class="" href="{{ route('superadmin.companies.index') }}" >All</a>
                            </li>
                            <li>
                                <a class="" href="{{ route('superadmin.companies.create') }}" >Create new</a>
                            </li>
                        </ul>
                    </li>
                </ul>

            </div>
            <!-- MAIN MENU - END -->
        </div>
        <!--  SIDEBAR - END -->

        <!-- START CONTENT -->
        <section id="main-content" class=" ">
            <section class="wrapper main-wrapper" style=''>
                <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                    <div class="page-title">
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
    </div>
</div>
<!-- END CONTAINER -->
<!-- LOAD FILES AT PAGE END FOR FASTER LOADING -->

<!-- CORE JS FRAMEWORK - START -->
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
</body>
</html>
