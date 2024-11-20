<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('\cms\commoncdn')
    <link rel="stylesheet" href="cms/assets/css/dashboard.css" />
    <title>Document</title>
</head>

<body>
    @include('\cms\layout\dashboard-nav')
    <div class="d-flex min-vh-100">
        <div id="sidebar" class="side-menu bg-dark">
            <div class="menu-header d-flex align-items-center justify-content-between px-3">
                <span class="text-white fs-5 menu-header-text">Dashboard</span>
                <button class="btn btn-sm btn-light slider-button" onclick="toggleSidebar()">
                    <i class="bi bi-caret-left-fill"></i>
                </button>
            </div>
            <ul class="nav flex-column py-2">
                <li class="nav-item">
                    <a href="#" class="nav-link text-white d-flex align-items-center" data-bs-toggle="tooltip"
                        data-bs-placement="right" data-bs-title="Appoinment Details">
                        <i class="bi bi-calendar-week fs-4 menu-icon"></i>
                        <span class="ms-2 menu-text">Appoinment Details</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link text-white d-flex align-items-center" data-bs-toggle="tooltip"
                        data-bs-placement="right" data-bs-title="Contact Details">
                        <i class="bi bi-people fs-4 menu-icon"></i>
                        <span class="ms-2 menu-text">Contact Details</span>
                    </a>
                </li>
                <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Email Control">
                    <a href="#" class="nav-link text-white d-flex align-items-center" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        <i class="bi bi-envelope-plus fs-4 menu-icon"></i>
                        <span class="ms-2 menu-text">Email Control</span>
                    </a>

                </li>
            </ul>
        </div>

        <div class="container mt-3 main-container">
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
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Enter Email</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('setemail') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email address</label>
                            <input type="email" class="form-control" name="recieverEmail" id="exampleInputEmail1"
                                aria-describedby="emailHelp">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('cms/assets/js/dashboard.js') }}"></script>
</body>

</html>
