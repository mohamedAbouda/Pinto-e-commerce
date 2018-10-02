<!DOCTYPE html>
<html class=" ">
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
    <meta charset="utf-8"/>
    <title>{{ isset($setting) && $setting ? $setting->site_name.' - ':'' }} Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta content="" name="description"/>
    <meta content="Restart_Technology" name="author"/>

    <link rel="shortcut icon" href="{{ url('/') }}/assets/dashboard/images/favicon.png" type="image/x-icon"/>
    <!-- Favicon -->
    <link rel="apple-touch-icon-precomposed" href="{{ url('/') }}/assets/dashboard/images/apple-touch-icon-57-precomposed.png">
    <!-- For iPhone -->
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ url('/') }}/assets/dashboard/images/apple-touch-icon-114-precomposed.png">
    <!-- For iPhone 4 Retina display -->
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ url('/') }}/assets/dashboard/images/apple-touch-icon-72-precomposed.png">
    <!-- For iPad -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ url('/') }}/assets/dashboard/images/apple-touch-icon-144-precomposed.png">
    <!-- For iPad Retina display -->


    <!-- CORE CSS FRAMEWORK - START -->
    <link href="{{ url('/') }}/assets/dashboard/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen"/>
    <link href="{{ url('/') }}/assets/dashboard/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{ url('/') }}/assets/dashboard/plugins/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{ url('/') }}/assets/dashboard/fonts/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
    <link href="{{ url('/') }}/assets/dashboard/css/animate.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{ url('/') }}/assets/dashboard/plugins/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" type="text/css"/>
    <!-- CORE CSS FRAMEWORK - END -->

    <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - START -->
    <link href="{{ url('/') }}/assets/dashboard/plugins/icheck/skins/square/orange.css" rel="stylesheet" type="text/css" media="screen"/>
    <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - END -->


    <!-- CORE CSS TEMPLATE - START -->
    <link href="{{ url('/') }}/assets/dashboard/css/style.css" rel="stylesheet" type="text/css"/>
    <link href="{{ url('/') }}/assets/dashboard/css/responsive.css" rel="stylesheet" type="text/css"/>
    <!-- CORE CSS TEMPLATE - END -->

</head>
<!-- END HEAD -->

<!-- BEGIN BODY -->
<body class=" login_page">


    <div class="login-wrapper">
        <div id="login" class="login loginpage col-lg-offset-4 col-lg-4 col-md-offset-3 col-md-6 col-sm-offset-3 col-sm-6 col-xs-offset-0 col-xs-12">


            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('dashboard.login') }}" method="post">
                {{ csrf_field() }}
                <label for="email">Email<br/>
                    <input type="email" name="email" id="email" class="input" size="20"/></label>
                    <label for="password">Password<br/>
                        <input type="password" name="password" id="password" class="input" size="20"/></label>
                        <label class="icheck-label form-label" for="remember">
                            <input name="remember" type="checkbox" id="remember" class="skin-square-orange" checked>
                            Remember me
                        </label>

                        <input type="submit" id="wp-submit" class="btn btn-orange btn-block" value="Sign In"/>
                    </form>

                    <p id="nav">
                        <a class="pull-right" href="#" title="Password Lost and Found">Forgot password?</a>
                    </p>

                </div>
            </div>


            <!-- LOAD FILES AT PAGE END FOR FASTER LOADING -->


            <!-- CORE JS FRAMEWORK - START -->
            <script src="{{ url('/') }}/assets/dashboard/js/jquery-1.11.2.min.js" type="text/javascript"></script>
            <script src="{{ url('/') }}/assets/dashboard/js/jquery.easing.min.js" type="text/javascript"></script>
            <script src="{{ url('/') }}/assets/dashboard/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
            <script src="{{ url('/') }}/assets/dashboard/plugins/pace/pace.min.js" type="text/javascript"></script>
            <script src="{{ url('/') }}/assets/dashboard/plugins/perfect-scrollbar/perfect-scrollbar.min.js" type="text/javascript"></script>
            <script src="{{ url('/') }}/assets/dashboard/plugins/viewport/viewportchecker.js" type="text/javascript"></script>
            <!-- CORE JS FRAMEWORK - END -->


            <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - START -->
            <script src="{{ url('/') }}/assets/dashboard/plugins/icheck/icheck.min.js" type="text/javascript"></script>
            <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - END -->


            <!-- CORE TEMPLATE JS - START -->
            <script src="{{ url('/') }}/assets/dashboard/js/scripts.js" type="text/javascript"></script>
            <!-- END CORE TEMPLATE JS - END -->

            <!-- Sidebar Graph - START -->
            <script src="{{ url('/') }}/assets/dashboard/plugins/sparkline-chart/jquery.sparkline.min.js" type="text/javascript"></script>
            <script src="{{ url('/') }}/assets/dashboard/js/chart-sparkline.js" type="text/javascript"></script>
            <!-- Sidebar Graph - END -->

        </body>
        </html>
