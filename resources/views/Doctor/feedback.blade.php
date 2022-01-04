@extends('website.layouts.app')

@section('website')
<div class="container">
    <div class="card doctor-feedback">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h6><span>@lang('Patient Name')</span>: <span class="patient-name">{{ $radiology->patient->user->getFullNameAttribute() }}</span></h6>
                </div>
                @if($radiology->center_id)
                    <h6><span>@lang('Center Name')</span>: <span class="patient-name">{{ $radiology->center->user->getFullNameAttribute() }}</span></h6>
                @endif
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <form action="">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description">@lang('Radiology feedback')</label>
                                    <textarea name="desc" class="form-control {{ $errors->has('desc') ? 'is-invalid' : '' }}" id="kt-ckeditor-1" rows="3"
                                    placeholder="@lang('Write description')" >{{ old('desc') }}</textarea>
                                    @error('desc')
                                        <div class="invalid-feedback">{{ $errors->first('desc') }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group file">
                                    <label for="">@lang('Upload radiology report file')(pdf/doc) @lang('only') (@lang('Not required'))</label>
                                    <input type="file" name="file" id="file">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-primary">@lang('Submit')</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
