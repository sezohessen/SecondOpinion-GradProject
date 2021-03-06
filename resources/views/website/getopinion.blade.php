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

        .field_age {
            display: inline-flex;
        }
        .invaild-feedback{
            display: none !important;
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

    <div class="container">
        <div class="card doctor-account">
            <div class="card-header">
                <h3>@lang('Get Second Opinion')</h3>
            </div>
            @if (session()->has('failed'))
                <div class="alert alert-success  m-4  ">
                    <p>{{ session('failed') }}</p>
                </div>
            @endif
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12">
                                <aside class="sidebar has-marign-right">
                                    <div class="member mb-0">
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
                                            <h4 class="member__name">
                                                <a href="{{ route('Website.doctor.profile',[
                                                    'field' => LangDetail($doctor->field->name,$doctor->field->name_ar),
                                                    'id'    => $doctor->id,
                                                    'name'  => $doctor->user->FullName
                                                    ]) }}">
                                                    {{ $doctor->user->FullName }}
                                                </a>
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
                        <form action="{{ route('Website.book.store',['doctor'=>$doctor->id,"patient"=> auth()->id()]) }}" method="POST" id="pay_processing"
                            enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="SessionID" id="SessionID" >
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
                                                <div class="invalid-feedback">{{ $errors->first('first_name') }}</div>
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
                                                <div class="invalid-feedback">{{ $errors->first('last_name') }}</div>
                                            @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('Phone') <span class="text-danger">*</span></label>
                                        <input id="text" type="phone"
                                            class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6 @error('phone') is-invalid @enderror"
                                            name="phone" value="{{ old('phone') ?? auth()->user()->phone }}"
                                            autocomplete="phone" placeholder="@lang('phone')">
                                            @error('phone')
                                                <div class="invalid-feedback">{{ $errors->first('phone') }}</div>
                                            @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>@lang('Whatsapp')</label>
                                        <input id="whats_app" type="phone"
                                            class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6 @error('whats_app') is-invalid @enderror"
                                            name="whats_app" value="{{ old('whats_app') ?? auth()->user()->whats_app }}"
                                            autocomplete="whats_app" placeholder="@lang('Whatsapp')">
                                            @error('whats_app')
                                                <div class="invalid-feedback">{{ $errors->first('whats_app') }}</div>
                                            @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="d-block">@lang('Date of birth') <span
                                                class="text-danger">*</span></label>
                                        <div class="field_age">
                                            <div class="field-inline-block">
                                                <label>@lang('Day')</label>
                                                <input type="text" pattern="[0-9]*" maxlength="2" size="2"
                                                    class="date-field" name="day"
                                                    value="{{ $date_of_birth->format('d') }}" />
                                                    @error('day')
                                                        <div class="invalid-feedback">{{ $errors->first('day') }}</div>
                                                    @enderror
                                            </div>
                                            /
                                            <div class="field-inline-block">
                                                <label>@lang('Month')</label>
                                                <input type="text" pattern="[0-9]*" maxlength="2" size="2"
                                                    class="date-field" name="month"
                                                    value="{{ $date_of_birth->format('m') }}" />
                                                    @error('month')
                                                        <div class="invalid-feedback">{{ $errors->first('month') }}</div>
                                                    @enderror
                                            </div>
                                            /
                                            <div class="field-inline-block">
                                                <label>@lang('Year')</label>
                                                <input type="text" pattern="[0-9]*" maxlength="4" size="4"
                                                    class="date-field date-field--year" name="year"
                                                    value="{{ $date_of_birth->format('Y') }}" />
                                                    @error('year')
                                                        <div class="invalid-feedback">{{ $errors->first('year') }}</div>
                                                    @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if($errors->count() != 1)
                                    <div class="col-md-12">
                                        <label for="files">@lang('Upload Radiology and files')(@lang('Max:3 files'))<span
                                                class="text-danger">*</span></label>
                                        <div class="from-group">
                                            <input type="file" id="files" name="files[]" multiple><br><br>
                                            @error('files')
                                                <div class="invalid-feedback">{{ $errors->first('files') }}</div>
                                            @enderror
                                        </div>
                                        <hr>
                                        <h6>@lang('Total Fees is') : <span class="text-info">{{ $doctor->price }}
                                                @lang('L.E')</span> </h6>
                                    </div>
                                @endif

                                <div class="col-md-12">
                                    <button class="btn btn-primary" type="submit">@lang('Get Second Opinion')</button>
                                </div>
                            </div>


                        </form>

                             <!-- Modal -->
                             <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <fieldset>
                                            <div class="form-group">
                                                <label class="col-md-8 control-label" for="cardNumber">@lang("Card number")</label>
                                                <div class="col-md-8">
                                                    <input type="text" id="cardNum"  name="cardNum"
                                                    placeholder="Valid Card Number"
                                                    value="{{old("cardNum")}}" class="form-control input-md"   readonly />
                                                </div>
                                            </div>
                                            <span class="invalid-feedback ml-4" role="alert" id="cardNumError" >
                                                <strong ></strong>
                                            </span>
                                            <div class="form-group">
                                                <label class="col-md-8 control-label" for="cardMonth">@lang("Expiry month")</label>
                                                <div class="col-md-8">
                                                    <input type="text" id="cardMonth" name="cardMonth" value="{{old("cardMonth")}}"
                                                    placeholder="00" class="form-control input-md" value="" />
                                                </div>
                                            </div>
                                            <span class="invalid-feedback ml-4" role="alert" id="monthError">
                                                <strong ></strong>
                                            </span>
                                            <div class="form-group">
                                                <label class="col-md-8 control-label" for="cardYear">@lang("Expiry year")</label>
                                                <div class="col-md-8">
                                                    <input type="text" id="cardYear" name="cardYear"    placeholder="0000"  value="{{old("cardYear")}}" class="form-control input-md" value="" />
                                                </div>
                                            </div>
                                            <span class="invalid-feedback ml-4" role="alert" id="yearError">
                                                <strong ></strong>
                                            </span>
                                            <div class="form-group">
                                                <label class="col-md-8 control-label" for="cardCVC">@lang("Security code (CVC)")</label>
                                                <div class="col-md-8">
                                                    <input type="text" id="cardCVC" name="cardCVC"value="{{old("cardCVC")}}"    placeholder="CVC"  class="form-control input-md" value="" readonly  />
                                                </div>
                                            </div>
                                            <span class="invalid-feedback ml-4" role="alert" id="cardCVCError">
                                                <strong ></strong>
                                            </span>
                                        </fieldset>
                                        <div class="alert alert-danger d-none " id="payment_failed">
                                            <i class="icon fa fa-times-circle" ></i>  <div class="text float-right"></div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button class="btn btn-primary pull-right" id="payButton" onclick="pay();">Pay</button>
                                    </div>
                                </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
