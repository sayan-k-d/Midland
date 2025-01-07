@extends('frontend.layouts.main')
@section('title', 'Service Page')
@section('content')

    <div class="st-content">
        <div class="st-page-heading st-dynamic-bg" style="background-size: auto;"
            data-src="{{ $service->innerImage ?? asset('public/assets/img/hero-bg17.jpg') }}">
            <div class="container">
                <div class="st-page-heading-in text-center">
                    <h1 class="st-page-heading-title">{{ $service->service_name }}</h1>
                </div>
            </div>
        </div><!-- .st-page-heading --><!-- .st-page-heading -->
        <div class="st-height-b100 st-height-lg-b80"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-md-1">
                    <div class="st-post-details st-style1">

                        <img class="st-zoom-in" src="{{ $service->image ?? asset('public/assets/img/service.jpg') }}" alt="blog1">
                        <h2>{{ $service->service_name }}</h2>
                        <div class="st-post-info">
                            <div class="st-post-text">
                                <p>{{ $service->long_details }}
                                </p>

                                <p>Call us on <a href="tel: +91-9196444444" class="blue_text">+91-9196444444</a> now!</p>
                            </div>
                        </div>
                    </div>
                    <div class="st-height-b60 st-height-lg-b60"></div>
                    <div class="comments-area doctor_list_area">

                        <div class="st-height-b60 st-height-lg-b60"></div>

                        <!-- .Contact-form -->
                        <div class="container">
                            <div class="st-section-heading st-style1">
                                <h2 class="st-section-heading-title">Stay connect with us</h2>
                                <div class="st-seperator">
                                    <div class="st-seperator-left wow fadeInLeft" data-wow-duration="1s"
                                        data-wow-delay="0.2s"
                                        style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInLeft;">
                                    </div>
                                    <div class="st-seperator-center"><img src="{{ asset('public/assets/img/icons/4.png') }}"
                                            alt="icon"></div>
                                    <div class="st-seperator-right wow fadeInRight" data-wow-duration="1s"
                                        data-wow-delay="0.2s"
                                        style="visibility: visible; animation-duration: 1s; animation-delay: 0.2s; animation-name: fadeInRight;">
                                    </div>
                                </div>
                                {{-- <div class="st-section-heading-subtitle">Lorem Ipsum is simply dummy
                                    text of the printing and typesetting
                                    industry. <br>Lorem Ipsum the industry's standard dummy
                                    text.</div> --}}
                            </div>
                            <div class="st-height-b40 st-height-lg-b40"></div>
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-10 offset-lg-1">
                                    <div id="st-alert" style="display: none;"></div>
                                    @include('frontend.layouts.contactUs')
                                </div><!-- .col -->
                            </div>
                        </div>
                        <!-- .Contact-form -->

                    </div>
                </div>
            </div>
        </div>
        <div class="st-height-b100 st-height-lg-b80"></div>
    </div>
    <!-- Start Video Popup -->
    <div class="st-video-popup">
        <div class="st-video-popup-overlay"></div>
        <div class="st-video-popup-content">
            <div class="st-video-popup-layer"></div>
            <div class="st-video-popup-container">
                <div class="st-video-popup-align">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="about:blank"></iframe>
                    </div>
                </div>
                <div class="st-video-popup-close"></div>
            </div>
        </div>
    </div>
    <!-- End Video Popup -->

    <!-- Scripts -->
    <script src="public/assets/js/vendor/modernizr-3.5.0.min.js"></script>
    <script src="public/assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="public/assets/js/isotope.pkg.min.js"></script>
    <script src="public/assets/js/jquery.slick.min.js"></script>
    <script src="public/assets/js/mailchimp.min.js"></script>
    <script src="public/assets/js/counter.min.js"></script>
    <script src="public/assets/js/lightgallery.min.js"></script>
    <script src="public/assets/js/ripples.min.js"></script>
    <script src="public/assets/js/wow.min.js"></script>
    <script src="public/assets/js/select2.min.js"></script>
    <script src="public/assets/js/main.js"></script>
@endsection
