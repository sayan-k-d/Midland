@extends('cms.layout.admin')
@section('title', 'Add Service')
@section('content')
    <div class="content">

        <!-- Page Header -->
        <div class="container">
            <div class="page-header mb-4">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">{{ $editFlag ? 'Edit Service Details' : 'Add Service Details' }}</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active">{{ $editFlag ? 'Edit Service' : 'Add Service' }}</li>
                        </ul>
                    </div>

                </div>
            </div>
            <!-- Page Header -->
            <div class="row">
                <div class="col-md-12">
                    <h3>{{ $editFlag ? 'Edit Service' : 'Add Service' }}</h3>
                </div>
            </div>

            <form action="{{ $editFlag ? route('service.update', $service->id) : route('service.store') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @if ($editFlag)
                    @method('PUT') <!-- Use PUT method for update -->
                @endif

                <div class="form-group mb-3">
                    <label for="service_name" class="mb-1">Service Name</label>
                    <input type="text" class="form-control" id="service_name" name="service_name"
                        value="{{ old('service_name', $service->service_name ?? '') }}" required>
                    @error('service_name')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="image" class="mb-1">Service Image</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*">
                            @if ($editFlag && $service->image)
                                <div class="mt-2">
                                    <img src="{{ $service->image }}" alt="Service Image" width="100">
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
                                    {{ old('is_active', $editFlag ? $service->is_active : '') == '1' ? 'selected' : '' }}>
                                    Yes
                                </option>
                                <option value="0"
                                    {{ old('is_active', $editFlag ? $service->is_active : '') == '0' ? 'selected' : '' }}>
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
                    <label for="short_details" class="mb-1">Short Details</label>
                    <textarea class="form-control" id="short_details" name="short_details" rows="3" required>{{ old('short_details', $service->short_details ?? '') }}</textarea>
                    @error('short_details')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="long_details" class="mb-1">Long Details</label>
                    <textarea class="form-control" id="long_details" name="long_details" rows="5" required>{{ old('long_details', $service->long_details ?? '') }}</textarea>
                    @error('long_details')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">{{ $editFlag ? 'Update Service' : 'Submit' }}</button>
            </form>

        </div>

    </div>

@endsection
