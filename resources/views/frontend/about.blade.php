@extends('frontend.layouts.main')
@section('title', 'About Page')
@section('content')

    <div class="st-content">
        {{-- <div class="st-page-heading st-dynamic-bg" data-src="{{ asset('public/assets/img/hero-bg15.jpg') }}"> --}}
        @if ($banners->count() > 0)
            @if ($banners->first()->type === 'carousel')
                <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        @foreach ($banners as $key => $banner)
                            <button type="button" data-bs-target="#carouselExampleSlidesOnly"
                                data-bs-slide-to="{{ $key }}" class="{{ $key === 0 ? 'active' : '' }}"
                                aria-current="{{ $key === 0 ? 'true' : '' }}"
                                aria-label="Slide {{ $key + 1 }}"></button>
                        @endforeach
                    </div>
                    <div class="carousel-inner">
                        @foreach ($banners as $key => $banner)
                            <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                <img src="{{ $banner->image }}" class="d-block w-100" alt="{{ $banner->banner_title }}">
                                @if (!empty($banner->banner_title) || !empty($banner->page_url))
                                    <div class="carousel-caption d-none d-md-block text-start"
                                        style="left: 10%; top: 0; transform: translateY(40%); max-width: 700px;">
                                        <h1 class="text-white">{{ $banner->banner_title }}</h1>
                                        <h5>{{ $banner->description }}</h5>
                                        @if (!empty($banner->page_url))
                                            <a href="{{ $banner->page_url }}"
                                                class="btn btn-primary">{{ $banner->button_label }}</a>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @elseif ($banners->first()->type === 'single')
                @if ($banners->first())
                    @php $banner = $banners->first(); @endphp
                    <div class="st-page-heading st-dynamic-bg" data-src="{{ $banner->image }}">
                        <div class="container">
                            <div class="st-page-heading-in text-center">
                                <h1 class="st-page-heading-title">{{ $banner->banner_title }}</h1>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        @else
            <div class="st-page-heading st-dynamic-bg" data-src="{{ asset('public/assets/img/hero-bg15.jpg') }}">
                <div class="container">
                    <div class="st-page-heading-in text-center">
                        <h1 class="st-page-heading-title">About Midland</h1>
                    </div>
                </div>
            </div>
        @endif
        <!-- Start Our Story Section -->
        <section class="st-faq-wrap st-shape-wrap abt_stry_otr">
            <div class="st-shape5">
                <img src="{{ asset('public/assets/img/shape/faq-bg.svg') }}" alt="shape1">
            </div>
            <div class="st-height-b120 st-height-lg-b80"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="st-vertical-middle">
                            <div class="st-vertical-middle-in">
                                <div class="st-slider st-style2 st-abt-slider">
                                    <div class="st-container" data-autoplay="0" data-loop="1" data-speed="600"
                                        data-center="0" data-slides-per-view="responsive" data-xs-slides="1"
                                        data-sm-slides="2" data-md-slides="3" data-lg-slides="4" data-add-slides="4">
                                        <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                                            <div class="carousel-indicators">
                                                <button type="button" data-bs-target="#carouselExampleSlidesOnly"
                                                    data-bs-slide-to="0" class="active" aria-current="true"
                                                    aria-label="Slide 1"></button>
                                                <button type="button" data-bs-target="#carouselExampleSlidesOnly"
                                                    data-bs-slide-to="1" aria-label="Slide 2"></button>
                                                <button type="button" data-bs-target="#carouselExampleSlidesOnly"
                                                    data-bs-slide-to="2" aria-label="Slide 3"></button>
                                                <button type="button" data-bs-target="#carouselExampleSlidesOnly"
                                                    data-bs-slide-to="3" aria-label="Slide 4"></button>
                                            </div>
                                            <div class="carousel-inner" style="border-radius: 7px">
                                                <div class="carousel-item">
                                                    <img src="{{ asset('public/assets/img/story1.webp') }}" class="d-block w-100"
                                                        alt="...">
                                                </div>
                                                <div class="carousel-item active">
                                                    <img src="{{ asset('public/assets/img/story2.webp') }}" class="d-block w-100"
                                                        alt="...">
                                                </div>
                                                <div class="carousel-item">
                                                    <img src="{{ asset('public/assets/img/story3.webp') }}" class="d-block w-100"
                                                        alt="...">
                                                </div>
                                                <div class="carousel-item">
                                                    <img src="{{ asset('public/assets/img/story4.JPG') }}" class="d-block w-100"
                                                        alt="...">
                                                </div>
                                            </div>
                                        </div>

                                        {{-- <div class="st-wrapper">

                                            <div class="slick-slide-in">
                                                <div class="st-member st-style1 st-zoom">
                                                    <div class="st-member-img">
                                                        <img src="{{ asset('public/assets/img/story2.webp') }}" alt="story2"
                                                            class="st-zoom-in">
                                                        <!-- <a class="st-doctor-link"
                                                        href="doctor-profile.html"><i
                                                          class="fas fa-link"></i></a>
                                                      <div class="st-member-social-wrap">
                                                        <img src="assets/img/shape/member-shape.svg"
                                                          alt="shape" class="st-member-social-bg">
                                                        <ul class="st-member-social st-mp0">
                                                          <li><a href="#"><i
                                                                class="fab fa-facebook-square"></i></a></li>
                                                          <li><a href="#"><i
                                                                class="fab fa-linkedin"></i></a></li>
                                                          <li><a href="#"><i
                                                                class="fab fa-pinterest-square"></i></a></li>
                                                          <li><a href="#"><i
                                                                class="fab fa-twitter-square"></i></a></li>
                                                          <li><a href="#"><i
                                                                class="fab fa-dribbble-square"></i></a></li>
                                                        </ul>
                                                      </div> -->
                                                    </div>
                                                    <!-- <div class="st-member-meta">
                                                      <div class="st-member-meta-in">
                                                        <h3 class="st-member-name"><a
                                                            href="doctor-profile.html">Dr. Vera
                                                            Hasson</a></h3>
                                                        <div
                                                          class="st-member-designation">Cardiology</div>
                                                      </div>
                                                    </div> -->
                                                </div>
                                            </div><!-- .slick-slide-in -->

                                            <div class="slick-slide-in">
                                                <div class="st-member st-style1 st-zoom">
                                                    <div class="st-member-img">
                                                        <img src="{{ asset('public/assets/img/story1.webp') }}" alt="story1"
                                                            class="st-zoom-in">
                                                        <!-- <a class="st-doctor-link"
                                                        href="doctor-profile.html"><i
                                                          class="fas fa-link"></i></a>
                                                      <div class="st-member-social-wrap">
                                                        <img src="assets/img/shape/member-shape.svg"
                                                          alt="shape" class="st-member-social-bg">
                                                        <ul class="st-member-social st-mp0">
                                                          <li><a href="#"><i
                                                                class="fab fa-facebook-square"></i></a></li>
                                                          <li><a href="#"><i
                                                                class="fab fa-linkedin"></i></a></li>
                                                          <li><a href="#"><i
                                                                class="fab fa-pinterest-square"></i></a></li>
                                                          <li><a href="#"><i
                                                                class="fab fa-twitter-square"></i></a></li>
                                                          <li><a href="#"><i
                                                                class="fab fa-dribbble-square"></i></a></li>
                                                        </ul>
                                                      </div> -->
                                                    </div>
                                                    <!-- <div class="st-member-meta">
                                                      <div class="st-member-meta-in">
                                                        <h3 class="st-member-name"><a
                                                            href="doctor-profile.html">Dr. Philip
                                                            Bailey</a></h3>
                                                        <div class="st-member-designation">Urology</div>
                                                      </div>
                                                    </div> -->
                                                </div>
                                            </div><!-- .slick-slide-in -->

                                            <div class="slick-slide-in">
                                                <div class="st-member st-style1 st-zoom">
                                                    <div class="st-member-img">
                                                        <img src="{{ asset('public/assets/img/story3.webp') }}" alt="story3"
                                                            class="st-zoom-in">
                                                        <!-- <a class="st-doctor-link"
                                                        href="doctor-profile.html"><i
                                                          class="fas fa-link"></i></a>
                                                      <div class="st-member-social-wrap">
                                                        <img src="assets/img/shape/member-shape.svg"
                                                          alt="shape" class="st-member-social-bg">
                                                        <ul class="st-member-social st-mp0">
                                                          <li><a href="#"><i
                                                                class="fab fa-facebook-square"></i></a></li>
                                                          <li><a href="#"><i
                                                                class="fab fa-linkedin"></i></a></li>
                                                          <li><a href="#"><i
                                                                class="fab fa-pinterest-square"></i></a></li>
                                                          <li><a href="#"><i
                                                                class="fab fa-twitter-square"></i></a></li>
                                                          <li><a href="#"><i
                                                                class="fab fa-dribbble-square"></i></a></li>
                                                        </ul>
                                                      </div> -->
                                                    </div>
                                                    <!-- <div class="st-member-meta">
                                                      <div class="st-member-meta-in">
                                                        <h3 class="st-member-name"><a
                                                            href="doctor-profile.html">Dr. Matthew
                                                            Hill</a></h3>
                                                        <div
                                                          class="st-member-designation">Neurosurgery</div>
                                                      </div>
                                                    </div> -->
                                                </div>
                                            </div><!-- .slick-slide-in -->

                                            <div class="slick-slide-in">
                                                <div class="st-member st-style1 st-zoom">
                                                    <div class="st-member-img">
                                                        <img src="{{ asset('public/assets/img/story4.JPG') }}" alt="story4"
                                                            class="st-zoom-in">
                                                        <!-- <a class="st-doctor-link"
                                                        href="doctor-profile.html"><i
                                                          class="fas fa-link"></i></a>
                                                      <div class="st-member-social-wrap">
                                                        <img src="assets/img/shape/member-shape.svg"
                                                          alt="shape" class="st-member-social-bg">
                                                        <ul class="st-member-social st-mp0">
                                                          <li><a href="#"><i
                                                                class="fab fa-facebook-square"></i></a></li>
                                                          <li><a href="#"><i
                                                                class="fab fa-linkedin"></i></a></li>
                                                          <li><a href="#"><i
                                                                class="fab fa-pinterest-square"></i></a></li>
                                                          <li><a href="#"><i
                                                                class="fab fa-twitter-square"></i></a></li>
                                                          <li><a href="#"><i
                                                                class="fab fa-dribbble-square"></i></a></li>
                                                        </ul>
                                                      </div> -->
                                                    </div>
                                                    <!-- <div class="st-member-meta">
                                                      <div class="st-member-meta-in">
                                                        <h3 class="st-member-name"><a
                                                            href="doctor-profile.html">Dr. Jeanette
                                                            Hoff</a></h3>
                                                        <div class="st-member-designation">Surgery</div>
                                                      </div>
                                                    </div> -->
                                                </div>
                                            </div><!-- .slick-slide-in -->
                                        </div> --}}
                                    </div><!-- .slick-container -->
                                    {{-- <div class="pagination st-style1 st-flex st-hidden"></div> --}}
                                    <!-- If dont need Pagination then add class .st-hidden -->
                                    {{-- <div class="swipe-arrow st-style1">
                                        <!-- If dont need navigation then add class .st-hidden -->
                                        <div class="slick-arrow-left"><i class="fa fa-chevron-left"></i></div>
                                        <div class="slick-arrow-right"><i class="fa fa-chevron-right"></i></div>
                                    </div> --}}
                                </div><!-- .st-slider -->
                            </div>
                        </div>
                        <div class="st-height-b0 st-height-lg-b30"></div>
                    </div>
                    <div class="col-lg-6">
                        <h2 class="st-accordian-heading">Welcome to Midland Healthcare – Providing Quality Healthcare for All</h2>
                        <div class="st-accordian-wrap">
                            <div class="st-accordian active ">
                                <div class="st-accordian-title">
                                    Who we are?
                                    <span class="st-accordian-toggle fa fa-angle-down"></span>
                                </div>
                                <div class="st-accordian-body">Midland Healthcare & Research
                                    Center is NABH accredited hospital in Lucknow. The service’s
                                    primary comprises of hospital, diagnostics and day care
                                    specialty facilities. <br><br>

                                    The multi-specialty hospital Lucknow is ISO 9001-2000
                                    certified unit known to provide accessible, accountable and
                                    affordable health care services to all sections of the
                                    society. <br><br>

                                    As a responsible corporate citizen, we at Midland take the
                                    spirit of leadership well beyond business and have embraced
                                    the responsibility of keeping our citizen healthy. We
                                    appropriately support the patients facing difficult
                                    financial circumstances and treat everyone in our diverse
                                    community with respect and dignity.

                                </div>
                            </div><!-- .st-accordian -->
                            <div class="st-accordian">
                                <div class="st-accordian-title">
                                    Our Vision & Mission
                                    <span class="st-accordian-toggle fa fa-angle-down"></span>
                                </div>
                                <div class="st-accordian-body">
                                    <h4>Vision</h4>
                                    To take humanity to a higher trajectory with our pioneering
                                    medical expertise and innovative personalized care.

                                    <br><br>

                                    <h4>Mission</h4>
                                    <ul>
                                        <li>To provide quality health care and services at an
                                            affordable price for the prevention, diagnosis, and
                                            treatment of various illness.</li>
                                        <li>To attract and support specialists and other
                                            healthcare professionals to achieve the highest
                                            character and greatest skill.</li>
                                        <li>To support research & development into the causes and
                                            treatment of human illness and to educate health
                                            professionals to advance knowledge in the Healthcare
                                            Sector.</li>
                                        <li>To strive effortlessly with compassion and innovation
                                            for progressive care.</li>
                                        <li>To serve all classes of the society with sincerity and
                                            integrity.</li>
                                    </ul>
                                </div>
                            </div><!-- .st-accordian -->
                            <div class="st-accordian">
                                <div class="st-accordian-title">
                                    Our Values
                                    <span class="st-accordian-toggle fa fa-angle-down"></span>
                                </div>
                                <div class="st-accordian-body">
                                    <span><b> & Patient-Centric Treatment Approach</b></span>
                                    Patients and families have placed their lives and health in
                                    our hands. Our culture of caring will be unmistakable in
                                    every personal interaction as we treat individuals,
                                    families, and colleagues with compassion, honesty, and
                                    openness. We believe that maintaining the highest safety
                                    standards is critical to delivering high-quality care and
                                    that a safe workplace protects us all.

                                    <br><br>

                                    <span><b> Teamwork </b></span>
                                    By working together across disciplines and proactively
                                    supporting each other and operate as one team, we will
                                    create a unified, integrated approach to care. We will
                                    continue to respect and value people at all levels with
                                    different opinions, experiences, and backgrounds.

                                    <br><br>

                                    <span><b> Foresight </b></span>
                                    Adopt a ‘can-do’ attitude. We will anticipate the challenges
                                    tomorrow may bring and develop new and innovative ways to
                                    inspire healthier communities.

                                </div>
                            </div><!-- .st-accordian -->
                            <div class="st-accordian">
                                <div class="st-accordian-title">
                                    Our Journey
                                    <span class="st-accordian-toggle fa fa-angle-down"></span>
                                </div>
                                <div class="st-accordian-body">We started our journey in 1990
                                    as Aditya Clinic with an aim to provide OPD facilities to
                                    our patients. It was the first and only tertiary care center
                                    for Respiratory, Sleep and Pulmonary Rehabilitation Center
                                    in the entire region. Since then, we have now grown up to be
                                    a 100+ bedded multi-specialty healthcare Lucknow, offering
                                    complete healthcare solutions to people of all ages, from
                                    Neonates to adults. <br><br>

                                    The cornerstones of Midland’s legacy lies in its unstinting
                                    focus on clinical excellence, affordable costs,
                                    technologically advanced equipment and a forward-looking
                                    approach towards training & research. <br><br>

                                    For more than 30 years, our patient has trusted us for the
                                    best care.

                                </div>
                            </div><!-- .st-accordian -->
                        </div><!-- .st-accordian-wrap -->
                    </div>
                </div>
            </div>
            <div class="st-height-b120 st-height-lg-b80"></div>
        </section>
        <!-- End Our Story Section -->

        <!-- Start Feature Seciton -->
        <section>
            <div class="st-height-b120 st-height-lg-b80 abt_ftr_otr"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="st-iconbox st-style1">
                            <div class="st-iconbox-icon st-purple-box">
                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512"
                                    xml:space="preserve">
                                    <g>
                                        <path
                                            d="M482.726,485.783l-22.65-132.603c-2.441-14.287-12.576-25.764-26.453-29.95l-61.092-18.433
                                                                      c-1.265-14.934-7.388-29.023-17.578-40.175c-8.151-8.92-18.403-15.415-29.704-18.999c1.934-2.146,3.727-4.285,5.372-6.377
                                                                      c14.528-18.477,22.306-38.833,24.286-52.724h4.713c12.258,0,22.231-9.972,22.231-22.231v-11.396
                                                                      c0-8.181-4.602-15.594-11.523-19.441V106.05c0-4.141-3.357-7.498-7.498-7.498s-7.497,3.356-7.497,7.498v30.764
                                                                      c-2.92,0.507-6.404,1.383-9.968,2.884c-0.365,0.133-0.72,0.287-1.056,0.472c-0.805,0.367-1.611,0.754-2.414,1.19V80.938
                                                                      c0-16.693-13.58-30.273-30.273-30.273h-20.695c-7.138,0-14.111,2.487-19.637,7.005l-2.031,1.66c-3.73,3.05-8.438,4.73-13.257,4.73
                                                                      c-4.819,0-9.528-1.68-13.258-4.73l-2.03-1.66c-5.526-4.517-12.499-7.005-19.637-7.005H200.38
                                                                      c-16.693,0-30.273,13.58-30.273,30.273v60.422c-0.803-0.436-1.609-0.823-2.414-1.19c-0.336-0.185-0.69-0.339-1.055-0.472
                                                                      c-3.564-1.501-7.049-2.377-9.968-2.884V59.025c0-24.278,19.752-44.03,44.03-44.03h110.601c24.279,0,44.03,19.752,44.03,44.03
                                                                      v11.786c0,4.141,3.357,7.498,7.497,7.498s7.498-3.356,7.498-7.498V59.025C370.326,26.479,343.847,0,311.301,0H200.7
                                                                      c-32.547,0-59.025,26.479-59.025,59.025v74.43c-6.921,3.847-11.523,11.259-11.523,19.441v11.396
                                                                      c0,12.259,9.973,22.231,22.231,22.231h4.713c1.979,13.891,9.758,34.247,24.286,52.724c1.643,2.09,3.435,4.227,5.367,6.371
                                                                      c-25.98,8.252-44.926,31.61-47.277,59.179L78.378,323.23c-13.877,4.186-24.013,15.663-26.453,29.95l-9.198,53.849
                                                                      c-0.697,4.082,2.047,7.955,6.128,8.652c4.08,0.699,7.955-2.046,8.653-6.128l9.198-53.849c1.476-8.644,7.608-15.586,16.003-18.118
                                                                      l56.505-17.049v14.831c-12.952,2.384-23.973,11.281-28.512,23.608c-1.205,3.272-1.954,6.698-2.226,10.182l-5.461,70.095
                                                                      c-0.412,5.28,1.415,10.538,5.01,14.423c3.595,3.886,8.694,6.116,13.989,6.116h9.348c4.141,0,7.498-3.356,7.498-7.498
                                                                      c0-4.142-3.357-7.497-7.498-7.497h-9.348c-1.129,0-2.215-0.474-2.982-1.304c-0.766-0.828-1.155-1.948-1.067-3.073l5.461-70.096
                                                                      c0.165-2.111,0.618-4.186,1.348-6.167c3.158-8.575,11.686-14.382,21.223-14.449l1.235-0.009c0.058-0.001,0.115-0.001,0.172-0.001
                                                                      c9.269,0,17.474,5.256,20.935,13.427c0.971,2.291,1.561,4.713,1.755,7.199l5.463,70.097c0.087,1.124-0.302,2.244-1.068,3.073
                                                                      c-0.766,0.828-1.853,1.303-2.982,1.303h-9.348c-4.141,0-7.498,3.356-7.498,7.497c0,4.141,3.357,7.498,7.498,7.498h9.348
                                                                      c5.295,0,10.395-2.229,13.989-6.116c3.596-3.887,5.423-9.144,5.011-14.422l-5.463-70.096c-0.32-4.102-1.295-8.101-2.898-11.884
                                                                      c-4.939-11.657-15.5-19.762-27.938-21.955v-19.306l25.774-7.777c2.345,4.939,6.992,15.612,16.197,38.619
                                                                      c9.277,23.214,20.808,52.969,31.867,81.895c0.079,0.243,0.17,0.48,0.272,0.712c7.38,19.311,14.539,38.225,20.662,54.541
                                                                      c1.098,2.926,3.895,4.864,7.02,4.864c3.125,0,5.922-1.938,7.02-4.864c6.122-16.316,13.281-35.23,20.662-54.541
                                                                      c0.103-0.232,0.193-0.47,0.272-0.712c11.051-28.909,22.576-58.645,31.849-81.852c9.217-23.037,13.868-33.719,16.214-38.662
                                                                      l25.774,7.777v44.285c-17.858,3.469-31.385,19.219-31.385,38.077c0,21.391,17.403,38.795,38.795,38.795
                                                                      c21.392,0,38.795-17.403,38.795-38.795c0-18.796-13.438-34.508-31.21-38.045v-39.792l56.506,17.049
                                                                      c8.395,2.532,14.526,9.474,16.003,18.118l22.65,132.603c0.376,2.199-0.209,4.349-1.648,6.054c-1.438,1.704-3.459,2.644-5.69,2.644
                                                                      H51.393c-2.231,0-4.251-0.939-5.69-2.644c-1.438-1.705-2.024-3.854-1.648-6.054l7.475-43.762c0.697-4.082-2.047-7.955-6.128-8.652
                                                                      c-4.08-0.7-7.955,2.047-8.653,6.128l-7.475,43.762c-1.115,6.532,0.696,13.183,4.968,18.248C38.516,509.096,44.767,512,51.393,512
                                                                      h409.214c6.626,0,12.878-2.904,17.151-7.969C482.03,498.966,483.841,492.315,482.726,485.783z M355.421,152.089
                                                                      c3.995-0.996,7.202-0.978,7.238-0.977c1.292,0.017,2.548-0.285,3.664-0.87c0.334,0.831,0.531,1.724,0.531,2.654v11.396
                                                                      c0,3.99-3.246,7.236-7.236,7.236h-4.197V152.089z M156.579,171.528L156.579,171.528h-4.197c-3.99,0-7.236-3.246-7.236-7.236
                                                                      v-11.396c0-0.93,0.198-1.823,0.531-2.653c1.115,0.585,2.371,0.887,3.664,0.869c0.057,0.01,3.255-0.008,7.238,0.981V171.528z
                                                                       M171.574,179.935v-19.698c2.272,0.681,4.757,0.588,7.051-0.369c3.935-1.642,6.477-5.455,6.477-9.716V80.938
                                                                      c0-8.424,6.854-15.278,15.278-15.278h20.695c3.688,0,7.291,1.285,10.146,3.619l2.03,1.66c6.401,5.234,14.48,8.115,22.749,8.115
                                                                      c8.269,0,16.348-2.882,22.749-8.115l2.03-1.66c2.854-2.334,6.458-3.619,10.146-3.619h20.695c8.424,0,15.278,6.854,15.278,15.278
                                                                      v69.215c0,4.26,2.542,8.074,6.477,9.716c1.314,0.548,2.69,0.814,4.054,0.814c1.017,0,2.026-0.149,2.997-0.439v19.691
                                                                      c0,10.947-7.568,32.205-21.594,50.043c-4.646,5.909-10.618,12.257-17.971,17.805c-0.233,0.156-0.456,0.325-0.669,0.505
                                                                      c-11.391,8.422-26.038,14.874-44.192,14.874s-32.801-6.452-44.193-14.875c-0.213-0.179-0.435-0.348-0.667-0.503
                                                                      c-7.353-5.549-13.325-11.897-17.972-17.806C179.143,212.141,171.574,190.882,171.574,179.935z M305.12,301.07L256,337.784
                                                                      l-49.12-36.714c4.871-6.191,7.6-14.138,7.6-21.23v-12.086c11.551,6.212,25.334,10.404,41.52,10.404s29.97-4.192,41.52-10.404
                                                                      v12.086C297.52,286.932,300.249,294.879,305.12,301.07z M194.367,292.701c-4.004-1.525-8.443-1.775-12.642-0.636
                                                                      c-0.184,0.043-0.364,0.092-0.539,0.144l-25.903,7.816c4.381-21.542,21.873-38.688,44.202-42.009v21.824
                                                                      C199.485,284.544,197.385,289.407,194.367,292.701z M214.716,352.889c-0.014-0.035-0.028-0.07-0.041-0.104
                                                                      c-0.38-0.961-0.755-1.909-1.127-2.846c-0.067-0.17-0.134-0.339-0.201-0.507c-0.364-0.917-0.725-1.827-1.081-2.722
                                                                      c-0.025-0.063-0.05-0.125-0.075-0.189c-1.111-2.793-2.182-5.472-3.212-8.039c-0.075-0.186-0.15-0.375-0.225-0.56
                                                                      c-0.296-0.736-0.587-1.461-0.876-2.177c-0.106-0.263-0.211-0.523-0.316-0.783c-0.28-0.694-0.558-1.384-0.832-2.059
                                                                      c-0.082-0.202-0.162-0.398-0.243-0.599c-0.497-1.226-0.983-2.421-1.457-3.586c-0.128-0.315-0.259-0.636-0.386-0.947
                                                                      c-0.186-0.454-0.367-0.896-0.549-1.341c-0.196-0.48-0.392-0.956-0.584-1.424c-0.072-0.175-0.147-0.36-0.219-0.534
                                                                      c-0.058-0.14-0.111-0.269-0.168-0.408c-0.866-2.104-1.689-4.087-2.47-5.952c-0.006-0.015-0.013-0.03-0.019-0.045
                                                                      c-0.416-0.993-0.823-1.963-1.214-2.887c-0.203-0.479-0.403-0.95-0.599-1.412l42.245,31.574l-17.652,7.499
                                                                      c-0.031,0.013-0.063,0.026-0.094,0.04l-7.37,3.131C215.533,354.955,215.124,353.919,214.716,352.889z M232.606,398.797
                                                                      c-1.481-3.843-2.973-7.708-4.468-11.569c-2.338-6.039-4.571-11.781-6.708-17.251l2.798-1.189l11.432,13.289L232.606,398.797z
                                                                       M256.145,459.735c-0.215-0.446-0.471-0.867-0.767-1.259c-3.388-8.955-7.688-20.286-12.447-32.753l7-38.325h12.138l7,38.325
                                                                      C264.082,438.784,259.603,450.594,256.145,459.735z M264.881,372.404h-17.762l-8.405-9.77L256,355.291l17.286,7.343
                                                                      L264.881,372.404z M283.862,387.228c-1.495,3.861-2.987,7.726-4.468,11.569l-3.054-16.721l11.432-13.289l2.798,1.189
                                                                      C288.433,375.446,286.2,381.189,283.862,387.228z M312.58,315.18c-0.371,0.876-0.757,1.795-1.15,2.733
                                                                      c-0.051,0.122-0.103,0.245-0.154,0.368c-0.389,0.93-0.785,1.88-1.195,2.869c-0.027,0.065-0.055,0.134-0.082,0.2
                                                                      c-0.354,0.853-0.717,1.733-1.086,2.63c-0.069,0.168-0.134,0.323-0.203,0.492c-0.082,0.201-0.17,0.414-0.253,0.617
                                                                      c-0.164,0.4-0.331,0.808-0.499,1.216c-0.206,0.503-0.411,1.004-0.622,1.519c-0.067,0.164-0.136,0.335-0.204,0.5
                                                                      c-0.522,1.279-1.058,2.597-1.606,3.951c-0.086,0.212-0.171,0.42-0.257,0.635c-0.271,0.669-0.547,1.352-0.824,2.039
                                                                      c-0.108,0.269-0.217,0.537-0.326,0.809c-0.286,0.709-0.575,1.427-0.867,2.155c-0.082,0.203-0.165,0.411-0.247,0.615
                                                                      c-1.017,2.532-2.072,5.173-3.167,7.925c-0.036,0.091-0.072,0.18-0.108,0.272c-0.354,0.889-0.712,1.793-1.074,2.704
                                                                      c-0.067,0.17-0.135,0.34-0.203,0.511c-0.374,0.942-0.751,1.894-1.133,2.861c-0.007,0.018-0.014,0.036-0.021,0.053
                                                                      c-0.412,1.042-0.826,2.09-1.248,3.16l-7.377-3.134c-0.026-0.011-0.052-0.022-0.077-0.033l-17.662-7.503l42.245-31.574
                                                                      C312.982,314.23,312.782,314.7,312.58,315.18z M330.814,292.21c-0.001,0-0.003-0.001-0.004-0.001
                                                                      c-0.006-0.002-0.013-0.003-0.019-0.006c-4.35-1.305-8.99-1.089-13.157,0.498c-3.019-3.294-5.118-8.157-5.118-12.861v-21.835
                                                                      c22.469,3.312,39.908,20.297,44.232,42.029L330.814,292.21z M389.001,398.375c0,13.124-10.677,23.8-23.8,23.8
                                                                      s-23.8-10.676-23.8-23.8c0-13.124,10.677-23.8,23.8-23.8S389.001,385.251,389.001,398.375z" />
                                    </g>
                                </svg>
                            </div>
                            <h2 class="st-iconbox-title">Great Doctors</h2>
                            <div class="st-iconbox-text">Our diverse team of 120+ doctors,
                                including physicians and clinicians, share a common passion to
                                provide the highest quality of world-class care.
                            </div>
                        </div>
                        <div class="st-height-b0 st-height-lg-b30"></div>
                    </div><!-- .col -->
                    <div class="col-lg-4">
                        <div class="st-iconbox st-style1">

                            <div class="st-iconbox-icon st-red-box">
                                <svg enable-background="new 0 0 512 512" viewBox="0 0 512 512"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <g>
                                            <g>
                                                <path
                                                    d="m256 38.397c5.522 0 10-4.477 10-10v-18.397c0-5.523-4.478-10-10-10-5.523 0-10 4.477-10 10v18.397c0 5.523 4.477 10 10 10z" />
                                                <path
                                                    d="m342.609 62.764c1.556.88 3.246 1.298 4.915 1.298 3.486 0 6.874-1.827 8.713-5.079l9.655-17.069c2.719-4.807 1.026-10.908-3.78-13.628-4.806-2.718-10.909-1.027-13.628 3.781l-9.655 17.069c-2.719 4.807-1.026 10.908 3.78 13.628z" />
                                                <path
                                                    d="m409.789 128.753c1.634 0 3.292-.401 4.823-1.247l18.457-10.187c4.835-2.668 6.592-8.752 3.923-13.587-2.669-4.836-8.754-6.592-13.587-3.923l-18.457 10.187c-4.835 2.668-6.592 8.752-3.923 13.587 1.824 3.304 5.241 5.17 8.764 5.17z" />
                                                <path
                                                    d="m455.027 199.147h-19.524c-5.522 0-10 4.477-10 10s4.478 10 10 10h19.524c5.522 0 10-4.477 10-10s-4.477-10-10-10z" />
                                                <path
                                                    d="m155.763 58.983c1.84 3.252 5.227 5.079 8.713 5.079 1.668 0 3.359-.418 4.915-1.298 4.807-2.719 6.499-8.82 3.78-13.627l-9.655-17.069c-2.721-4.808-8.821-6.499-13.628-3.781-4.807 2.719-6.499 8.82-3.78 13.628z" />
                                                <path
                                                    d="m78.931 117.319 18.457 10.187c1.532.846 3.188 1.247 4.823 1.247 3.523 0 6.94-1.867 8.764-5.17 2.669-4.835.912-10.918-3.923-13.587l-18.457-10.187c-4.835-2.668-10.918-.913-13.587 3.923-2.669 4.835-.912 10.918 3.923 13.587z" />
                                                <path
                                                    d="m76.497 219.147c5.522 0 10-4.477 10-10s-4.478-10-10-10h-19.524c-5.522 0-10 4.477-10 10s4.478 10 10 10z" />
                                                <path
                                                    d="m448.091 446.815h-24.502v-61.428c0-5.523-4.478-10-10-10h-20.807v-171.08c0-75.405-61.347-136.752-136.813-136.752-75.405 0-136.752 61.347-136.752 136.752v171.081h-20.806c-5.522 0-10 4.477-10 10v61.428h-24.502c-5.522 0-10 4.477-10 10v45.184c0 5.523 4.478 10 10 10h384.182c5.523 0 10-4.477 10-10v-45.185c0-5.522-4.478-10-10-10zm-308.873-242.508c0-64.377 52.375-116.752 116.813-116.752 64.377 0 116.752 52.374 116.752 116.752v171.081h-86.683v-94.379c14.468-9.871 23.231-26.229 23.231-44.02 0-29.396-23.924-53.311-53.331-53.311s-53.331 23.915-53.331 53.311c0 17.79 8.764 34.148 23.232 44.02v94.379h-86.683zm101.326 62.204c-11.025-5.781-17.875-17.093-17.875-29.522 0-18.368 14.952-33.311 33.331-33.311s33.331 14.943 33.331 33.311c0 12.43-6.85 23.742-17.875 29.522-3.293 1.727-5.356 5.138-5.356 8.856v100.02h-20.2v-100.02c0-3.719-2.063-7.13-5.356-8.856zm197.547 225.489h-364.182v-25.185h136.885c5.523 0 10-4.477 10-10s-4.477-10-10-10h-102.383v-51.428h295.178v51.428h-102.383c-5.522 0-10 4.477-10 10s4.478 10 10 10h136.885z" />
                                                <path
                                                    d="m265.42 452.99c-1.61-3.865-5.581-6.387-9.771-6.16-4.161.225-7.816 3.098-9.029 7.08-1.212 3.978.243 8.471 3.606 10.938 3.284 2.409 7.764 2.601 11.23.458 4.105-2.538 5.822-7.856 3.964-12.316z" />
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                            <h2 class="st-iconbox-title">Multi-Specialty Care</h2>
                            <div class="st-iconbox-text">An ISO 9001-2000 certified, NABH
                                Accredited multi-specialty hospital offering a patient-centric
                                care to people of all age group, backed by the NABL Accredited
                                Laboratories.
                            </div>
                        </div>
                        <div class="st-height-b0 st-height-lg-b30"></div>
                    </div><!-- .col -->
                    <div class="col-lg-4">
                        <div class="st-iconbox st-style1">
                            <div class="st-iconbox-icon st-green-box">
                                <svg enable-background="new 0 0 511.988 511.988" viewBox="0 0 511.988 511.988"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <path
                                            d="m511.988 227.658c0-60.096-23.44-116.593-66.004-159.085-42.559-42.489-99.142-65.888-159.327-65.888-62.806 0-122.954 26.329-165.547 72.348-7.616-2.821-15.75-4.293-24.108-4.293-.001 0 .001 0 0 0-18.539 0-35.977 7.24-49.098 20.385-.274.275-.532.565-.772.87l-15.678 19.868c-14.987 18.993-25.114 41.58-29.285 65.318-4.207 23.943-2.269 48.627 5.605 71.384 5.707 16.494 12.887 29.151 21.342 37.622l193.83 194.143c6.704 6.717 16.109 12.686 27.956 17.74 17.668 7.539 36.431 11.233 55.167 11.232 31.195-.001 62.309-10.246 88.105-30.047l22.298-17.116c.348-.268.679-.558.989-.868 17.59-17.623 23.745-42.431 18.464-65.082 48.367-42.732 76.063-104.032 76.063-168.531zm-108.241 219.036-21.75 16.696c-35.571 27.305-82.795 33.545-123.246 16.285-9.479-4.044-16.763-8.578-21.65-13.474l-193.831-194.144c-6.301-6.313-11.885-16.418-16.596-30.032-13.829-39.97-6.173-83.997 20.48-117.773l15.301-19.391c9.295-9.111 21.541-14.121 34.546-14.121 13.19 0 25.599 5.155 34.941 14.514l32.021 32.081c18.41 18.444 18.41 48.454-.002 66.9l-35.863 35.951c-3.895 3.905-3.894 10.226.003 14.128l126.446 126.631c1.876 1.878 4.421 2.934 7.076 2.934h.003c2.656 0 5.202-1.058 7.077-2.938l35.86-35.948c8.919-8.936 20.767-13.857 33.36-13.857s24.44 4.921 33.36 13.857l32.021 32.081c19.135 19.17 19.282 50.268.443 69.62zm-15.287-112.803-3.021-3.026c-12.698-12.722-29.573-19.728-47.515-19.728-17.943 0-34.817 7.006-47.518 19.73l-28.786 28.857-112.313-112.479 28.812-28.883c25.359-25.407 26.159-66.243 2.401-92.624 27.711-28.735 66.034-45.095 106.137-45.095 81.209 0 147.276 65.95 147.276 147.014 0 40.189-16.496 78.547-45.473 106.234zm29.001 29.055-14.869-14.897c32.721-31.428 51.341-74.875 51.341-120.392 0-92.092-75.04-167.014-167.276-167.014-45.385 0-88.762 18.449-120.206 50.873l-20.353-20.391c-2.191-2.195-4.502-4.225-6.918-6.084 38.582-39.723 91.887-62.356 147.477-62.356 113.22 0 205.331 91.95 205.331 204.972 0 56.381-23.234 110.084-64.048 148.736-2.866-4.796-6.359-9.319-10.479-13.447z" />
                                        <path
                                            d="m355.669 228.279h-1.121c.121-21.045.184-43.537-.076-46.664-.586-7.056-4.823-12.807-10.796-14.65-5.923-1.828-12.211.471-16.822 6.152-4.979 6.136-27.961 47.742-34.886 60.347-1.702 3.098-1.642 6.864.158 9.907 1.8 3.042 5.072 4.908 8.606 4.908h33.681c-.041 5.609-.084 10.986-.125 15.844-.047 5.523 4.391 10.038 9.914 10.085.029.001.059.001.088.001 5.482 0 9.951-4.421 9.997-9.914.026-2.999.074-8.807.128-16.016h1.253c5.523 0 10-4.477 10-10 .001-5.523-4.477-10-9.999-10zm-21.125 0h-16.853c6.251-11.227 12.345-21.998 16.965-29.943-.004 8.206-.048 18.878-.112 29.943z" />
                                        <path
                                            d="m277.116 256.998c-8.794.111-18.124.184-25.861.199 4.857-6.523 11.614-15.793 20.75-28.902 5.593-8.025 9.24-15.609 10.84-22.541.375-1.584.688-4.6.689-5.647.018-17.91-14.528-32.48-32.385-32.48-15.444 0-28.809 11.02-31.779 26.204-1.06 5.42 2.474 10.673 7.895 11.733 5.419 1.059 10.673-2.475 11.733-7.895 1.138-5.819 6.248-10.042 12.151-10.042 6.649 0 12.09 5.307 12.373 11.938l-.272 2.136c-1.091 4.338-3.664 9.436-7.654 15.16-13.857 19.883-22.126 30.756-26.567 36.598-5.489 7.217-7.994 10.511-6.29 16.041 1.001 3.249 3.461 5.744 6.749 6.844 1.337.448 2.619.877 19.628.877 6.676 0 15.777-.066 28.251-.224 5.522-.069 9.943-4.603 9.873-10.125-.068-5.523-4.619-9.93-10.124-9.874z" />
                                    </g>
                                </svg>
                            </div>
                            <h2 class="st-iconbox-title">24/7 Support
                            </h2>
                            <div class="st-iconbox-text">Fully equipped to offer medical
                                assistance for all kinds of emergencies including pediatrics
                                (facilities for Children).
                                Backed by Ambulance with ventilator support.</div>
                        </div>
                        <div class="st-height-b0 st-height-lg-b30"></div>
                    </div><!-- .col -->
                </div>
            </div>
        </section>
        <!-- End Feature Seciton -->

        <!-- Start About Seciton -->
        <section class="st-about-wrap" id="about">
            <div class="st-shape-bg">
                <img src="{{ asset('public/assets/img/shape/about-bg-shape.svg') }}" alt="shape">
            </div>
            <div class="st-height-b120 st-height-lg-b50"></div>
            <div class="container">

                <div class="st-height-b40 st-height-lg-b40"></div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="st-vertical-middle">
                            <div class="st-vertical-middle-in">
                                <div class="st-text-block st-style1">
                                    <h2 class="st-text-block-title">Our Leader
                                        Dr. B.P. Singh</h2>
                                    <div class="st-height-b20 st-height-lg-b20"></div>
                                    <div class="st-text-block-text">
                                        <p>It is indeed a great privilege for me and my team to
                                            present Midland Healthcare & Research Center. With this
                                            center coming closer to more than a decade of service in
                                            the healthcare industry, it is quite satisfying to turn
                                            back the pages of history to see the thousands of
                                            smiling faces. Over these years, our main focus was
                                            always on delivering quality healthcare service with the
                                            utmost compassion and care.
                                        </p>
                                        <p>We are blessed with a highly qualified and dedicated
                                            team of Medical, Administrative and Support staff. The
                                            consultants in our various departments are among the
                                            cream of specialists in the entire region.
                                        </p>

                                        <p>With state-of-the-art technology and qualified and
                                            trained staff, we are able to offer world class services
                                            closer to home.
                                        </p>
                                    </div>
                                    <div class="st-height-b25 st-height-lg-b25"></div>
                                    <div class="st-text-block-avatar">
                                        <div class="st-avatar-img"><img
                                                src="{{ $hod->image ? $hod->image : asset('assets/img/avatar1.png') }}"
                                                alt="avatar">
                                        </div>
                                        <div class="st-avatar-info">
                                            <h4 class="st-avatar-name">
                                                {{ $hod->doctor_name }}</h4>
                                            <div class="st-avatar-designation">Founder &
                                                Director</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="st-height-b0 st-height-lg-b30"></div>
                    </div><!-- .col -->
                    <div class="col-lg-6 wow fadeInRight" data-wow-duration="0.8s" data-wow-delay="0.2s">
                        <div class="st-leader-img">
                            <img src="{{ asset('public/assets/img/abt_ldr.webp') }}" alt="Leader_img">
                        </div>
                        <!--<div class="st-shedule-wrap">
                                <div class="st-shedule">
                                <h2 class="st-shedule-title">Weekly Timetable</h2>
                                <ul class="st-shedule-list">
                                <li>
                                    <div class="st-shedule-left">Monday</div>
                                    <div class="st-shedule-right">8:00am–7:00pm </div>
                                </li>
                                <li>
                                    <div class="st-shedule-left">Tuesday</div>
                                    <div class="st-shedule-right">9:00am–6:00pm </div>
                                </li>
                                <li>
                                    <div class="st-shedule-left">Wednesday</div>
                                    <div class="st-shedule-right">9:00am–6:00pm </div>
                                </li>
                                <li>
                                    <div class="st-shedule-left">Thursday</div>
                                    <div class="st-shedule-right">8:00am–7:00pm</div>
                                </li>
                                <li>
                                    <div class="st-shedule-left">Friday</div>
                                    <div class="st-shedule-right">8:00am–7:00pm</div>
                                </li>
                                <li>
                                    <div class="st-shedule-left">Saturday</div>
                                    <div class="st-shedule-right">9:00am–5:00pm</div>
                                </li>
                                <li>
                                    <div class="st-shedule-left">Sunday</div>
                                    <div class="st-shedule-right">9:00am–3:00pm</div>
                                </li>
                                </ul>
                                <div class="st-height-b25 st-height-lg-b25"></div>
                                <div class="st-call st-style1">
                                <div class="st-call-icon">
                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                    x="0px" y="0px" viewBox="0 0 512 512"
                                    xml:space="preserve">
                                    <g>
                                        <path
                                        d="M492.557,400.56L392.234,300.238c-11.976-11.975-31.458-11.975-43.435,0l-26.088,26.088
                                    c-8.174,8.174-10.758,19.845-7.773,30.241l-9.843,9.843c-0.003,0.003-0.005,0.005-0.008,0.008
                                    c-6.99,6.998-50.523-3.741-103.145-56.363c-52.614-52.613-63.356-96.139-56.366-103.142c0-0.002,0.002-0.002,0.002-0.002
                                    l9.852-9.851c2.781,0.799,5.651,1.207,8.523,1.207c7.865,0,15.729-2.993,21.718-8.98l26.088-26.088
                                    c11.975-11.975,11.975-31.458,0-43.434L111.436,19.441c-5.8-5.8-13.513-8.994-21.716-8.994c-8.205,0-15.915,3.196-21.716,8.994
                                    l-26.09,26.09c-8.174,8.174-10.758,19.846-7.773,30.241c0,0-8.344,8.424-8.759,8.956c-27.753,30.849-32.96,79.418-14.561,137.487
                                    c18.017,56.857,56.857,117.088,109.367,169.595c52.508,52.508,112.739,91.348,169.596,109.367
                                    C312.624,508.414,333.991,512,353.394,512c31.813,0,58.337-9.648,77.35-28.66l5.474-5.474c2.74,0.788,5.602,1.213,8.532,1.213
                                    c8.205,0,15.917-3.196,21.716-8.994l26.09-26.09C504.531,432.02,504.531,412.536,492.557,400.56z M89.72,41.157l100.324,100.325
                                    l-26.074,26.102c0,0-0.005-0.005-0.014-0.014l-0.375-0.375l-49.787-49.787L63.631,67.247L89.72,41.157z M409.029,461.623
                                    c-0.002,0.002-0.003,0.003-0.005,0.005c-22.094,22.091-61.146,25.74-109.961,10.27c-52.252-16.558-108.065-52.714-157.156-101.806
                                    C92.814,321,56.658,265.189,40.101,212.936c-15.47-48.817-11.821-87.87,10.275-109.967l0.002-0.002l2.77-2.77l77.857,77.856
                                    l-7.141,7.141c-0.005,0.005-0.009,0.011-0.015,0.017c-29.585,29.622,5.963,96.147,56.378,146.562
                                    c37.734,37.734,84.493,67.14,118.051,67.14c11.284,0,21.076-3.325,28.528-10.778c0.003-0.003,0.005-0.005,0.008-0.008l7.133-7.133
                                    l77.857,77.856L409.029,461.623z M444.752,448.368L344.428,348.044l26.088-26.088L470.84,422.278
                                    C470.84,422.278,444.761,448.377,444.752,448.368z" />
                                    </g>
                                    <g>
                                        <path
                                        d="M388.818,123.184c-29.209-29.209-68.042-45.294-109.344-45.293c-8.481,0-15.356,6.875-15.356,15.356
                                    c0,8.481,6.876,15.356,15.356,15.356c33.1-0.002,64.219,12.89,87.628,36.297c23.406,23.406,36.295,54.525,36.294,87.624
                                    c0,8.481,6.875,15.358,15.356,15.358c8.48,0,15.356-6.875,15.356-15.354C434.109,191.224,418.023,152.393,388.818,123.184z" />
                                    </g>
                                    <g>
                                        <path
                                        d="M443.895,68.107C399.972,24.186,341.578-0.002,279.468,0c-8.481,0-15.356,6.876-15.356,15.356
                                    c0,8.481,6.876,15.356,15.356,15.356c53.907-0.002,104.588,20.992,142.709,59.111c38.118,38.118,59.111,88.799,59.11,142.706
                                    c0,8.481,6.875,15.356,15.356,15.356c8.48,0,15.356-6.875,15.356-15.354C512.001,170.419,487.813,112.027,443.895,68.107z" />
                                    </g>
                                    <g>
                                        <path
                                        d="M333.737,178.26c-14.706-14.706-33.465-22.477-54.256-22.477c0,0-0.005,0-0.006,0
                                    c-8.481,0.002-15.356,6.876-15.354,15.358c0.002,8.481,6.878,15.356,15.358,15.354c0.002,0,0.003,0,0.005,0
                                    c12.644,0,23.593,4.536,32.539,13.481c8.819,8.82,13.481,20.075,13.479,32.544c-0.002,8.481,6.875,15.356,15.354,15.358h0.002
                                    c8.481,0,15.354-6.875,15.356-15.354C356.215,211.732,348.444,192.968,333.737,178.26z" />
                                    </g>
                                    </svg>
                                </div>
                                <div class="st-call-text">
                                    <div class="st-call-title">Call Now</div>
                                    <div class="st-call-number">(+01) - 234 567 890</div>
                                </div>
                                </div>
                                </div>
                                </div> -->
                    </div><!-- .col -->
                </div>
            </div>
        </section>
        <!-- End About Seciton -->
        <section class="st-about-wrap abt_tpa_otr" id="about">
            <div class="st-shape-bg">
                <img src="assets/img/shape/about-bg-shape.svg" alt="shape">
            </div>
            <div class="st-height-b120 st-height-lg-b50"></div>
            <div class="container">
                <div class="st-section-heading st-style1">
                    <h2 class="st-section-heading-title">
                        OUR ACHIEVEMENTS
                    </h2>
                    <div class="st-seperator">
                        <div class="st-seperator-left wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s"></div>
                        <div class="st-seperator-center"><img src="{{ asset('public/assets/img/icons/4.png') }}"
                                alt="icon">
                        </div>
                        <div class="st-seperator-right wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.2s">
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <ul class="list-group achievement-list">
                            <li class="list-group-item border-0">Pioneer in Pulmonary Healthcare Initiatives Since Past 20
                                Years
                            </li>
                            <li class="list-group-item border-0">Pioneer in Sleep Medicine</li>
                            <li class="list-group-item border-0">First Pulmonary Rehabilitation Center in U.P.</li>
                            <li class="list-group-item border-0">One of the only Healthcare Center in the entire Asia to be
                                selected for involvement in prestigious international trials for lung diseases.</li>
                            <li class="list-group-item border-0">First Cryobiopsy Center in U.P. & the Only Private Unit
                                Offering the Facility</li>
                            <li class="list-group-item border-0">More than 5000+ Bronchoscopy Performed</li>
                            <li class="list-group-item border-0">Pioneer in Women Healthcare since past 40 years</li>
                            <li class="list-group-item border-0">The modern NICU has the least mortality rate compared to
                                any other
                                hospitals in the region
                            </li>
                            <li class="list-group-item border-0">More than 2000+ EBUS Performed</li>
                            <li class="list-group-item border-0">One of the few well-eqquipped centers to successfully
                                perform
                                Joint Replacement Surgery</li>
                            <li class="list-group-item border-0">Nodal Center in the region for Collaboration for
                                Lung Transplant Procedure</li>
                            <li class="list-group-item border-0">On forefront of treating critical COVID patients with
                                state-of-art
                                facilities like ECMO unit
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <!-- Start About Seciton -->
        <section class="st-about-wrap abt_tpa_otr" id="about">
            <div class="st-shape-bg">
                <img src="assets/img/shape/about-bg-shape.svg" alt="shape">
            </div>
            <div class="st-height-b120 st-height-lg-b50"></div>
            <div class="container">
                <div class="st-section-heading st-style1">
                    <h2 class="st-section-heading-title">
                        TPA & Corporate</h2>
                    <div class="st-seperator">
                        <div class="st-seperator-left wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s"></div>
                        <div class="st-seperator-center"><img src="{{ asset('public/assets/img/icons/4.png') }}"
                                alt="icon">
                        </div>
                        <div class="st-seperator-right wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.2s">
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="st-vertical-middle">
                            <div class="st-vertical-middle-in">
                                <div class="st-text-block st-style1">
                                    <div class="st-height-b20 st-height-lg-b20"></div>
                                    <div class="st-text-block-text">
                                        <p>Midland Healthcare & Research Center is recognized by
                                            all TPA and insurance companies for the government,
                                            semi-government as well as many private organizations
                                            providing services for their employees and their
                                            dependents.
                                        </p>
                                        <p>The hospital maintains a centralized database of the
                                            various health Insurance companies for the cashless
                                            settlement for the patients.
                                        </p>
                                        <p><span><b>Note:</b></span> The ID issued by the TPA to
                                            the individual
                                            insured is needed at the time of hospitalization.
                                            Treatment at the hospital is given as per the terms &
                                            conditions of the policy. For further queries regarding
                                            TPA or tax exemption, you may contact us.
                                        </p>
                                    </div>
                                    <div class="st-height-b25 st-height-lg-b25"></div>
                                    <h4>Exemption From Income-Tax</h4>
                                    <p>Midland Healthcare & Research Center is recognized by the
                                        Govt. of India, Ministry of Finance for income tax
                                        exemption facility. Under this, any sum paid by an
                                        employer directly to M/s Midland Healthcare and Research
                                        Center(P) Ltd for the purpose of medical treatment of the
                                        specified diseases or ailments mentioned in Rule 3A(2) of
                                        the Income Tax Rule 1962 on account of the treatment of an
                                        employee or any member of the family of the employee,
                                        shall not be treated as a prerequisite for the purposes of
                                        section 15,16, and 17 of the Income Tax Act, 1961 and such
                                        sum shall be exempt from Income Tax in the hands of the
                                        employee. The employer will not be liable to deduct tax
                                        under Section 192 in respect of such sum.

                                    </p>
                                    <div class="st-height-b25 st-height-lg-b25"></div>

                                    <h4>List of Empanelment</h4>
                                    <div class="st-height-b25 st-height-lg-b25"></div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="abt_tpa_list">
                                                <ul>
                                                    <li>Alankit Healthcare TPA Ltd.</li>
                                                    <li>Aditya Birla Health In. Co. LTD.</li>
                                                    <li>Asia Medical Assistance Pvt. Ltd.</li>
                                                    <li>Bayer CropScience Ltd.</li>
                                                    <li>CEGA Group Services Limited</li>
                                                    <li>Cholamandalam MS General Insurance Company
                                                        Ltd</li>
                                                    <li>Cigna TTK Health Insurance Co. Ltd.</li>
                                                    <li>Europ Assistance India Pvt. Ltd.</li>
                                                    <li>Family Health Plan TPA Ltd.</li>
                                                    <li>Focus TPA</li>
                                                    <li>Future Generali India In. Co. LTD.</li>
                                                    <li>HDFC Ergo General Insurance Co. Ltd.</li>
                                                    <li>Health India Insurance TPA Services Pvt.
                                                        Ltd.</li>
                                                    <li>Health Insurance TPA Of India Ltd.</li>
                                                    <li>Home Credit India Finance Pvt. Ltd.</li>
                                                    <li>HUDCO</li>
                                                    <li>Iffco Tokio General Insurance Co. Ltd.</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="abt_tpa_list">
                                                <ul>
                                                    <li>Indian Health Organisation Pvt. Ltd.</li>
                                                    <li>Med Health Cliniq</li>
                                                    <li>Medsave Health Insurance TPA Limited</li>
                                                    <li>Meera Rescue Services Pvt. Ltd.</li>
                                                    <li>NDTV CONVERGENCE LIMITED</li>
                                                    <li>Orient Refractories Limited</li>
                                                    <li>Park Mediclaim Insurance TPA Pvt. Ltd.</li>
                                                    <li>Raksha TPA</li>
                                                    <li>Religare Health Insurance Co. Ltd.</li>
                                                    <li>Rothshield TPA</li>
                                                    <li>Safeway TPA</li>
                                                    <li>TATA Motors Ltd.</li>
                                                    <li>United Healthcare Parekh Insurance TPA Pvt.
                                                        Ltd.</li>
                                                    <li>Universal Sompo General Insurance Co. Ltd.</li>
                                                    <li>Vidal Health 4 Sure</li>
                                                    <li>Vidal Health Insurance TPA Pvt. Ltd.</li>
                                                    <li>Vision E-Medi Solutions Insurance TPA Pvt.
                                                        Ltd.</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="st-height-b0 st-height-lg-b30"></div>
                    </div><!-- .col -->
                </div>
            </div>
        </section>
        <!-- End About Seciton -->

        <!-- Start Logo Carousel -->
        <div class="st-tpa-logo">
            <div class="st-height-b120 st-height-lg-b80"></div>
            <div class="container">
                <div class="st-slider st-style2 st-pricing-wrap">
                    <div class="slick-container" data-autoplay="0" data-loop="1" data-speed="600" data-center="0"
                        data-slides-per-view="responsive" data-xs-slides="1" data-sm-slides="2" data-md-slides="3"
                        data-lg-slides="4" data-add-slides="5">
                        <div class="slick-wrapper">
                            <div class="slick-slide-in">
                                <div class="st-logo-carousel st-style1">
                                    <img src="{{ asset('public/assets/img/tpa1.webp') }}" alt="client1">
                                </div>
                            </div><!-- .slick-slide-in -->
                            <div class="slick-slide-in">
                                <div class="st-logo-carousel st-style1">
                                    <img src="{{ asset('public/assets/img/tpa2.webp') }}" alt="client2">
                                </div>
                            </div><!-- .slick-slide-in -->
                            <div class="slick-slide-in">
                                <div class="st-logo-carousel st-style1">
                                    <img src="{{ asset('public/assets/img/tpa3.webp') }}" alt="client3">
                                </div>
                            </div><!-- .slick-slide-in -->
                            <div class="slick-slide-in">
                                <div class="st-logo-carousel st-style1">
                                    <img src="{{ asset('public/assets/img/tpa4.webp') }}" alt="client4">
                                </div>
                            </div><!-- .slick-slide-in -->
                            <div class="slick-slide-in">
                                <div class="st-logo-carousel st-style1">
                                    <img src="{{ asset('public/assets/img/tpa5.webp') }}" alt="client5">
                                </div>
                            </div><!-- .slick-slide-in -->
                            <div class="slick-slide-in">
                                <div class="st-logo-carousel st-style1">
                                    <img src="{{ asset('public/assets/img/tpa6.webp') }}" alt="client5">
                                </div>
                            </div><!-- .slick-slide-in -->
                        </div>
                    </div><!-- .slick-container -->
                    <div class="pagination st-style1 st-flex st-hidden"></div>
                    <!-- If dont need Pagination then add class .st-hidden -->
                    <div class="swipe-arrow st-style1">
                        <!-- If dont need navigation then add class .st-hidden -->
                        <div class="slick-arrow-left"><i class="fa fa-chevron-left"></i></div>
                        <div class="slick-arrow-right"><i class="fa fa-chevron-right"></i></div>
                    </div>
                </div><!-- .st-slider -->
            </div>
            <div class="st-height-b120 st-height-lg-b80"></div>
        </div>
        <!-- End Logo Carousel -->

        <div class="st-height-b100 st-height-lg-b80"></div>
    </div>
@endsection
