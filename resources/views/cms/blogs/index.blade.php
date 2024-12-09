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
            'is_active' => 'Active',
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
                                    @elseif($key == 'is_active')
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
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal" title="View Details"
                                        data-row="{{ json_encode($row) }}" data-label = "Blog Details">
                                        <i class="bi bi-eye"></i>
                                    </button>
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
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 1200px">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Blog Details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="modalContent" class="card" style="transform: none">
                        <div class="card-body" id="dynamicModalContent">
                            <div class="d-flex gap-2 align-items-center">
                                <img id='blog_image' src="" width="150px" />
                                <div>
                                    <h3 id="blog_title"></h3>
                                    <div class="d-flex align-items-center gap-2">
                                        <p class="my-1 fw-bold" style="color: rgba(0,0,0,50%)" id="blog_createdby"></p>
                                        <div class="divider"></div>
                                        <p class="m-0 fw-bold" style="color: rgba(0,0,0,50%)" id="blog_date"></p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <p id="blog_desc"></p>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-lg-12">
                                    <h5>Content</h5>
                                    <div id="blog_content"></div>
                                </div>
                                <div class="col-lg-12">
                                    <h5>Tags</h5>
                                    <ul class="list-unstyled d-flex" id="blog_tags">
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const exampleModal = document.getElementById("exampleModal");

            // Helper function to append list items
            const populateList = (listElement, dataArray, hasDivider = false) => {
                dataArray.forEach((item, index) => {
                    const li = document.createElement("li");
                    li.textContent = item;
                    if (hasDivider && index < dataArray.length - 1) {
                        li.innerHTML = `${item}<div class="divider"></div>`;
                        li.classList.add("d-flex");
                    }
                    listElement.appendChild(li);
                });
            };

            exampleModal.addEventListener("show.bs.modal", (event) => {
                const button = event.relatedTarget;
                const rowData = JSON.parse(button.getAttribute("data-row"));

                // Populate image
                const image = document.getElementById("blog_image");
                image.src = rowData.image || ""; // Default to empty if no image
                image.alt = rowData.title || "No Image Available";

                // Populate text fields
                document.getElementById("blog_title").textContent = rowData.title || "N/A";
                document.getElementById("blog_createdby").textContent = rowData.created_by || "N/A";
                document.getElementById("blog_date").textContent = rowData.created_at.split("T")[0] ||
                    "N/A";
                document.getElementById("blog_desc").textContent = rowData.short_description || "N/A";

                // Populate experience
                document.getElementById("blog_content").innerHTML = rowData.content || "N/A"


                // Populate tags numbers
                const tags = document.getElementById("blog_tags");
                const tagArray = rowData.tags ? rowData.tags.split(",") : [];
                populateList(tags, tagArray, true);



                // Populate languages and degrees
                document.getElementById("dr_languages").textContent = rowData.languages || "N/A";
                document.getElementById("dr_degrees").textContent = rowData.degree || "N/A";
            });

            exampleModal.addEventListener("hide.bs.modal", () => {
                // Clear all dynamic content
                document.getElementById("blog_title").textContent = "";
                document.getElementById("blog_createdby").textContent = "";
                document.getElementById("blog_date").textContent = "";
                document.getElementById("blog_desc").textContent = "";
                document.getElementById("blog_content").innerHTML = "";

                // Clear lists
                const clearList = (elementId) => {
                    const element = document.getElementById(elementId);
                    while (element.firstChild) {
                        element.removeChild(element.firstChild);
                    }
                };

                clearList("blog_tags");

                // Reset image
                const image = document.getElementById("blog_image");
                image.src = "";
                image.alt = "";
            });
        });
    </script>
@endsection
