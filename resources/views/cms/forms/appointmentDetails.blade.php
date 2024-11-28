@extends('cms.layout.admin')
@section('title', 'Appointment Details')
@section('content')

<div class="mt-3 main-container dashboard-table">
    <div class="d-flex align-items-center justify-content-between admin-details">
        {{-- <h3> Department Details</h3> --}}
        <h2 class="text-center my-4 text-uppercase fw-bold flex-grow-1">Appoinment Details</h2>

    </div>

            <div class="table-responsive mb-5">
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
                            'url' => fn($id) => "/editReschedule/$id",
                            'class' => 'btn-warning',
                            'label' => 'Reschedule',
                        ],
                        [
                            'url' => fn($id) => "/appointments/delete/$id",
                            'route_name' => 'appointment.destroy',
                            'class' => 'btn-danger',
                            'label' => 'Delete',
                        ],
                    ],
                    'totalData' => $totalAppoinments,
                    'maxPageLimit' => $maxPageLimit,
                ])
            </div>
</div>
@endsection
