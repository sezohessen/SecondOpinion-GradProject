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
                @if(session()->has('created'))
                    <div class="alert alert-success  m-4  ">
                        <p>{{ session('created') }}</p>
                    </div>
                @endif
                <div class="card">
                    <div class="card-heading">
                        <form action="{{ route('Website.doctors.search') }}" method="get">
                            @csrf
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="specialty">@lang('Select a specialty')</label>
                                                <select name="specialty_id" id="specialty"  class="form-control">
                                                    <option value="">@lang('Choose Specialty')</option>
                                                    @foreach ($specialties as $specialty)
                                                        <option value="{{ $specialty->id }}">{{ LangDetail($specialty->name,$specialty->name_ar) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="specialty">@lang('In this city')</label>
                                                <select name="governorate_id" id="governorate"  class="form-control">
                                                    <option value="">@lang('Choose city')</option>
                                                    @foreach ($governorates as $governorate)
                                                        <option value="{{$governorate->id}}">{{ LangDetail($governorate->title,$governorate->title_ar) }}</option>
                                                    @endforeach
                                                    @error('governorate_id')
                                                        <div class="invalid-feedback">{{ $errors->first('governorate_id') }}</div>
                                                    @enderror
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="specialty">@lang('In this area')</label>
                                                <select name="city_id" id="city"  class="form-control">
                                                    <option value="">@lang('Choose area')</option>
                                                </select>
                                                @error('city_id')
                                                    <div class="invalid-feedback">{{ $errors->first('city_id') }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="specialty">@lang('Or search by name')</label>
                                                <input  class="form-control" type="text" name="name" id="specialty" placeholder="@lang('Doctor name')">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 search-button">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> @lang('Search')</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')
<script>
    $('#governorate').on('change', function() {
        var id = this.value ;
        var en = <?php echo Session::get('app_locale')=='en' ? 1: 0;?>;
        en ? governorate(id):governorate_ar(id);
    });
    function governorate(id){
        $('#city').empty();
        old_city="<?php echo  request()->get('city_id') ?>";
        $.ajax({
            url: '/doctors/getcity/'+id,
            success: data => {
                if(data.cities){
                    $('#city').append(`<option value="" >@lang('All')</option>`)
                    data.cities.forEach(city =>
                    $('#city').append(`<option value="${city.id}" ${(old_city==city.id) ? "selected" : "" } >${city.title}</option>`))
                }else{
                $('#city').append(`<option value="">@lang('Select Governorate')</option>`)
                }
            }
        });
    }
    function governorate_ar(id){
        $('#city').empty();
        old_city="<?php echo  request()->get('city_id') ?>";
        $.ajax({
            url: '/doctors/getcity/'+id,
            success: data => {
                $('#city').append(`<option value="" >@lang('All')</option>`)
                if(data.cities){
                    data.cities.forEach(city =>
                    $('#city').append(`<option value="${city.id}" ${(old_city==city.id) ? "selected" : "" }> ${city.title_ar}</option>`))
                }else{
                $('#city').append(`<option value="">@lang('Select governorate first')</option>`)
                }
            }
        });
    }


</script>
@endsection
