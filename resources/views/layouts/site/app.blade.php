<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>

    <link rel="shortcut icon" href="{{ asset('assets/site/images/ficon.png') }}">
    <!-- Standard -->
    <!-- Latest Bootstrap min CSS -->
    <link rel="stylesheet" href="{{ asset('assets/site/css/bootstrap.min.css') }}" type="text/css">
    <!-- Dropdownhover CSS -->
    <link rel="stylesheet" href="{{ asset('assets/site/css/bootstrap-dropdownhover.min.css') }}" type="text/css">
    <!-- simple line fonts awesome -->
    <link rel="stylesheet" href="{{ asset('assets/site/simple-line-icon/css/simple-line-icons.css') }}" type="text/css">
    <!-- stroke-gap-icons -->
    <link rel="stylesheet" href="{{ asset('assets/site/stroke-gap-icons/stroke-gap-icons.css') }}" type="text/css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{ asset('assets/site/css/animate.min.css') }}" type="text/css">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/site/css/style.css') }}" type="text/css">
    <!--  baguetteBox -->
    <link rel="stylesheet" href="{{ asset('assets/site/css/baguetteBox.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/site/css/starrr.css')}}">
    <!--  jCarousel -->
    <link rel="stylesheet" href="{{ asset('assets/site/css/jcarousel.connected-carousels.css')}}">

    <!-- Owl Carousel Assets -->
    <link href="{{ asset('assets/site/owl-carousel/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/site/owl-carousel/owl.theme.css') }}" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-social/5.1.1/bootstrap-social.css" />
{{ Html::style('assets/panel-assets/css/sweetalert.css') }}
@yield('stylesheets')
<style>
.spinner-container {
    position: fixed;
    background-color: #0009;
    width: 100%;
    height: 110%;
    z-index: 10000;
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
.fas {
    display: inline-block;
    font: normal normal normal 14px/1 FontAwesome;
        font-size: 14px;
    font-size: inherit;
    text-rendering: auto;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}
</style>
</head>
<body>
    @include('layouts.site.parts.header')
    <div id="app">
        <div class="spinner-container" v-show="loading_screen" style="display:none;"><div class="spinner"></div></div>
        @yield('content')
    </div>
    <!-- /deal-outer -->
    <!-- newsletter -->
    <section class="newsletter">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <h6 class="sing-up-text">sign up to<strong>newsletter</strong> &<strong>free shipping</strong> for first shopping</h6>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="sing-up-input">
                        <input name="singup" type="text" placeholder="Your email address...">
                        <input name="submit" type="button" value="Submit" />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /newsletter -->
    @include('layouts.site.parts.footer')
    <!-- Login Modal -->
    <div class="modal fade" id="login" data-open-onload="true" data-open-delay="1500" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="fa fa-times"></i>
                </button>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            {{ Form::open(['route' => 'web.login' ,'id' => "form-login"]) }}
                            <div class="pt-20 text-center col-sm-6 col-sm-offset-3">
                                <h2 class="heading font34 inverse text-uppercase">
                                    LOGIN TO YOUR ACCOUNT
                                </h2>
                                <p class="font22 text-center">Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat.</p>
                                <div class="form-group">
                                    <input type="text" required name="email" class="form-control" placeholder="Enter your Email">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" required class="form-control" placeholder="Enter your Password">
                                </div>
                                <div class="form-group">
                                    <input type="checkbox"  id="remember" checked name="remember">
                                    <label for="remember">Remember me</label>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-black" type="submit">Login</button>
                                </div>
                            </div>
                            {{ Form::close() }}

                        </div>
                        <div style="margin-left: 450px;">
                       <strong> or login with</strong>

                          <a class="btn btn-social-icon btn-facebook" href="{{route('facebook.redirect')}}">
                              <span class="fa fa-facebook"></span>
                          </a>
                          <a class="btn btn-social-icon btn-google" href="{{route('google.redirect')}}">
                              <span class="fa fa-google"></span>
                          </a>
                      </div>
                      <br>
                      <div class="row">
                        <div class="form-group" style="margin-left: 470px;">
                            <a href="{{route('register')}}">New ? Register</a>
                        </div>

                        <div class="form-group" style="margin-left: 470px;">
                            <a href="{{route('reset.password')}}">Forget your password ? click here</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Get Our Email Letter popup -->
<div class="modal fade modal-popup" id="modal1" data-open-onload="true" data-open-delay="1500" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i class="fa fa-times"></i>
            </button>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6 pt-20">
                        </div>
                        <div class="col-sm-6 pt-20 text-center">
                            <h2 class="heading font34 inverse text-uppercase">
                                Subscribe to our newsletter
                            </h2>
                            <p class="font22 text-center">Subscribe to the Platin mailing list to receive updates on new arrivals, special offers and other discount information.</p>
                            <form name="main">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Enter your Email id">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-black" type="button">Subscribe!</button>
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" name="check" /> Do not show this popup again
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Get Our Email Letter popup -->
<p id="back-top"> <a href="#top"><i class="fa fa-chevron-up" aria-hidden="true"></i></a> </p>
<script type="text/javascript">
    window.csrfToken = "{{ csrf_token() }}";
</script>
<script src="{{ asset('assets/site/js/jquery.js') }}"></script>
<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('assets/site/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/site/js/bootstrap-dropdownhover.min.js') }}"></script>
<!-- Plugin JavaScript -->
<script src="{{ asset('assets/site/js/jquery.easing.min.js') }}"></script>
<script src="{{ asset('assets/site/js/jquery.countdown.js') }}"></script>
<script src="{{ asset('assets/site/js/wow.min.js') }}"></script>
<!-- owl carousel -->
<script src="{{ asset('assets/site/owl-carousel/owl.carousel.js') }}"></script>
<!--  Custom Theme JavaScript  -->
<script src="{{ asset('assets/site/js/custom.js') }}"></script>

@yield('scripts')

{{ Html::script('assets/panel-assets/js/sweetalert.min.js') }}
@include('sweet::alert')
<script type="text/javascript">
    function wishlist(id) {
        var id = id;
        $.ajax({
            type: "POST",

            url: "{{route('web.wishlist.add')}}",
            data: {
                _token: "{{ csrf_token() }}",
                id: id
            },
            success: function(data) {
                swal("Done", data[0], "success");
                $('#wishListCount').text(data[1]);
            }
        });
    }

      function removeCartItem(rowId) {

        $.ajax({
            type: "POST",

            url: "{{route('web.cart.remove.item')}}",
            data: {
                _token: "{{ csrf_token() }}",
                rowId: rowId
            },
            success: function(data) {
                $('.cartContent'+data[0]).remove();
                $('#cartCountTotalAjax').text('');
                $('#cartCountTotalAjax').text(data[2]);
                $('#cartSubTotalAjax').text('');
                $('#cartSubTotalAjax').text(data[1]);
            }
        });
    }

    function addCompare(id) {
        var id = id;
        $.ajax({
            type: "POST",

            url: "{{route('web.add.compare.product')}}",
            data: {
                _token: "{{ csrf_token() }}",
                id: id
            },
            success: function(data) {
                console.log(data);
                $('#compareCount').text(data[1]);
                swal("Done", "Add to Compare List!", "success");

            }
        });
    }
</script>
</body>
</html>
