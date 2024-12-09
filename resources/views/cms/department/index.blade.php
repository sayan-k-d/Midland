@extends('cms.layout.admin')
@section('title', 'Department')
@section('content')

    <div class="mt-3 main-container dashboard-table">
        <div class="d-flex align-items-center justify-content-between admin-details">
            {{-- <h3> Department Details</h3> --}}
            <h2 class="text-center my-4 text-uppercase fw-bold flex-grow-1">Department Details</h2>
            <div><a class="btn btn-success" href="/addDepartment">Add Department</a></div>
        </div>

        <div class="table-responsive mb-5">
            @include('\cms\layout\dashboard-table', [
                'columns' => [
                    'id' => '#',
                    'department_name' => 'Name',
                    'image' => 'Image',
                    'short_details' => 'Short Details',
                    'long_details' => 'Long Details',
                    'is_active' => 'Active',
                ],
                'data' => $departments,
                'wrapContent' => true,
                'actions' => [
                    [
                        'url' => fn($id) => "/department/edit/$id",
                        'class' => 'btn-warning',
                        'label' => 'Edit',
                    ],
                    [
                        'url' => fn($id) => "/department/delete/$id",
                        'route_name' => 'department.destroy',
                        'class' => 'btn-danger',
                        'label' => 'Delete',
                    ],
                ],
                'totalData' => $totaldepartment,
                'maxPageLimit' => $maxPageLimit,
            ])
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

    @if ($errors->has('doctorIsHead'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Cannot Delete: Head Doctor Exists',
                text: "{{ $errors->first('doctorIsHead') }}",
            });
        </script>
    @endif
@endsection
