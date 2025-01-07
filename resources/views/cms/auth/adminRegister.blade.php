@extends('cms.layout.admin')
@section('title', 'Register')
@section('content')
    <div class="content main-container">
        <div class="container">
            <div class="page-header mb-4">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">
                            WELCOME TO THE MIDLAND HEALTHCARE ADMIN REGISTRATION PORTAL
                        </h3>
                    </div>
                </div>
            </div>
            @if (session('error'))
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: '{{ session('alertTitle') ?? 'Error' }}',
                        text: '{{ session('error') }}',
                    });
                </script>
            @endif
            <!-- Form Section -->
            <div class="form-container">
                <h2>Add Users</h2>
                <form method="POST" action="{{ route('register') }}" id="register-form">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="name" class="mb-1">Enter Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                            required>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="role" class="mb-1">Role</label>
                        <select id="role" name="role" class="form-select" required>
                            <option value="">Select role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}" {{ old('role') == $role->id ? 'selected' : '' }}>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('role')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="email" class="mb-1">Enter Email ID (Username)</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}"
                            required>
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="password" class="mb-1">Enter Password</label>
                        <input type="password" name="password" class="form-control" id="password" required>
                        <div class="password-hint">
                            <ul>
                                <p>You are advised to create a strong password:</p>
                                <li id="min-length" class="password-item">Password must be at least 6 characters long.</li>
                                <li id="uppercase" class="password-item">Include at least one uppercase letter.</li>
                                <li id="number" class="password-item">Include at least one number.</li>
                                <li id="special-char" class="password-item">Include at least one special character (e.g., !,
                                    @, #).</li>
                            </ul>
                        </div>

                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Register</button>
                </form>

            </div>
        </div>
    </div>
    <!-- JavaScript for Single Submission -->

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const passwordInput = document.getElementById("password");
            const form = document.querySelector("form");
            const submitButton = form.querySelector('button[type="submit"]');

            const minLengthItem = document.getElementById("min-length");
            const uppercaseItem = document.getElementById("uppercase");
            const numberItem = document.getElementById("number");
            const specialCharItem = document.getElementById("special-char");

            // Regular expressions for validation
            const uppercaseRegex = /[A-Z]/;
            const numberRegex = /[0-9]/;
            const specialCharRegex = /[!@#$%^&*(),.?":{}|<>]/;

            let isPasswordValid = false;

            // Function to validate password
            function validatePassword() {
                const password = passwordInput.value;
                let isValid = true;

                // Reset color to black for all requirements
                const items = document.querySelectorAll(".password-item");
                items.forEach(item => item.style.color = "black");

                // Check password length
                if (password.length >= 6) {
                    minLengthItem.style.color = "green";
                } else {
                    isValid = false;
                }

                // Check for uppercase letter
                if (uppercaseRegex.test(password)) {
                    uppercaseItem.style.color = "green";
                } else {
                    isValid = false;
                }

                // Check for number
                if (numberRegex.test(password)) {
                    numberItem.style.color = "green";
                } else {
                    isValid = false;
                }

                // Check for special character
                if (specialCharRegex.test(password)) {
                    specialCharItem.style.color = "green";
                } else {
                    isValid = false;
                }

                // Update the overall validity status
                isPasswordValid = isValid;
            }

            // Check on submit
            form.addEventListener("submit", function(event) {
                // Validate password before submitting the form
                validatePassword();

                // If password is invalid, prevent form submission
                if (!isPasswordValid) {
                    event.preventDefault(); // Prevent form submission

                    // Highlight unmet requirements in red
                    const items = document.querySelectorAll(".password-item");
                    items.forEach(item => {
                        if (item.style.color !== "green") {
                            item.style.color = "red"; // Highlight unmet requirements in red
                        }
                    });
                } else {
                    // Prevent multiple form submissions by adding 'submitted' class
                    if (!form.classList.contains('submitted')) {
                        form.classList.add('submitted');
                    } else {
                        event.preventDefault(); // Prevent the form from being submitted again
                    }
                }
            });

            // Bind the validation to input changes in password field
            passwordInput.addEventListener("input", validatePassword);
        });
    </script>



@endsection
