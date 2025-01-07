<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('public/cms/assets/css/login.css') }}">
</head>

<body>
    <div class="header">
        WELCOME TO THE MIDLAND HEALTHCARE ADMIN PORTAL
    </div>
    <!-- Sub-Header Section -->
    <div class="sub-header">
        © 2024 Midland Healthcare. All rights reserved.
    </div>
    <div class="form-container">
        <h2>Login</h2>
        @if (session('throttle_time') && now()->timestamp < session('throttle_time'))
            @php
                $remainingTime = session('throttle_time') - now()->timestamp;
            @endphp
            <div class="timer error-message" id="timer">
                Too many login attempts. Please wait for <span id="time">{{ $remainingTime }}</span>
                seconds.
            </div>
        @elseif ($errors->any())
            <div class="error-message" id="error-message">
                {{ $errors->first() }}
            </div>
        @endif
        @if (session('error'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: '{{ session('alertTitle') ?? 'Error' }}',
                    text: '{{ session('error') }}',
                });
            </script>
        @endif
        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <input type="text" id="email" name="email" value="{{ old('email') }}"placeholder="Enter Username"
                required>
            <input type="password" id="password" name="password" placeholder="Enter Password" required>
            <button type="submit" id="loginButton">Login</button>
        </form>
    </div>
    <script src="{{ asset('public/cms/assets/js/login.js') }}"></script>
</body>

</html>
