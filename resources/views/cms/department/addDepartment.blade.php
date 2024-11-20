@extends('cms.layout.admin')
@section('title', 'Add Department')
@section('content')
<div class="content container-fluid">
				
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Add Department Details</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active">Add Department</li>
                </ul>
            </div>
            
        </div>
    </div>
    <!-- Page Header -->
    <div class="row">
        <div class="col-md-12">
            <h3> Add Department</h3>
        </div>
    </div>
    <div class="container">
        
        <form action="{{ route('department.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label for="department_name">Department Name</label>
                <input type="text" class="form-control" id="department_name" name="department_name" required>
            </div>
    
            <div class="form-group">
                <label for="image">Department Image</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*">
            </div>
    
            <div class="form-group">
                <label for="short_details">Short Details</label>
                <textarea class="form-control" id="short_details" name="short_details" rows="3" required></textarea>
            </div>
    
            <div class="form-group">
                <label for="long_details">Long Details</label>
                <textarea class="form-control" id="long_details" name="long_details" rows="5" required></textarea>
            </div>
    
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    
</div>
@endsection