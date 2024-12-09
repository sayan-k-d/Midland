@extends('cms.layout.admin')
@section('title', 'Banner')
@section('content')

    <div class="content">
        <div class="container mt-5">
            <h1> {{ $editFlag ? 'Edit Banner' : 'Add New Banner' }}</h1>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ $editFlag ? route('banners.update', ['id' => $banner->id]) : route('banners.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @if ($editFlag)
                    @method('PUT')
                @endif
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="page" class="form-label">Page</label>
                        <select id="page" name="page" class="form-select" aria-label="Default select example"
                            required>
                            <option selected>--Select Page--</option>
                            @foreach ($pages as $page)
                                <option value="{{ $page }}" @if ($editFlag && $banner->page == $page) selected @endif>
                                    {{ $page }}</option>
                            @endforeach
                        </select>
                        @error('page')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="type" class="form-label">Type</label>
                        <select name="type" id="type" class="form-control" required onchange="toggleFields()">
                            <option value="carousel"
                                {{ old('type', $editFlag ? $banner->type : '') == 'carousel' ? 'selected' : '' }}>Carousel
                            </option>
                            <option value="single"
                                {{ old('type', $editFlag ? $banner->type : '') == 'single' ? 'selected' : '' }}>Single
                            </option>
                        </select>
                        @error('type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="banner_title" class="form-label">Banner Title</label>
                        <input type="text" name="banner_title" id="banner_title" class="form-control"
                            value="{{ old('banner_title', $editFlag ? $banner->banner_title : '') }}">
                        @error('banner_title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="image" class="form-label">Banner Image</label>
                        @if ($editFlag && $banner->image)
                            <input type="file" name="image" id="image" class="form-control" accept="image/*">
                            <div class="mt-2">
                                <img src="{{ $banner->image }}" alt="Blog Image" style="width: 100px; height: auto;">
                            </div>
                        @else
                            <input type="file" name="image" id="image" class="form-control" accept="image/*"
                                required>
                        @endif
                        @error('image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" class="form-control">{{ old('description', $editFlag ? $banner->description : '') }}</textarea>
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="position" class="form-label">Position</label>
                        <input type="number" name="position" id="position" class="form-control"
                            value="{{ old('position', $editFlag ? $banner->position : '0') }}">
                        @error('position')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="is_active" class="form-label">Active</label>
                        <select name="is_active" id="is_active" class="form-control" required>
                            <option value="1"
                                {{ old('is_active', $editFlag ? $banner->is_active : '') == '1' ? 'selected' : '' }}>Yes
                            </option>
                            <option value="0"
                                {{ old('is_active', $editFlag ? $banner->is_active : '') == '0' ? 'selected' : '' }}>No
                            </option>
                        </select>
                        @error('is_active')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Conditionally Visible Fields -->
                <div id="carouselFields">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="page_url" class="form-label">Page URL</label>
                            <input type="text" name="page_url" id="page_url" class="form-control"
                                value="{{ old('page_url', $editFlag ? $banner->page_url : '') }}">
                            @error('page_url')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="button_label" class="form-label">Button Label</label>
                            <input type="text" name="button_label" id="button_label" class="form-control"
                                value="{{ old('button_label', $editFlag ? $banner->button_label : '') }}">
                            @error('button_label')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">{{ $editFlag ? 'Update' : 'Submit' }}</button>
            </form>
        </div>
    </div>

    <script>
        // JavaScript to toggle visibility of fields based on type
        function toggleFields() {
            const type = document.getElementById('type').value;
            const carouselFields = document.getElementById('carouselFields');

            if (type === 'carousel') {
                carouselFields.style.display = 'block';
            } else {
                carouselFields.style.display = 'none';
            }
        }

        // Run on page load to set the initial state
        document.addEventListener('DOMContentLoaded', () => {
            toggleFields();
        });
    </script>
@endsection
