@extends('cms.layout.admin')
@section('title', 'Add Service')
@section('content')
    <div class="content">

        <!-- Page Header -->
        <div class="container">
            <div class="page-header mb-4">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Add Service Details</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active">Add Service</li>
                        </ul>
                    </div>

                </div>
            </div>
            <!-- Page Header -->
            <div class="row">
                <div class="col-md-12">
                    <h3> Add Service</h3>
                </div>
            </div>

            <form action="{{ route('service.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group mb-3">
                    <label for="Service_name" class="mb-1">Service Name</label>
                    <input type="text" class="form-control" id="service_name" name="service_name" required>
                </div>

                <div class="form-group mb-3">
                    <label for="image" class="mb-1">Service Image</label>
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
            </form>
        </div>

    </div>
@endsection
