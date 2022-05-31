@extends('website.layouts.app')
@section('website')
    <section class="page-title page-title-layout6">
        <div class="bg-img"><img src="{{ asset('img/website/bg-doctor.jpg') }}" alt="background"></div>
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex flex-wrap justify-content-end align-items-center">
                    <div class="testimonials__rating mr-30">
                        <div class="testimonials__rating-inner d-flex align-items-center">
                            @if ($reviews->count())
                                <span
                                    class="total__rate">{{ number_format($reviews->sum('rating') / $reviews->count(), 1) }}</span>
                                <div>
                                    <span class="overall__rate">@lang('Overall Rating')</span>
                                    <span>,@lang('based on') {{ $reviews->count() }} @lang('reviews').</span>
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

                                    @if (file_exists(public_path($doctor->avatar->base . $doctor->avatar->name)))
                                        <img src="{{ view_image($doctor->avatar) }}" alt="member img">
                                    @else
                                        <img src="{{ asset(App\Models\Doctor::DefaultAvatar) }}" alt="member img">
                                    @endif
                                </div><!-- /.member-img -->
                                <div class="member__info">
                                    <h4 class="member__name">
                                        @if ($reviews->count())
                                            <div class="star-rating">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if (($reviews->sum('rating') / $reviews->count()) >= $i)
                                                    <i class="zmdi zmdi-star"></i>
                                                @else
                                                    <i class="zmdi zmdi-star-outline"></i>
                                                @endif
                                                @endfor
                                            </div>
                                        @endif
                                        <a
                                            href="doctors-single-doctor1.html">{{ $doctor->user->FullName }}</a></h4>
                                    <p class="member__job">
                                        {{ LangDetail($doctor->field->name, $doctor->field->name_ar) }}</p>
                                    <h6>@lang('Fees') :
                                        <strong class="text-info">
                                            @if (isset($doctor->price))
                                                <strong>{{ $doctor->price }} @lang('L.E')</strong>
                                            @endif
                                        </strong>
                                    </h6>
                                    <div class="mt-20 d-flex flex-wrap justify-content-between align-items-center">
                                        <ul class="social-icons list-unstyled mb-0">
                                            @if ($doctor->facebook && $doctor->facebook != '')
                                                <li><a href="{{ $doctor->facebook }}" class="facebook"><i
                                                            class="fab fa-facebook-f"></i></a></li>
                                            @endif
                                            @if ($doctor->user->whats_app)
                                                <li>
                                                    <a href="https://api.whatsapp.com/send?phone={{ $doctor->user->whats_app }}"
                                                        class="phone">
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
                    @if (session()->has('success'))
                        <div class="alert alert-success  m-4  ">
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif
                    @if (session()->has('failed'))
                    <div class="alert alert-success  m-4  ">
                        <p>{{ session('failed') }}</p>
                    </div>
                @endif
                    <div class="text-block mb-50">
                        <h5 class="text-block__title">@lang('Biography')</h5>
                        <p class="text-block__desc mb-20">{{ LangDetail($doctor->brief_desc, $doctor->brief_desc_ar) }}
                        </p>
                    </div><!-- /.text-block -->
                    <ul class="details-list list-unstyled mb-60">
                        @if ($doctor_specializes->count())
                            <li>
                                <h5 class="details__title">@lang('Areas Of Expertise')</h5>
                                <div class="details__content">
                                    <ul class="list-items list-items-layout2 list-unstyled mb-0">
                                        @foreach ($doctor_specializes as $doctor_specialize)
                                            <li>{{ LangDetail($doctor_specialize->specialty->name, $doctor_specialize->specialty->name_ar) }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                        @endif
                        <li>
                            <h5 class="details__title">@lang('Speciality')</h5>
                            <div class="details__content">
                                <p class="mb-0">{{ LangDetail($doctor->field->name, $doctor->field->name_ar) }}
                                </p>
                            </div>
                        </li>

                    </ul>
                    <section class="contact-layout4 bg-overlay bg-overlay-secondary-gradient pb-50 pb-50">
                        <div class="bg-img"><img src="assets/images/banners/3.jpg" alt="banner"></div>
                        <div class="contact-panel mb-0">
                            <form method="GET" action="{{ route('Website.book-opinion', ['id' => $doctor->id]) }}">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h4 class="contact-panel__title">@lang('Book Second Opinion')</h4>
                                        <p class="contact-panel__desc mb-30">@lang('You can now get second opinion radiology quickly. We have doctors who are experts in different fields and have extensive experience in radiology evaluation and treatment.')</p>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit"
                                            class="btn btn__primary btn__rounded btn__block btn__xhight mt-10">
                                            <span>@lang('Get Second Opinion')</span> <i class="fa fa-arrow-right"></i>
                                        </button>
                                    </div><!-- /.col-lg-12 -->
                                </div><!-- /.row -->
                            </form>
                        </div>
                    </section><!-- /.contact layout 2 -->
                    <hr>
                    @if ($reviews->count())
                    <div class="reviews">
                        <h4> @lang('Patients Review') <div class="star-rating float-left"> <i class="zmdi zmdi-star"
                                    style="font-size:39px"></i> </div>
                        </h4>
                        @foreach ($reviews as $review)
                            <div class="comment-list">
                                <div class="comment-item">
                                    <div class="comment-content">
                                        <div class="comment-author">
                                            <span class="author">{{ $review->patient->user->fullName }}</span>
                                            <div class="star-rating">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($review->rating >= $i)
                                                        <i class="zmdi zmdi-star"></i>
                                                    @else
                                                        <i class="zmdi zmdi-star-outline"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                            <em class="comment-time">{{ $review->created_at->format('Y-m-d') }}</em>
                                            <p>{{ $review->comment }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @endif

                </div><!-- /.col-lg-8 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </section>
@endsection
@section('js')

<script>

$("#ClickMe").click(function() {
        $('html, body').animate({
            scrollTop: $("#Book").offset().top - 200
        }, 100);
    });
</script>

@endsection
