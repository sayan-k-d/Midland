@extends('frontend.layouts.main')
@section('title', 'Department Page')
@section('content')

    <div class="st-content">
        <div class="st-page-heading st-dynamic-bg" style="background-size: auto;"
            data-src="{{ $department->innerImage ?? asset('public/assets/img/hero-bg17.jpg') }}">
            <div class="container">
                <div class="st-page-heading-in text-center">
                    <h1 class="st-page-heading-title">{{ $department->department_name }}</h1>
                </div>
            </div>
        </div><!-- .st-page-heading -->
        <div class="st-height-b100 st-height-lg-b80"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-md-1">
                    <div class="st-post-details st-style1">

                        <img class="st-zoom-in" src="{{ $department->image ?? asset('public/assets/img/department.jpg') }}" alt="blog1">
                        <h2>{{ $department->department_name }}</h2>
                        <div class="st-post-info">
                            <div class="st-post-text">
                                <p>{{ $department->long_details }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="st-height-b60 st-height-lg-b60"></div>
                    <div class="comments-area doctor_list_area">
                        <div class="comment-list-outer">
                            <h2 class="comments-title">{{ $department->department_name }}</h2>

                            <ol class="comment-list">
                                @foreach ($doctors as $doctor)
                                    @if ($doctor->department === $department->id)
                                        <li class="comment">
                                            <div class="comment-body">
                                                <div class="comment-meta">
                                                    <div class="comment-author">
                                                        <img src="{{ $doctor->image ?? asset('public/assets/img/doctor.jpg') }}" alt="{{ $doctor->name }}"
                                                            class="avatar">
                                                        <a href="#" class="nm">{{ $doctor->doctor_name }}</a>
                                                    </div><!-- .comment-author -->
                                                </div><!-- .comment-meta -->
                                                <div class="comment-content">
                                                    <p>{{ $department->department_name }}</p>
                                                </div>
                                                <div class="reply">
                                                    <a href="{{ route('doctor-profile', ['id' => $doctor->id]) }}"
                                                        class="comment-reply-link">View Profile</a>
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                @endforeach
                            </ol>

                        </div>
                        <div class="st-height-b60 st-height-lg-b60"></div>

                        <!-- .appointment-form -->
                        <div class="container">
                            <div class="st-section-heading st-style1">
                                <h2 class="st-section-heading-title">Make an appointment</h2>
                                <div class="st-seperator">
                                    <div class="st-seperator-left wow fadeInLeft" data-wow-duration="1s"
                                        data-wow-delay="0.2s"></div>
                                    <div class="st-seperator-center"><img
                                            src="{{ asset('public/assets/img/icons/4.png') }}" alt="icon"></div>
                                    <div class="st-seperator-right wow fadeInRight" data-wow-duration="1s"
                                        data-wow-delay="0.2s"></div>
                                </div>
                                {{-- <div class="st-section-heading-subtitle">Lorem Ipsum is simply
                                    dummy
                                    text of the printing and typesetting
                                    industry. <br>Lorem Ipsum the industry's standard dummy
                                    text.</div> --}}
                            </div>
                            <div class="st-height-b40 st-height-lg-b40"></div>
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-10 offset-lg-1">
                                    @include('frontend.layouts.appointments')
                                </div>
                            </div>
                        </div>
                        <!-- .appointment-form -->

                    </div>
                </div>
            </div>
        </div>
        <div class="st-height-b100 st-height-lg-b80"></div>
    </div>

@endsection
