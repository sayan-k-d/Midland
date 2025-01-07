@extends('cms.layout.admin')
@section('title', 'Service')
@section('content')

    <div class="mt-3 main-container dashboard-table">
        <div class="d-flex align-items-center justify-content-between admin-details">
            {{-- <h3> service Details</h3> --}}
            <h2 class="text-center my-4 text-uppercase fw-bold flex-grow-1">Service Details</h2>
            <div><a class="btn btn-success" href="{{ route('addservice') }}">Add Service</a></div>
        </div>

        <div class="table-responsive mb-5">
            @include('cms.layout.dashboard-table', [
                'columns' => [
                    'id' => '#',
                    'service_name' => 'Name',
                    'image' => 'Image',
                    'short_details' => 'Short Details',
                    'long_details' => 'Long Details',
                    'is_active' => 'Active',
                ],
                'data' => $services,
                'wrapContent' => true,
                'actions' => [
                    [
                        'url' => fn($id) => route('editServices', ['id' => $id]),
                        'class' => 'btn-warning',
                        'label' => 'Edit',
                    ],
                    [
                        'url' => fn($id) => route('service.destroy', ['id' => $id]),
                        'route_name' => 'service.destroy',
                        'class' => 'btn-danger',
                        'label' => 'Delete',
                    ],
                ],
                'totalData' => $totalservice,
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
    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: '{{ session('alertTitle') ?? 'Error' }}',
                text: '{{ session('error') }}',
            });
        </script>
    @endif
@endsection
