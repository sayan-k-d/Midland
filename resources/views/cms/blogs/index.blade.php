@extends('cms.layout.admin')
@section('title', 'Blogs')
@section('content')
    @php
        $columns = [
            'id' => '#',
            'title' => 'Title',
            // 'content' => 'Content',
            'image' => 'Image',
            'created_at' => 'Date',
            // 'short_description' => 'Short Description',
            'created_by' => 'Created By',
            // 'tags' => 'Tags',
            // 'slug' => 'Slug',
        ];
        $wrapContent = true;
    @endphp
    <div class="mt-3 main-container dashboard-table">
        <div class="d-flex align-items-center justify-content-between admin-details">
            {{-- <h3> Department Details</h3> --}}
            <h2 class="text-center my-4 text-uppercase fw-bold flex-grow-1">Blog Details</h2>
            <div><a class="btn btn-success" href="/addBlog">Add Blogs</a></div>
        </div>

        <div class="table-responsive mb-5">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        @foreach ($columns as $column)
                            <th scope="col" class="{{ $wrapHeaderContent ?? false ? '' : 'text-nowrap' }}">
                                {{ $column }}
                            </th>
                        @endforeach
                        <th scope="col" class="text-center ">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($blogs as $row)
                        <tr>
                            @foreach ($columns as $key => $column)
                                <td class="{{ $wrapContent ?? false ? '' : 'text-nowrap' }}"
                                    style="max-height: 500px; overflow: auto; @if ($key == 'content') display: block; @endif">
                                    {{-- @if ($key == 'tags')
                                        @php
                                            $tags = explode(',', $row[$key]);
                                        @endphp
                                        @foreach ($tags as $tag)
                                            <p>{{ $tag }}</p>
                                        @endforeach --}}
                                    @if ($key == 'image')
                                        @if (!empty($row[$key]))
                                            <img src="{{ $row[$key] }}" alt="{{ $column }}"
                                                style="max-width: 100px; height: auto;">
                                        @else
                                            No Image
                                        @endif
                                    @else
                                        {{ $row[$key] ?? 'N/A' }}
                                    @endif
                                </td>
                                {{-- <!-- <td class="text-nowrap">{{ $row[$key] ?? 'N/A' }}</td> --> --}}
                            @endforeach

                            <td class="text-center">
                                <div class="d-flex gap-2 justify-content-center">
                                    <a href="/blogs/edit/{{ $row['id'] }}" class="btn btn-warning text-uppercase">
                                        Edit
                                    </a>
                                    <form action="/blogs/delete/{{ $row['id'] }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this blog?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger text-uppercase">
                                            Delete
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if ($totalBlogs > $maxPageLimit)
                <div class="text-center pagination-container">
                    {{ $blogs->links() }}
                </div>
            @endif
        </div>

    </div>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @endif

@endsection
