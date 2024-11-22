@extends('cms.layout.admin')
@section('title', 'Service')
@section('content')

    <div class="mt-3 main-container">
        <div class="d-flex align-items-center justify-content-between admin-details">
            {{-- <h3> service Details</h3> --}}
            <h2 class="text-center my-4 text-uppercase fw-bold flex-grow-1">Service Details</h2>
            <div><a class="btn btn-success" href="/addService">Add Service</a></div>
        </div>

        <div class="table-responsive">
            @include('\cms\layout\dashboard-table', [
                'columns' => [
                    'id' => '#',
                    'service_name' => 'Name',
                    'image' => 'Image',
                    'short_details' => 'Short Details',
                    'long_details' => 'Long Details',
                ],
                'data' => $services,
                'wrapContent' => true,
                'actions' => [
                    [
                        'url' => fn($id) => "services/edit/$id",
                        'class' => 'btn-warning',
                        'label' => 'Edit',
                    ],
                    [
                        'url' => fn($id) => "services/delete/$id",
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



@endsection