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

            <form method="POST" action="{{ route('appointment.reschedule', ['id' => $appointment->id]) }}"
                class="st-appointment-form">
                @csrf
                @method('PUT') <!-- Use PUT for updating an existing resource -->
                <div id="st-alert1"></div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group mb-3">
                            <label>Full Name</label>
                            <input class="form-control" type="text" id="uname" name="uname" placeholder="John Doe"
                                value="{{ $appointment->name }}" required>
                            @error('uname')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-3">
                            <label>Email Address</label>
                            <input class="form-control" type="email" id="uemail" name="uemail"
                                placeholder="example@gmail.com" value="{{ $appointment->email }}" required>
                            @error('uemail')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-3">
                            <label>Phone Number</label>
                            <input class="form-control" type="text" id="unumber" name="unumber"
                                placeholder="+00 141 23 234" value="{{ $appointment->phone }}" required>
                            @error('unumber')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-3">
                            <label>Booking Date</label>
                            <input class="form-control" name="udate" type="date" id="udate"
                                value="{{ $appointment->booking_date }}" required>
                            @error('udate')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group mb-3">
                            <label>Department</label>
                            <div class="st-custom-select-wrap">
                                <select name="udepartment" id="udepartment" class="form-control" required>
                                    {{-- <option value="">Select department</option> --}}
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}"
                                            {{ $appointment->department == $department->department_name ? 'selected' : '' }}>
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
                        <div class="form-group mb-3">
                            <label>Doctor</label>
                            <input type="hidden" name="udoctor_name" id='udoctor_name'
                                value="{{ $appointment->doctor_name }}">
                            <div class="st-custom-select-wrap">
                                <select name="udoctor" id="udoctor" class="form-control" required>
                                    {{-- <option value="">Select doctor</option> --}}
                                    {{-- @foreach ($doctors as $doctor)
                                        <option value="{{ $doctor->doctor_name }}"
                                            {{ $appointment->doctor_name == $doctor->doctor_name ? 'selected' : '' }}>
                                            {{ $doctor->doctor_name }}
                                        </option>
                                    @endforeach --}}
                                </select>
                                @error('udoctor')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group mb-3">
                            <label>Message</label>
                            <textarea class="form-control" cols="30" rows="10" id="umsg" name="umsg"
                                placeholder="Write something here...">{{ $appointment->message }}</textarea>
                            @error('umsg')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button class="btn btn-primary" type="submit" id="appointment-submit">Reschedule
                            Appointment</button>
                    </div>
                </div>
            </form>

        </div>

    </div>
@endsection
@section('scripts')
    <script>
        // Ensure booking date cannot be in the past
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('udate').setAttribute('min', today);

        // Function to fetch and update doctors based on the selected department
        var departmentId = document.getElementById('udepartment').value;
        var doctorName = document.getElementById('udoctor_name').value;
        if (departmentId) {
            var doctorDropdown = document.getElementById('udoctor');
            doctorDropdown.innerHTML = `<option value="" selected>Select Doctor</option>`;
            fetch('/get-doctors/' + departmentId)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data && data.length > 0) {
                        data.forEach(doctor => {
                            var option = document.createElement('option');
                            option.value = doctor.doctor_name;
                            option.textContent = doctor.doctor_name;
                            option.selected = doctor.doctor_name === doctorName;
                            doctorDropdown.appendChild(option);
                        });
                    } else {
                        var option = document.createElement('option');
                        option.value = '';
                        option.textContent = 'No doctors available';
                        doctorDropdown.appendChild(option);
                    }
                })
                .catch(error => {
                    console.error('Error fetching doctors:', error);
                });
        }
        document.getElementById('udepartment').addEventListener('change', function() {
            const departmentId = this.value; // Get selected department
            const doctorSelect = document.getElementById('udoctor');

            // Clear the existing doctor options
            doctorSelect.innerHTML = '<option value="">Select Doctor</option>';
            fetch('/get-doctors/' + departmentId)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    // console.log(response);

                    return response.json();
                })
                .then(data => {
                    if (data && data.length > 0) {
                        data.forEach(doctor => {
                            var option = document.createElement('option');
                            option.value = doctor.doctor_name;
                            option.textContent = doctor.doctor_name;
                            doctorDropdown.appendChild(option);
                        });
                    } else {
                        var option = document.createElement('option');
                        option.value = '';
                        option.textContent = 'No doctors available';
                        doctorDropdown.appendChild(option);
                    }
                })
                .catch(error => {
                    console.error('Error fetching doctors:', error);
                });
        });
    </script>
@endsection
