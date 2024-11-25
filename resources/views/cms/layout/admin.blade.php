<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('\cms\commoncdn')
    <link rel="stylesheet" href="cms/assets/css/dashboard.css" />
    <link rel="stylesheet" href="cms/assets/css/style2.css" />
    <title>Midland CMS</title>
</head>
<body>
    @include('\cms\layout\dashboard-nav')
        <div id="sidebar" class="side-menu bg-dark">
            <div class="menu-header sticky-top d-flex align-items-center justify-content-between px-3">
                <span class="text-white fs-5 menu-header-text">Dashboard</span>
                <button class="btn btn-sm btn-light slider-button" onclick="toggleSidebar()">
                    <i class="bi bi-caret-left-fill"></i>
                </button>
            </div>
            <ul class="nav flex-column py-2">
                <li class="nav-item">
                    <a href="{{ route('appointmentDetails') }}" class="nav-link text-white d-flex align-items-center" data-bs-toggle="tooltip"
                        data-bs-placement="right" data-bs-title="Appoinment Details">
                        <i class="bi bi-calendar-week fs-4 menu-icon"></i>
                        <span class="ms-2 menu-text">Appoinment Details</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('contactDetails') }}" class="nav-link text-white d-flex align-items-center" data-bs-toggle="tooltip"
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
                <li class="nav-item">
                    <a href="{{ route('departmentDetails') }}" class="nav-link text-white d-flex align-items-center" data-bs-toggle="tooltip"
                        data-bs-placement="right" data-bs-title="Contact Details">
                        <i class="bi bi-people fs-4 menu-icon"></i>
                        <span class="ms-2 menu-text">Department Details</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('serviceDetails') }}" class="nav-link text-white d-flex align-items-center" data-bs-toggle="tooltip"
                        data-bs-placement="right" data-bs-title="Contact Details">
                        <i class="bi bi-people fs-4 menu-icon"></i>
                        <span class="ms-2 menu-text">Service Details</span>
                    </a>
                </li>
                
            </ul>
        </div>

@yield('content')

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Enter Reciever Email</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('setemail') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" name="receiverEmail" id="exampleInputEmail1"
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