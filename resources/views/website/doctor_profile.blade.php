
@extends('website.layouts.app')
@section('website')
<section class="page-title page-title-layout6">
        <div class="bg-img"><img src="{{ asset('img/website/bg-doctor.jpg') }}" alt="background"></div>
        <div class="container">
        <div class="row">
            <div class="col-12 d-flex flex-wrap justify-content-end align-items-center">
            <div class="testimonials__rating mr-30">
                <div class="testimonials__rating-inner d-flex align-items-center">
                @if($reviews->count())
                    <span class="total__rate">{{number_format($reviews->sum('rating') / $reviews->count(),1)}}</span>
                    <div>
                        <span class="overall__rate">@lang("Overall Rating")</span>
                        <span>,@lang("based on") {{$reviews->count()}} @lang("reviews").</span>
                    </div>

                @endif


                </div><!-- /.testimonials__rating-inner -->
            </div><!-- /.testimonials__rating -->
            <a href="#Form" id="ClickMe" class="btn btn__white btn__rounded">
                <i class="fas fa-arrow-down"></i> @lang('Get Opinion')
            </a>
            </div><!-- /.col-12 -->
        </div><!-- /.row -->
        </div><!-- /.container -->
</section><!-- /.page-title -->

<section class="pt-120 pb-80">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-4">
                <aside class="sidebar has-marign-right">
                <div class="widget widget-member shifted-top">
                    <div class="member mb-0">
                    <div class="member__img">
                        @if (file_exists(public_path($doctor->avatar->base.$doctor->avatar->name)))
                                <img src="{{ view_image($doctor->avatar) }}" alt="member img">
                        @else
                            <img src="{{ asset(App\Models\Doctor::DefaultAvatar) }}" alt="member img">
                        @endif
                    </div><!-- /.member-img -->
                    <div class="member__info">
                        <h5 class="member__name"><a href="doctors-single-doctor1.html">{{ $doctor->user->FullName }}</a></h5>
                        <p class="member__job">{{ LangDetail($doctor->field->name,$doctor->field->name_ar) }}</p>
                        <div class="mt-20 d-flex flex-wrap justify-content-between align-items-center">
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
                        </ul><!-- /.social-icons -->
                        </div>
                    </div><!-- /.member-info -->
                    </div><!-- /.member -->
                </div><!-- /.widget-member -->

                </aside><!-- /.sidebar -->
            </div><!-- /.col-lg-4 -->
            <div class="col-sm-12 col-md-12 col-lg-8">
                <div class="text-block mb-50">
                <h5 class="text-block__title">@lang('Biography')</h5>
                <p class="text-block__desc mb-20">{{ LangDetail($doctor->brief_desc,$doctor->brief_desc_ar) }}</p>
                </div><!-- /.text-block -->
                <ul class="details-list list-unstyled mb-60">
                @if ($doctor_specializes->count())
                    <li>
                        <h5 class="details__title">@lang('Areas Of Expertise')</h5>
                        <div class="details__content">
                            <ul class="list-items list-items-layout2 list-unstyled mb-0">
                                @foreach ($doctor_specializes as $doctor_specialize)
                                    <li>{{ LangDetail($doctor_specialize->specialty->name,$doctor_specialize->specialty->name_ar) }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </li>
                @endif
                <li>
                    <h5 class="details__title">@lang('Speciality')</h5>
                    <div class="details__content">
                    <p class="mb-0">{{ LangDetail($doctor->field->name,$doctor->field->name_ar) }} </p>
                    </div>
                </li>

                </ul>
                <div class="pricing-widget-layout3 mb-70">
                <h5 class="pricing__title">@lang('Treatments Price List')</h5>
                <div class="row">
                    <div class="col-md-6">
                    <ul class="pricing__list list-unstyled mb-0">
                        <li><span>Umbilical Cord Appearance</span><span class="price">$50</span></li>
                        <li><span>Cardiac Electrophysiology</span><span class="price">$45</span></li>
                        <li><span>Repositioning Techniques</span><span class="price">$60</span></li>
                        <li><span>Geriatric Neurology</span><span class="price">$65</span></li>
                        <li><span>Nuclear Cardiology</span><span class="price">$40</span></li>
                        <li><span>Nuclear Cardiology</span><span class="price">$55</span></li>
                    </ul><!-- /.pricing__list -->
                    </div><!-- /.col-md-6 -->
                    <div class="col-md-6">
                    <ul class="pricing__list list-unstyled mb-0">
                        <li><span>Umbilical Cord Appearance</span><span class="price">$50</span></li>
                        <li><span>Cardiac Electrophysiology</span><span class="price">$45</span></li>
                        <li><span>Repositioning Techniques</span><span class="price">$60</span></li>
                        <li><span>Geriatric Neurology</span><span class="price">$65</span></li>
                        <li><span>Nuclear Cardiology</span><span class="price">$40</span></li>
                        <li><span>Nuclear Cardiology</span><span class="price">$55</span></li>
                    </ul><!-- /.pricing__list -->
                    </div><!-- /.col-md-6 -->
                </div><!-- /.pricing-widget-layout3 -->
                </div><!-- /.text-block -->
                <section class="contact-layout4 bg-overlay bg-overlay-secondary-gradient pb-50 pb-50" >
                <div class="bg-img"><img src="assets/images/banners/3.jpg" alt="banner" ></div>
                <div class="contact-panel mb-0" id="Book">
                    <form class="contact-panel__form" method="POST" action="{{ route('Website.doctor.form.validate',['doctor'=> $doctor->id, ]) }}"   enctype="multipart/form-data" id="AppointmentForm">
                        @csrf
                        @method('POST')
                    <div class="row">
                        <div class="col-sm-12">
                        <h4 class="contact-panel__title">Book An Appointment</h4>
                        <p class="contact-panel__desc mb-30">Please feel welcome to contact our friendly reception staff
                            with any general or medical enquiry. Our doctors will receive or return any urgent calls.
                        </p>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <i class="icon-widget form-group-icon"></i>
                            <select class="form-control">
                            <option value="0">Choose Clinic</option>
                            <option value="1">Pathology Clinic</option>
                            <option value="2">Pathology Clinic</option>
                            </select>
                        </div>

                        </div><!-- /.col-lg-6 -->
                        <div class="col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <i class="icon-user form-group-icon"></i>
                            <select class="form-control">
                            <option value="0">Choose Doctor</option>
                            <option value="1">Ahmed Abdallah</option>
                            <option value="2">Mahmoud Begha</option>
                            </select>
                        </div>
                        </div><!-- /.col-lg-6 -->
                        <div class="col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <i class="icon-news form-group-icon"></i>
                            <input type="text" class="form-control" placeholder="Name" id="contact-name" name="contact-name" value="{{old("contact-name")}}"
                            required>
                        </div>
                        </div><!-- /.col-lg-6 -->
                        <div class="col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <i class="icon-email form-group-icon"></i>
                            <input type="email" class="form-control" placeholder="Email" id="contact-email"
                            name="contact-email" required>
                        </div>
                        </div><!-- /.col-lg-6 -->
                        <div class="col-sm-4 col-md-4 col-lg-4">
                        <div class="form-group">
                            <i class="icon-phone form-group-icon"></i>
                            <input type="text" class="form-control" placeholder="Phone" id="contact-Phone"
                            name="contact-phone" required>
                        </div>
                        </div><!-- /.col-lg-4 -->
                        <div class="col-sm-4 col-md-4 col-lg-4">
                        <div class="form-group form-group-date">
                            <i class="icon-calendar form-group-icon"></i>
                            <input type="date" class="form-control" id="contact-date" name="contact-date" required>
                        </div>
                        </div><!-- /.col-lg-4 -->
                        <div class="col-sm-4 col-md-4 col-lg-4">
                        <div class="form-group form-group-date">
                            <i class="icon-clock form-group-icon"></i>
                            <input type="time" class="form-control" id="contact-time" name="contact-time" required>
                        </div>
                        <input type="hidden" name="SessionID" id="SessionID">
                        <input type="hidden" name="payment" id="payment" value="">

                        </div><!-- /.col-lg-4 -->
                        <div class="col-12">

                        <button type="submit" class="btn btn__primary btn__rounded btn__block btn__xhight mt-10">
                            <span>Book Appointment</span> <i class="icon-arrow-right"></i>
                        </button>

                        <div class="contact-result"></div>
                        </div><!-- /.col-lg-12 -->
                                <!-- Button trigger modal -->
                    </div><!-- /.row -->
                    </form>

                </section><!-- /.contact layout 2 -->



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

                                @error('SessionID')
                                    <span class="invalid-feedback ml-4" role="alert">
                                        <strong>@lang("Invalid Card Payment Details")</strong>
                                    </span>
                                @enderror
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
                <hr>
                <div class="reviews">
                    <h4> @lang("Patients Review") <div class="star-rating float-left"> <i class="zmdi zmdi-star" style="font-size:39px"></i> </div> </h4>
                    @foreach ($reviews as $review)
                        <div class="comment-list">
                            <div class="comment-item">
                                <div class="comment-content">
                                        <div class="comment-author">
                                            <span class="author">{{$review->patient->user->fullName}}</span>
                                            <div class="star-rating">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($review->rating >= $i)
                                                    <i class="zmdi zmdi-star"></i>
                                                @else
                                                    <i class="zmdi zmdi-star-outline"></i>
                                                @endif
                                            @endfor
                                            </div>

                                        <em class="comment-time">{{$review->created_at->format('Y-m-d')}}</em>

                                        <p>{{$review->comment}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div><!-- /.col-lg-8 -->

        </div><!-- /.row -->
    </div><!-- /.container -->

</section>

@endsection
@section('js')

<!-- INCLUDE SESSION.JS JAVASCRIPT LIBRARY -->
<script src="https://api.vapulus.com:1338/app/session/script?appId={{env("appId")}}"></script>
<style id="antiClickjack">body {disply: none !important;}</style>
<script>

$("#ClickMe").click(function() {
        $('html, body').animate({
            scrollTop: $("#Book").offset().top - 200
        }, 100);
    });
</script>
@if($errors->count() == 1)
    <script>
        $('#exampleModalLong').modal('show')
    </script>
@endif
<script>
     $(document).ready(function(){

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

                        // console.log("init....");
                        // console.log(err, response);
                        // console.log("/init.....");
                        // HANDLE INITIALIZATION RESPONSE
                    },
                    formSessionUpdate: function (err,response) {
                        //console.log("update callback.....");
                        // console.log(err,response);
                        // console.log("/update callback....");x
                        // HANDLE RESPONSE FOR UPDATE SESSION
                        if (response.statusCode) {
                            if (200 == response.statusCode) {
                                $("#SessionID").val(response.data.sessionId);
                                $("#payment").val("true");
                                submit_form();
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
                        }
                    }
                }
            });
        }
        });

        function pay() {
            // UPDATE THE SESSION WITH THE INPUT FROM HOSTED FIELDS
            PaymentSession.updateSessionFromForm();
        }
        function submit_form(){
            $("#AppointmentForm").submit();
        }

</script>

@endsection
