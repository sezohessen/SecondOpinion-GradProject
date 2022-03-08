@extends('website.layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/website/css/doctor-search.css') }}">
@endsection
@section('website')

<div class="Doctor-search" style="background-image: url({{ asset('img/website/SearchPage/bg.jpg') }})">
    <div class="container">
        <div class="row">
            <div class="heading col-md-12 mt-50 mb-100">
                <h2>@lang('Get Second Opinion')</h2>
            </div>
            <div class="search col-md-12 mt-50">
                <div class="card">
                    <div class="card-heading">
                        <div class="box">
                            <div class="form-group">
                                <label for="specialty">@lang('Select a specialty')</label>
                                <select name="" id="specialty">
                                    <option value="">@lang('Choose Specialty')</option>
                                </select>
                            </div>
                        </div>
                        <div class="box">
                            <div class="form-group">
                                <label for="specialty">@lang('Select a specialty')</label>
                                <select name="" id="specialty">
                                    <option value="">@lang('Choose Specialty')</option>
                                </select>
                            </div>
                        </div>
                        <div class="box">
                            <div class="form-group">
                                <label for="specialty">@lang('Select a specialty')</label>
                                <select name="" id="specialty">
                                    <option value="">@lang('Choose Specialty')</option>
                                </select>
                            </div>
                        </div>
                        <div class="box">
                            <div class="form-group">
                                <label for="specialty">@lang('Select a specialty')</label>
                                <select name="" id="specialty">
                                    <option value="">@lang('Choose Specialty')</option>
                                </select>
                            </div>
                        </div>
                        <div class="box search-button">
                            <button type="submit"><i class="fa fa-search"></i> @lang('Search')</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
