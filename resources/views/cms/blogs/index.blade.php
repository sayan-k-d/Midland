@extends('cms.layout.admin')
@section('title', 'Blogs')
@section('content')
    @php
        $columns = [
            'id' => '#',
            'title' => 'Title',
            'date' => 'Date',
            'content' => 'Content',
            'content_image' => 'Content Image',
            'intro_heading' => 'Introduction Area Heading',
            'introduction' => 'Introduction',
            'intro_image' => 'Introduction Area Image',
            'video_heading' => 'Video Area Heading',
            'video_link' => 'Video Link',
            'video_content' => 'Video Content',
            'diet_heading' => 'Diet Area Heading',
            'diet_image' => 'Diet Area Image',
            'diet_description' => 'Diet Description',
            'diet_content' => 'Diet Content',
            'diet_advice' => 'Diet Advices',
            'test_heading' => 'Tests Area Heading',
            'test_content' => 'Tests Content',
            'is_recent' => 'Show In Recent Blogs',
            'tags' => 'Tags',
            'created_by' => 'Created By',
        ];
        $wrapContent = true;
    @endphp
    <div class="mt-3 main-container dashboard-table">
        <div class="d-flex align-items-center justify-content-between admin-details">
            {{-- <h3> Department Details</h3> --}}
            <h2 class="text-center my-4 text-uppercase fw-bold flex-grow-1">Blog Details</h2>
            <div><a class="btn btn-success" href="/addBlog">Add Blogs</a></div>
        </div>

        <div class="table-responsive ">
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
                                <td class="{{ $wrapContent ?? false ? '' : 'text-nowrap' }}" style="min-width: 500px ">
                                    @if ($key == 'diet_content')
                                        @php
                                            $dietContents = explode('.', $row['diet_content']);
                                        @endphp
                                        @foreach ($dietContents as $dietContent)
                                            <p>{{ $dietContent }}</p>
                                        @endforeach
                                    @elseif ($key == 'tags')
                                        @php
                                            $tags = explode(',', $row[$key]);
                                        @endphp
                                        @foreach ($tags as $tag)
                                            <p>{{ $tag }}</p>
                                        @endforeach
                                    @elseif ($key == 'content_image' || $key == 'intro_image' || $key == 'diet_image')
                                        @if (!empty($row[$key]))
                                            <img src="{{ $row[$key] }}" alt="{{ $column }}"
                                                style="max-width: 50px; height: auto;">
                                        @else
                                            No Image
                                        @endif
                                    @elseif($key == 'is_recent')
                                        @if ($row[$key] == 1)
                                            Yes
                                        @else
                                            No
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

@endsection