<!-- INCLUDE SESSION.JS JAVASCRIPT LIBRARY -->
<script src="https://api.vapulus.com:1338/app/session/script?appId={{env("appId")}}"></script>
<style id="antiClickjack">body {disply: none !important;}</style>
@if($errors->count() == 1)
    <script>
        $('#exampleModalLong').modal('show');
    </script>
@endif
<script type="text/javascript">
    if(window.PaymentSession){
        PaymentSession.configure({
            fields: {
                // ATTACH HOSTED FIELDS IDS TO YOUR PAYMENT PAGE FOR A CREDIT CARD
                card: {
                    cardNumber: "cardNum",
                    securityCode: "cardCVC",
                    expiryMonth: "cardMonth",
                    expiryYear: "cardYear"
                }
            },
            callbacks: {
                initialized: function (err, response) {
                    console.log("init....");
                    console.log(err, response);
                    console.log("/init.....");
                    // HANDLE INITIALIZATION RESPONSE
                },
                formSessionUpdate: function (err,response) {
                    console.log("update callback.....");
                    console.log(err,response);
                    console.log("/update callback....");

                    if (response.statusCode) {

                        if (200 == response.statusCode) {
                            $("#SessionID").val(response.data.sessionId);
                            $("#pay_processing").submit();
                            // submit_form();
                            //  console.log("Session updated with data: " + response.data.sessionId);
                        } else if (201 == response.statusCode) {
                            console.log("Session update failed with field errors.");
                            if (response.message) {
                                console.log(response.message);
                                var field = response.message.indexOf('valid')
                                field = response.message.slice(field + 5, response.message.length);
                                $("#"+field.slice(1)+"Error").children().text(field + " Is Missing or invalid");
                            }else {
                                $("#payment_failed").children().eq(1).text("Invalid Card Payment Details");
                                $("#payment_failed").removeClass("d-none");
                            }
                        } else {
                            $("#payment_failed").children().eq(1).text("Invalid Card Payment Details");
                            $("#payment_failed").removeClass("d-none");
                            console.log(response.statusCode);
                        }
                    }else {
                        console.log(response.statusCode);
                    }
                }
            }
        });
    }
    function pay() {
        // UPDATE THE SESSION WITH THE INPUT FROM HOSTED FIELDS
        PaymentSession.updateSessionFromForm();
    }

</script>

@endsection
