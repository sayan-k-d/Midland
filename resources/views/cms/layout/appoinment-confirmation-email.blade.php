<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Confirmed</title>
</head>

<body
    style="font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;">
    <div class="email-container"
        style=" max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;">
        <div class="header"
            style="text-align: center;
            background: #4CAF50;
            color: white;
            padding: 10px 0;
            border-radius: 8px 8px 0 0;">
            <h1>Appointment Confirmed</h1>
        </div>
        <div class="body" style="padding: 20px;
            color: #333;">
            <p>Dear <strong>{{ $data['name'] }}</strong>,</p>
            <p>Thank you for booking an appointment with us! Here are your appointment details:</p>
            <ul>
                <li><strong>Date:</strong> {{ $data['booking_date'] }}</li>
                <li><strong>Doctor:</strong> {{ $data['doctor_name'] }}</li>
                <li><strong>Location: </strong>Mandir Marg, Mahanagar Lucknow, U.P.</li>
            </ul>
            <p>If you have any questions or need to reschedule, feel free to contact us.</p>
            <p>
                Our contact:
            <ul>
                <li><strong>Email: </strong><a class="email" style="text-decoration: none;
            color: #113366"
                        href="mailto:info.midlandhealthcare@gmail.com">info.midlandhealthcare@gmail.com</a></li>
                <li><strong>Mobile: </strong>0522-4655555 || 8004024365 || 0522-4042888</li>
            </ul>
            </p>
            <p>We look forward to seeing you!</p>
        </div>
        <div class="footer"
            style=" text-align: center;
            padding: 10px 0;
            font-size: 12px;
            color: #999;">
            <p>&copy; {{ date('Y') }} Midland Healthcare. All Rights Reserved.</p>
        </div>
    </div>
</body>

</html>
