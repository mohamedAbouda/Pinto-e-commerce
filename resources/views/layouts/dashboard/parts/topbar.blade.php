<header id="topbar">
    <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="navbar-collapse collapse" id="bs-example-navbar-collapse-1">

                <ul class="nav navbar-nav navbar-right margin-top0">

                    <li class="dropdown pad0">
                        <a href="#" class="dropdown-toggle pad-bottom0 margin-top5" data-toggle="dropdown">
                            <span class="top-bar-username">{{ Auth::user()->name }} </span>
                            <img scr="" src="{{ asset('assets/panel-assets/images/profile-picutre/01_img.png') }}" class="navbar-profile-picture" style="width: 25px;height: 25px;">
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- <li>
                                <a href="#">Action</a>
                            </li>
                            <li>
                                <a href="#">Another action</a>
                            </li>
                            <li>
                                <a href="#">Something else here</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">Separated link</a>
                            </li>
                            <li class="divider"></li> -->
                            <li>
                                <a href="{{ Auth::guard('web')->check() ? route('dashboard.logout') : route('dashboard.merchant.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                  <i class="fa fa-lock"></i>
                                  Logout
                              </a>
                              <form id="logout-form" action="{{ Auth::guard('web')->check() ? route('dashboard.logout') : route('dashboard.merchant.logout') }}" method="POST" style="display: none;">
                                  {{ csrf_field() }}
                              </form>
                          </li>
                      </ul>

                  </li>
                  @if(Config::get('app.locale') == 'en')
                    <li class="dropdown pad0">
                        <a href="#" class="dropdown-toggle pad-bottom0 margin-top5" data-toggle="dropdown">
                           English
                        </a>
                        <ul class="dropdown-menu">
                            
                            <li>
                                <a href="{{url('locale/ar')}}" title="">اللغة العربية</a>
                          </li>
                      </ul>

                  </li>
                  @else
                       <li class="dropdown pad0">
                        <a href="#" class="dropdown-toggle pad-bottom0 margin-top5" data-toggle="dropdown">
                           العربية
                        </a>
                        <ul class="dropdown-menu">
                            
                            <li>
                                <a href="{{url('locale/en')}}" title="">English</a>
                          </li>
                      </ul>

                  </li>
                 
                  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-rtl/3.4.0/css/bootstrap-flipped.css" />
                 
                  @endif
                
            </ul>

        </div>
    </div>
</nav>
</header>
