{{-- Extends layout --}}
@extends('layout.master')
@section('styles')
<link href="{{ asset('css/pages/wizard/wizard-4.css') }}"  rel="stylesheet" type="text/css"/>
@endsection
{{-- Content --}}
@section('content')

    <div class="card card-custom">
        <div class="card-header">
            <h3 class="card-title">
                {{$page_title}}
            </h3>
        </div>
        <!--begin::Form-->
        <form action="{{route("dashboard.capacity.store")}}" method="POST">
            @csrf

            <div class="card-body">
                <!-- EN Form -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>@lang('Car Capacity Name') <span class="text-danger">*</span></label>
                            <input type="text" class="form-control {{ $errors->has('capacity') ? 'is-invalid' : '' }}"
                             name="capacity"  placeholder="@lang('Car Capacity ')" value="{{ old('capacity')}}" required autofocus  />
                            @error('capacity')
                                 <div class="invalid-feedback">{{ $errors->first('capacity') }}</div>
                            @enderror
                        </div>
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

@endsection
