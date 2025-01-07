@extends('cms.layout.admin')
@section('title', 'Department')
@section('content')
    <div class="content">

        <!-- Page Header -->
        <div class="container">
            <div class="page-header mb-4">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">
                            {{ $editFlag ? 'Edit Department Details' : 'Add Department Details' }}
                        </h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active">
                                {{ $editFlag ? 'Edit Department Details' : 'Add Department Details' }}</li>
                        </ul>
                    </div>

                </div>
            </div>
            <!-- Page Header -->
            <div class="row">
                <div class="col-md-12">
                    <h3> {{ $editFlag ? 'Edit Department Details' : 'Add Department Details' }}</h3>
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
            <form
                action="{{ $editFlag ? route('department.update', ['id' => $department->id]) : route('department.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @if ($editFlag)
                    @method('PUT')
                @endif

                <div class="form-group mb-3">
                    <label for="department_name" class="mb-1">Department Name</label>
                    <input type="text" class="form-control" id="department_name" name="department_name"
                        value="{{ old('department_name', $editFlag ? $department->department_name : '') }}" required>
                    @error('department_name')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="image" class="mb-1">Department Image</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*">
                            <small class="form-text text-muted">
                                Please upload an image with a size of up to 2MB and Dimension of 600 x 400
                            </small>
                            @if ($editFlag && $department->image)
                                <div class="mt-2">
                                    <img src="{{ $department->image }}" alt="Department Image"
                                        style="width: 100px; height: auto;">
                                </div>
                            @endif
                            @error('image')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="is_active" class="form-label mb-1">Active</label>
                            <select name="is_active" id="is_active" class="form-control" required>
                                <option value="1"
                                    {{ old('is_active', $editFlag ? $department->is_active : '') == '1' ? 'selected' : '' }}>
                                    Yes
                                </option>
                                <option value="0"
                                    {{ old('is_active', $editFlag ? $department->is_active : '') == '0' ? 'selected' : '' }}>
                                    No
                                </option>
                            </select>
                            @error('is_active')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="innerImage" class="mb-1">Department Inner Banner Image</label>
                    <input type="file" class="form-control" id="innerImage" name="innerImage" accept="image/*">
                    <small class="form-text text-muted">Please upload an image with a size of up to 5MB and Dimension of 1920 x 1080
                    </small>
                    @if ($editFlag && $department->innerImage)
                        <div class="mt-2">
                            <img src="{{ $department->innerImage }}" alt="Department Banner Image"
                                style="width: 100px; height: auto;">
                        </div>
                    @endif
                    @error('innerImage')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="short_details" class="mb-1">Short Details</label>
                    <textarea class="form-control" id="short_details" name="short_details" rows="3" required>{{ old('short_details', $editFlag ? $department->short_details : '') }}</textarea>
                    @error('short_details')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="long_details" class="mb-1">Long Details</label>
                    <textarea class="form-control" id="long_details" name="long_details" rows="5" required>{{ old('long_details', $editFlag ? $department->long_details : '') }}</textarea>
                    @error('long_details')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    {{ $editFlag ? 'Update' : 'Submit' }}
                </button>
            </form>

        </div>

    </div>
    @if ($errors->has('doctorIsHead'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Cannot Disable',
                text: "{{ $errors->first('doctorIsHead') }}",
            });
        </script>
    @endif
@endsection
