@extends('frontend.layouts.main')
@section('title', 'Department Page')
@section('content')

    <div class="st-content">
      <div class="st-page-heading st-dynamic-bg"
        data-src="assets/img/hero-bg17.jpg">
        <div class="container">
          <div class="st-page-heading-in text-center">
            <h1 class="st-page-heading-title">Anesthesia and Pain
              Management</h1>
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

              <img class="st-zoom-in"
                src="https://midlandhealthcare.org/wp-content/uploads/2021/06/Anesthesia-and-Pain-Management.jpg"
                alt="blog1">
              <h2>Anesthesia and Pain Management </h2>
              <div class="st-post-info">
                <div class="st-post-text">
                  <p>Our Department of Anesthesiology and Critical Care Medicine
                    provides 24-hour coverage of facilities to improve outcomes
                    of any surgical procedure, including general surgeries,
                    respiratory issues, cardiac arrest, pain management,
                    pediatric, orthopedics, obstetric coverage, intensive care
                    medicine, and critical emergency medicine.
                  </p>
                  <p>Our team of experts Anesthesiologists in Lucknow focuses on
                    optimal patient safety and satisfaction. Physician
                    anesthesiologists specialize in anesthesia care, pain
                    management, and critical care medicine. We have the latest
                    equipment in anesthesia care, which give us the ability to
                    provide timely and efficient care at our health center. We
                    and our best anesthesiologist doctors in Lucknow are
                    engineered in ways to focus on the individual needs of the
                    patient.
                  </p>

                </div>
              </div>
            </div>
            <div class="st-height-b60 st-height-lg-b60"></div>
            <div class="comments-area doctor_list_area">
              <div class="comment-list-outer">
                <h2 class="comments-title">Anaesthesia And Pain Management
                  Doctors</h2>
                <ol class="comment-list">
                  <li class="comment">
                    <div class="comment-body">
                      <div class="comment-meta">
                        <div class="comment-author">
                          <img
                            src="https://midlandhealthcare.org/wp-content/uploads/2019/01/Dr-Kapil-Rastogi-e1552640562274.jpg"
                            alt="comment1"
                            class="avatar">
                          <a href="/doctor-profile.html" class="nm">Dr. Kapil
                            Rastogi</a>
                        </div><!-- .comment-author -->
                      </div><!-- .comment-meta -->
                      <div class="comment-content">
                        <p>Department of Anesthesiology and Pain Medicine</p>
                      </div>
                      <div class="reply"><a href="/doctor-profile.html"
                          class="comment-reply-link">View Profile</a></div>
                    </div>
                  </li>
                  <li class="comment">
                    <div class="comment-body">
                      <div class="comment-meta">
                        <div class="comment-author">
                          <img
                            src="https://midlandhealthcare.org/wp-content/uploads/2019/01/Dr-Kapil-Rastogi-e1552640562274.jpg"
                            alt="comment1"
                            class="avatar">
                          <a href="/doctor-profile.html" class="nm">Dr. Kapil
                            Rastogi</a>
                        </div><!-- .comment-author -->
                      </div><!-- .comment-meta -->
                      <div class="comment-content">
                        <p>Department of Anesthesiology and Pain Medicine</p>
                      </div>
                      <div class="reply"><a href="/doctor-profile.html"
                          class="comment-reply-link">View Profile</a></div>
                    </div>
                  </li>
                  <li class="comment">
                    <div class="comment-body">
                      <div class="comment-meta">
                        <div class="comment-author">
                          <img
                            src="https://midlandhealthcare.org/wp-content/uploads/2019/01/Dr-Kapil-Rastogi-e1552640562274.jpg"
                            alt="comment1"
                            class="avatar">
                          <a href="/doctor-profile.html" class="nm">Dr. Kapil
                            Rastogi</a>
                        </div><!-- .comment-author -->
                      </div><!-- .comment-meta -->
                      <div class="comment-content">
                        <p>Department of Anesthesiology and Pain Medicine</p>
                      </div>
                      <div class="reply"><a href="/doctor-profile.html"
                          class="comment-reply-link">View Profile</a></div>
                    </div>
                  </li>
                </ol><!-- .comment-list -->
              </div>
              <div class="st-height-b60 st-height-lg-b60"></div>

              <!-- .appointment-form -->
              <div class="container">
                <div class="st-section-heading st-style1">
                  <h2 class="st-section-heading-title">Make an appointment</h2>
                  <div class="st-seperator">
                    <div class="st-seperator-left wow fadeInLeft"
                      data-wow-duration="1s" data-wow-delay="0.2s"></div>
                    <div class="st-seperator-center"><img
                        src="assets/img/icons/4.png"
                        alt="icon"></div>
                    <div class="st-seperator-right wow fadeInRight"
                      data-wow-duration="1s" data-wow-delay="0.2s"></div>
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
                    <form method="POST"
                      action="https://html.laralink.com/nischinto/nischinto/assets/php/appointment.php"
                      class="st-appointment-form" id="appointment-form">
                      <div id="st-alert1"></div>
                      <div class="row">
                        <div class="col-lg-6">
                          <div class="st-form-field st-style1">
                            <label>Full Name</label>
                            <input type="text" id="uname" name="uname"
                              placeholder="Jhon Doe" required>
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
                            <input type="text" id="unumber" name="unumber"
                              placeholder="+00 141 23 234" required>
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="st-form-field st-style1">
                            <label>Booking Date</label>
                            <input name="udate" type="text" id="udate"
                              placeholder="dd/mm/yy">
                            <div class="form-field-icon"><i
                                class="fa fa-calendar"></i></div>
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="st-form-field st-style1">
                            <label>Department</label>
                            <div class="st-custom-select-wrap">
                              <select name="udepartment" id="udepartment"
                                class="st_select1"
                                data-placeholder="Select department">
                                <option></option>
                                <option value="dental-care">Dental Care</option>
                                <option value="neurology">Neurology</option>
                                <option value="crutches">Crutches</option>
                                <option value="cardiology">Cardiology</option>
                                <option value="pulmonary">Pulmonary</option>
                                <option value="x-ray">X-Ray</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="st-form-field st-style1">
                            <label>Doctor</label>
                            <div class="st-custom-select-wrap">
                              <select name="udoctor" class="st_select1"
                                id="udoctor"
                                data-placeholder="Select doctor">
                                <option></option>
                                <option value="jhon-doe">Dr. Jhon Doe</option>
                                <option value="mak-rushi">Dr. Mak Roshi</option>
                                <option value="mohoshin-kabir">Dr. Mohoshin
                                  Kabir</option>
                                <option value="nayon-borua">Dr. Nayon
                                  Borua</option>
                                <option value="rasel-islam">Dr. Rasel
                                  Islam</option>
                                <option value="mahid-islam">Dr. Mahid
                                  Islam</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <div class="st-form-field st-style1">
                            <label>Message</label>
                            <textarea cols="30" rows="10" id="umsg" name="umsg"
                              placeholder="Write something here..."></textarea>
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <button
                            class="st-btn st-style1 st-color1 st-size-medium"
                            type="submit" id="appointment-submit"
                            name="submit">Appointment</button>
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