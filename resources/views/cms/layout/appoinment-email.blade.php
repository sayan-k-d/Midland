<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('\cms\commoncdn')
    <title>Appointments Details</title>
</head>

<body>
    <div class="container">
        <h2 class="text-center my-4 text-uppercase fw-bold">Appoinment Details</h2>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Email</th>
                        <th scope="col">Booking Date</th>
                        <th scope="col">Department</th>
                        <th scope="col">Doctor</th>
                        <th scope="col">Message</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $data['name'] }}</td>
                        <td>{{ $data['phone'] }}</td>
                        <td>{{ $data['email'] }}</td>
                        <td>{{ $data['booking_date'] }}</td>
                        <td>{{ $data['department'] }}</td>
                        <td>{{ $data['doctor_name'] }}</td>
                        <td>{{ $data['message'] }}</td>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
