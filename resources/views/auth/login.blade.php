@extends('website.layouts.app')
@section('css')
<link href="{{ asset('css/pages/login/login-1.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('website')
<div class="d-flex flex-column flex-root">
    <!--begin::Login-->
    <div class="flex bg-white login login-1 login-signin-on flex-column flex-lg-row flex-column-fluid" id="kt_login">

        <!--begin::Aside-->
        <!--begin::Content-->
        <div class="pt-56 mx-auto overflow-hidden login-content flex-row-fluid d-flex flex-column justify-content-center position-relative p-7">
            <!--begin::Content body-->
            <div class="d-flex flex-column-fluid flex-center my-5">
                @guest
                <!--begin::Signin-->
                <div class="login-form login-signin" >
                    <!--begin::Form-->
                    <!--begin::Title-->
                    <div class="pb-5 pb-13 pt-lg-0">
                        <h4 class="py-10 text-4xl font-bold text-dark font-size-h4 font-size-h1-lg">{{ __('Welcome to ') }}{{ Session::get('app_locale')=='en'? App\Models\Settings::first()->appName : App\Models\Settings::first()->appName_ar }}</h4>
                        <span class="text-muted font-weight-bold font-size-h4">{{ __('New Here?') }}
                        <a href="{{ url('/register') }}" id="kt_login_signup" class="text-primary font-weight-bolder">{{ __('Create an Account') }}</a></span>
                    </div>
                    <form method="POST" action="{{ route('login') }}" class="form" id="kt_login_signin_form" >
                        @csrf
                        <div class="form-group">
                            <label for="email" class="font-size-h6 font-weight-bolder text-dark">{{ __('E-Mail Address') }}</label>
                            <input id="email" type="email" class="form-control form-control-solid h-auto py-6 px-6 rounded-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus >
                            @error('email')
                                <div class="fv-plugins-message-container">
                                    <div class="text-red-600 fv-help-block">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="d-flex justify-content-between mt-n5">
                                <label for="password" class="pt-5 font-size-h6 font-weight-bolder text-dark">{{ __('Password') }}</label>
                                <a href="{{ route('password.request') }}"class="pt-5 text-primary font-size-h6 font-weight-bolder text-hover-primary" id="kt_login_forgot"> {{ __('Forgot Your Password?') }}</a>
                            </div>
                            <input id="password" type="password" class="form-control form-control-solid h-auto py-6 px-6 rounded-lg @error('password') is-invalid @enderror"
                             name="password" value="{{ old('password') }}" required  >
                            @error('password')
                                <div class="fv-plugins-message-container">
                                    <div class="text-red-600 fv-help-block">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                </div>
                            @enderror
                        </div>
                        <div class="form-check" style="display: inline-block;">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="ml-5 form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>

                        <div class="pb-5 pb-lg-0">
                            <button type="submit" id="kt_login_signin_submit" class="px-8 py-4 my-3 mr-3 btn btn-primary font-weight-bolder font-size-h6">
                                {{ __('Login') }}
                            </button>
                        </div>
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Signin-->
                @else
                    <div class="card">

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">{{ __('Welcome to ') }}{{ Session::get('app_locale')=='en'? App\Models\Settings::first()->appName : App\Models\Settings::first()->appName_ar }}</h3>
                        </div>
                    </div>
                @endguest
            </div>

        </div>
        <!--end::Content-->
    </div>
    <!--end::Login-->
</div>

@endsection


