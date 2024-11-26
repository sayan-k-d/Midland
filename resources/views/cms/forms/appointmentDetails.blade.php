@extends('cms.layout.admin')
@section('title', 'Appointment Details')
@section('content')

<div class="mt-3 main-container dashboard-table">
    <div class="d-flex align-items-center justify-content-between admin-details">
        {{-- <h3> Department Details</h3> --}}
        <h2 class="text-center my-4 text-uppercase fw-bold flex-grow-1">Appoinment Details</h2>

    </div>

            <div class="table-responsive">
                @include('\cms\layout\dashboard-table', [
                    'columns' => [
                        'id' => '#',
                        'name' => 'Name',
                        'phone' => 'Phone',
                        'email' => 'Email',
                        'booking_date' => 'Booking Date',
                        'department' => 'Department',
                        'doctor_name' => 'Doctor',
                        'message' => 'Message',
                    ],
                    'data' => $appoinments,
                    'actions' => [
                        [
                            'url' => fn($id) => "/edit/$id",
                            'class' => 'btn-warning',
                            'label' => 'Edit',
                        ],
                        [
                            'url' => fn($id) => "/delete/$id",
                            'route_name' => '',
                            'class' => 'btn-danger',
                            'label' => 'Delele',
                        ],
                    ],
                    'totalData' => $totalAppoinments,
                    'maxPageLimit' => $maxPageLimit,
                ])
            </div>
</div>
@endsection
