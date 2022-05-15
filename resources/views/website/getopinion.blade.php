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
        .field_age{
            display: inline-flex;
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
    {{-- {{ dd($errors) }} --}}
    <div class="container">
        <div class="card doctor-account">
            <div class="card-header">
                <h3>@lang('Get Second Opinion')</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12">
                                <aside class="sidebar has-marign-right">
                                    <div class="member mb-0">
                                        <div class="member__img">
                                            @if (file_exists(public_path($doctor->avatar->base . $doctor->avatar->name)))
                                                <img src="{{ view_image($doctor->avatar) }}" alt="member img">
                                            @else
                                                <img src="{{ asset(App\Models\Doctor::DefaultAvatar) }}" alt="member img">
                                            @endif
                                        </div><!-- /.member-img -->
                                        <div class="member__info">
                                            <h4 class="member__name"><a
                                                    href="doctors-single-doctor1.html">{{ $doctor->user->FullName }}</a>
                                            </h4>
                                            <p class="member__job">
                                                {{ LangDetail($doctor->field->name, $doctor->field->name_ar) }}</p>
                                            <h6>@lang('Fees') :
                                                <strong class="text-info">
                                                    @if (isset($doctor->price))
                                                        <strong>{{ $doctor->price }} @lang('L.E')</strong>
                                                    @endif
                                                </strong>
                                            </h6>
                                        </div><!-- /.member-info -->
                                    </div><!-- /.member -->
                                </aside><!-- /.sidebar -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <form action="{{ route('Website.book-opinion.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('First Name') <span class="text-danger">*</span></label>
                                        <input id="first_name" type="text"
                                            class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6 @error('first_name') is-invalid @enderror"
                                            name="first_name"
                                            value="{{ old('first_name') ?? auth()->user()->first_name }}" required
                                            autocomplete="first_name" autofocus placeholder="@lang('first name')">
                                        @error('first_name')
                                            <div class="fv-plugins-message-container">
                                                <div class="fv-help-block">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            </div>
                                        @enderror
                                    </div>
                                    <!--end::Form group-->
                                </div>
                                <div class="col-md-6">
                                    <!--begin::Form group-->
                                    <div class="form-group">
                                        <label>@lang('Last Name') <span class="text-danger">*</span></label>
                                        <input id="last_name" type="text"
                                            class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6 @error('last_name') is-invalid @enderror"
                                            name="last_name" value="{{ old('last_name') ?? auth()->user()->last_name }}"
                                            required autocomplete="last_name" placeholder="@lang('last name')">
                                        @error('last_name')
                                            <div class="fv-plugins-message-container">
                                                <div class="fv-help-block">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('Phone') <span class="text-danger">*</span></label>
                                        <input id="text" type="phone" class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6 @error('phone') is-invalid @enderror"
                                         name="phone" value="{{ old('phone') ?? auth()->user()->phone }}"  autocomplete="phone"  placeholder="@lang('phone')">
                                        @error('phone')
                                            <div class="fv-plugins-message-container">
                                                <div class="fv-help-block">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('Whatsapp')</label>
                                        <input id="whats_app" type="phone" class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6 @error('whats_app') is-invalid @enderror"
                                         name="whats_app" value="{{ old('whats_app') ?? auth()->user()->whats_app  }}" autocomplete="whats_app"  placeholder="@lang('Whatsapp')">
                                        @error('whats_app')
                                            <div class="fv-plugins-message-container">
                                                <div class="fv-help-block">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="d-block">@lang('Date of birth') <span class="text-danger">*</span></label>
                                        <div class="field_age">
                                            <div class="field-inline-block">
                                            <label>@lang('Day')</label>
                                            <input type="text" pattern="[0-9]*" maxlength="2" size="2" class="date-field" name="day" value="{{ $date_of_birth->format('d') }}" />
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
                                            <input type="text" pattern="[0-9]*" maxlength="2" size="2" class="date-field" name="month" value="{{ $date_of_birth->format('m') }}" />
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
                                            <input type="text" pattern="[0-9]*" maxlength="4" size="4" class="date-field date-field--year" name="year" value="{{ $date_of_birth->format('Y') }}" />
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
                                </div>
                                <div class="col-md-12">
                                    <label for="files">@lang('Upload Radiology and files')(@lang('Max:3 files'))<span class="text-danger">*</span></label>
                                    <div class="from-group">
                                        <input type="file" id="files" name="files" multiple max="3"><br><br>
                                        @error('files')
                                            <div class="fv-plugins-message-container">
                                                <div class="text-red-600 fv-help-block">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            </div>
                                        @enderror
                                    </div>
                                    <hr>
                                    <h6>@lang('Total Fees is') : <span class="text-info">{{ $doctor->price }} @lang('L.E')</span> </h6>
                                </div>
                                <div class="col-md-12">
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
