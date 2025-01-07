@extends('cms.layout.admin')
@section('title', 'Profile')
@section('content')
<div class="content">
    <div class="container">
        <h2 class="text-center my-4">Change Password</h2>

        <!--@if(session('success'))-->
        <!--    <div class="alert alert-success">-->
        <!--        {{ session('success') }}-->
        <!--    </div>-->
        <!--@endif-->

        <!--@if(session('error'))-->
        <!--    <div class="alert alert-danger">-->
        <!--        {{ session('error') }}-->
        <!--    </div>-->
        <!--@endif-->
        @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    text: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 1500
                });
            </script>
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
        <form action="{{ route('password.update') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="current_password">Current Password</label>
                <input type="password" name="current_password" id="current_password" class="form-control" required>
                @error('current_password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group mb-3">
                <label for="new_password">New Password</label>
                <input type="password" name="new_password" id="new_password" class="form-control" required>
                @error('new_password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="new_password_confirmation">Confirm New Password</label>
                <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" required>
                @error('new_password_confirmation')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update Password</button>
        </form>
    </div>
</div>
@endsection
