@extends('frontend.layouts.main')
@section('title', 'Doctors Page')
@section('content')
    <div class="st-content">
        <!-- Start Doctors Profile -->
        <div class="st-page-heading st-dynamic-bg" style="background-size: auto;"
            data-src="{{ $doctor->innerImage ?? asset('public/assets/img/hero-bg6.jpg') }}">
            <div class="container">
                <div class="st-page-heading-in text-center">
                    <h1 class="st-page-heading-title">Doctors Profile</h1>
                </div>
            </div>
        </div>
        <div class="st-perloader">
            <div class="st-perloader-in">
                <div class="st-wave-first">
                    <svg enable-background="new 0 0 300.08 300.08" viewBox="0 0 300.08 300.08"
                        xmlns="http://www.w3.org/2000/svg">
                        <g>
                            <path
                                d="m293.26 184.14h-82.877l-12.692-76.138c-.546-3.287-3.396-5.701-6.718-5.701-.034 0-.061 0-.089 0-3.369.027-6.199 2.523-6.677 5.845l-12.507 87.602-14.874-148.69c-.355-3.43-3.205-6.056-6.643-6.138-.048 0-.096 0-.143 0-3.39 0-6.274 2.489-6.752 5.852l-19.621 137.368h-9.405l-12.221-42.782c-.866-3.028-3.812-5.149-6.8-4.944-3.13.109-5.777 2.332-6.431 5.395l-8.941 42.332h-73.049c-3.771 0-6.82 3.049-6.82 6.82 0 3.778 3.049 6.82 6.82 6.82h78.566c3.219 0 6.002-2.251 6.67-5.408l4.406-20.856 6.09 21.313c.839 2.939 3.526 4.951 6.568 4.951h20.46c3.396 0 6.274-2.489 6.752-5.845l12.508-87.596 14.874 148.683c.355 3.437 3.205 6.056 6.643 6.138h.143c3.39 0 6.274-2.489 6.752-5.845l14.227-99.599 6.397 38.362c.546 3.287 3.396 5.702 6.725 5.702h88.66c3.771 0 6.82-3.049 6.82-6.82-.001-3.772-3.05-6.821-6.821-6.821z" />
                        </g>
                    </svg>
                </div>
                <div class="st-wave-second">
                    <svg enable-background="new 0 0 300.08 300.08" viewBox="0 0 300.08 300.08"
                        xmlns="http://www.w3.org/2000/svg">
                        <g>
                            <path
                                d="m293.26 184.14h-82.877l-12.692-76.138c-.546-3.287-3.396-5.701-6.718-5.701-.034 0-.061 0-.089 0-3.369.027-6.199 2.523-6.677 5.845l-12.507 87.602-14.874-148.69c-.355-3.43-3.205-6.056-6.643-6.138-.048 0-.096 0-.143 0-3.39 0-6.274 2.489-6.752 5.852l-19.621 137.368h-9.405l-12.221-42.782c-.866-3.028-3.812-5.149-6.8-4.944-3.13.109-5.777 2.332-6.431 5.395l-8.941 42.332h-73.049c-3.771 0-6.82 3.049-6.82 6.82 0 3.778 3.049 6.82 6.82 6.82h78.566c3.219 0 6.002-2.251 6.67-5.408l4.406-20.856 6.09 21.313c.839 2.939 3.526 4.951 6.568 4.951h20.46c3.396 0 6.274-2.489 6.752-5.845l12.508-87.596 14.874 148.683c.355 3.437 3.205 6.056 6.643 6.138h.143c3.39 0 6.274-2.489 6.752-5.845l14.227-99.599 6.397 38.362c.546 3.287 3.396 5.702 6.725 5.702h88.66c3.771 0 6.82-3.049 6.82-6.82-.001-3.772-3.05-6.821-6.821-6.821z" />
                        </g>
                    </svg>
                </div>
            </div>
        </div>
        <div class="st-height-b125 st-height-lg-b80"></div>
        <section class="st-shape-wrap">
            <div class="st-shape6">
                <img src="{{ asset('public/assets/img/shape/contact-shape3.svg') }}" alt="shape3">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-3">
                        <div class="st-doctors-info-left">
                            <div class="st-member st-style1 st-zoom">
                                <div class="st-member-img">
                                    <img src="{{ $doctor->image ? $doctor->image : asset('public/assets/img/doctor.jpg') }}"
                                        alt class="st-zoom-in">
                                    @if ($doctor->facebook || $doctor->instagram || $doctor->linkedin || $doctor->twitter || $doctor->youtube)
                                        <div class="st-member-social-wrap">
                                            <img src="{{ asset('public/assets/img/shape/member-shape.svg') }}"
                                                alt="shape" class="st-member-social-bg">
                                            <ul class="st-member-social st-mp0">
                                                @if ($doctor->facebook)
                                                    <li><a href="{{ $doctor->facebook }}"><i
                                                                class="fab fa-facebook-square"></i></a></li>
                                                @endif
                                                @if ($doctor->instagram)
                                                    <li><a href="{{ $doctor->instagram }}"><i
                                                                class="fa-brands fa-instagram"></i></a></li>
                                                @endif
                                                @if ($doctor->linkedin)
                                                    <li><a href="{{ $doctor->linkedin }}"><i
                                                                class="fab fa-linkedin"></i></a></li>
                                                @endif
                                                @if ($doctor->twitter)
                                                    <li><a href="{{ $doctor->twitter }}"><i
                                                                class="fa-brands fa-x-twitter"></i></a></li>
                                                @endif
                                                @if ($doctor->youtube)
                                                    <li><a href="{{ $doctor->youtube }}"><i
                                                                class="fa-brands fa-youtube"></i></a></li>
                                                @endif
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="st-height-b20 st-height-lg-b20"></div>
                            <ul class="st-doctors-special st-mp0">
                                <li><b>Speciality :</b><span>{{ $departmentName }}</span></li>
                                <li><b>Experience :</b><span>{{ $doctor->experience }} Years+</span></li>
                                {{-- <li><b>Languages :</b><span>{{ $doctor->languages }}</span></li>
                                <li><b>Types Of :</b><a
                                        href="{{ route('department.details', ['id' => $doctor->department]) }}">Department
                                        of
                                        {{ $departmentName }}</a></li> --}}
                            </ul>
                            <div class="st-height-b30 st-height-lg-b30"></div>
                            <!-- <div class="row"> -->
                            <!-- <div class="col-lg-7"> -->
                            <div class="st-shedule-wrap st-style1">
                                <div class="st-shedule">
                                    <h2 class="st-shedule-title">Contact info</h2>
                                    <div class="st-height-b10 st-height-lg-b10"></div>
                                    <ul class="st-footer-contact-list st-mp0">
                                        {{-- <li><span class="st-footer-contact-title">Address:</span>
                                            {{ $doctor->address }}
                                        </li> --}}
                                        <li><span class="st-footer-contact-title">Email:</span>
                                            {{ $doctor->email }}</li>
                                        @php
                                            $phones = explode(',', $doctor->phone);
                                        @endphp
                                        @foreach ($phones as $index => $phone)
                                            @if ($index == 0)
                                                <li><span class="st-footer-contact-title">Phone:</span> <a
                                                        href="tel:{{ $phone }}">
                                                        {{ $phone }}</a></li>
                                            @else
                                                <li><span class="st-footer-contact-title"></span><a
                                                        href="tel:{{ $phone }}">{{ $phone }}</a></li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="st-height-b0 st-height-lg-b30"></div>
                            <!-- </div> -->
                            <!-- <div class="col-lg-5"> -->
                            @if (count($schedules) > 0)
                                <div class="st-shedule-wrap st-style2">
                                    <div class="st-shedule">
                                        <h2 class="st-shedule-title">Working hours</h2>
                                        <ul class="st-shedule-list">
                                            @foreach ($schedules as $schedule)
                                                <li>
                                                    <div class="st-shedule-left">{{ $schedule[0] }} </div>
                                                    <div class="st-shedule-right">{{ $schedule[1] }} hours </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif
                            <!-- </div> -->
                            <!-- </div> -->

                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-9">
                        <div class="st-height-b25 st-height-lg-b25"></div>
                        <div class="st-doctors-info-right">
                            <div class="st-doctor-heading">
                                <h3 class="st-doctor-name">{{ $doctor->doctor_name }}</h3>
                                <div class="st-doctor-designation">Department of {{ $departmentName }}</div>
                                <div class="st-doctor-desc">{{ $doctor->degree }}</div>
                            </div>
                            <div class="st-height-b20 st-height-lg-b20"></div>

                            <div class="st-hero-btn">
                                <a href="#section2" id="scrollButton" class="st-btn st-style1 st-color1"
                                    data-bs-toggle="modal" data-bs-target="#exampleModal">Book
                                    Appointment</a>
                            </div>

                            <div class="st-height-b20 st-height-lg-b20"></div>

                            <div class="st-height-b25 st-height-lg-b25"></div>
                            <div class="st-tabs st-fade-tabs st-style2">
                                <ul class="st-tab-links st-style2 st-mp0">
                                    <li class="st-tab-title active ">
                                        <a href="#Biography">Biography</a>
                                    </li>
                                    <li class="st-tab-title">
                                        <a href="#Education">Education</a>
                                    </li>
                                </ul>
                                <div class="st-height-b25 st-height-lg-b25"></div>
                                <div class="tab-content">
                                    <div id="Biography" class="st-tab active">
                                        <div class="st-doctor-details-box">
                                            <p>
                                                {{ $doctor->biography }}
                                            </p>
                                        </div>
                                    </div>
                                    <div id="Education" class="st-tab">
                                        <div class="st-doctor-details-box">
                                            <ul>
                                                @php
                                                    $educations = explode(',', $doctor->education);
                                                @endphp
                                                @foreach ($educations as $education)
                                                    <li>{{ $education }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .st-tabs -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="st-height-b120 st-height-lg-b80"></div>
        </section>
        <!-- End Doctors Profile -->

        <hr>
        <!-- Start Service Section -->
        <section id="section2" class="st-shape-wrap">
            <div class="st-shape2"><img src="{{ asset('public/assets/img/shape/contact-shape2.svg') }}" alt="shape2">
            </div>
            <div class="st-height-b120 st-height-lg-b80"></div>
            <div class="container">
                <div class="st-section-heading st-style1">
                    <h2 class="st-section-heading-title">Make an appointment</h2>
                    <div class="st-seperator">
                        <div class="st-seperator-left wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.2s"></div>
                        <div class="st-seperator-center"><img src="{{ asset('public/assets/img/icons/4.png') }}"
                                alt="icon">
                        </div>
                        <div class="st-seperator-right wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.2s">
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
                        @include('frontend.layouts.appointments')
                    </div>
                </div>
            </div>
            <div class="st-height-b120 st-height-lg-b80"></div>
        </section>
        <!-- End Service Section -->
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

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Make an appointment</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('appointment.store') }}" class="st-appointment-form-modal">
                        @csrf
                        <div id="st-alert1"></div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="st-form-field st-style1">
                                    <label>Full Name</label>
                                    <input type="text" id="unamemodal" name="uname" placeholder="John Doe"
                                        value="{{ old('uname') }}" required>
                                    @error('uname')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="st-form-field st-style1">
                                    <label>Email Address</label>
                                    <input type="email" id="uemailmodal" name="uemail"
                                        placeholder="example@gmail.com" value="{{ old('uemail') }}" required>
                                    @error('uemail')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="st-form-field st-style1">
                                    <label>Phone Number</label>
                                    <input type="text" id="unumbermodal" name="unumber" placeholder="+00 141 23 234"
                                        value="{{ old('unumber') }}" required>
                                    @error('unumber')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="st-form-field st-style1">
                                    <label>Booking Date</label>
                                    <input name="udate" type="date" id="udatemodal" placeholder="mm/dd/yyyy"
                                        value="{{ old('udate') }}">
                                    @error('udate')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="st-form-field st-style1">
                                    <label>Department</label>
                                    <div class="st-custom-select-wrap">
                                        <select name="udepartment" id="udepartmentmodal" class="form-select"
                                            data-placeholder="Select department" required>
                                            <option value="">Select Department</option>
                                            @foreach ($departments as $department)
                                                <option value="{{ $department->id }}">
                                                    {{ $department->department_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('udepartment')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="st-form-field st-style1">
                                    <label>Doctor</label>
                                    <div class="st-custom-select-wrap">
                                        <select name="udoctor" class="form-select" id="udoctormodal"
                                            data-placeholder="Select doctor" required disabled>
                                            <option value="">Select Doctor</option>
                                        </select>
                                        <span id="doctor-error-message-modal" class="text-danger"></span>
                                        <div id="doctor-overlay-modal"
                                            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1; cursor: not-allowed;">
                                        </div>
                                        @error('udoctor')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="st-form-field st-style1">
                                    <label>Message</label>
                                    <textarea cols="30" rows="10" id="umsgmodal" name="umsg" placeholder="Write something here...">{{ old('umsg') }}</textarea>
                                    @error('umsg')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('udatemodal').setAttribute('min', today);

            const modal = document.getElementById('exampleModal');
            const appointmentForm = document.querySelector('.st-appointment-form-modal');
            const departmentSelector = document.getElementById('udepartmentmodal');
            const doctorDropdown = document.getElementById('udoctormodal');
            const errorMessage = document.getElementById('doctor-error-message-modal');
            const overlay = document.getElementById('doctor-overlay-modal');

            overlay.addEventListener('click', function() {
                errorMessage.textContent = 'Please select a Department first.';
            });
            // Event listener for the department dropdown change
            departmentSelector.addEventListener('change', function() {
                const departmentId = departmentSelector.value;
                if (departmentId) {
                    // Enable the doctor dropdown and clear previous options
                    doctorDropdown.disabled = false;
                    overlay.style.display = 'none';
                    errorMessage.textContent = '';
                    doctorDropdown.innerHTML = '<option value="">Select Doctor</option>'; // Reset options
                    var fetchUrl = "{{ route('getDoctorsOfDepartment', ['departmentId' => ':id']) }}"
                        .replace(':id', departmentId);
                    // Fetch doctors based on the selected department
                    fetch(fetchUrl)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data && data.length > 0) {
                                data.forEach(doctor => {
                                    const option = document.createElement('option');
                                    option.value = doctor.doctor_name;
                                    option.textContent = doctor.doctor_name;
                                    doctorDropdown.appendChild(option);
                                });
                            } else {
                                const option = document.createElement('option');
                                option.value = '';
                                option.textContent = 'No doctors available';
                                doctorDropdown.appendChild(option);
                            }
                        })
                        .catch(error => {
                            console.error('Error fetching doctors:', error);
                        });
                } else {
                    // If no department is selected, disable the doctor dropdown
                    doctorDropdown.disabled = true;
                    overlay.style.display = 'block';
                    errorMessage.textContent = '';
                    doctorDropdown.innerHTML = '<option value="">Select Doctor</option>';
                }
            });

            // Event listener to reset form fields when the modal is closed
            $('#exampleModal').on('hidden.bs.modal', function() {
                appointmentForm.reset(); // Reset all input fields in the form
                doctorDropdown.disabled = true; // Disable the doctor dropdown
                doctorDropdown.innerHTML =
                    '<option value="">Select Doctor</option>'; // Reset doctor dropdown options
            });
        });
    </script>
    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: '{{ session('alertTitle') ?? 'Error' }}',
                text: '{{ session('error') }}',
            });
        </script>
    @endif
@endsection
