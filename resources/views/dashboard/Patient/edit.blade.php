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
                <a href="{{ route('dashboard.patient.index') }}" style="margin-top: 16px;" class="btn btn-primary mr-2">  @lang('Back')  <i class="fa fa-arrow-left fa-sm"></i></a>
            </div>
        </div>

        <!--begin::Form-->
        <form action="{{route("dashboard.patient.update",$patient->id)}}" method="POST" enctype='multipart/form-data' >
            @csrf
            @method('PATCH')

            <div class="card-body">
                <!--begin::Form group-->
             <div class="form-group">
                <label>@lang('first name') <span class="text-danger">*</span></label>
                 <input id="first_name" type="text" class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6 @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') ?? $patient->user->first_name }}" required autocomplete="first_name" autofocus placeholder="@lang('first name')">
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
                <label>@lang('last name') <span class="text-danger">*</span></label>
                 <input id="last_name" type="text" class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6 @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name')  ?? $patient->user->first_name }}" required autocomplete="last_name"  placeholder="@lang('last name')">
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
                <label>@lang('Email') <span class="text-danger">*</span></label>
                 <input id="email" type="email" class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6 @error('email') is-invalid @enderror" name="email" value="{{ old('email')  ?? $patient->user->email }}" required autocomplete="email"  placeholder="@lang('Email')">
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
                <label>@lang('National ID')</label>
                <input type="number" class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6 @error('national_id') is-invalid @enderror"
                 name="national_id" value="{{ old('national_id')  ?? $patient->national_id }}"  autocomplete="national_id"  placeholder="@lang('National ID')">
                @error('national_id')
                    <div class="fv-plugins-message-container">
                        <div class="fv-help-block">
                            <strong>{{ $message }}</strong>
                        </div>
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label>@lang('Date of bith')</label>
                <input type="input" class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6 @error('date_of_birth') is-invalid @enderror"
                 name="date_of_birth" value="{{ old('date_of_birth')  ?? $patient->date_of_birth }}"  autocomplete="date_of_birth"  placeholder="@lang('Date of bith')">
                @error('date_of_birth')
                    <div class="fv-plugins-message-container">
                        <div class="fv-help-block">
                            <strong>{{ $message }}</strong>
                        </div>
                    </div>
                @enderror
            </div>
             <!--end::Form group-->
             <div class="form-group">
                <label>@lang('phone') <span class="text-danger">*</span></label>
                 <input id="text" type="phone" class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6 @error('phone') is-invalid @enderror"
                  name="phone" value="{{ old('phone') ?? $patient->user->phone }}"  autocomplete="phone"  placeholder="@lang('phone')">
                 @error('phone')
                     <div class="fv-plugins-message-container">
                         <div class="fv-help-block">
                             <strong>{{ $message }}</strong>
                         </div>
                     </div>
                 @enderror
             </div>
             <div class="form-group">
                <label>@lang('Whatsapp') </label>
                 <input id="whats_app" type="phone" class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6 @error('whats_app') is-invalid @enderror"
                  name="whats_app" value="{{ old('whats_app') ?? $patient->user->whats_app  }}" autocomplete="whats_app"  placeholder="@lang('Whatsapp')">
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
                <label>@lang('Password') </label>
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

            </div>
             </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary mr-2">@lang('update') </button>
            </div>
        </form>
        <!--end::Form-->
    </div>

@endsection

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
