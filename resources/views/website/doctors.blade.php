@extends('website.layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/website/css/doctor-search.css') }}">
    <link rel="stylesheet" href="{{ asset('css/website/css/doctors.css') }}">
@endsection
@section('website')
<section class="Doctor-search">
    <div class="container">
        <div class="row">
            <div class="heading  mt-50 col-md-12">
                <h2>@lang('Get Second Opinion')</h2>
            </div>
            <div class="search col-md-12">
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
                                                        <option value="{{ $specialty->id }}"
                                                            @if (request()->get('specialty_id') && $specialty->id==request()->get('specialty_id'))
                                                                {{ 'selected' }}
                                                            @endif
                                                            >{{ LangDetail($specialty->name,$specialty->name_ar) }}</option>
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
                                                        <option value="{{$governorate->id}}"
                                                            @if (request()->get('governorate_id') && $governorate->id==request()->get('governorate_id'))
                                                                {{ 'selected' }}
                                                            @endif
                                                            >{{ LangDetail($governorate->title,$governorate->title_ar) }}</option>
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
                                                <input  class="form-control" type="text" value="{{ app('request')->input('name') }}" name="name" id="specialty" placeholder="@lang('Doctor name')">
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
    </div><!-- /.container -->
</section><!-- /.page-title -->
  <!-- ========================
      Team layout 2
  ========================== -->
<section class="team-layout2 pb-10">
    <div class="container">
        <div class="row">
            @if ($Doctors->count())
                @foreach ($Doctors as $doctor)
                    <div class="col-sm-6 col-md-4 col-lg-4">
                        <div class="member">
                        <div class="member__img">
                            @if (file_exists(public_path($doctor->avatar->base.$doctor->avatar->name)))
                                <a href="{{ route('Website.doctor.profile',[
                                    'field' => LangDetail($doctor->field->name,$doctor->field->name_ar),
                                    'id'    => $doctor->id,
                                    'name'  => $doctor->user->FullName
                                    ]) }}">
                                    <img src="{{ view_image($doctor->avatar) }}" alt="member img">
                                </a>
                            @else
                                <a href="{{ route('Website.doctor.profile',[
                                    'field' => LangDetail($doctor->field->name,$doctor->field->name_ar),
                                    'id'    => $doctor->id,
                                    'name'  => $doctor->user->FullName
                                    ]) }}">
                                    <img src="{{ asset(App\Models\Doctor::DefaultAvatar) }}" alt="member img">
                                </a>
                            @endif

                        </div><!-- /.member-img -->
                        <div class="member__info">
                            <h5 class="member__name">
                                <a href="{{ route('Website.doctor.profile',[
                                    'field' => LangDetail($doctor->field->name,$doctor->field->name_ar),
                                    'id'    => $doctor->id,
                                    'name'  => $doctor->user->FullName
                                    ]) }}">
                                    {{ $doctor->user->FullName }}
                                </a>
                            </h5>
                            <p class="member__job">{{ LangDetail($doctor->field->name,$doctor->field->name_ar) }}</p>
                            <p class="member__desc">{{ LangDetail($doctor->brief_desc,$doctor->brief_desc_ar) }}</p>
                            <div class="mt-20 d-flex flex-wrap justify-content-between align-items-center">
                            <a href="doctors-single-doctor1.html" class="btn btn__secondary btn__link btn__rounded">
                                <span>@lang('Get Opinion')</span>
                                <i class="fa fa-arrow-right"></i>
                            </a>
                            <ul class="social-icons list-unstyled mb-0">
                                @if ($doctor->facebook&& $doctor->facebook!='')
                                    <li><a href="{{ $doctor->facebook }}" class="facebook"><i class="fab fa-facebook-f"></i></a></li>
                                @endif
                                @if ($doctor->user->whats_app)
                                    <li>
                                        <a href="https://api.whatsapp.com/send?phone={{ $doctor->user->whats_app }}" class="phone">
                                            <i class="fab fa-whatsapp"></i>
                                        </a>
                                    </li>
                                @endif
                                {{-- <li><a href="#" class="twitter"><i class="fab fa-twitter"></i></a></li> --}}

                            </ul><!-- /.social-icons -->
                            </div>
                        </div><!-- /.member-info -->
                        </div><!-- /.member -->
                    </div><!-- /.col-lg-4 -->
                @endforeach
            @else
                <div class="col-md-12">
                    <div class="card mt-30 mb-30">
                        <div class="card-heading mx-10 my-10">
                            <div class="alert alert-info d-inline-flex w-100" role="alert">
                                <i class="fas fa-exclamation-triangle fa-2x"></i> <h4>@lang('There are no doctors with this search')</h4>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div> <!-- /.row -->
        <div class="row">
            <div class="col-12 text-center">
                <nav class="pagination-area">
                <ul class="pagination justify-content-center">
                    {{ $Doctors->appends(Request::only(['specialty_id','governorate_id','city_id','name']))->links("pagination::bootstrap-4") }}
                </ul>
                </nav><!-- .pagination-area -->
            </div><!-- /.col-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.Team layout 2  -->
@endsection
@section('js')
<script>
    $('#governorate').on('change', function() {
        var id = this.value ;
        var en = <?php echo Session::get('app_locale')=='en' ? 1: 0;?>;
        en ? governorate(id):governorate_ar(id);
    });
    function getCities(){
        var id = "<?php echo  request()->get('governorate_id') ?>";
        if(id){
            var en = <?php echo Session::get('app_locale')=='en' ? 1: 0;?>;
            en ? governorate(id):governorate_ar(id);
        }
    }
    getCities();
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
