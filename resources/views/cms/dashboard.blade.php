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
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="/dashboard">
                <img src="/assets/img/logo.webp" style="width: 150px" alt="Logo" class="logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Settings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-3">
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
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Email</th>
                        <th scope="col">Booking Date</th>
                        <th scope="col">Department</th>
                        <th scope="col">Doctor</th>
                        <th scope="col">Message</th>
                        <th scope="col" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($appoinments as $appoinment)
                        <tr>
                            <th scope="row">{{ $appoinment['id'] }}</th>
                            <td>{{ $appoinment['name'] }}</td>
                            <td>{{ $appoinment['phone'] }}</td>
                            <td>{{ $appoinment['email'] }}</td>
                            <td>{{ $appoinment['booking_date'] }}</td>
                            <td>{{ $appoinment['department'] }}</td>
                            <td>{{ $appoinment['doctor_name'] }}</td>
                            <td>{{ $appoinment['message'] }}</td>
                            <td class="text-center">
                                <a href="/edit/{{ $appoinment['id'] }}" class="btn btn-warning text-uppercase">Edit</a>
                                <a href="/delete/{{ $appoinment['id'] }}" class="btn btn-danger text-uppercase">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if ($totalAppoinments > $maxPageLimit)
                <div class="text-center pagination-container">
                    {{ $appoinments->links() }}
                </div>
            @endif
        </div>
        <h2 class="text-center my-4 text-uppercase fw-bold">Contact Details</h2>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Email</th>
                        <th scope="col">Subject</th>
                        <th scope="col">Message</th>
                        <th scope="col" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contactData as $contact)
                        <tr>
                            <th scope="row">{{ $contact['id'] }}</th>
                            <td>{{ $contact['name'] }}</td>
                            <td>{{ $contact['phone'] }}</td>
                            <td>{{ $contact['email'] }}</td>
                            <td>{{ $contact['subject'] }}</td>
                            <td>{{ $contact['message'] }}</td>
                            <td class="text-center">
                                <a href="/edit/{{ $contact['id'] }}" class="btn btn-warning text-uppercase">Edit</a>
                                <a href="/delete/{{ $contact['id'] }}" class="btn btn-danger text-uppercase">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if ($totalContacts > $maxPageLimit)
                <div class="text-center pagination-container">
                    {{ $contactData->links() }}
                </div>
            @endif
        </div>
    </div>
</body>

</html>
