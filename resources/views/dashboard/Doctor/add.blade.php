{{-- Extends layout --}}
@extends('layout.master')

{{-- Content --}}
@section('content')

    <div class="card card-custom">
        <div class="card-header">
            <h3 class="card-title">
                {{$page_title}}
            </h3>
            <div class="text-right">
                <a href="{{ route('dashboard.doctor.index') }}" style="margin-top: 16px;" class="btn btn-primary mr-2">  @lang('Back')  <i class="fa fa-arrow-left fa-sm"></i></a>
            </div>
        </div>
        <!--begin::Form-->
        <form action="{{route("dashboard.doctor.store")}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <!--begin::Form group-->
             <div class="form-group">
                 <input id="first_name" type="text" class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6 @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus placeholder="@lang('first name')">
                 @error('first_name')
                     <div class="fv-plugins-message-container">
                         <div class="fv-help-block">
                             <strong>{{ $message }}</strong>
                         </div>
                     </div>
                 @enderror
             </div>
             <!--end::Form group-->
             <!--begin::Form group-->
             <div class="form-group">
                 <input id="last_name" type="text" class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6 @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name"  placeholder="@lang('last name')">
                 @error('last_name')
                     <div class="fv-plugins-message-container">
                         <div class="fv-help-block">
                             <strong>{{ $message }}</strong>
                         </div>
                     </div>
                 @enderror
             </div>
             <!--end::Form group-->
             <div class="form-group">
                 <input id="email" type="email" class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email"  placeholder="@lang('Email')">
                 @error('email')
                     <div class="fv-plugins-message-container">
                         <div class="fv-help-block">
                             <strong>{{ $message }}</strong>
                         </div>
                     </div>
                 @enderror
             </div>
             <!--end::Form group-->
             <div class="form-group">
                <input type="text" class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6 @error('national_id') is-invalid @enderror"
                 name="national_id" value="{{ old('national_id') }}"  autocomplete="national_id"  placeholder="@lang('National ID')">
                @error('national_id')
                    <div class="fv-plugins-message-container">
                        <div class="fv-help-block">
                            <strong>{{ $message }}</strong>
                        </div>
                    </div>
                @enderror
            </div>
             <!--end::Form group-->
             <div class="form-group">
                 <input id="text" type="phone" class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6 @error('phone') is-invalid @enderror"
                  name="phone" value="{{ old('phone') }}"  autocomplete="phone"  placeholder="@lang('phone')">
                 @error('phone')
                     <div class="fv-plugins-message-container">
                         <div class="fv-help-block">
                             <strong>{{ $message }}</strong>
                         </div>
                     </div>
                 @enderror
             </div>
             <div class="form-group">
                 <input id="whats_app" type="phone" class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6 @error('whats_app') is-invalid @enderror"
                  name="whats_app" value="{{ old('whats_app') }}" autocomplete="whats_app"  placeholder="@lang('Whatsapp')">
                 @error('whats_app')
                     <div class="fv-plugins-message-container">
                         <div class="fv-help-block">
                             <strong>{{ $message }}</strong>
                         </div>
                     </div>
                 @enderror
             </div>
             <!--end::Form group-->
             <!--end::Form group-->
             <div class="form-group">
                 <input id="password" type="password"  class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6 @error('password') is-invalid @enderror"
                  name="password" value="{{ old('password') }}" required autocomplete="password"  placeholder="@lang('Password')">
                 <label class="checkbox mt-5">
                     <input type="checkbox" onclick="myFunction()"/>
                     <span></span>
                     <div class="ml-2">
                         @lang('Show Password')
                     </div>
                 </label>
                 @error('password')
                     <div class="fv-plugins-message-container">
                         <div class="fv-help-block">
                             <strong>{{ $message }}</strong>
                         </div>
                     </div>
                 @enderror
             </div>
             <div class="col-md-12">
                <div class="form-group">
                    <label for="brief_desc">@lang('Brief Description About Yourself(ENG)')<span class="text-danger">*</span></label>
                    <textarea name="brief_desc" class="form-control {{ $errors->has('brief_desc') ? 'is-invalid' : '' }}" id="kt-ckeditor-1" rows="8"
                    placeholder="@lang('Write description')" required>
                    {{ old('brief_desc')}}
                    </textarea>
                    @if ($errors->has('brief_desc'))
                        <div class="fv-plugins-message-container">
                            <div class="fv-help-block">
                                <strong>{{ $errors->first('brief_desc')  }}</strong>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="brief_desc_ar">@lang('Brief Description About Yourself(AR)')<span class="text-danger">*</span></label>
                    <textarea name="brief_desc_ar" class="form-control {{ $errors->has('brief_desc_ar') ? 'is-invalid' : '' }}" id="kt-ckeditor-2" rows="8"
                    placeholder="@lang('Write description')" required>
                    {{ old('brief_desc_ar')}}
                    </textarea>
                    @if ($errors->has('brief_desc_ar'))
                        <div class="fv-plugins-message-container">
                            <div class="fv-help-block">
                                <strong>{{ $errors->first('brief_desc_ar')  }}</strong>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>@lang('Facebook')</label>
                    <input type="text" class="form-control {{ $errors->has('facebook') ? 'is-invalid' : '' }}"
                    name="facebook"  placeholder="@lang('Link')"  value="{{old("facebook")}}"/>
                    @error('facebook')
                        <div class="invalid-feedback">{{ $errors->first('facebook') }}</div>
                    @enderror
                </div>
            </div>
             <div class="col-md-6">
                <div class="form-group">
                    <label for="avatar_id">@lang('image') </label><br>
                    <div class="image-input image-input-empty image-input-outline" id="avatar_id" style="background-image: url({{asset('media/svg/logos/Logo.jpg') }})">
                        <div class="image-input-wrapper"></div>
                        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                            <i class="fas fa-pen icon-sm text-muted"></i>
                            <input type="file" name="avatar_id" accept=".png, .jpg, .jpeg ,gif,svg"  required />
                            <input type="hidden" name="logo_remove" />
                        </label>
                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                        </span>
                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove avatar">
                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                        </span>
                    </div>
                    @error('avatar_id')
                        <div class="invalid-feedback">{{ $errors->first('avatar_id') }}</div>
                    @enderror
                </div>
            </div>
             </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary mr-2">@lang('create')  </button>
            </div>
        </form>
        <!--end::Form-->
    </div>

@endsection

{{-- Scripts Section --}}
@section('scripts')
<script src="{{ asset('js/pages/crud/forms/validation/form-controls.js') }}"></script>
<script src="{{asset("plugins/custom/ckeditor/ckeditor-classic.bundle.js")}}"></script>
<script src="{{asset("js/pages/crud/forms/editors/ckeditor-classic.js")}}"></script>
<script src="/metronic/theme/html/demo1/dist/assets/js/pages/crud/forms/validation/form-controls.js?v=7.1.8"></script>
<script>
    function myFunction() {
      var x = document.getElementById("password");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }
</script>
<script>
    "use strict";
    var KTUserEdit={
        init:function(){
            new KTImageInput("avatar_id");
            }
            };jQuery(document).ready((function(){KTUserEdit.init()}));
    </script>
@endsection
