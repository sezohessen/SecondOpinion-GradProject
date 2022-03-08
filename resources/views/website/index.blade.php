@extends('website.layouts.app')

@section('website')

<section class="slider">
    <div class="slick-carousel m-slides-0"
      data-slick='{"slidesToShow": 1, "arrows": true, "dots": false, "speed": 700,"fade": true,"cssEase": "linear"}'>
      <div class="slide-item align-v-h">
        <div class="bg-img"><img src="assets/images/sliders/2.jpg" alt="slide img"></div>
        <div class="container">
          <div class="row align-items-center">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-7">
              <div class="slide__content">
                <h2 class="slide__title">Caring For The Health And Well Being Of Family.</h2>
                <p class="slide__desc">The health and well-being of our patients and their health care team will
                  always be our priority, so we follow the best practices for cleanliness.</p>
                <div class="d-flex flex-wrap align-items-center">
                  <a href="appointment.html" class="btn btn__primary btn__rounded mr-30">
                    <span>Find A Doctor</span>
                    <i class="icon-arrow-right"></i>
                  </a>
                  <a href="services.html" class="btn btn__white btn__rounded">
                    <span>Our Services</span>
                    <i class="icon-arrow-right"></i>
                  </a>
                </div>
              </div><!-- /.slide-content -->
            </div><!-- /.col-xl-7 -->
          </div><!-- /.row -->
        </div><!-- /.container -->
      </div><!-- /.slide-item -->
      <div class="slide-item align-v-h">
        <div class="bg-img"><img src="assets/images/sliders/3.jpg" alt="slide img"></div>
        <div class="container">
          <div class="row align-items-center">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-7">
              <div class="slide__content">
                <h2 class="slide__title">All Aspects Of Medical Practice</h2>
                <p class="slide__desc">The health and well-being of our patients and their health care team will
                  always be our priority, so we follow the best practices for cleanliness.</p>
                <div class="d-flex flex-wrap align-items-center">
                  <a href="appointment.html" class="btn btn__primary btn__rounded mr-30">
                    <span>Find A Doctor</span>
                    <i class="icon-arrow-right"></i>
                  </a>
                  <a href="services.html" class="btn btn__white btn__rounded">
                    <span>Our Services</span>
                    <i class="icon-arrow-right"></i>
                  </a>
                </div>
              </div><!-- /.slide-content -->
            </div><!-- /.col-xl-7 -->
          </div><!-- /.row -->
        </div><!-- /.container -->
      </div><!-- /.slide-item -->
    </div><!-- /.carousel -->
</section><!-- /.slider -->

@endsection
