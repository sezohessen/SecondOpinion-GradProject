<!DOCTYPE html>
<html lang="en" @if (App::isLocale('ar')) direction="rtl" dir="rtl" style="direction: rtl" @endif>

<!-- Mirrored from premiumlayers.com/html/automan/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 04 Sep 2021 05:37:39 GMT -->
<head>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>{{ LangDetail(App\Models\Settings::first()->appName,App\Models\Settings::first()->appName_ar) }} @yield('title',$page_title ?? '')</title>

		<!-- Bootstrap -->
		<link href="{{ asset('css/website/css/bootstrap.min.css') }}" rel="stylesheet">
		<!-- Font Awesome -->
		<link href="{{ asset('lang/fonts/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
		<!-- Ionicons -->
		<link href="{{ asset('lang/fonts/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
        <!-- Cars -->
		<link href="{{ asset('lang/fonts/cars/style.css') }}" rel="stylesheet">
		<!-- FlexSlider -->
		<link href="{{ asset('js/website/scripts/FlexSlider/flexslider.css') }}" rel="stylesheet">
		<!-- Owl Carousel -->
		<link href="{{ asset('css/website/css/owl.carousel.css') }}" rel="stylesheet">
		<link href="{{ asset('css/website/css/owl.theme.default.css') }}" rel="stylesheet">
		<!-- noUiSlider -->
		<link href="{{ asset('css/website/css/jquery.nouislider.min.css') }}" rel="stylesheet">
		<!-- Style.css -->
		<link href="{{ asset('css/website/css/style.css') }}" rel="stylesheet">
        @if (App::isLocale('ar')) <link href="{{ asset('css/website/css/style_ar.css') }}" rel="stylesheet"> @endif
        <!-- Tailwindcss -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100;300;400;500;700&display=swap" rel="stylesheet">

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        {{-- CDN --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
        @yield('css')
	</head>
	<body>

		<header class="header ">
			<div class="container">
				<div class="clearfix navigation">
					<div class="logo"><a href="{{ route('Website.Index') }}"><img style='height: 55px;' src="{{ asset('img/website/logo1.png') }}" alt="Automan" class="p-4 img-responsive"></a></div> <!-- end .logo -->
					<div class="contact">
					</div> <!-- end .contact -->
					<nav class="main-nav">
						<ul class="list-unstyled">

							<li class="active">
								<a href="{{url('index')}}">@lang('Home')</a>
							</li>
                            @if (Auth::check())
							<li class="favorite">
								<a href="{{url('favorite')}}">@lang('Favorite')
                                    <span>( {{  App\Models\UserFav::where('user_id', Auth()->user()->id)->count(); }} )</span>
                                </a>
							</li>
                            @endif

							<li><a href="{{url('contact-us')}}">@lang('Contact Us')</a></li>

                            <!-- Langague -->
                            <li class="relative nav-lang-container">
                                <a href="">@lang('language')</a>
                                <ul class="absolute left-0 nav-lang" id='nav-lang'>
                                    <li class="py-3 navi-item">
                                        <a href="{{url('/lang/en')}}" class="navi-link @if (App::isLocale('en'))  active  @endif">
                                            <div>
                                                <div class="flex">
                                                    <span class="leading-10">@lang('English') </span>
                                                    <img class="w-32 ml-auto mr-auto" style="height: 30px;" src="{{ asset('img/language/united-kingdom.svg') }}" alt=""/>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="py-3 navi-item">
                                        <a href="{{url('/lang/ar')}}" class="navi-link @if (App::isLocale('ar'))  active  @endif" href="{{url('/ar')}}">
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
                            <!-- User component -->
                            <li class="relative">
								<a id="user-logo" href="#">
                                     <i class="px-4 text-gray-100 bg-gray-600 rounded-t-md ion-ios-person fa-2x"></i> </a>
									<ul class="absolute right-0">
                                    @auth
									<li><a href="{{url('/edit-user')}}"> @lang('Profile') </a></li>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>

                                    @endauth
                                    @guest
                                    <li class="p-4"><a href="{{ url('/') }}">@lang('Login')</a></li>
                                    @endguest
								</ul>
							</li>
						</ul>
					</nav> <!-- end .main-nav -->
					<a href="#" class="responsive-menu-open"><i class="fa fa-bars"></i></a>
				</div> <!-- end .navigation -->
			</div> <!-- end .container -->
		</header> <!-- end .header -->
		<div class="responsive-menu">
			<a href="#" class="responsive-menu-close"><i class="ion-android-close"></i></a>
			<nav class="responsive-nav"></nav> <!-- end .responsive-nav -->
		</div> <!-- end .responsive-menu -->

        <main>
            @yield('website')
        </main>


		<footer class="footer">
			<div class="top" style="padding-top:50px;">
				<div class="container">
					<div class="row">
						<div class="col-sm-4">
							<h3 class="mb-10">@lang('About Us')</h3>
							<p>Lorem ipsum dolor sit amet, consectetur  some dymm adipiscing elit. Nam turpis quam, sodales in text she ante sagittis, varius efficitur mauris.</p>
                            <hr class="my-10"/>
                            <!-- Call Setting globaly -->
                            @php
                              use App\Models\Settings;
                              $Settings = Settings::all()->first();
                            @endphp
							<div class="iconbox-left">
								<div class="px-5 icon"><i class="fa fa-map-marker"></i></div> <!-- end .icon -->
								<div class="content"><p>{{ $Settings->location }}</p></div> <!-- end .content -->
							</div> <!-- end .iconbox-left -->
							<div class="iconbox-left">
								<div class="px-5 icon"><i class="fa fa-envelope"></i></div> <!-- end .icon -->
								<div class="content"><p> {{ $Settings->email }} </p></div> <!-- end .content -->
							</div> <!-- end .iconbox-left -->
							<div class="iconbox-left">
								<div class="px-5 icon"><i class="fa fa-phone"></i></div> <!-- end .icon -->
								<div class="content"><p>{{ $Settings->phone }}</p></div> <!-- end .content -->
							</div> <!-- end .iconbox-left -->
						</div> <!-- end .col-sm-4 -->
						<div class="col-sm-4">
							<h3 class="mb-10">@lang('Top parts')</h3>
                            @php
                                $footerParts = App\Models\Part::Where('active',1)->orderBy('views','DESC')->limit(3)->get();
                            @endphp
                            @foreach ($footerParts as $part)
                                <div id="footer-parts">
                                    <div class="row">
                                        <div class="img col-md-4">
                                            <a href="{{ route('Website.ShowPart',$part->id) }}">
                                                <img src="{{ find_image($part->FirstImage->image,App\Models\Part::base) }}" alt="{{ $part->FirstImage->image->name }}">
                                            </a>
                                        </div>
                                        <div class="part-info col-md-8">
                                            <a href="{{ route('Website.ShowPart',$part->id) }}">
                                                <div>{{ LangDetail($part->name,$part->name_ar) }}</div>
                                            </a>
                                            <div>{{ $part->price }} @lang('L.E')</div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

						</div> <!-- end .col-sm-4 -->
						<div class="col-sm-4">
							<h3 class="mb-10">@lang('Get in Touch')</h3>
                            <div class="row">
                                <div class="iconbox-left">
                                    <div class="px-5 icon"><i class="fas fa-envelope-open-text"></i></div> <!-- end .icon -->
                                    <div class="content"><a href="{{ route('Website.ContactUs') }}">@lang('Feel free to contact us')</a> </div> <!-- end .content -->
                                </div> <!-- end .iconbox-left -->
                                <div class="iconbox-left">
                                    <div class="px-5 icon"><i class="fas fa-journal-whills"></i></div> <!-- end .icon -->
                                    <div class="content"><a href="{{ route('OurTerms') }}">@lang('Check Terms and Conditions')</a></div> <!-- end .content -->
                                </div> <!-- end .iconbox-left -->
                                <div class="iconbox-left">
                                    <div class="px-5 icon"><i class="fas fa-handshake"></i></div> <!-- end .icon -->
                                    <div class="content"><a href="{{ route('OurPolicy') }}">@lang('Check Privacy and Policy')</a></div> <!-- end .content -->
                                </div> <!-- end .iconbox-left -->
                            </div>
                            {{-- social links --}}
                            <h5 style="margin-top:15px;margin-bottom:10px;">@lang('Our Social media links')</h5>
                            <div class="row">
                                <div class="col-md-12">
                                <!-- Instagram -->
                                <a id="insta" class="btn btn-primary"  href="#!" role="button"
                                title="Check our Instagram"
                                ><i class="fab fa-instagram"></i
                                ></a>
                                <!-- Whatsapp -->
                                <a id="whatsapp" class="btn btn-primary"
                                href="https://api.whatsapp.com/send?phone={{$Settings->whatsapp}}" role="button"
                                target="_blank"
                                title="{{ $Settings->whatsapp }}"
                                ><i class="fab fa-whatsapp"></i
                                ></a>
                                </div>
                            </div>
                            {{-- Download IOS/ANDRIOD --}}
                            <h5 style="margin-top:15px;margin-bottom:10px;">@lang('Download Our App..')</h5>
                            <div class="row">
                                <div class="col-md-12">
                                <!-- Ios -->
                                <a class="btn btn-primary"
                                id="ios"
                                title="Download Ios App"
                                href="#!" role="button">
                                <i class="fab fa-apple"></i></a>
                                <!-- Andriod -->
                                    <a class="btn btn-primary"
                                    id="andriod"
                                    title="Download Andriod App"
                                    href="#!" role="button">
                                    <i class="fab fa-android"></i></a>
                                </div>
                            </div>
                            </div>
                            {{-- End Footer --}}
                            </div>
						</div> <!-- end .col-sm-4 -->
					</div> <!-- end .row -->
				</div> <!-- end .container -->
			</div> <!-- end .top -->
			<div class="bottom">
				<span class="copyright">Copyright 2015. All Rights Reserved by Automan. Designed by Theme Designer.</span>
			</div> <!-- end .bottom -->
		</footer> <!-- end .footer -->

		<!-- jQuery -->
		<script src="{{ asset('js/website/js/jquery-1.11.2.min.js') }}"></script>
		<!-- Bootstrap -->
		<script src="{{ asset('js/website/js/bootstrap.min.js') }}"></script>
		<!-- Inview -->
		<script src="{{ asset('js/website/js/jquery.inview.min.js') }}"></script>
		<!-- google maps -->
		<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
		<!-- Tweetie -->
		<script src="{{ asset('js/website/scripts/Tweetie/tweetie.min.js') }}"></script>
		<!-- FlexSlider -->
		<script src="{{ asset('js/website/scripts/FlexSlider/jquery.flexslider-min.js') }}"></script>
		<!-- Owl Carousel -->
		<script src="{{ asset('js/website/js/owl.carousel.min.js') }}"></script>
		<!-- Isotope -->
		<script src="{{ asset('js/website/js/isotope.pkgd.min.js') }}"></script>

		<script src="{{ asset('js/website/js/imagesloaded.pkgd.min.js') }}"></script>
		<!-- noUiSlider -->
		<script src="{{ asset('js/website/js/jquery.nouislider.all.min.js') }}"></script>
		<!-- Scripts.js -->
		<script src="{{ asset('js/website/js/scripts.js') }}"></script>

        @yield('js')

	</body>

<!-- Mirrored from premiumlayers.com/html/automan/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 04 Sep 2021 05:37:39 GMT -->
</html>
