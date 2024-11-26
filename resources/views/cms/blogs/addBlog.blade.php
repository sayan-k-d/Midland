@extends('cms.layout.admin')
@section('title', 'Add Blog')
@section('content')
    <div class="content">

        <!-- Page Header -->
        <div class="container">
            <div class="page-header mb-4">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">{{ $editFlag ? 'Edit Blog Details' : 'Add Blog Details' }}</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active">{{ $editFlag ? 'Edit Blog' : 'Add Blog' }}</li>
                        </ul>
                    </div>

                </div>
            </div>
            <!-- Page Header -->
            <div class="row">
                <div class="col-md-12">
                    <h3>{{ $editFlag ? 'Edit Blog' : 'Add Blog' }}</h3>
                </div>
            </div>

            <form action="{{ $editFlag ? route('blog.update', $blog->id) : route('blog.store') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @if ($editFlag)
                    @method('PUT') <!-- Use PUT method for update -->
                @endif

                <div class="form-group mb-3">
                    <label for="title" class="mb-1">Title</label>
                    <input type="text" class="form-control" id="title" name="title"
                        value="{{ old('title', $blog->title ?? '') }}" required>
                </div>
                <div class="form-group mb-3">
                    <label for="date" class="mb-1">Date</label>
                    <input class="form-control" id="date" name="date" type="date" required
                        value="{{ old('date', $blog->date ?? '') }}" />
                </div>


                <div class="form-group mb-3">
                    <label for="content" class="mb-1">Content</label>
                    <textarea class="form-control" id="content" name="content" rows="3" required>{{ old('content', $blog->content ?? '') }}</textarea>
                </div>
                <div class="form-group mb-3">
                    <label for="content_image" class="mb-1">Content Image</label>
                    <input type="file" class="form-control" id="content_image" name="content_image" accept="image/*" />
                    @if ($editFlag && $blog->content_image)
                        <div class="mt-2">
                            <img src="{{ $blog->content_image }}" alt="blog content_image" width="100">
                        </div>
                    @endif
                </div>


                <div class="form-group mb-3">
                    <label for="intro_heading" class="mb-1">Introduction Area Heading</label>
                    <input class="form-control" id="intro_heading" name="intro_heading" required
                        value="{{ old('intro_heading', $blog->intro_heading ?? '') }}" />
                </div>
                <div class="form-group mb-3">
                    <label for="introduction" class="mb-1">Introduction</label>
                    <textarea class="form-control" id="introduction" name="introduction" rows="3" required>{{ old('introduction', $blog->introduction ?? '') }}</textarea>
                </div>
                <div class="form-group mb-3">
                    <label for="intro_image" class="mb-1">Introduction Image</label>
                    <input type="file" class="form-control" id="intro_image" name="intro_image" accept="image/*" />
                    @if ($editFlag && $blog->intro_image)
                        <div class="mt-2">
                            <img src="{{ $blog->intro_image }}" alt="blog intro_image" width="100">
                        </div>
                    @endif
                </div>


                <div class="form-group mb-3">
                    <label for="video_heading" class="mb-1">Video Heading</label>
                    <input class="form-control" id="video_heading" name="video_heading" required
                        value="{{ old('video_heading', $blog->video_heading ?? '') }}"/>
                </div>
                <div class="form-group mb-3">
                    <label for="video_link" class="mb-1">Video Link</label>
                    <input class="form-control" id="video_link" name="video_link" type="url" required
                        value="{{ old('video_link', $blog->video_link ?? '') }}" />
                </div>
                <div class="form-group mb-3">
                    <label for="video_content" class="mb-1">Video Content</label>
                    <textarea class="form-control" id="video_content" name="video_content" rows="3" required>{{ old('video_content', $blog->video_content ?? '') }}</textarea>
                </div>


                <div class="form-group mb-3">
                    <label for="diet_heading" class="mb-1">Diet Heading</label>
                    <input class="form-control" id="diet_heading" name="diet_heading" required
                        value="{{ old('diet_heading', $blog->diet_heading ?? '') }}"/>
                </div>
                <div class="form-group mb-3">
                    <label for="diet_image" class="mb-1">Diet Area Image</label>
                    <input type="file" class="form-control" id="diet_image" name="diet_image" accept="image/*" />
                    @if ($editFlag && $blog->diet_image)
                        <div class="mt-2">
                            <img src="{{ $blog->diet_image }}" alt="blog diet_image" width="100">
                        </div>
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="diet_description" class="mb-1">Diet Description</label>
                    <textarea class="form-control" id="diet_description" name="diet_description" rows="3" required>{{ old('diet_description', $blog->diet_description ?? '') }}</textarea>
                </div>
                <div class="form-group mb-3">
                    <label for="diet_content" class="mb-1">Diet Content</label>
                    <input class="form-control" id="diet_content" name="diet_content" type="text" required
                   value="{{ old('diet_content', $blog->diet_content ?? '') }}"  placeholder="Separate With Commas(',')" />
                </div>
                <div class="form-group mb-3">
                    <label for="diet_advice" class="mb-1">Diet advice</label>
                    <input class="form-control" id="diet_advice" name="diet_advice" type="text"
                   value="{{ old('diet_advice', $blog->diet_advice ?? '') }}" />
                </div>


                <div class="form-group mb-3">
                    <label for="test_heading" class="mb-1">Tests Area Heading</label>
                    <input class="form-control" id="test_heading" name="test_heading" required
                        value="{{ old('test_heading', $blog->test_heading ?? '') }}" />
                </div>
                <div class="form-group mb-3">
                    <label for="test_content" class="mb-1">Tests Content</label>
                    <textarea class="form-control" id="test_content" name="test_content" rows="3" required>{{ old('test_content', $blog->test_content ?? '') }}</textarea>
                </div>


                <div class="form-group mb-3">
                    <label for="tags" class="mb-1">Tags</label>
                    <input class="form-control" id="tags" name="tags" required
                        value="{{ old('tags', $blog->tags ?? '') }}" placeholder="Separate With Commas(',')" />
                </div>

                <div class="form-group mb-3">
                    <label for="created_by" class="mb-1">Created By</label>
                    <input class="form-control" id="created_by" name="created_by"
                        value="{{ old('created_by', $blog->created_by ?? '') }}" />
                </div>


                <div class="form-group mb-3">
                    <label for="meta_header" class="mb-1">Meta Header</label>
                    <input class="form-control" id="meta_header" name="meta_header"
                        value="{{ old('meta_header', $blog->meta_header ?? '') }}" />
                </div>
                <div class="form-group mb-3">
                    <label for="meta_desc" class="mb-1">Meta Description</label>
                    <textarea class="form-control" id="meta_desc" name="meta_desc" rows="3">{{ old('meta_desc', $blog->meta_desc ?? '') }}</textarea>
                </div>


                <div class="form-group mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="is_recent" value="checked"
                            @if ($editFlag && $blog['is_recent'] == 1) @checked(true) @else
                            @checked(false) @endif
                            id="is_recent" />
                        <label class="form-check-label" for="is_recent">
                            Show In Recent Blogs
                        </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">{{ $editFlag ? 'Update Blog' : 'Submit' }}</button>
            </form>
        </div>

    </div>
@endsection

