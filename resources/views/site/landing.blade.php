<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="format-detection" content="telephone=no" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no, minimal-ui" />

	<!-- fonts collection 5 -->
	<link href='https://fonts.googleapis.com/css?family=Inconsolata:400,700' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Share+Tech+Mono' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Droid+Serif:400italic,700italic' rel='stylesheet' type='text/css'>
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link href="{{ asset('assets/site/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('assets/site/css/bootstrap.extension.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('assets/site/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('assets/site/css/style.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('assets/site/css/swiper.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('assets/site/css/boxesFx.css') }}" rel="stylesheet" type="text/css" />
	<!--[if lt IE 9]>
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/site/css/ie8-and-down.css') }}" />
	<![endif]-->
	<!--[if IE 9]>
	<link href="{{ asset('assets/site/css/ie9.css') }}" rel="stylesheet" type="text/css" />
	<![endif]-->
	{{ Html::style('assets/panel-assets/css/sweetalert.css') }}

	<link rel="shortcut icon" href="{{ asset('assets/site/img/favicon.ico') }}" />
	<title>Pinto | The World's Most Comfortable Underwears</title>
</head>

<body class="fonts-5">

	<!-- LOADER -->
	<div id="loader-wrapper"></div>

	<div id="content-block">
		<!-- HEADER -->
		<header class="type-4 fixed light">
			<div class="wide-container-fluid">
				<div class="row">
					<div class="col-xs-6 col-sm-2">
						<a class="logo"><img src="{{ asset('assets/site/img/logo1.png') }}" alt="" /></a>
					</div>
					<div class="col-xs-6 col-sm-10 text-right">
						<div class="navigation-wrapper">
							<a class="logo responsive"><img src="{{ asset('assets/site/img/logo.png') }}" alt="" /></a>
							<div class="navigation-overflow">
								<nav class="text-left clearfix">
									<ul>
										<li class="active">
											<a href="{{ url('/') }}">Home</a>
										</li>
										<li class="megamenu-wrapper">
											<a href="{{ route('web.products.shop') }}">Shop</a>
											<?php if (!$categories->isEmpty()): ?>
												<span class="toggle-icon"></span>
												<div class="megamenu clearfix">
													<div class="row">
														@foreach($categories as $category)
														<div class="col-md-3">
															<a href="products.html" class="title">{{ $category->name }}</a>
															<span class="toggle-icon"></span>
															<div class="rs-slide">
																@foreach($category->subCategories as $sub_category)
																<a href="products.html">{{ $sub_category->name }}</a>
																@endforeach
															</div>
														</div>
														@endforeach
													</div>
												</div>
											<?php endif; ?>
										</li>
										<li>
											<a href="{{ route('web.products.shop' ,['sort' => 'top_deals']) }}">Top Deals</a>
										</li>
										<li>
											<a href="{{ route('web.about') }}">About</a>
										</li>

										<li>
											<a href="{{ route('web.blog.index') }}">Blog</a>
										</li>
										<li>
											<a href="{{ route('web.contact') }}">Contact Us</a>
										</li>
									</ul>
								</nav>
							</div>

							<div class="follow style-1">
								<span class="title">Follow Us:</span>
								<a class="entry" href="{{ $contact_details && $contact_details->instagram ? $contact_details->instagram : '#' }}"><i class="fa fa-instagram"></i></a>
								<a class="entry" href="{{ $contact_details && $contact_details->facebook ? $contact_details->facebook : '#' }}"><i class="fa fa-facebook"></i></a>
								<a class="entry" href="{{ $contact_details && $contact_details->twitter ? $contact_details->twitter : '#' }}"><i class="fa fa-twitter"></i></a>
								<a class="entry" href="{{ $contact_details && $contact_details->google ? $contact_details->google : '#' }}"><i class="fa fa-google-plus"></i></a>
							</div>

						</div>
						<div class="hamburger-icon open-navigation">
							<span></span>
							<span></span>
							<span></span>
						</div>
					</div>
				</div>
			</div>
			<div class="close-layer toggle-visibility">
				<div class="button-close"></div>
			</div>
		</header>

		<div class="page-height">
			<div class="homepage-9-container">
				<div class="homepage-9-slider">
					<div id="boxgallery" class="boxgallery" data-effect="effect-1">
						@foreach($slider_sheets as $sheet)
						<?php if ($sheet->image): ?>
							<div class="panel">
								<img src="{{ $sheet->image_url }}" class="img-responsive" alt="" />
							</div>
						<?php endif; ?>
						@endforeach
						<div class="boxgallery-text">
							@foreach($slider_sheets as $sheet)
							<div class="boxgallery-text-panel">
								<div class="text">
									<div class="text-animation">
										<div class="project-logo"></div>
									</div>
									<div class="empty-space col-xs-b35"></div>
									<div class="text-animation delay-1">
										<div class="slide-title h2 small light">
											{{ $sheet->head1 }}
										</div>
									</div>
									<div class="empty-space col-xs-b15"></div>
									<div class="text-animation delay-2">
										<div class="slide-description simple-article large light transparent">
											{{ $sheet->desc }}
										</div>
									</div>
									<div class="empty-space col-xs-b35"></div>
									<div class="text-animation delay-3">
										<a href="{{ $sheet->url ? $sheet->url : '' }}" class="button type-3 light">
											{{ $sheet->action_text ? $sheet->action_text : 'SHOP NOW' }}
										</a>
									</div>
								</div>
							</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- FOOTER -->
		<footer class="type-2 transparent">
			<div class="wide-container-fluid">
				<div class="row">
					<div class="col-md-6 col-xs-text-center col-md-text-left col-sm-b10 col-md-b0">
						<div class="copyright">
							<div class="simple-article small light transparent">
								&copy; 2018 All rights reserved.
								<div class="developed-by">Development by <a href="" target="blank">Graphic Hex.</a></div>
							</div>
						</div>
						<div class="empty-space col-xs-b20 col-md-b0"></div>
					</div>
					<div class="col-md-6 col-xs-text-center col-md-text-right">
						<div class="follow style-3">
							<span class="title">Follow Us:</span>
							<a class="entry" href="{{ $contact_details && $contact_details->instagram ? $contact_details->instagram : '#' }}" target="_blank"><i class="fa fa-instagram"></i></a>
							<a class="entry" href="{{ $contact_details && $contact_details->facebook ? $contact_details->facebook : '#' }}" target="_blank"><i class="fa fa-facebook"></i></a>
							<a class="entry" href="{{ $contact_details && $contact_details->twitter ? $contact_details->twitter : '#' }}" target="_blank"><i class="fa fa-twitter"></i></a>
							<a class="entry" href="{{ $contact_details && $contact_details->google ? $contact_details->google : '#' }}" target="_blank"><i class="fa fa-google-plus"></i></a>
						</div>
					</div>
				</div>
			</div>
		</footer>
	</div>

	<script src="{{ asset('assets/site/js/jquery-2.1.4.min.js') }}"></script>
	<script src="{{ asset('assets/site/js/swiper.jquery.min.js') }}"></script>
	<script src="{{ asset('assets/site/js/jquery.mousewheel.min.js') }}"></script>
	<script src="{{ asset('assets/site/js/global.js') }}"></script>
	<script src="{{ asset('assets/site/js/modernizr.custom.js') }}"></script>
	<script src="{{ asset('assets/site/js/boxesFx.js') }}"></script>
	{{ Html::script('assets/panel-assets/js/sweetalert.min.js') }}
    @include('sweet::alert')
	<script>
	new BoxesFx(document.getElementById('boxgallery'));
	</script>
</body>
</html>
