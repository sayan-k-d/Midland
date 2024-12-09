@extends('cms.layout.admin')
@section('title', 'Department')
@section('content')
    @php
        $columns = [
            'id' => '#',
            'doctor_name' => 'Name',
            'phone' => 'Phone',
            'email' => 'Email',
            'image' => 'Image',
            // 'doctor_post' => 'Post',
            'department' => 'Department',
            // 'biography' => 'Biography',
            // 'education' => 'Education',
            'experience' => 'Experience',
            // 'languages' => 'Languages',
            // 'workingSchedules' => 'Working Hours',
            'degree' => 'Degree',
            'is_active' => 'Active',
            // 'isHead' => 'Head of the Department',
        ];

    @endphp
    <div class="mt-3 main-container dashboard-table">
        <div class="d-flex align-items-center justify-content-between admin-details">
            {{-- <h3> Department Details</h3> --}}
            <h2 class="text-center my-4 text-uppercase fw-bold flex-grow-1">Doctor Details</h2>
            <div><a class="btn btn-success" href="/addDoctor">Add Doctor</a></div>
        </div>

        <div class="table-responsive mb-5">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        @foreach ($columns as $column)
                            <th scope="col" class="{{ $wrapContent ?? false ? '' : 'text-nowrap' }}">{{ $column }}
                            </th>
                        @endforeach
                        <th scope="col" class="text-center ">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($doctors as $row)
                        <tr>
                            @foreach ($columns as $key => $column)
                                <td class="{{ $wrapContent ?? false || $key != 'department' ? '' : 'text-nowrap' }}"
                                    style="@if ($key == 'biography') display: block; min-width:400px; @endif">
                                    @if (strtolower($column) == 'phone')
                                        @php
                                            $phones = explode(',', $row['phone']);
                                        @endphp
                                        @foreach ($phones as $phone)
                                            <p>{{ $phone }}</p>
                                        @endforeach
                                        {{-- @elseif(strtolower($column) == 'department')
                                        @foreach ($departments as $department)
                                            @if ($department->id == $row['department'])
                                                {{ $department->department_name }}
                                            @endif
                                        @endforeach --}}
                                        {{-- @elseif (strtolower($column) == 'education')
                                        @php
                                            $educations = explode(',', $row[$key]);
                                        @endphp
                                        @foreach ($educations as $education)
                                            <p>{{ $education }}</p>
                                        @endforeach --}}
                                        {{-- @elseif($key == 'workingSchedules')
                                        @php
                                            $schedules = explode(',', $row[$key]);
                                        @endphp
                                        @foreach ($schedules as $schedule)
                                            <p>{{ $schedule }}</p>
                                        @endforeach --}}
                                    @elseif (strtolower($column) == 'image')
                                        @if (!empty($row[$key]))
                                            <img src="{{ $row[$key] }}" alt="Department Image"
                                                style="max-width: 50px; height: auto;">
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
                                        data-row="{{ json_encode($row) }}" data-label = "Doctor Details">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <a href="/doctors/edit/{{ $row['id'] }}" class="btn btn-warning text-uppercase">
                                        Edit
                                    </a>
                                    <form action="/doctors/delete/{{ $row['id'] }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this doctor?');">
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
            @if ($totalDoctors > $maxPageLimit)
                <div class="text-center pagination-container">
                    {{ $doctors->links() }}
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
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Doctor Details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="modalContent" class="card" style="transform: none">
                        <div class="card-body" id="dynamicModalContent">
                            <div class="d-flex gap-2 align-items-center">
                                <img id='dr_image' src="" width="150px" />
                                <div>
                                    <h3 id="dr_name"></h3>
                                    <p class="my-1 fw-bold" style="color: rgba(0,0,0,50%)" id="dr_department"></p>
                                    <div class="d-flex gap-2 align-items-center color-40">
                                        <i class="bi bi-envelope fs-5"></i>
                                        <p class="m-0" id="dr_email"></p>
                                    </div>
                                    <div class="d-flex gap-2 color-40">
                                        <i class="bi bi-telephone fs-5"></i>
                                        <ul class="list-unstyled d-flex" id="dr_phone"></ul>
                                        {{-- <p class="m-0" id="dr_phone"></p> --}}
                                    </div>
                                    <p class="m-0 color-40" id="dr_experience"></p>
                                </div>
                            </div>
                            <div>
                                <p id="dr_bio"></p>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <h5>Education</h5>
                                    <ul class="list-unstyled d-flex" id="dr_education">
                                    </ul>
                                </div>
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h5>Head of Department</h5>
                                            <p id="dr_hod"></p>
                                        </div>
                                        <div class="col-lg-6">
                                            <h5>Degrees</h5>
                                            <p id="dr_degrees"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12" id="schedules">
                                    <h5 class="mb-3">Working Schedules</h5>
                                    <ul class="list-unstyled" id="dr_schedules">
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
                const image = document.getElementById("dr_image");
                image.src = rowData.image || ""; // Default to empty if no image
                image.alt = rowData.doctor_name || "No Image Available";

                // Populate text fields
                document.getElementById("dr_name").textContent = rowData.doctor_name || "N/A";
                document.getElementById("dr_email").textContent = rowData.email || "N/A";
                document.getElementById("dr_department").textContent = rowData.department || "N/A";
                document.getElementById("dr_bio").textContent = rowData.biography || "N/A";

                // Populate experience
                const experience = document.getElementById("dr_experience");
                experience.innerHTML = `<b>${rowData.experience || 0} Years+</b> of Experience`;

                // Populate phone numbers
                const phone = document.getElementById("dr_phone");
                const phoneArray = rowData.phone ? rowData.phone.split(",") : [];
                populateList(phone, phoneArray, true);

                // Populate education
                const education = document.getElementById("dr_education");
                const educationArray = rowData.education ? rowData.education.split(",") : [];
                populateList(education, educationArray, true);

                // Populate schedules
                const scheduleArray = rowData.workingSchedules ?
                    rowData.workingSchedules.split(",").map((item) => item.split("=")) : [];
                const schedulesArea = document.getElementById("schedules");
                if (scheduleArray.length > 0) {
                    schedulesArea.style.display = "block";
                    const schedules = document.getElementById("dr_schedules");
                    scheduleArray.forEach((item, index) => {
                        const li = document.createElement("li");
                        li.innerHTML = `<div>${item[0]}</div><div>${item[1]} hours</div>`;
                        li.classList.add("d-flex", "justify-content-between");
                        schedules.appendChild(li);
                        if (index < scheduleArray.length - 1) {
                            schedules.appendChild(document.createElement("hr"));
                        }
                    });
                } else {
                    schedulesArea.style.display = "none";
                }

                // Populate languages and degrees
                document.getElementById("dr_hod").textContent = rowData.isHead ? "Yes" : "No";
                document.getElementById("dr_degrees").textContent = rowData.degree || "N/A";
            });

            exampleModal.addEventListener("hide.bs.modal", () => {
                // Clear all dynamic content
                document.getElementById("dr_name").textContent = "";
                document.getElementById("dr_email").textContent = "";
                document.getElementById("dr_department").textContent = "";
                document.getElementById("dr_bio").textContent = "";
                document.getElementById("dr_experience").innerHTML = "";
                document.getElementById("dr_hod").textContent = "";
                document.getElementById("dr_degrees").textContent = "";

                // Clear lists
                const clearList = (elementId) => {
                    const element = document.getElementById(elementId);
                    while (element.firstChild) {
                        element.removeChild(element.firstChild);
                    }
                };

                clearList("dr_phone");
                clearList("dr_education");
                clearList("dr_schedules");

                // Reset image
                const image = document.getElementById("dr_image");
                image.src = "";
                image.alt = "";
            });
        });
    </script>
@endsection
