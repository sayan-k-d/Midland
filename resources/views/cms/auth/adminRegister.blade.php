<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            background: url(https://midlandhealthcare.org/wp-content/uploads/2022/06/Waiting-hall-in-Lucknow-Midland-Healthcare-scaled.jpg) no-repeat center center fixed;
            /* Background image */
            background-size: cover;
            /* Ensure the image covers the entire screen */
        }

        .header {
            background-color: rgba(0, 121, 107, 0.8);
            /* Semi-transparent teal */
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 1.8rem;
            font-weight: bold;
            width: 100%;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            z-index: 1000;
        }

        .sub-header {
            background-color: rgba(0, 77, 64, 0.8);
            /* Semi-transparent darker teal */
            color: #e0f7fa;
            padding: 10px;
            font-size: 0.9rem;
            text-align: center;
            width: 100%;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 70px;
            z-index: 999;
        }

        .form-container {
            background: rgba(255, 255, 255, 0.9);
            /* Semi-transparent white background */
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
            width: 400px;
            margin-top: 150px;
            /* Adjusted for the header and sub-header */
        }

        h2 {
            text-align: center;
            color: #00796b;
            margin-bottom: 20px;
            font-size: 1.5rem;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        input:focus {
            border-color: #00796b;
            outline: none;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #00796b;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #004d40;
        }

        .password-hint {
            display: none;
            font-family: 'Comic Sans MS', cursive, sans-serif;
            color: #1e88e5;
            font-size: 0.9rem;
            margin-top: -10px;
            margin-bottom: 15px;
        }

        input[name="password"]:not(:placeholder-shown)+.password-hint {
            display: block;
        }

        .password-hint ul {
            list-style-type: disc;
            /* Bullet points */
            padding-left: 20px;
            /* Indentation */
        }

        .password-hint li {
            margin-bottom: 5px;
            /* Space between list items */
        }
    </style>
</head>

<body>
    <!-- Header Section -->
    <div class="header">
        WELCOME TO THE MIDLAND HEALTHCARE ADMIN REGISTRATION PORTAL
    </div>

    <!-- Sub-Header Section -->
    <div class="sub-header">
        © 2024 Midland Healthcare. All rights reserved.
    </div>

    <!-- Form Section -->
    <div class="form-container">
        <h2>Create Your Account</h2>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <input type="text" name="email" placeholder="Enter Username" required>
            <input type="password" name="password" placeholder="Enter Password" required>
            <div class="password-hint">
                <ul>
                    <p1>You are advised to create a strong password:</p1>
                    <li>Password must be at least 6 characters long.</li>
                    <li>Include at least one uppercase letter.</li>
                    <li>Include at least one number.</li>
                    <li>Include at least one special character (e.g., !, @, #).</li>
                </ul>
            </div>
            <button type="submit">Register</button>
        </form>
    </div>

    <!-- JavaScript for Single Submission -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            form.addEventListener('submit', function(e) {
                if (!form.classList.contains('submitted')) {
                    form.classList.add('submitted');
                } else {
                    e.preventDefault();
                }
            });
        });
    </script>
</body>

</html>
