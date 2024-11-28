@extends('cms.layout.admin')
@section('title', 'Department')
@section('content')
    
<div class="content">
    <div class="container mt-5">
        <h1> {{ $editFlag ? 'Edit Banner' : 'Add New Banner' }}</h1>
    
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
    
        <form action="{{ $editFlag ? route('banners.update', ['id' => $banner->id]) :route('banners.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if ($editFlag)
                @method('PUT')
            @endif
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="page" class="form-label">Page</label>
                    <input type="text" name="page" id="page" class="form-control"  value="{{ old('page', $editFlag ? $banner->page : '') }}" required>
                    @error('page')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="banner_title" class="form-label">Banner Title</label>
                    <input type="text" name="banner_title" id="banner_title" class="form-control" value="{{ old('banner_title', $editFlag ? $banner->banner_title : '') }}">
                    @error('banner_title')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
    
                
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="image" class="form-label">Banner Image</label>
                    
                    @if ($editFlag && $banner->image)
                    <input type="file" name="image" id="image" class="form-control" accept="image/*">
                        <div class="mt-2">
                            <img src="{{ $banner->image }}" alt="Department Image" style="width: 100px; height: auto;">
                        </div>
                    @else 
                        <input type="file" name="image" id="image" class="form-control" accept="image/*" required>
                    @endif
                    @error('image')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" class="form-control" value="{{ old('description', $editFlag ? $banner->description : '') }}"></textarea>
                    @error('description')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="page_url" class="form-label">Page URL</label>
                    <input type="text" name="page_url" id="page_url" class="form-control" value="{{ old('page_url', $editFlag ? $banner->page_url : '') }}">
                    @error('page_url')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>    
                <div class="col-md-6 mb-3">
                    <label for="type" class="form-label">Type</label>
                    <select name="type" id="type" class="form-control" required>
                        <option value="carousel">Carousel</option>
                        <option value="single">Single</option>
                    </select>
                    @error('type')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="position" class="form-label">Position</label>
                    <input type="number" name="position" id="position" class="form-control" value="0" value="{{ old('position', $editFlag ? $banner->position : '') }}">
                    @error('position')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>   
                <div class="col-md-6 mb-3">
                    <label for="is_active" class="form-label">Active</label>
                    <select name="is_active" id="is_active" class="form-control" required>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                    @error('is_active')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary">{{ $editFlag ? 'Update' : 'Submit' }}</button>
        </form>
        
    </div>
</div>
@endsection