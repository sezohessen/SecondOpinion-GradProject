{{-- Extends layout --}}
@extends('layout.insurance')
@section('styles')

@endsection
{{-- Content --}}
@section('content')

    <div class="card card-custom">
        <div class="card-header">
            <h3 class="card-title">
                {{$page_title}}
            </h3>
            <div class="text-right">
                <a href="{{ route('insurance.insurance-offer.index') }}" style="margin-top: 16px;" class="btn btn-primary mr-2">@lang('Back') ></a>
            </div>
        </div>
        <!--begin::Form-->
        <form action="{{route("insurance.insurance-offer.store")}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <!-- EN Form -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Insurance offer title(ENG)') <span class="text-danger">*</span></label>
                            <input type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
                             name="title"  placeholder="@lang('Title(ENG)')" value="{{ old('title')}}" required autofocus  />
                            @if ($errors->has('title'))
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block">
                                        <strong>{{ $errors->first('title')  }}</strong>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Insurance offer title(AR)') <span class="text-danger">*</span></label>
                            <input type="text" class="form-control {{ $errors->has('title_ar') ? 'is-invalid' : '' }}"
                             name="title_ar"  placeholder="@lang('Title(AR)')" value="{{ old('title_ar') }}" required   />
                            @if ($errors->has('title_ar'))
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block">
                                        <strong>{{ $errors->first('title_ar')  }}</strong>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">@lang('Description(ENG)') <span class="text-danger">*</span></label>
                            <textarea name="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" id="kt-ckeditor-1" rows="3"
                            placeholder="@lang('Write description')" >{{ old('description') }}</textarea>
                            @if ($errors->has('description'))
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block">
                                        <strong>{{ $errors->first('description')  }}</strong>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">@lang('Description(AR)') <span class="text-danger">*</span></label>
                            <textarea name="description_ar" class="form-control {{ $errors->has('description_ar') ? 'is-invalid' : '' }}" id="kt-ckeditor-2" rows="3"
                            placeholder="@lang('Write description')" >{{ old('description_ar') }}</textarea>
                            @if ($errors->has('description_ar'))
                                <div class="fv-plugins-message-container">
                                    <div class="fv-help-block">
                                        <strong>{{ $errors->first('description_ar')  }}</strong>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="logo">@lang('Logo image') <span class="text-danger">*</span></label>
                            <br>
                            <div class="image-input image-input-empty image-input-outline" id="logo" style="background-image: url({{asset('media/users/blank.png') }})">
                                <div class="image-input-wrapper"></div>
                                <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                    <input type="file" name="logo" accept=".png, .jpg, .jpeg ,gif,svg" required/>
                                    <input type="hidden" name="logo_remove" />
                                </label>
                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                </span>
                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove avatar">
                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                </span>
                            </div>
                             @if ($errors->has('logo'))
                             <div class="fv-plugins-message-container">
                                 <div class="fv-help-block">
                                    <strong>{{ $errors->first('logo')}}</strong>
                                 </div>
                             </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary mr-2">@lang('create')</button>
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
<script>
"use strict";
var KTUserEdit={
    init:function(){
        new KTImageInput("logo");
        }
        };jQuery(document).ready((function(){KTUserEdit.init()}));
</script>
@endsection
