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
<body class=" ">
    <!-- START TOPBAR -->
    <!-- Loader -->
    <div id="loading">
        <span class="spinner"></span>
    </div>
    <!-- Loader end -->
    <!-- START CONTENT -->
    <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-12">
        <section class="wrapper main-wrapper" style=''>
            @include('alerts.error')
            @include('alerts.info')
            @include('alerts.success')
            <div class="row">
                <section class="box">
                    <header class="panel_header">
                        <h2 class="title pull-left">Please fill in the following data to proceed : </h2>
                    </header>
                    <div class="content-body">
                        <div class="row">
                            <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-12">
                                {{ Form::open(['files' => TRUE]) }}
                                <div class="form-group">
                                    <label class="form-label" for="site_name">Site name :</label>
                                    <p class="desc">eg: YouTupe , Twitter</p>
                                    <input type="text" name="site_name" id="site_name" value="{{ old('site_name') }}" class="form-control">
                                    <p class="text-danger">{{ $errors->first('site_name') }}</p>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="site_domain">Site domain :</label>
                                    <p class="desc">eg: youtube.com , twitter.com</p>
                                    <input type="text" name="site_domain" id="site_domain" value="{{ old('site_domain') }}" class="form-control">
                                    <p class="text-danger">{{ $errors->first('site_domain') }}</p>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="currency">Currency :</label>
                                    <select name="currency" id="currency" class="form-control">
                                        <option value="">Select the currency</option>
                                        <option value="USD">United States Dollars</option>
                                        <option value="EUR">Euro</option>
                                        <option value="GBP">United Kingdom Pounds</option>
                                        <option value="DZD">Algeria Dinars</option>
                                        <option value="ARP">Argentina Pesos</option>
                                        <option value="AUD">Australia Dollars</option>
                                        <option value="ATS">Austria Schillings</option>
                                        <option value="BSD">Bahamas Dollars</option>
                                        <option value="BBD">Barbados Dollars</option>
                                        <option value="BEF">Belgium Francs</option>
                                        <option value="BMD">Bermuda Dollars</option>
                                        <option value="BRR">Brazil Real</option>
                                        <option value="BGL">Bulgaria Lev</option>
                                        <option value="CAD">Canada Dollars</option>
                                        <option value="CLP">Chile Pesos</option>
                                        <option value="CNY">China Yuan Renmimbi</option>
                                        <option value="CYP">Cyprus Pounds</option>
                                        <option value="CSK">Czech Republic Koruna</option>
                                        <option value="DKK">Denmark Kroner</option>
                                        <option value="NLG">Dutch Guilders</option>
                                        <option value="XCD">Eastern Caribbean Dollars</option>
                                        <option value="EGP">Egypt Pounds</option>
                                        <option value="FJD">Fiji Dollars</option>
                                        <option value="FIM">Finland Markka</option>
                                        <option value="FRF">France Francs</option>
                                        <option value="DEM">Germany Deutsche Marks</option>
                                        <option value="XAU">Gold Ounces</option>
                                        <option value="GRD">Greece Drachmas</option>
                                        <option value="HKD">Hong Kong Dollars</option>
                                        <option value="HUF">Hungary Forint</option>
                                        <option value="ISK">Iceland Krona</option>
                                        <option value="INR">India Rupees</option>
                                        <option value="IDR">Indonesia Rupiah</option>
                                        <option value="IEP">Ireland Punt</option>
                                        <option value="ILS">Israel New Shekels</option>
                                        <option value="ITL">Italy Lira</option>
                                        <option value="JMD">Jamaica Dollars</option>
                                        <option value="JPY">Japan Yen</option>
                                        <option value="JOD">Jordan Dinar</option>
                                        <option value="KRW">Korea (South) Won</option>
                                        <option value="LBP">Lebanon Pounds</option>
                                        <option value="LUF">Luxembourg Francs</option>
                                        <option value="MYR">Malaysia Ringgit</option>
                                        <option value="MXP">Mexico Pesos</option>
                                        <option value="NLG">Netherlands Guilders</option>
                                        <option value="NZD">New Zealand Dollars</option>
                                        <option value="NOK">Norway Kroner</option>
                                        <option value="PKR">Pakistan Rupees</option>
                                        <option value="XPD">Palladium Ounces</option>
                                        <option value="PHP">Philippines Pesos</option>
                                        <option value="XPT">Platinum Ounces</option>
                                        <option value="PLZ">Poland Zloty</option>
                                        <option value="PTE">Portugal Escudo</option>
                                        <option value="ROL">Romania Leu</option>
                                        <option value="RUR">Russia Rubles</option>
                                        <option value="SAR">Saudi Arabia Riyal</option>
                                        <option value="XAG">Silver Ounces</option>
                                        <option value="SGD">Singapore Dollars</option>
                                        <option value="SKK">Slovakia Koruna</option>
                                        <option value="ZAR">South Africa Rand</option>
                                        <option value="KRW">South Korea Won</option>
                                        <option value="ESP">Spain Pesetas</option>
                                        <option value="XDR">Special Drawing Right (IMF)</option>
                                        <option value="SDD">Sudan Dinar</option>
                                        <option value="SEK">Sweden Krona</option>
                                        <option value="CHF">Switzerland Francs</option>
                                        <option value="TWD">Taiwan Dollars</option>
                                        <option value="THB">Thailand Baht</option>
                                        <option value="TTD">Trinidad and Tobago Dollars</option>
                                        <option value="TRL">Turkey Lira</option>
                                        <option value="VEB">Venezuela Bolivar</option>
                                        <option value="ZMK">Zambia Kwacha</option>
                                        <option value="EUR">Euro</option>
                                        <option value="XCD">Eastern Caribbean Dollars</option>
                                        <option value="XDR">Special Drawing Right (IMF)</option>
                                        <option value="XAG">Silver Ounces</option>
                                        <option value="XAU">Gold Ounces</option>
                                        <option value="XPD">Palladium Ounces</option>
                                        <option value="XPT">Platinum Ounces</option>
                                    </select>
                                    <p class="text-danger">{{ $errors->first('currency') }}</p>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="contact_email">Contact email :</label>
                                    <input type="email" name="contact_email" id="contact_email" value="{{ old('contact_email') }}" class="form-control">
                                    <p class="text-danger">{{ $errors->first('contact_email') }}</p>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="logo">Logo image :</label>
                                    <img style="max-height: 200px;max-width: 200px;margin-bottom:0px !important;" class="thumbnail" id="logo-preview" alt="No image uploaded">
                                    <div class="controls">
                                        <label for="logo" class="btn btn-primary">
                                            Upload logo image
                                            <input type="file" name="logo" id="logo" class="form-control hidden" onchange="preview(this);">
                                        </label>
                                        <span id="logo-text" class="text-primary">
                                        </span>
                                    </div>
                                    <p class="text-danger">{{ $errors->first('logo') }}</p>
                                </div>
                                <button type="reset" class="btn btn-danger">Reset <i class="fa fa-close"></i></button>
                                <button type="submit" class="btn btn-primary pull-right">Next <i class="fa fa-check"></i></button>
                                <div class="clearfix"></div>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </section>
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

<script type="text/javascript">
    function preview(fileInput)
    {
        document.getElementById('logo-text').innerHTML = document.getElementById('logo').value;
        var preview = document.getElementById('logo-preview');
        var file    = fileInput.files[0];
        var reader  = new FileReader();

        reader.addEventListener("load", function () {
            preview.src = reader.result;
        }, false);

        if (file) {
            reader.readAsDataURL(file);
        }
    }
</script>
</body>
</html>
