@extends('cms.layout.admin')
@section('title', 'Reschedule Appointment')
@section('content')
    <div class="content">

        <!-- Page Header -->
        <div class="container">
            <div class="page-header mb-4">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">
                            Reschedule Appointment
                        </h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active">
                                Reschedule Appointment</li>
                        </ul>
                    </div>

                </div>
            </div>
            <!-- Page Header -->
            <div class="row">
                <div class="col-md-12">
                    <h3> Reschedule Appointment </h3>
                </div>
            </div>

            <form method="POST" action="{{ route('appointment.reschedule', ['id' => $appointment->id]) }}" class="st-appointment-form">
                @csrf
                @method('PUT') <!-- Use PUT for updating an existing resource -->
                <div id="st-alert1"></div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group mb-3">
                            <label>Full Name</label>
                            <input class="form-control" type="text" id="uname" name="uname" placeholder="John Doe"
                                value="{{ $appointment->name }}" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-3">
                            <label>Email Address</label>
                            <input class="form-control" type="email" id="uemail" name="uemail" placeholder="example@gmail.com"
                                value="{{ $appointment->email }}" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-3">
                            <label>Phone Number</label>
                            <input class="form-control" type="text" id="unumber" name="unumber" placeholder="+00 141 23 234"
                                value="{{ $appointment->phone }}" required>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-3">
                            <label>Booking Date</label>
                            <input class="form-control" name="udate" type="date" id="udate" value="{{ $appointment->booking_date }}" required>
                            
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-3">
                            <label>Department</label>
                            <div class="st-custom-select-wrap">
                                <select name="udepartment" id="udepartment" class="form-control" required>
                                    {{-- <option value="">Select department</option> --}}
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->department_name }}"
                                            {{ $appointment->department == $department->department_name ? 'selected' : '' }}>
                                            {{ $department->department_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-3">
                            <label>Doctor</label>
                            <div class="st-custom-select-wrap">
                                <select name="udoctor" id="udoctor" class="form-control" required>
                                    {{-- <option value="">Select doctor</option> --}}
                                    @foreach ($doctors as $doctor)
                                        <option value="{{ $doctor->doctor_name }}"
                                            {{ $appointment->doctor_name == $doctor->doctor_name ? 'selected' : '' }}>
                                            {{ $doctor->doctor_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group mb-3">
                            <label>Message</label>
                            <textarea class="form-control" cols="30" rows="10" id="umsg" name="umsg" placeholder="Write something here...">{{ $appointment->message }}</textarea>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button class="btn btn-primary" type="submit"
                            id="appointment-submit" >Reschedule Appointment</button>
                    </div>
                </div>
            </form>
            
        </div>

    </div>
@endsection
