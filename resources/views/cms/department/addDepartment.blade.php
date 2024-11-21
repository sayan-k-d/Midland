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
                            <li class="breadcrumb-item active">{{ $editFlag ? 'Edit Department Details' : 'Add Department Details' }}</li>
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

            {{-- <form action="{{ route('department.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group mb-3">
                    <label for="department_name" class="mb-1">Department Name</label>
                    <input type="text" class="form-control" id="department_name" name="department_name" required>
                </div>

                <div class="form-group mb-3">
                    <label for="image" class="mb-1">Department Image</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                </div>

                <div class="form-group mb-3">
                    <label for="short_details" class="mb-1">Short Details</label>
                    <textarea class="form-control" id="short_details" name="short_details" rows="3" required></textarea>
                </div>

                <div class="form-group mb-3">
                    <label for="long_details" class="mb-1">Long Details</label>
                    <textarea class="form-control" id="long_details" name="long_details" rows="5" required></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form> --}}
            <form action="{{ $editFlag ? route('department.update', $department->id) : route('department.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if($editFlag)
                    @method('PUT')
                @endif

                <div class="form-group mb-3">
                    <label for="department_name" class="mb-1">Department Name</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        id="department_name" 
                        name="department_name" 
                        value="{{ old('department_name', $editFlag ? $department->department_name : '') }}" 
                        required>
                </div>

                <div class="form-group mb-3">
                    <label for="image" class="mb-1">Department Image</label>
                    <input 
                        type="file" 
                        class="form-control" 
                        id="image" 
                        name="image" 
                        accept="image/*">
                    @if($editFlag && $department->image_path)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $department->image_path) }}" 
                                alt="Department Image" 
                                style="width: 100px; height: auto;">
                        </div>
                    @endif
                </div>

                <div class="form-group mb-3">
                    <label for="short_details" class="mb-1">Short Details</label>
                    <textarea 
                        class="form-control" 
                        id="short_details" 
                        name="short_details" 
                        rows="3" 
                        required>{{ old('short_details', $editFlag ? $department->short_details : '') }}</textarea>
                </div>

                <div class="form-group mb-3">
                    <label for="long_details" class="mb-1">Long Details</label>
                    <textarea 
                        class="form-control" 
                        id="long_details" 
                        name="long_details" 
                        rows="5" 
                        required>{{ old('long_details', $editFlag ? $department->long_details : '') }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">
                    {{ $editFlag ? 'Update' : 'Submit' }}
                </button>
            </form>
        </div>

    </div>
@endsection
