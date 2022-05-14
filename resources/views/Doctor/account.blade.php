@extends('website.layouts.app')
@section('css')
<link href="{{ asset('plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/website/css/account') }}" rel="stylesheet" type="text/css" />
<style>
    .select2-container--default .select2-selection--multiple .select2-selection__choice{
        background-color: #f3f6f9;
        color: #3f4254;
        padding: 3px;
    }
    .select2-container--default .select2-selection--multiple{height: 43px;}
    .select2-container--default .select2-results>.select2-results__options{width: 100%;}
</style>
@endsection
@section('website')
{{-- {{ dd($errors) }} --}}
<div class="container">
    <div class="card doctor-account">
        <div class="card-header">
            <h3>@lang('My Account')</h3>
        </div>
        <div class="card-body">
            <div class="row">
                @if(session()->has('success'))
                <div class="col-md-12">
                    <div class="alert alert-success  m-4  ">
                        <p>{{ session('success') }}</p>
                    </div>
                </div>
                @endif
                <div class="col-md-3">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header account-header">
                                    <h6>@lang('Radiology')</h6>
                                </div>
                                <div class="card-body">
                                    <ul class="profile">
                                        <li class="nav__item">
                                            <a href="{{ route('doctor.pending.radiology') }}" class="nav__item-link">@lang('Pending radiology')</a>
                                        </li><!-- /.nav-item -->
                                        <li class="nav__item">
                                            <a href="{{ route('doctor.completed.radiology') }}" class="nav__item-link">@lang('Completed radiology')</a>
                                        </li><!-- /.nav-item -->
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <a href="{{ route('Website.doctor.profile',[
                            'field' => LangDetail($doctor->field->name,$doctor->field->name_ar),
                            'id'    => $doctor->id,
                            'name'  => $doctor->user->FullName
                            ]) }}" class="my-3">
                            <h5>
                                @lang('See Profile')
                            </h5>
                        </a>
                    </div>
                </div>
                <div class="col-md-9">
                    <form action="{{ route('doctor.update.account') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description">@lang('Biography(AR)')<span class="text-danger">*</span></label>
                                    <textarea name="desc_ar" class="form-control {{ $errors->has('desc_ar') ? 'is-invalid' : '' }}" id="kt-ckeditor-2" rows="3" required
                                    placeholder="@lang('Write description')" >{{ old('desc_ar') ? old('desc_ar') : $doctor->brief_desc }}</textarea>
                                    @error('desc_ar')
                                        <div class="invalid-feedback">{{ $errors->first('desc_ar') }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Desc -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description">@lang('Biography(ENG)')</label>
                                    <textarea name="desc" class="form-control {{ $errors->has('desc') ? 'is-invalid' : '' }}" id="kt-ckeditor-1" rows="3"
                                    placeholder="@lang('Write description')" >{{ old('desc') ? old('desc') :$doctor->brief_desc_ar }}</textarea>
                                    @error('desc')
                                        <div class="invalid-feedback">{{ $errors->first('desc') }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-12">
                                        @lang('Select field')<span class="text-danger">*</span>
                                    </label>
                                    <br>
                                    <select class="form-control select2{{ $errors->has('field_id') ? 'is-invalid' : '' }}"
                                        name="field_id"   required >
                                        <option value="">@lang('Choose a field of specialization')</option>
                                        @foreach ($fields as $field)
                                            <option value="{{$field->id}}"
                                                @if ($field->id==$doctor->field_id)
                                                    {{ 'selected' }}
                                                @endif
                                                >
                                               {{ LangDetail($field->name,$field->name_ar) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('field_id')
                                        <div class="invalid-feedback">{{ $errors->first('field_id') }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="specialty_id">@lang('Areas Of Expertise') <span class="text-danger">*</span></label>
                                    <select class="form-control select2{{ $errors->has('specialty_id') ? 'is-invalid' : '' }}" id="kt_select2_3" multiple="multiple"
                                     name="specialty_id[]"  required>
                                        @foreach ($specialties as $specialty)
                                            @if (in_array($specialty->id, $Selectedspecialties))
                                                <option value="{{$specialty->id}}" selected>{{ LangDetail($specialty->name,$specialty->name_ar) }}</option>
                                            @else
                                                <option value="{{$specialty->id}}">{{ LangDetail($specialty->name,$specialty->name_ar) }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('specialty_id')
                                     <div class="invalid-feedback">{{ $errors->first('specialty_id') }}</div>
                                    @enderror
                                    <span class="form-text text-warning">@lang('You can choose more than one specialty')</span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>@lang('Facebook')</label>
                                    <input type="text" class="form-control {{ $errors->has('facebook') ? 'is-invalid' : '' }}"
                                    name="facebook"  placeholder="@lang('Link')"  value="{{ old('facebook') ? old('facebook') : $doctor->facebook }}"/>
                                    @error('facebook')
                                        <div class="invalid-feedback">{{ $errors->first('facebook') }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Image">@lang('Your main photo')<span class="text-danger">*</span></label>
                                    <br>
                                    <div class="avatar-upload">
                                        <div class="avatar-edit">
                                            <input type='file' name="avatar" id="imageUpload" accept=".png, .jpg, .jpeg" />
                                            <label for="imageUpload"><i class="fa fa-pen"></i> </label>
                                        </div>
                                        <div class="avatar-preview">
                                            <div id="imagePreview" style="background-image: url({{ $doctor->avatar_id ? asset(App\Models\Doctor::Avatar.$doctor->avatar->name) : asset(App\Models\Doctor::Avatar.'doctor.png') }});">
                                            </div>
                                        </div>
                                    </div>
                                    @error('avatar')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-primary" type="submit">@lang('Update')</button>
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
<script src="{{ asset('js/pages/crud/forms/widgets/select2.js') }}"></script>
<script src="{{ asset('plugins/global/plugins.bundle.js') }}"></script>
<script>
    function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imagePreview').css('background-image', 'url('+e.target.result +')');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
    }
    $("#imageUpload").change(function() {
        readURL(this);
    });
</script>
@endsection
