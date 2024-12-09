<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enquiry Details</title>
</head>

<body style="font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;">
    <h1>Appointment Details</h1>
    <p>You have received a new enquiry with the following details:</p>
    <table
        style="width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            border: 1px solid #ddd;">
        <tr>
            <th style="border: 1px solid #ddd;  padding: 10px;
            text-align: left; background-color: #f4f4f4;">
                Name</th>
            <td style="border: 1px solid #ddd;  padding: 10px;
            text-align: left;">{{ $data['name'] }}</td>
        </tr>
        <tr>
            <th style="border: 1px solid #ddd;  padding: 10px;
            text-align: left; background-color: #f4f4f4;">
                Phone</th>
            <td style="border: 1px solid #ddd;  padding: 10px;
            text-align: left;">{{ $data['phone'] }}</td>
        </tr>
        <tr>
            <th
                style="border: 1px solid #ddd;  padding: 10px;
            text-align: left; background-color: #f4f4f4;">
                Email</th>
            <td style="border: 1px solid #ddd;  padding: 10px;
            text-align: left;">{{ $data['email'] }}</td>
        </tr>
        <tr>
            <th
                style="border: 1px solid #ddd;  padding: 10px;
            text-align: left; background-color: #f4f4f4;">
                Booking Date</th>
            <td style="border: 1px solid #ddd;  padding: 10px;
            text-align: left;">
                {{ $data['booking_date'] }}</td>
        </tr>
        <tr>
            <th
                style="border: 1px solid #ddd;  padding: 10px;
            text-align: left; background-color: #f4f4f4;">
                Department</th>
            <td style="border: 1px solid #ddd;  padding: 10px;
            text-align: left;">{{ $data['department'] }}
            </td>
        </tr>
        <tr>
            <th
                style="border: 1px solid #ddd;  padding: 10px;
            text-align: left; background-color: #f4f4f4;">
                Doctor</th>
            <td style="border: 1px solid #ddd;  padding: 10px;
            text-align: left;">{{ $data['doctor_name'] }}
            </td>
        </tr>
        <tr>
            <th
                style="border: 1px solid #ddd;  padding: 10px;
            text-align: left; background-color: #f4f4f4;">
                Message</th>
            <td style="border: 1px solid #ddd;  padding: 10px;
            text-align: left;">{{ $data['message'] }}
            </td>
        </tr>
    </table>
    <p>Please review the enquiry and take the necessary action.</p>
    <footer>
        <p>&copy; {{ date('Y') }} Your Clinic Name. All rights reserved.</p>
    </footer>
</body>

</html>
