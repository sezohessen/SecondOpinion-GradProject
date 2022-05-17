<!DOCTYPE html>
<html lang="en" @if (App::isLocale('ar')) direction="rtl" dir="rtl" style="direction: rtl" @endif>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ LangDetail(App\Models\Settings::first()->appName,App\Models\Settings::first()->appName_ar) }} @yield('title',@$page_title ? ' | '.@$page_title : '')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="{{ asset('img/settings/TO-PART-LOGO.svg') }}" />
    {{-- Meta Data --}}
    <meta name="description" content="@yield('page_description', $page_description ?? '')" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&amp;family=Roboto:wght@400;700&amp;display=swap">

    <link rel="stylesheet" href="{{ asset('css/website/css/material-design-font.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/website/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/website/css/libraries.css') }}">
    <link rel="stylesheet" href="{{ asset('css/website/css/style.css') }}">
    @if (App::isLocale('ar')) <link href="{{ asset('css/website/css/style_ar.css') }}" rel="stylesheet"> @endif
    @yield('css')
</head>
<body>
    <div class="wrapper">
        <div class="preloader">
          <div class="loading"><span></span><span></span><span></span><span></span></div>
        </div><!-- /.preloader -->
        <header class="header header-layout1">
          <nav class="navbar navbar-expand-lg sticky-navbar main-nav">
            <div class="container-fluid">
              <a class="navbar-brand" href="index.html">
                <!-- <img src="assets/images/logo/logo-light.png" class="logo-light" alt="logo">
                <img src="assets/images/logo/logo-dark.png" class="logo-dark" alt="logo"> -->
              </a>
              <button class="navbar-toggler" type="button">
                <span class="menu-lines"><span></span></span>
              </button>
              <div class="collapse navbar-collapse" id="mainNavigation">
                <ul class="navbar-nav ml-auto">
                  <li class="nav__item">
                    <a href="#" class="nav__item-link active">@lang('Home')</a>
                  </li><!-- /.nav-item -->
                  <li class="nav__item has-dropdown">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle nav__item-link">@lang('Doctors')</a>
                    <ul class="dropdown-menu">
                      <li class="nav__item">
                        <a href="{{ route('Website.page.doctors') }}" class="nav__item-link">@lang('Search for doctor')</a>
                      </li> <!-- /.nav-item -->
                      <li class="nav__item">
                        <a href="doctors-single-doctor1.html" class="nav__item-link">Doctor page</a>
                      </li> <!-- /.nav-item -->

                    </ul><!-- /.dropdown-menu -->
                  </li><!-- /.nav-item -->
                  <li class="nav__item has-dropdown">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle nav__item-link">@lang('Radiology centers')</a>
                    <ul class="dropdown-menu">
                      <li class="nav__item">
                        <a href="centers.html" class="nav__item-link">All centers</a>
                      </li><!-- /.nav-item -->
                      <li class="nav__item">
                        <a href="center.html" class="nav__item-link">Center page</a>
                      </li><!-- /.nav-item -->
                    </ul><!-- /.dropdown-menu -->
                  </li><!-- /.nav-item -->
                  <li class="nav__item">
                    <a href="faqs.html" class="nav__item-link">@lang('FAQs')</a>
                  </li><!-- /.nav-item -->
                  <li class="nav__item">
                    <a href="contact-us.html" class="nav__item-link">@lang('Contact us')</a>
                  </li><!-- /.nav-item -->
                  <li class="nav__item has-dropdown">
                    <a href="#" class="nav__item-link">@lang('About Us')</a>
                  </li><!-- /.nav-item -->
                  <li class="nav__item has-dropdown">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle nav__item-link">
                        <i class="fas fa-user"></i>
                        @auth
                        {{ auth()->user()->FullName }}
                        @endauth
                        @guest
                            @lang('My Account')
                        @endguest
                    </a>
                    @guest
                        <ul class="dropdown-menu profile">
                            <li class="nav__item">
                                <a href="{{ route('login') }}"  class="nav__item-link"> @lang('Login')</a>
                            </li>
                            <li class="nav__item">
                                <a href="{{ route('register') }}"  class="nav__item-link">  @lang('Register')</a>
                            </li>
                        </ul>
                    @endguest
                    @auth
                        <ul class="dropdown-menu profile">
                            @if (auth()->user()->hasRole(App\Models\User::DoctorRole))
                                <li class="nav__item">
                                    <a href="{{ route('doctor.pending.radiology') }}" class="nav__item-link">@lang('Pending radiology')</a>
                                </li><!-- /.nav-item -->
                                <li class="nav__item">
                                    <a href="{{ route('doctor.completed.radiology') }}" class="nav__item-link">@lang('Completed radiology')</a>
                                </li><!-- /.nav-item -->
                                <li class="nav__item">
                                    <a href="{{ route('doctor.account') }}" class="nav__item-link">@lang('My account')</a>
                                </li><!-- /.nav-item -->
                            @elseif(auth()->user()->hasRole(App\Models\User::CenterRole))
                            <li class="nav__item">
                                <a href="#" class="nav__item-link">@lang('Send Radiology')</a>
                                <a href="{{ route('center.pending.radiology') }}" class="nav__item-link">@lang('Pending Radiology')</a>
                                <a href="{{ route('center.completed.radiology') }}" class="nav__item-link">@lang('Completed Radiology')</a>
                                <a href="#" class="nav__item-link">@lang('Contracts')</a>
                                </li><!-- /.nav-item -->
                            @endif
                            <li class="nav__item">
                                <a class="nav__item-link" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                            </li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </ul>
                    @endauth
                  </li><!-- /.nav-item -->
                  <li class="nav__item has-dropdown relative nav-lang-container">
                    <a data-toggle="dropdown" class="dropdown-toggle nav__item-link">@lang('language')</a>
                    <ul class="absolute left-0 nav-lang" id='nav-lang'>
                        <li class="py-3 navi-item nav__item">
                            <a href="{{url('/lang/en')}}" class="navi-link  @if (App::isLocale('en'))  active  @endif">
                                <div>
                                    <div class="flex">
                                        <span class="leading-10">@lang('English') </span>
                                        <img class="w-32 ml-auto mr-auto" style="height: 30px;" src="{{ asset('img/language/united-kingdom.svg') }}" alt=""/>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="py-3 navi-item nav__item">
                            <a href="{{url('/lang/ar')}}" class="navi-link  @if (App::isLocale('ar'))  active  @endif" href="{{url('/ar')}}">
                                <div>
                                    <div class="flex">
                                        <span class="leading-10">@lang('Arabic') </span>
                                        <img class="w-32 ml-auto mr-auto" style="height: 30px;" src="{{ asset('img/language/saudi-arabia.svg') }}" alt=""/>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>

                </ul><!-- /.navbar-nav -->
                <button class="close-mobile-menu d-block d-lg-none"><i class="fas fa-times"></i></button>
              </div><!-- /.navbar-collapse -->
            </div><!-- /.container -->
          </nav><!-- /.navabr -->
        </header>
        <!-- /.Header -->

        <main>
            @yield('website')
        </main>
        <footer class="footer">
            <div class="footer-primary">
            <div class="container">
                <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-3">
                    <div class="footer-widget-about">
                    <h4 class="text-white">Second Opinion</h4>
                    <!-- <img src="assets/images/logo/logo-light.png" alt="logo" class="mb-30"> -->
                    <p class="color-gray">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero quam doloribus earum non consectetur consequuntur, mollitia autem et id eos aliquam inventore provident? Illum molestiae iste laudantium nulla culpa expedita?
                    </p>
                    <a href="doctors-single-doctor1.html" class="btn btn__primary btn__primary-style2 btn__link">
                        <span>Find doctors</span> <i class="icon-arrow-right"></i>
                    </a>
                    </div><!-- /.footer-widget__content -->
                </div><!-- /.col-xl-2 -->
                <div class="col-sm-6 col-md-6 col-lg-2 offset-lg-1">
                    <div class="footer-widget-nav">
                    <h6 class="footer-widget__title">Departments</h6>
                    <nav>
                        <ul class="list-unstyled">
                        <li><a href="#">Neurology radiology</a></li>
                        <li><a href="#">Cardiology radiology</a></li>
                        <li><a href="#">Pathology radiology</a></li>
                        <li><a href="#">Laboratory Analysis</a></li>
                        <li><a href="#">Pediatric radiology</a></li>
                        <li><a href="#">Cardiac radiology</a></li>
                        </ul>
                    </nav>
                    </div><!-- /.footer-widget__content -->
                </div><!-- /.col-lg-2 -->
                <div class="col-sm-6 col-md-6 col-lg-2">
                    <div class="footer-widget-nav">
                    <h6 class="footer-widget__title">Links</h6>
                    <nav>
                        <ul class="list-unstyled">
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Our radiology</a></li>
                        <li><a href="#">Our Doctors</a></li>
                        <li><a href="#">Appointments</a></li>
                        </ul>
                    </nav>
                    </div><!-- /.footer-widget__content -->
                </div><!-- /.col-lg-2 -->
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="footer-widget-contact">
                    <h6 class="footer-widget__title color-heading">Quick Contacts</h6>
                    <ul class="contact-list list-unstyled">
                        <li>If you have any questions or need help, feel free to contact with our team.</li>
                        <li>
                        <a href="tel:01000000000" class="phone__number">
                            <i class="icon-phone"></i> <span>01000000000</span>
                        </a>
                        </li>
                        <li class="color-body">Egypt -Giza</li>
                    </ul>
                    <div class="d-flex align-items-center">
                        <a href="contact-us.html" class="btn btn__primary btn__link mr-30">
                        <i class="icon-arrow-right"></i> <span>Get Directions</span>
                        </a>
                        <ul class="social-icons list-unstyled mb-0">
                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                        </ul><!-- /.social-icons -->
                    </div>
                    </div><!-- /.footer-widget__content -->
                </div><!-- /.col-lg-2 -->
                </div><!-- /.row -->
            </div><!-- /.container -->
            </div><!-- /.footer-primary -->
        </footer><!-- /.Footer -->
    </div>
    <button id="scrollTopBtn"><i class="fas fa-long-arrow-alt-up"></i></button>
    <script src="{{ asset('js/website/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('js/website/js/plugins.js') }}"></script>
    <script src="{{ asset('js/website/js/main.js') }}"></script>
    @yield('js')
</body>
</html>
