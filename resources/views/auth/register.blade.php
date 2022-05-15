@extends('website.layouts.app')
@section('css')
    <link href="{{ asset('css/pages/login/login-1.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .form-label {
            width: 100%;
            margin-top: 10px;
        }

        .form-label>div {
            display: inline-block;
            margin: 0px 5px;
        }

    </style>
@endsection
@section('website')
    <div class="d-flex flex-column flex-root my-5">
        <!--begin::Login-->
        <div class="flex bg-white login login-1 login-signin-on flex-column flex-lg-row flex-column-fluid" id="kt_login">
            <div
                class="pt-56 mx-auto overflow-hidden login-content flex-row-fluid d-flex flex-column justify-content-center position-relative p-7">
                <!--begin::Content body-->
                <div class="d-flex flex-column-fluid ">
                    <div class="login-form login-signup pt-11" style="display: block">
                        <!--begin::Form-->
                        <form class="form" method="POST" action="{{ route('Website.patient.create') }}">
                            @csrf
                            <!--begin::Title-->
                            <div class="py-10 reg_doctor">
                                <h2 class="text-4xl font-bold text-dark font-size-h2 font-size-h1-lg pb-9">@lang('Sign Up As Patient')
                                </h2>
                                <a href="{{ route('Website.doctor.register') }}" class="my-2">
                                    <h6>
                                        @lang('Register as doctor') ?
                                    </h6>
                                </a>
                                <a href="{{ route('Website.center.register') }}" class="my-2">
                                    <h6>
                                        @lang('Register as center') ?
                                    </h6>
                                </a>
                                <p class="text-muted font-weight-bold font-size-h4">@lang('Enter your details to create your
                                    account')</p>
                            </div>
                            <!--end::Title-->
                            <!--begin::Form group-->
                            <div class="form-group">
                                <label>@lang('First Name') <span class="text-danger">*</span> </label>
                                <input id="first_name" type="text"
                                    class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6 @error('first_name') is-invalid @enderror"
                                    name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name"
                                    autofocus placeholder="@lang('First Name')*">
                                @error('first_name')
                                    <div class="fv-plugins-message-container">
                                        <div class="text-red-600 fv-help-block">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    </div>
                                @enderror
                            </div>
                            <!--end::Form group-->
                            <!--begin::Form group-->
                            <div class="form-group">
                                <label>@lang('Last Name') <span class="text-danger">*</span> </label>
                                <input id="last_name" type="text"
                                    class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6 @error('last_name') is-invalid @enderror"
                                    name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name"
                                    placeholder="@lang('Last Name')">
                                @error('last_name')
                                    <div class="fv-plugins-message-container">
                                        <div class="text-red-600 fv-help-block">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    </div>
                                @enderror
                            </div>
                            <!--end::Form group-->
                            <div class="form-group">
                                <label>@lang('Email') <span class="text-danger">*</span> </label>
                                <input id="email" type="email"
                                    class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6 @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required placeholder="@lang('Email')">
                                @error('email')
                                    <div class="fv-plugins-message-container">
                                        <div class="text-red-600 fv-help-block">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="d-block">@lang('Date of birth') <span class="text-danger">*</span></label>
                                <div class="field_age">
                                    <div class="field-inline-block">
                                    <label>@lang('Day')</label>
                                    <input type="text" pattern="[0-9]*" maxlength="2" size="2" class="date-field" name="day" />
                                    @error('day')
                                        <div class="fv-plugins-message-container">
                                            <div class="text-red-600 fv-help-block">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        </div>
                                    @enderror
                                    </div>
                                    /
                                    <div class="field-inline-block">
                                    <label>@lang('Month')</label>
                                    <input type="text" pattern="[0-9]*" maxlength="2" size="2" class="date-field" name="month" />
                                    @error('month')
                                        <div class="fv-plugins-message-container">
                                            <div class="text-red-600 fv-help-block">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        </div>
                                    @enderror
                                    </div>
                                    /
                                    <div class="field-inline-block">
                                    <label>@lang('Year')</label>
                                    <input type="text" pattern="[0-9]*" maxlength="4" size="4" class="date-field date-field--year" name="year" />
                                    @error('year')
                                        <div class="fv-plugins-message-container">
                                            <div class="text-red-600 fv-help-block">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        </div>
                                    @enderror
                                    </div>
                                </div>
                            </div>
                            <!--end::Form group-->
                            <!--end::Form group-->
                            <div class="form-group">
                                <label>@lang('Phone')</label>
                                <input id="text" type="phone"
                                    class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6 @error('phone') is-invalid @enderror"
                                    name="phone" value="{{ old('phone') }}" autocomplete="phone"
                                    placeholder="@lang('Phone')">
                                @error('phone')
                                    <div class="fv-plugins-message-container">
                                        <div class="text-red-600 fv-help-block">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    </div>
                                @enderror
                            </div>
                            <!--end::Form group-->
                            <div class="form-group">
                                <label>@lang('Whatsapp')</label>
                                <input id="text" type="phone"
                                    class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6 @error('whats_app') is-invalid @enderror"
                                    name="whats_app" value="{{ old('whats_app') }}" autocomplete="whats_app"
                                    placeholder="@lang('Whats app')">
                                @error('whats_app')
                                    <div class="fv-plugins-message-container">
                                        <div class="text-red-600 fv-help-block">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    </div>
                                @enderror
                            </div>
                            <!--end::Form group-->
                            <div class="form-group">
                                <label>@lang('Password') <span class="text-danger">*</span> </label>
                                <input id="password" type="password"
                                    class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6 @error('password') is-invalid @enderror"
                                    name="password" value="{{ old('password') }}" required
                                    placeholder="@lang('Password')">
                                @error('password')
                                    <div class="fv-plugins-message-container">
                                        <div class="fv-help-block">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>@lang('Confirm Password') <span class="text-danger">*</span> </label>
                                <input id="confirm_password" type="password"
                                    class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6 @error('password') is-invalid @enderror"
                                    name="password_confirmation" required
                                    placeholder="@lang('Confirm Password')">
                                <label class="form-label">
                                    <input type="checkbox" onclick="myFunction()" />
                                    <span></span>
                                    <div class="leading-10">
                                        @lang('Show Password')
                                    </div>
                                </label>
                            </div>
                            <!--end::Form group-->
                            <!--begin::Form group-->
                            <div class="pt-10 mt-10 text-center">
                                <button type="submit"
                                    class="px-8 py-4 mx-4 my-3 btn btn-primary font-weight-bolder font-size-h6">@lang('Sign Up')</button>
                            </div>
                            <!--end::Form group-->
                        </form>
                        <!--end::Form-->
                    </div>
                </div>
            </div>
            <!--end::Content-->
        </div>
        <!--end::Login-->
    </div>
@endsection
{{-- Scripts Section --}}
@section('js')
    <script>
        function myFunction() {
            var x = document.getElementById("password");
            var y = document.getElementById("confirm_password");
            if (x.type === "password") {
                x.type = "text";
                y.type = "text";
            } else {
                x.type = "password";
                y.type = "password";
            }
        }
    </script>
    <script src="{{ asset('js/pages/custom/login/login-general.js') }}"></script>
@endsection
