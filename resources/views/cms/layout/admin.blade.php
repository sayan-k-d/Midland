<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('\cms\commoncdn')
    <link rel="stylesheet" href="{{ asset('cms/assets/css/dashboard.css') }}" />
    <link rel="stylesheet" href="{{ asset('cms/assets/css/style2.css') }}" />
    <title>Midland CMS</title>
    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
</head>

<body>
    @include('\cms\layout\dashboard-nav')
    <div id="sidebar" class="side-menu bg-dark">
        <div class="menu-header sticky-top d-flex align-items-center justify-content-between px-3">
            <a class="nav-link text-white d-flex align-items-center" href="{{ route('dashboard') }}">
                <span class="text-white fs-5 menu-header-text">Dashboard</span>
            </a>
            <button class="btn btn-sm btn-light slider-button" onclick="toggleSidebar()">
                <i class="bi bi-caret-left-fill"></i>
            </button>
        </div>
        <ul class="nav flex-column py-2">
            @if (Auth::check() && Auth::user()->role_id == '1')
                <!-- Check if the user is logged in and is an admin -->
                <li class="nav-item">
                    <a href="{{ route('register') }}" class="nav-link text-white d-flex align-items-center"
                        data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Appointment Details">
                        <i class="bi bi-person-plus fs-4 menu-icon"></i>
                        <span class="ms-2 menu-text">Register User</span>
                    </a>
                </li>
                <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Email Control">
                    <a href="{{ route('setemail') }}" class="nav-link text-white d-flex align-items-center">
                        <i class="bi bi-envelope-plus fs-4 menu-icon"></i>
                        <span class="ms-2 menu-text">Email Control</span>
                    </a>
                </li>
            @endif
            <li class="nav-item">
                <a href="{{ route('appointmentDetails') }}" class="nav-link text-white d-flex align-items-center"
                    data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Appoinment Details">
                    <i class="bi bi-calendar-week fs-4 menu-icon"></i>
                    <span class="ms-2 menu-text">Appoinment Details</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('contactDetails') }}" class="nav-link text-white d-flex align-items-center"
                    data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Contact Details">
                    <i class="bi bi-people fs-4 menu-icon"></i>
                    <span class="ms-2 menu-text">Contact Details</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('departmentDetails') }}" class="nav-link text-white d-flex align-items-center"
                    data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Department Details">
                    <i class="bi bi-diagram-3 fs-4 menu-icon"></i>
                    <span class="ms-2 menu-text">Department Details</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('serviceDetails') }}" class="nav-link text-white d-flex align-items-center"
                    data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Service Details">
                    <i class="bi bi-headset fs-4 menu-icon"></i>
                    <span class="ms-2 menu-text">Service Details</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('doctorDetails') }}" class="nav-link text-white d-flex align-items-center"
                    data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Doctor Details">
                    <i class="bi bi-person-badge fs-4 menu-icon"></i>
                    <span class="ms-2 menu-text">Doctor Details</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('blogDetails') }}" class="nav-link text-white d-flex align-items-center"
                    data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Blog Details">
                    <i class="bi bi-journal-richtext fs-4 menu-icon"></i>
                    <span class="ms-2 menu-text">Blog Details</span>
                </a>
            </li>
        </ul>
    </div>

    @yield('content')
    @yield('scripts')
    <script src="{{ asset('cms/assets/js/dashboard.js') }}"></script>
</body>

</html>
