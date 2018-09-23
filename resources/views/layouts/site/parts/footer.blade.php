<footer>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-4 col-md-4">
                <!-- f-weghit -->
                <div class="f-weghit">
                    <img src="{{asset('assets/site/images/logo-footer.png')}}" alt="logo" style="margin:0 auto; text-align: center;" />
                    <p><strong>Lorem</strong> Typi non habent claritatem insitam, est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus.</p>
                    <div class="row" style="margin-top:15px;">
                        <div class="col-md-6">
                            <img src="{{asset('assets/site/images/play-store.png')}}" class="img-responsive">
                        </div>
                        <div class="col-md-6">
                            <img src="{{asset('assets/site/images/app-store.png')}}" class="img-responsive">
                        </div>
                    </div>
                </div>
                <!-- /f-weghit -->
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4">
                <!-- f-weghit2 -->
                <div class="f-weghit2">
                    <h4>INFORMATION</h4>
                    <ul>
                        <li>
                            <a href="{{ route('web.about') }}">About Us</a>
                        </li>
                        <li>
                            <a href="{{ route('web.contact') }}">Contact Us</a>
                        </li>
                        <li>
                            <a href="{{ route('web.policy') }}">Privacy policy</a>
                        </li>
                        <li>
                            <a href="{{ route('web.terms') }}">Terms & conditions</a>
                        </li>
                    </ul>
                </div>
                <!-- /f-weghit2 -->
                <!-- f-weghit2 -->
                <div class="f-weghit2">
                    <h4>Quick Links</h4>
                    <ul>
                        <li>
                            <a href="{{ route('index') }}">Home</a>
                        </li>
                        <li>
                            <a href="{{ route('web.products.search') }}">Shop</a>
                        </li>
                        <li>
                            <a href="{{ route('register') }}">Register</a>
                        </li>
                        <li>
                            <a href="{{ route('web.wishlist.index') }}">Wishlist</a>
                        </li>
                    </ul>
                </div>
                <!-- /f-weghit2 -->
            </div>
            <div class="col-xs-12 col-sm-4 col-md-2">
                <!-- f-weghit -->
                <div class="f-weghit2">
                    <h4>Brands</h4>
                    <ul>
                        <li>
                            <a href="#">Samsung</a>
                        </li>
                        <li>
                            <a href="#">Apple</a>
                        </li>
                        <li>
                            <a href="#">LG</a>
                        </li>
                        <li>
                            <a href="#">Sony</a>
                        </li>
                        <li>
                            <a href="#">Toshiba</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- copayright -->
            <div class="copayright">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        Copyright ©
                        <a href="#">Graphichex</a> all rights reserved. Powered by
                    </div>
                    <div class="col-sm-6 col-md-6">
                        <ul class="footer-social-links">
                            <li>
                                <a href="{{ $contact && $contact->facebook ? $contact->facebook : '#' }}">
                                    <img src="{{ asset('assets/site/images/social/facebook.png') }}">
                                </a>
                            </li>
                            <li>
                                <a href="{{ $contact && $contact->twitter ? $contact->twitter : '#' }}">
                                    <img src="{{ asset('assets/site/images/social/twitter.png') }}">
                                </a>
                            </li>
                            <li>
                                <a href="{{ $contact && $contact->google ? $contact->google : '#' }}">
                                    <img src="{{ asset('assets/site/images/social/google-plus.png') }}">
                                </a>
                            </li>
                            <li>
                                <a href="{{ $contact && $contact->instagram ? $contact->instagram : '#' }}">
                                    <img src="{{ asset('assets/site/images/social/instagram.png') }}">
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /copayright -->
        </div>
    </div>
</footer>
