@extends('cms.layout.admin')
@section('title', 'Dashboard')
@section('content')

        <div class="mt-3 main-container">
            <div class="d-flex align-items-center justify-content-between admin-details">
                <div class="admin-avatar">
                    <img src="\assets\img\avatartest.svg" alt="avatar" />
                </div>
                <div class="admin-data">
                    <div class="d-flex align-items-center gap-3 justify-content-evenly my-2">
                        <label class="">
                            <h4>Name</h4>
                        </label>
                        <div class="data-rows">
                            <h5>{{ $admin ? $admin->name : 'N/A' }}</h5>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-3 justify-content-evenly my-2">
                        <label class="">
                            <h4>Phone</h4>
                        </label>
                        <div class="data-rows">
                            <h5>{{ $admin ? $admin->phone : 'N/A' }}</h5>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-3 justify-content-evenly my-2">
                        <label class="">
                            <h4>Email</h4>
                        </label>
                        <div class="data-rows">
                            <h5>{{ $admin ? $admin->email : 'N/A' }}</h5>
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-3 justify-content-evenly my-2">
                        <label class="">
                            <h4>Role</h4>
                        </label>
                        <div class="data-rows">
                            <h5>{{ $admin ? $admin->role : 'N/A' }}</h5>
                        </div>
                    </div>
                </div>
                <div class="calendar-container">
                    <iframe
                        src="https://calendar.google.com/calendar/embed?src=d0bfe33165c2dd9d206426f7ace120071d4934ea1f80387dfef5af0aa3b27a0d%40group.calendar.google.com&ctz=Asia%2FKolkata"
                        style="border: 0" frameborder="0" scrolling="no"></iframe>
                </div>
            </div>

            <h2 class="text-center my-4 text-uppercase fw-bold">Appoinment Details</h2>
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
                            'class' => 'btn-danger',
                            'label' => 'Delete',
                        ],
                    ],
                    'totalData' => $totalAppoinments,
                    'maxPageLimit' => $maxPageLimit,
                ])
            </div>
            <h2 class="text-center my-4 text-uppercase fw-bold">Contact Details</h2>
            <div class="table-responsive">
                @include('\cms\layout\dashboard-table', [
                    'columns' => [
                        'id' => '#',
                        'name' => 'Name',
                        'phone' => 'Phone',
                        'email' => 'Email',
                        'subject' => 'Subject',
                        'message' => 'Message',
                    ],
                    'data' => $contactData,
                    'actions' => [
                        [
                            'url' => fn($id) => "/edit/$id",
                            'class' => 'btn-warning',
                            'label' => 'Edit',
                        ],
                        [
                            'url' => fn($id) => "/delete/$id",
                            'class' => 'btn-danger',
                            'label' => 'Delete',
                        ],
                    ],
                    'totalData' => $totalContacts,
                    'maxPageLimit' => $maxPageLimit,
                ])
            </div>
        </div>
        
   

@endsection
