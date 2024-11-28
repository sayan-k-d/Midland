@extends('frontend.layouts.main')
@section('title', 'Department Page')
@section('content')

    <div class="st-content">
        <div class="st-page-heading st-dynamic-bg" data-src="{{ asset('assets/img/hero-bg17.jpg') }}">
            <div class="container">
                <div class="st-page-heading-in text-center">
                    <h1 class="st-page-heading-title">{{ $department->department_name }}</h1>
                    <!-- <div class="st-post-label">
                                    <span>By <a href="#">Mary Neo</a></span>
                                    <span>Mar 15, 2020</span>
                                  </div> -->
                </div>
            </div>
        </div><!-- .st-page-heading -->
        <div class="st-height-b100 st-height-lg-b80"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-md-1">
                    <div class="st-post-details st-style1">

                        <img class="st-zoom-in" src="{{ $department->image }}" alt="blog1">
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
                                @foreach($doctors as $doctor)
                                    @if($doctor->department === $department->id)
                                        <li class="comment">
                                            <div class="comment-body">
                                                <div class="comment-meta">
                                                    <div class="comment-author">
                                                        <img src="{{ $doctor->image }}" alt="{{ $doctor->name }}" class="avatar">
                                                        <a href="#" class="nm">{{ $doctor->doctor_name }}</a>
                                                    </div><!-- .comment-author -->
                                                </div><!-- .comment-meta -->
                                                <div class="comment-content">
                                                    <p>{{ $department->department_name }}</p>
                                                </div>
                                                <div class="reply">
                                                    <a href="{{ route('doctor-profile', ['id' => $doctor->id]) }}" class="comment-reply-link">View Profile</a>
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
                                    <div class="st-seperator-center"><img src="{{ asset('assets/img/icons/4.png') }}"
                                            alt="icon"></div>
                                    <div class="st-seperator-right wow fadeInRight" data-wow-duration="1s"
                                        data-wow-delay="0.2s"></div>
                                </div>
                                <div class="st-section-heading-subtitle">Lorem Ipsum is simply
                                    dummy
                                    text of the printing and typesetting
                                    industry. <br>Lorem Ipsum the industry's standard dummy
                                    text.</div>
                            </div>
                            <div class="st-height-b40 st-height-lg-b40"></div>
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-10 offset-lg-1">
                                    <form method="POST" action="{{ route('appointment.store') }}" class="st-appointment-form">
                                        @csrf
                                        <div id="st-alert1"></div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="st-form-field st-style1">
                                                    <label>Full Name</label>
                                                    <input type="text" id="uname" name="uname" placeholder="Jhon Doe"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="st-form-field st-style1">
                                                    <label>Email Address</label>
                                                    <input type="text" id="uemail" name="uemail"
                                                        placeholder="example@gmail.com" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="st-form-field st-style1">
                                                    <label>Phone Number</label>
                                                    <input type="text" id="unumber" name="unumber" placeholder="+00 141 23 234"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="st-form-field st-style1">
                                                    <label>Booking Date</label>
                                                    <input name="udate" type="text" id="udate" placeholder="dd/mm/yy">
                                                    <div class="form-field-icon"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="st-form-field st-style1">
                                                    <label>Department</label>
                                                    <div class="st-custom-select-wrap">
                                                        <select name="udepartment" id="udepartment" class="st_select1"
                                                            data-placeholder="Select department">
                                                            <option></option>
                                                            @foreach ($departments as $department)
                                                                <option value="{{ $department->department_name }}">
                                                                    {{ $department->department_name }}
                                                                </option>
                                                            @endforeach
                                                            {{-- <option value="dental-care">Dental Care</option>
                                                            <option value="neurology">Neurology</option>
                                                            <option value="crutches">Crutches</option>
                                                            <option value="cardiology">Cardiology</option>
                                                            <option value="pulmonary">Pulmonary</option>
                                                            <option value="x-ray">X-Ray</option> --}}
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="st-form-field st-style1">
                                                    <label>Doctor</label>
                                                    <div class="st-custom-select-wrap">
                                                        <select name="udoctor" class="st_select1" id="udoctor"
                                                            data-placeholder="Select doctor">
                                                            <option></option>
                                                            @foreach ($doctors as $doctor)
                                                                <option value="{{ $doctor->doctor_name }}">{{ $doctor->doctor_name }}
                                                                </option>
                                                            @endforeach
                                                            
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="st-form-field st-style1">
                                                    <label>Message</label>
                                                    <textarea cols="30" rows="10" id="umsg" name="umsg" placeholder="Write something here..."></textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <button class="st-btn st-style1 st-color1 st-size-medium" type="submit"
                                                    id="appointment-submit" name="submit">Appointment</button>
                                            </div>
                                        </div>
                                    </form>
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
