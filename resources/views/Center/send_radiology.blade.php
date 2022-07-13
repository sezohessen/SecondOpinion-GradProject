@extends('website.layouts.app')
@section('css')
    <link href="{{ asset('plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/website/css/account') }}" rel="stylesheet" type="text/css" />
    <style>
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #f3f6f9;
            color: #3f4254;
            padding: 3px;
        }

        .field_age {
            display: inline-flex;
        }

        .invaild-feedback {
            display: block !important;
        }

        .select2-container--default .select2-selection--multiple {
            height: 43px;
        }

        .select2-container--default .select2-results>.select2-results__options {
            width: 100%;
        }

    </style>
@endsection
@section('website')
    <div class="container">
        <div class="card doctor-account">
            <div class="card-header">
                <h3>@lang('Send Radiology')</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('center.store.radiology') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <input type="hidden" id="change_fees" name="fees" value="">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>@lang('Select Doctor') <span class="text-danger">*</span></label>
                                                <select class="form-control doctor_select select2{{ $errors->has('doctor_id') ? 'is-invalid' : '' }}"
                                                    name="doctor_id" required>
                                                    <option value="">@lang('Choose doctor')</option>
                                                    @foreach ($doctors as $doctor)
                                                        <option value="{{ $doctor->id }}">
                                                            {{ $doctor->user->FullName }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('doctor_id')
                                                    <div class="invalid-feedback">{{ $errors->first('doctor_id') }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="description">@lang('Case description')<span
                                                        class="text-danger">*</span></label>
                                                <textarea name="desc" class="form-control {{ $errors->has('desc') ? 'is-invalid' : '' }}" id="kt-ckeditor-2" rows="3"
                                                    required placeholder="@lang('Write description')">{{ old('desc') }}</textarea>
                                                @error('desc')
                                                    <div class="invalid-feedback">{{ $errors->first('desc') }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!--begin::Form group-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('First Name') <span class="text-danger">*</span> </label>
                                        <input id="first_name" type="text"
                                            class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6 @error('first_name') is-invalid @enderror"
                                            name="first_name" value="{{ old('first_name') }}" required
                                            autocomplete="first_name" autofocus placeholder="@lang('First Name')*">
                                        @error('first_name')
                                            <div class="fv-plugins-message-container">
                                                <div class="text-red-600 fv-help-block">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!--begin::Form group-->
                                    <div class="form-group">
                                        <label>@lang('Last Name') <span class="text-danger">*</span> </label>
                                        <input id="last_name" type="text"
                                            class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6 @error('last_name') is-invalid @enderror"
                                            name="last_name" value="{{ old('last_name') }}" required
                                            autocomplete="last_name" placeholder="@lang('Last Name')">
                                        @error('last_name')
                                            <div class="fv-plugins-message-container">
                                                <div class="text-red-600 fv-help-block">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('Email') <span class="text-danger">*</span> </label>
                                        <input id="email" type="email"
                                            class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6 @error('email') is-invalid @enderror"
                                            name="email" value="{{ old('email') }}" required
                                            placeholder="@lang('Email')">
                                        @error('email')
                                            <div class="fv-plugins-message-container">
                                                <div class="text-red-600 fv-help-block">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="d-block">@lang('Date of birth') <span
                                                class="text-danger">*</span></label>
                                        <div class="field_age">
                                            <div class="field-inline-block">
                                                <label>@lang('Day')</label>
                                                <input type="text" pattern="[0-9]*" maxlength="2" size="2"
                                                    class="date-field" name="day" />
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
                                                <input type="text" pattern="[0-9]*" maxlength="2" size="2"
                                                    class="date-field" name="month" />
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
                                                <input type="text" pattern="[0-9]*" maxlength="4" size="4"
                                                    class="date-field date-field--year" name="year" />
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
                                </div>
                                <div class="col-md-6">

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
                                        <label class="form-label mt-2">
                                            <input type="checkbox" onclick="myFunction()" />
                                            <span></span>
                                            <div class="leading-10 mt-2">
                                                @lang('Show Password')
                                            </div>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label for="files">@lang('Upload Radiology and files')(@lang('Max:3 files'))<span
                                                class="text-danger">*</span></label>
                                        <div class="from-group">
                                            <input type="file" id="files" name="files[]" multiple><br><br>
                                            @error('files')
                                                <div class="invalid-feedback">{{ $errors->first('files') }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <hr>
                                    <h6>@lang('Total Fees is') :
                                        <span class="text-info" id="cost">
                                        </span>
                                    </h6>
                                    <button class="btn btn-primary" type="submit">@lang('Get Second Opinion')</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
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
    $(document).on("change", '.doctor_select', function () {
            // get city id
            var id       = $(this).val()
            // api url
            var stateUrl = `get-fees/${id}`;
            // ajax
            $.get(stateUrl,
            {option: $(this).val()},
                    function (data) {
                    var model = $('#cost');
                    model.empty();
                    model.append(data.fees +" @lang('L.E')");
                    document.getElementById("change_fees").value = data.fees;
                }
            )
        });
</script>
@endsection
