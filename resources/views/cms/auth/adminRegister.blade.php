@extends('cms.layout.admin')
@section('title', 'Register')
@section('content')
<div class="content">
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

        <!-- Form Section -->
        <div class="form-container">
            <h2>Add Users</h2>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group mb-3">
                    <label for="name" class="mb-1">Enter Full Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group mb-3">
                    <label for="role" class="mb-1">Role</label>
                    
                    <select id="role" name="role" class="form-select" aria-label="Default select example"
                        required>
                        <option selected>Select role</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">
                                {{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="name" class="mb-1">Enter Email ID (Username)</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label for="name" class="mb-1">Enter Password</label>
                    <input type="password" name="password" class="form-control" id="password" required>
                    <div class="password-hint">
                        <ul>
                            <p1>You are advised to create a strong password:</p1>
                            <li>Password must be at least 6 characters long.</li>
                            <li>Include at least one uppercase letter.</li>
                            <li>Include at least one number.</li>
                            <li>Include at least one special character (e.g., !, @, #).</li>
                        </ul>
                    </div>
                </div>
            
                
                <button type="submit" class="btn btn-primary">Register</button>
            </form>
        </div>
    </div>
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
@endsection
