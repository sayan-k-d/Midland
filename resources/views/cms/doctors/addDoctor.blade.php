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
            @if (session('error'))
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: '{{ session('alertTitle') ?? 'Error' }}',
                        text: '{{ session('error') }}',
                    });
                </script>
            @endif
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
                    @error('doctor_name')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="phone" class="mb-1">Phone</label>
                    <input class="form-control" id="phone" name="phone" required
                        value="{{ old('phone', $doctor->phone ?? '') }}" placeholder="Separate With Commas(',')" />
                    @error('phone')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="email" class="mb-1">Email</label>
                    <input class="form-control" id="email" name="email" type="email" required
                        value="{{ old('email', $doctor->email ?? '') }}" />
                    @error('email')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>



                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="image" class="mb-1">Doctor Image</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*" />
                            <small class="form-text text-muted">
                                Please upload an image with a size of up to 2MB and a 1:1 aspect ratio (e.g., 100x100,
                                200x200).
                            </small>
                            @if ($editFlag && $doctor->image)
                                <div class="mt-2">
                                    <img src="{{ $doctor->image }}" alt="Doctor Image" width="100">
                                </div>
                            @endif
                            @error('image')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="innerImage" class="mb-1">Doctor Inner Banner Image</label>
                            <input type="file" class="form-control" id="innerImage" name="innerImage" accept="image/*">
                            <small class="form-text text-muted">Please upload an image with a size of up to 5MB and Dimension of 1920 x 1080</small>
                            @if ($editFlag && $doctor->innerImage)
                                <div class="mt-2">
                                    <img src="{{ $doctor->innerImage }}" alt="Doctor Banner Image"
                                        style="width: 100px; height: auto;">
                                </div>
                            @endif
                            @error('innerImage')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                </div>

                <div class="form-group mb-3">
                    <label for="doctor_post" class="mb-1">Doctor Post</label>
                    <input class="form-control" id="doctor_post" name="doctor_post" required
                        value="{{ old('doctor_post', $doctor->doctor_post ?? '') }}" />
                    @error('doctor_post')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="department" class="mb-1">Department</label>
                    <select id="department" name="department" class="form-select" aria-label="Default select example"
                        required>
                        <option selected>Select Department</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}" @if ($editFlag && $doctor->department == $department->id) selected @endif>
                                {{ $department->department_name }}</option>
                        @endforeach
                    </select>
                    @error('department')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="biography" class="mb-1">Biography</label>
                    <textarea class="form-control" id="biography" name="biography" rows="3" required>{{ old('biography', $doctor->biography ?? '') }}</textarea>
                    @error('biography')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="education" class="mb-1">Education</label>
                    <input class="form-control" id="education" name="education" required
                        value="{{ old('education', $doctor->education ?? '') }}"
                        placeholder="Separate With Commas(',')" />
                    @error('education')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="experience" class="mb-1">Experience</label>
                    <input class="form-control" id="experience" name="experience" type="number" required
                        placeholder="in Years" value="{{ old('experience', $doctor->experience ?? '') }}" />
                    @error('experience')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                {{-- <div class="form-group mb-3">
                    <label for="languages" class="mb-1">Languages</label>
                    <input class="form-control" id="languages" name="languages"
                        value="{{ old('languages', $doctor->languages ?? '') }}"
                        placeholder="Separate With Commas(',')" />
                    @error('languages')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div> --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="degree" class="mb-1">Degree</label>
                            <input class="form-control" id="degree" name="degree" required
                                value="{{ old('degree', $doctor->degree ?? '') }}" />
                            @error('degree')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="is_active" class="form-label mb-1">Active</label>
                            <select name="is_active" id="is_active" class="form-control" required>
                                <option value="1"
                                    {{ old('is_active', $editFlag ? $doctor->is_active : '') == '1' ? 'selected' : '' }}>
                                    Yes
                                </option>
                                <option value="0"
                                    {{ old('is_active', $editFlag ? $doctor->is_active : '') == '0' ? 'selected' : '' }}>No
                                </option>
                            </select>
                            @error('is_active')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <input type="hidden" class="form-control" id="is_active_department"
                                name="is_active_department"
                                value="{{ old('is_active_department', $doctor->is_active_department ?? true) }}" />
                        </div>
                    </div>
                </div>


                <div class="form-group mb-3">
                    <label for="workingHours" class="mb-1">Working Schedule</label>
                    <div id="working-schedules-container">
                        @if ($editFlag && count($schedules) > 0)
                            @foreach ($schedules as $index => $schedule)
                                <div class="d-flex">
                                    <div class="input-group working-schedule mb-2">
                                        <span class="input-group-text">Working Days</span>
                                        <input id="workingDays" name="workingDays[]" type="text"
                                            aria-label="Working Days" class="form-control"
                                            value="{{ $schedule[0] }}" />
                                        <span class="input-group-text">Working Hours</span>
                                        <input id="workingHours" name="workingHours[]" type="text"
                                            aria-label="Working Hours" class="form-control" value="{{ $schedule[1] }}">
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
                                    <input id="workingDays" name="workingDays[]" type="text"
                                        aria-label="Working Days" class="form-control"
                                        value="{{ old('workingDays') }}" />
                                    <span class="input-group-text">Working Hours</span>
                                    <input id="workingHours" name="workingHours[]" type="text"
                                        aria-label="Working Hours" class="form-control"
                                        value="{{ old('workingHours') }}">
                                    <span class="input-group-text">Hours</span>
                                </div>
                                <div>
                                    <button type="button" class="btn btn-primary" id="add-schedule-btn">
                                        <i class="bi bi-plus-circle"></i>
                                    </button>
                                </div>
                            </div>
                        @endif
                    </div>
                    @error('workingHours')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="isHead" value="checked"
                            @if ($editFlag && $doctor['isHead'] == 1) @checked(true) @else @checked(false) @endif
                            id="is_head" />
                        <label class="form-check-label" for="is_head">
                            Is Founder / Department Head
                        </label>
                    </div>
                    @error('isHead')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="card mb-3" style="transform: none">
                    <div class="card-header">
                        Social Media Profiles
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="facebook" class="form-label mb-1">Facebook</label>
                                    <input class="form-control" type="url" id="facebook" name="facebook"
                                        value="{{ old('facebook', $doctor->facebook ?? '') }}">
                                    @error('facebook')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="instagram" class="form-label mb-1">Instagram</label>
                                    <input class="form-control" type="url" id="instagram" name="instagram"
                                        value="{{ old('instagram', $doctor->instagram ?? '') }}">
                                    @error('instagram')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="linkedin" class="form-label mb-1">LinkedIn</label>
                                    <input class="form-control" type="url" id="linkedin" name="linkedin"
                                        value="{{ old('linkedin', $doctor->linkedin ?? '') }}">
                                    @error('linkedin')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="twitter" class="form-label mb-1">Twitter</label>
                                    <input class="form-control" type="url" id="twitter" name="twitter"
                                        value="{{ old('twitter', $doctor->twitter ?? '') }}">
                                    @error('twitter')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="youtube" class="form-label mb-1">Youtube</label>
                                    <input class="form-control" type="url" id="youtube" name="youtube"
                                        value="{{ old('youtube', $doctor->youtube ?? '') }}">
                                    @error('youtube')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">{{ $editFlag ? 'Update Doctor' : 'Submit' }}</button>
            </form>

        </div>

    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.querySelector("form");
            const isHeadCheckbox = document.getElementById("is_head");

            form.addEventListener("submit", function(event) {
                if (isHeadCheckbox.checked) {
                    // Check if another doctor already has isHead = 1
                    const existingHead =
                        {{ json_encode($existingHead) }}; // Pass existing head info from server-side

                    if (existingHead) {
                        event.preventDefault(); // Prevent form submission

                        // SweetAlert to confirm if user wants to proceed
                        Swal.fire({
                            title: 'Are you sure?',
                            text: "Another doctor is already marked as the Head of the Department. Are you sure you want to change this?",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Yes, update it!',
                            cancelButtonText: 'Cancel',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit(); // Submit the form if user confirms
                            }
                        });
                    }
                }
            });

        });
    </script>
    @if ($errors->has('isHead'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                text: "{{ $errors->first('isHead') }}",
            });
        </script>
    @endif


@endsection
{{-- department wiill be used for Speciality, Types of: Department of <department> --}}
