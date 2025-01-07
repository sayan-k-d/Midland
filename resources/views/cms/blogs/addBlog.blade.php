@extends('cms.layout.admin')
@section('title', 'Add Blog')
@section('content')
    <div class="content main-container">
        <div class="container">
            <div class="page-header mb-4">
                <h3 class="page-title">{{ $editFlag ? 'Edit Blog Details' : 'Add Blog Details' }}</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active">{{ $editFlag ? 'Edit Blog' : 'Add Blog' }}</li>
                </ul>
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
            <form action="{{ $editFlag ? route('blog.update', $blog->id) : route('blog.store') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @if ($editFlag)
                    @method('PUT') <!-- Use PUT method for update -->
                @endif

                <!-- Title -->
                <div class="form-group mb-3">
                    <label for="title" class="mb-1">Title</label>
                    <input type="text" class="form-control" id="title" name="title"
                        value="{{ old('title', $blog->title ?? '') }}" required>
                </div>

                <!-- CKEditor Fields -->
                <div class="form-group mb-3">
                    <label for="content" class="mb-1">Content</label>
                    <textarea class="form-control" id="content" name="content">{{ old('content', $blog->content ?? '') }}</textarea>
                </div>


                <div class="form-group mb-3">
                    <label for="short_description" class="mb-1">Short Description</label>
                    <textarea class="form-control" id="short_description" name="short_description" rows="3" required>{{ old('short_description', $blog->short_description ?? '') }}</textarea>
                </div>


                <div class="form-group mb-3">
                    <label for="slug" class="mb-1">Slug</label>
                    <input class="form-control" id="slug" name="slug" type="text"
                        value="{{ old('slug', $blog->slug ?? '') }}" />
                </div>


                <div class="form-group mb-3">
                    <label for="tags" class="mb-1">Tags</label>
                    <input class="form-control" id="tags" name="tags" value="{{ old('tags', $blog->tags ?? '') }}"
                        placeholder="Separate With Commas(',')" />
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="created_by" class="mb-1">Created By</label>
                            <input class="form-control" id="created_by" name="created_by"
                                value="{{ old('created_by', $blog->created_by ?? $user->name) }}" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="is_active" class="form-label mb-1">Active</label>
                            <select name="is_active" id="is_active" class="form-control" required>
                                <option value="1"
                                    {{ old('is_active', $editFlag ? $blog->is_active : '') == '1' ? 'selected' : '' }}>
                                    Yes
                                </option>
                                <option value="0"
                                    {{ old('is_active', $editFlag ? $blog->is_active : '') == '0' ? 'selected' : '' }}>No
                                </option>
                            </select>
                            @error('is_active')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="image" class="mb-1">Blog Image</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*" />
                            <small class="form-text text-muted">Please upload an image with a size of up to 2MB and Dimension of 600 x 400
                            </small>
                            @if ($editFlag && $blog->image)
                                <div class="mt-2">
                                    <img src="{{ $blog->image }}" alt="blog image" width="100">
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="innerImage" class="mb-1">Blog Inner Banner Image</label>
                            <input type="file" class="form-control" id="innerImage" name="innerImage" accept="image/*">
                            <small class="form-text text-muted">Please upload an image with a size of up to 5MB and Dimension of 1920 x 1080
                            </small>
                            @if ($editFlag && $blog->innerImage)
                                <div class="mt-2">
                                    <img src="{{ $blog->innerImage }}" alt="Blog Banner Image"
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
                    <label for="meta_header" class="mb-1">Meta Header</label>
                    <input class="form-control" id="meta_header" name="meta_header"
                        value="{{ old('meta_header', $blog->meta_header ?? '') }}" />
                </div>
                <div class="form-group mb-3">
                    <label for="meta_desc" class="mb-1">Meta Description</label>
                    <textarea class="form-control" id="meta_desc" name="meta_desc" rows="3">{{ old('meta_desc', $blog->meta_desc ?? '') }}</textarea>
                </div>
                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">{{ $editFlag ? 'Update Blog' : 'Submit' }}</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Initialize CKEditor
        ClassicEditor
            .create(document.querySelector('#content'), {
                ckfinder: {
                    uploadUrl: '{{ route('ckeditor.upload') }}?_token={{ csrf_token() }}',
                },
                mediaEmbed: {
                    previewsInData: true,
                    providers: [{
                        name: 'youtube',
                        url: /^(?:https:\/\/)?(?:www\.)?(youtube\.com|youtu\.be)\/.+/,
                        html: match => {
                            const url = new URL(match[0]);

                            // Extract video ID based on the URL type
                            let id = null;
                            if (url.hostname === 'youtu.be') {
                                id = url.pathname.slice(1);
                            } else if (url.hostname === 'www.youtube.com' || url.hostname ===
                                'youtube.com') {
                                // Standard YouTube URL with possible query parameters
                                id = url.searchParams.get('v');
                                if (!id) {
                                    id = url.pathname.split('/').pop();
                                }
                            }

                            return (
                                `<div class="embed-responsive embed-responsive-16by9" style="position:relative;padding-bottom:45%;height:0;overflow:hidden;">` +
                                `<iframe src="https://www.youtube.com/embed/${id}" ` +
                                `style="position:absolute;top:0;left:0;width:816px;height:459px;" ` +
                                `frameborder="0" allowfullscreen></iframe>` +
                                `</div>`
                            );
                        }
                    }]
                }
            })
            .catch(error => console.error(error));
    </script>
@endsection
