@extends('cms.layout.admin')
@section('title', 'Add Doctor')
@section('content')
    <div class="content">

        <!-- Page Header -->
        <div class="container">
            <div class="page-header mb-4">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">{{ $editFlag ? 'Edit Doctor Details' : 'Add Doctor Details' }}</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active">{{ $editFlag ? 'Edit Doctor' : 'Add Doctor' }}</li>
                        </ul>
                    </div>

                </div>
            </div>
            <!-- Page Header -->
            <div class="row">
                <div class="col-md-12">
                    <h3>{{ $editFlag ? 'Edit doctor' : 'Add doctor' }}</h3>
                </div>
            </div>

            <form action="{{ $editFlag ? route('doctor.update', $doctor->id) : route('doctor.store') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @if ($editFlag)
                    @method('PUT') <!-- Use PUT method for update -->
                @endif

                <div class="form-group mb-3">
                    <label for="doctor_name" class="mb-1">Doctor Name</label>
                    <input type="text" class="form-control" id="doctor_name" name="doctor_name"
                        value="{{ old('doctor_name', $doctor->doctor_name ?? '') }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="phone" class="mb-1">Phone</label>
                    <input class="form-control" id="phone" name="phone" required
                        value="{{ old('phone', $doctor->phone ?? '') }}" placeholder="Separate With Commas(',')" />
                </div>

                <div class="form-group mb-3">
                    <label for="email" class="mb-1">Email</label>
                    <input class="form-control" id="email" name="email" type="email" required
                        value="{{ old('email', $doctor->email ?? '') }}" />
                </div>

                <div class="form-group mb-3">
                    <label for="image" class="mb-1">Doctor Image</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*" />
                    @if ($editFlag && $doctor->image)
                        <div class="mt-2">
                            <img src="{{ $doctor->image }}" alt="Doctor Image" width="100">
                        </div>
                    @endif
                </div>

                <div class="form-group mb-3">
                    <label for="doctor_post" class="mb-1">Doctor Post</label>
                    <input class="form-control" id="doctor_post" name="doctor_post" required
                        value="{{ old('doctor_post', $doctor->doctor_post ?? '') }}" />
                </div>

                <div class="form-group mb-3">
                    <label for="department" class="mb-1">Department</label>
                    {{-- <input class="form-control" id="department" name="department" required
                    value="{{ old('department', $doctor->department ?? '') }}" /> --}}
                    <select id="department" name="department" class="form-select" aria-label="Default select example"
                        required>
                        <option selected>Select Department</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}" @if ($editFlag && $doctor->department == $department->id) selected @endif>
                                {{ $department->department_name }}</option>
                        @endforeach
                    </select>
                </div>



                <div class="form-group mb-3">
                    <label for="biography" class="mb-1">Biography</label>
                    <textarea class="form-control" id="biography" name="biography" rows="3" required>{{ old('biography', $doctor->biography ?? '') }}</textarea>
                </div>

                <div class="form-group mb-3">
                    <label for="education" class="mb-1">Education</label>
                    <input class="form-control" id="education" name="education" required
                        value="{{ old('education', $doctor->education ?? '') }}" placeholder="Separate With Commas(',')" />
                </div>

                <div class="form-group mb-3">
                    <label for="experience" class="mb-1">Experience</label>
                    <input class="form-control" id="experience" name="experience" type="number" required
                        placeholder="in Years" value="{{ old('experience', $doctor->experience ?? '') }}" />
                </div>

                <div class="form-group mb-3">
                    <label for="languages" class="mb-1">Languages</label>
                    <input class="form-control" id="languages" name="languages" required
                        value="{{ old('languages', $doctor->languages ?? '') }}" placeholder="Separate With Commas(',')" />
                </div>

                <div class="form-group mb-3">
                    <label for="address" class="mb-1">Address</label>
                    <input class="form-control" id="address" name="address" required
                        value="{{ old('address', $doctor->address ?? '') }}" />
                </div>

                <div class="form-group mb-3">
                    <label for="degree" class="mb-1">Degree</label>
                    <input class="form-control" id="degree" name="degree" required
                        value="{{ old('degree', $doctor->degree ?? '') }}" />
                </div>

                <div class="form-group mb-3">
                    <label for="workingHours" class="mb-1">Working Schedule</label>

                    <!-- Container to hold the working schedules -->
                    <div id="working-schedules-container">
                        @if ($editFlag && count($schedules) > 0)
                            @foreach ($schedules as $index => $schedule)
                                <div class="d-flex">
                                    <div class="input-group working-schedule mb-2">
                                        <span class="input-group-text">Working Days</span>
                                        <input id="workingDays" name="workingDays[]" required type="text"
                                            aria-label="Working Days" class="form-control"
                                            value="{{ $schedule[0] }}" />
                                        <span class="input-group-text">Working Hours</span>
                                        <input id="workingHours" name="workingHours[]" type="text"
                                            aria-label="Working Hours" class="form-control" required
                                            value="{{ $schedule[1] }}">
                                        <span class="input-group-text">Hours</span>
                                    </div>
                                    <div>
                                        @if ($index > 0)
                                            <button type="button" class="btn btn-danger delete-schedule-btn">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        @else
                                            <button type="button" class="btn btn-primary" id="add-schedule-btn">
                                                <i class="bi bi-plus-circle"></i>
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="d-flex">
                                <div class="input-group working-schedule mb-2">
                                    <span class="input-group-text">Working Days</span>
                                    <input id="workingDays" name="workingDays[]" required type="text"
                                        aria-label="Working Days" class="form-control"
                                        value="{{ old('workingDays') }}" />
                                    <span class="input-group-text">Working Hours</span>
                                    <input id="workingHours" name="workingHours[]" type="text"
                                        aria-label="Working Hours" class="form-control" required
                                        value="{{ old('workingHours') }}">
                                    <span class="input-group-text">Hours</span>
                                </div>
                                <div>
                                    <button type="button" class="btn btn-primary" id="add-schedule-btn"><i
                                            class="bi bi-plus-circle"></i></button>
                                </div>
                            </div>
                    </div>
                    @endif
                </div>

                <div class="form-group mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="isHead" value="checked"
                            @if ($editFlag && $doctor['isHead'] == 1) @checked(true) @else
                            @checked(false) @endif
                            id="is_head" />
                        <label class="form-check-label" for="is_head">
                            Is Founder / Department Head
                        </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">{{ $editFlag ? 'Update Doctor' : 'Submit' }}</button>
            </form>
        </div>

    </div>
@endsection
{{-- department wiill be used for Speciality, Types of: Department of <department> --}}
