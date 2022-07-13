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
                        <form class="form" method="POST" action="{{ route('Website.center.create') }}" enctype="multipart/form-data">
                            @csrf
                            <!--begin::Title-->
                            <div class="py-10 reg_doctor">
                                <h2 class="text-4xl font-bold text-dark font-size-h2 font-size-h1-lg pb-9">@lang('Sign Up As Center')
                                </h2>
                                <a href="{{ route('register') }}" class="my-2">
                                    <h6>
                                        @lang('Register as patient') ?
                                    </h6>
                                </a>
                                <a href="{{ route('Website.doctor.register') }}" class="my-2">
                                    <h6>
                                        @lang('Register as doctor') ?
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
                                <label for="governorate">@lang('Select Governorate') <span
                                        class="text-danger">*</span></label>
                                <select class="form-control {{ $errors->has('governorate_id') ? 'is-invalid' : '' }}"
                                    id="governorate" name="governorate_id" required>
                                    <option value="">@lang('Select Governorate')</option>
                                    @foreach ($governorates as $governorate)
                                        <option value="{{ $governorate->id }}"
                                            @if (old('governorate_id') == $governorate->id) {{ 'selected' }} @endif>
                                            {{ LangDetail($governorate->title, $governorate->title_ar) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('governorate_id')
                                    <div class="invalid-feedback">{{ $errors->first('governorate_id') }}</div>
                                @enderror
                            </div>
                            <div class="form-group city">
                                <label for="city">@lang('Select City') <span class="text-danger">*</span></label>
                                <select class="form-control {{ $errors->has('city_id') ? 'is-invalid' : '' }}" id="city"
                                    name="city_id" required>
                                    <option value="">@lang('--Select governorate first--')</option>
                                </select>
                                @error('city_id')
                                    <div class="invalid-feedback">{{ $errors->first('city_id') }}</div>
                                @enderror
                            </div>
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
                                    name="password_confirmation" required placeholder="@lang('Confirm Password')">
                                <label class="form-label">
                                    <input type="checkbox" onclick="myFunction()" />
                                    <span></span>
                                    <div class="leading-10">
                                        @lang('Show Password')
                                    </div>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="Image">@lang('Center image')<span class="text-danger">*</span></label>
                                <br>
                                <div class="avatar-upload">
                                    <div class="avatar-edit">
                                        <input type='file' name="avatar" id="imageUpload" accept=".png, .jpg, .jpeg"
                                            required />
                                        <label for="imageUpload"><i class="fa fa-pen"></i> </label>
                                    </div>
                                    <div class="avatar-preview">
                                        <div id="imagePreview"
                                            style="background-image: url({{ asset(App\Models\Doctor::Avatar . 'doctor.png') }});">
                                        </div>
                                    </div>
                                </div>
                                @error('avatar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <!--end::Form group-->
                            <!--begin::Form group-->
                            <div class="pt-10 mt-10 text-center">
                                <button type="submit"
                                    class="px-8 py-4 mx-4 my-3 btn btn-primary font-weight-bolder font-size-h6">@lang('Sign
                                    Up')</button>
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
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                    $('#imagePreview').hide();
                    $('#imagePreview').fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#imageUpload").change(function() {
            readURL(this);
        });

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

        function governorate(id) {
            console.log(id);
            $('#city').empty();
            $.ajax({
                url: '/governorate/' + id,
                success: data => {
                    if (data.cities) {
                        data.cities.forEach(city =>
                            $('#city').append(`<option value="${city.id}" >${city.title}</option>`))
                        $('.city .nice-select ul').empty();
                        data.cities.forEach(city =>
                            $('.city .nice-select ul').append(
                                `<li data-value="${city.id}" class="option">${city.title}</li>`))

                    } else {
                        $('#city').append(`<option value="">@lang('Select Governorate first')</option>`)
                    }
                }
            });
        }

        function governorate_ar(id) {

            $('#city').empty();
            $.ajax({
                url: '/governorate/' + id,
                success: data => {
                    if (data.cities) {
                        data.cities.forEach(city =>
                            $('#city').append(`<option value="${city.id}" >${city.title_ar}</option>`))
                        $('.city .nice-select ul').empty();
                        data.cities.forEach(city =>
                            $('.city .nice-select ul').append(
                                `<li data-value="${city.id}" class="option">${city.title_ar}</li>`))
                    } else {
                        $('#city').append(`<option value="">@lang('Select Governorate first')</option>`)
                    }
                }
            });
        }
        $('#governorate').on('change', function() {
            var id = this.value;
            var en = <?php echo Session::get('app_locale') == 'en' ? 1 : 0; ?>;
            console.log(en);
            en ? governorate(id) : governorate_ar(id);
        });
    </script>
    <script src="{{ asset('js/pages/custom/login/login-general.js') }}"></script>
@endsection
