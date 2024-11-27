@extends('frontend.layouts.main')
@section('title', 'Apointment Page')
@section('content')

    <div class="st-content">

      <div class="st-hero-wrap st-color1 st-bg st-dynamic-bg overflow-hidden"
      data-src="{{ asset('assets/img/hero-bg11.jpg') }}">
      <div class="container">
        <div class="st-hero st-style1 st-type1">
          <div class="container">
            <div class="st-hero-text">
              <h1 class="st-hero-title">Always Laugh <br>When you Can.</h1>
              <!-- <h1 class="st-hero-title">Wellness Builds <br>Upon the Medical.</h1> -->
              <!-- <h1 class="st-hero-title">Way to get happy. <br>Best promises.</h1> -->
              <div class="st-hero-subtitle">Lorem ipsum dolor sit amet,
                consectetur mag. <br>
                Tempor incididunt ut labore et dolore elit.</div>
              <div class="st-hero-btn">
                <a href="/frontend/departments"
                  class="st-btn st-style1 st-color3 st-smooth-move">Departments</a>
              </div>
            </div>
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
                                  {{-- <option value="mak-rushi">Dr. Mak Roshi</option>
            <option value="mohoshin-kabir">Dr. Mohoshin
              Kabir</option>
            <option value="nayon-borua">Dr. Nayon Borua</option>
            <option value="rasel-islam">Dr. Rasel Islam</option>
            <option value="mahid-islam">Dr. Mahid Islam</option> --}}
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
    </div>

      

      <!-- Start FAQ Section -->
      <section class="st-faq-wrap st-shape-wrap apmt_faq_otr">
        <div class="st-shape5">
          <img src="{{ asset('assets/img/shape/faq-bg.svg')}}" alt="shape1">
        </div>
        <div class="st-height-b120 st-height-lg-b80"></div>
        <div class="container">
          <div class="row">
            <div class="col-lg-6">
              <div class="st-vertical-middle">
                <div class="st-vertical-middle-in">
                  <div class="st-faq-img">
                    <img src="{{ asset('assets/img/faq-img.png')}}" alt="Faq Image">
                  </div>
                </div>
              </div>
              <div class="st-height-b0 st-height-lg-b30"></div>
            </div>
            <div class="col-lg-6">
              <h2 class="st-accordian-heading">Just Answer the Questions</h2>
              <div class="st-accordian-wrap">
                <div class="st-accordian active ">
                  <div class="st-accordian-title">
                    Why Midland Healthcare?
                    <span class="st-accordian-toggle fa fa-angle-down"></span>
                  </div>
                  <div class="st-accordian-body" style="display: block;">
                    <ul class="st-accordian-list">
                      <li class="st-accordian-items">Economic for one and
                        all</li>
                      <li class="st-accordian-items">Well connected to major
                        places of the city
                      </li>
                      <li class="st-accordian-items">Patient-friendly staff
                      </li>
                      <li class="st-accordian-items">Highest standards and
                        quality healthcare
                      </li>
                      <li class="st-accordian-items">NABH Accredited with NABL
                        certified labs
                      </li>
                    </ul>
                  </div>
                </div><!-- .st-accordian -->
                <div class="st-accordian">
                  <div class="st-accordian-title">
                    What are the facilities available in the hospital?
                    <span class="st-accordian-toggle fa fa-angle-down"></span>
                  </div>
                  <div class="st-accordian-body" style="display: none;">
                    Midland Healthcare is NABH accredited, multispecialty
                    hospital and offer the complete range of medical and
                    surgical specialties under one roof, with highly experienced
                    doctors, state-of-the-art infrastructure and diagnostic
                    services.
                  </div>
                </div><!-- .st-accordian -->
                <div class="st-accordian">
                  <div class="st-accordian-title">
                    What are the regular appointment hours?
                    <span class="st-accordian-toggle fa fa-angle-down"></span>
                  </div>
                  <div class="st-accordian-body" style="display: none;">The
                    appointment hours vary from one doctor to another. Please
                    call <a href="tel:0522-4042888">0522-4042888</a> for more
                    details.
                  </div>
                </div><!-- .st-accordian -->
                <div class="st-accordian">
                  <div class="st-accordian-title">
                    Can I get an online appointment with Dr B. P. Singh?
                    <span class="st-accordian-toggle fa fa-angle-down"></span>
                  </div>
                  <div class="st-accordian-body" style="display: none;">To book
                    an appointment with Dr B. P. Singh, please <br> call <a
                      href="tel:0522-4042888"> 0522-4042888</a>
                    . Please note that it might take up to a month
                    to get an appointment with Dr B. P. Singh. This is due to
                    the high number of patients we recieve every day for the
                    consultation.
                  </div>
                </div><!-- .st-accordian -->
                <div class="st-accordian">
                  <div class="st-accordian-title">
                    What to do in case of an emergency?
                    <span class="st-accordian-toggle fa fa-angle-down"></span>
                  </div>
                  <div class="st-accordian-body" style="display: none;">We have
                    doctors in the positions of medical and surgical registrars,
                    junior and senior registrars, and junior and senior
                    residents, thus offering 24 hours coverage in areas such as
                    Casualty, Wards, Intensive Care Units and Post Op recovery
                    areas. Any complaints in the odd hours are first attended to
                    by the resident doctors, and, depending upon the case, the
                    respective consultants are called in to attend to the
                    patients.

                  </div>
                </div>
                <div class="st-accordian">
                  <div class="st-accordian-title">
                    Is my Mediclaim policy accepted at your hospital?
                    <span class="st-accordian-toggle fa fa-angle-down"></span>
                  </div>
                  <div class="st-accordian-body" style="display: none;">Yes, if
                    your TPA is on the panel of our hospital.

                  </div>
                </div>
                <div class="st-accordian">
                  <div class="st-accordian-title">
                    Do you have an ambulance service?
                    <span class="st-accordian-toggle fa fa-angle-down"></span>
                  </div>
                  <div class="st-accordian-body" style="display: none;">Yes, we
                    have an ambulance service round-the-clock.

                  </div>
                </div>
                <div class="st-accordian">
                  <div class="st-accordian-title">
                    What are the modes of payment available ?
                    <span class="st-accordian-toggle fa fa-angle-down"></span>
                  </div>
                  <div class="st-accordian-body" style="display: none;">We
                    accept cash and all major credit cards like VISA, MASTER
                    CARD, and AMEX.

                  </div>
                </div>
              </div><!-- .st-accordian-wrap -->
            </div>
          </div>
        </div>
        <div class="st-height-b120 st-height-lg-b80"></div>
      </section>
      <!-- End FAQ Section -->

      <!-- Start Contact Section -->
      <section class="st-shape-wrap" id="contact">
        <div class="st-shape1"><img src="{{ asset('assets/img/shape/contact-shape1.svg')}}"
            alt="shape1"></div>
        <div class="st-shape2"><img src="{{ asset('assets/img/shape/contact-shape2.svg')}}"
            alt="shape2"></div>
        <div class="st-height-b120 st-height-lg-b80"></div>
        <div class="container">
          <div class="st-section-heading st-style1">
            <h2 class="st-section-heading-title">Stay connect with us</h2>
            <div class="st-seperator">
              <div class="st-seperator-left wow fadeInLeft"
                data-wow-duration="1s" data-wow-delay="0.2s"></div>
              <div class="st-seperator-center"><img src="{{asset('assets/img/icons/4.png')}}"
                  alt="icon"></div>
              <div class="st-seperator-right wow fadeInRight"
                data-wow-duration="1s" data-wow-delay="0.2s"></div>
            </div>
            <div class="st-section-heading-subtitle">Lorem Ipsum is simply dummy
              text of the printing and typesetting industry. <br>Lorem Ipsum the
              industry's standard dummy text.</div>
          </div>
          <div class="st-height-b40 st-height-lg-b40"></div>
        </div>
        <div class="container">
          <div class="row">
            <div class="col-lg-10 offset-lg-1">
              <div id="st-alert"></div>
              <form action="{{ route('contact.store') }}" method="POST" class="row st-contact-form st-type1">
                {{-- <form action="{{ route('contact.store') }}" method="POST" class="row st-contact-form st-type1" id="contact-form"> --}}
                @csrf
                <div class="col-lg-6">
                    <div class="st-form-field st-style1">
                        <label>Full Name</label>
                        <input type="text" id="name" name="name" placeholder="John Doe" required>
                    </div>
                </div><!-- .col -->
                <div class="col-lg-6">
                    <div class="st-form-field st-style1">
                        <label>Email Address</label>
                        <input type="email" id="email" name="email" placeholder="example@gmail.com"
                            required>
                    </div>
                </div><!-- .col -->
                <div class="col-lg-6">
                    <div class="st-form-field st-style1">
                        <label>Subject</label>
                        <input type="text" id="subject" name="subject" placeholder="Write subject"
                            required>
                    </div>
                </div><!-- .col -->
                <div class="col-lg-6">
                    <div class="st-form-field st-style1">
                        <label>Phone</label>
                        <input type="text" id="phone" name="phone" placeholder="+00 376 12 465"
                            required>
                    </div>
                </div><!-- .col -->
                <div class="col-lg-12">
                    <div class="st-form-field st-style1">
                        <label>Your Message</label>
                        <textarea cols="30" rows="10" id="msg" name="msg" placeholder="Write something here..." required></textarea>
                    </div>
                </div><!-- .col -->
                <div class="col-lg-12">
                    <div class="text-center">
                        <div class="st-height-b10 st-height-lg-b10"></div>
                        <button class="st-btn st-style1 st-color1 st-size-medium" type="submit"
                            id="submit" name="submit">Send message</button>
                    </div>
                </div><!-- .col -->
            </form>
            </div><!-- .col -->
          </div>
        </div>
        <div class="st-height-b120 st-height-lg-b80"></div>
      </section>
      <!-- End Contact Section -->

      <div class="st-google-map">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d96652.27317354927!2d-74.33557928194516!3d40.79756494697628!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c3a82f1352d0dd%3A0x81d4f72c4435aab5!2sTroy+Meadows+Wetlands!5e0!3m2!1sen!2sbd!4v1563075599994!5m2!1sen!2sbd"
          allowfullscreen></iframe>
      </div>
    </div>
 @endsection