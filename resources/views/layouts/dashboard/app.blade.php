<!DOCTYPE html>
<html lang="en" style="height:100%;">
<head content="A">
    <meta charset="utf-8">
    <title>Alashank Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content=" bootstrap,graphic,hex" />
    <meta name="description" content="CRM" />
    <meta name="author" content="Abdulrahman Khaled">
    <link rel="shortcut icon" href="ico/favicon.png">
    <!-- Core CSS -->
    <link href="{{ asset('assets/panel-assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous"> -->
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet">
    <!-- Style Library -->
    <link href="{{ asset('assets/panel-assets/css/style-library-1.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/panel-assets/css/plugins.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/panel-assets/css/blocks.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/panel-assets/css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/panel-assets/css/navigations.css') }}" rel="stylesheet">
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>
    <script src="{{ asset('assets/panel-assets/js/html5shiv.js') }}"></script>
    <script src="{{ asset('assets/panel-assets/js/respond.min.js') }}"></script>
    <![endif]-->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700italic,700,800,800italic">

    {{ Html::style('assets/panel-assets/css/sweetalert.css') }}
    <style>
    .table-borderless > tbody > tr > td,
    .table-borderless > tbody > tr > th,
    .table-borderless > tfoot > tr > td,
    .table-borderless > tfoot > tr > th,
    .table-borderless > thead > tr > td,
    .table-borderless > thead > tr > th {
        border: none;
    }
    </style>
    @yield('stylesheets')
</head>
<body data-spy="scroll" data-target="#bs-sidebar-navbar-collapse-1">

    @include('layouts.dashboard.parts.sidebar')
    @include('layouts.dashboard.parts.topbar')

    <main id="main" style="margin-left: 90px;">

        <section id="add-contact">
            <div class="container">
                <div class="col-md-12">
                    @yield('section-title')
                    @include('alerts.error')
                    @include('alerts.info')
                    @include('alerts.success')
                    @yield('content')
                </div>
            </div>
        </section>
    </main>
    <script type="text/javascript" src="{{ asset('assets/panel-assets/js/jquery-1.11.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/panel-assets/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/panel-assets/js/plugins.js') }}"></script>
    <!-- <script src="https://maps.google.com/maps/api/js?sensor=true"></script> -->
    <script type="text/javascript" src="{{ asset('assets/panel-assets/js/bskit-scripts.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/panel-assets/js/scripts.js') }}"></script>

    @yield('scripts')

    {{ Html::script('assets/panel-assets/js/sweetalert.min.js') }}
    @include('sweet::alert')
</body>
</html>
