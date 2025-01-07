@extends('cms.layout.admin')
@section('title', 'Profile')
@section('content')
    <div class="content">
        <div class="container">

            <div class="mt-3">
                <div class="d-flex align-items-center justify-content-between admin-details">
                    <h2 class="text-center my-4 text-uppercase fw-bold flex-grow-1">My Profile</h2>
                    <div class="mx-2">
                        <button id="edit-profile-btn" class="btn btn-primary">Edit Profile</button>
                    </div>
                    <div>
                        <a href="{{ route('changePassword') }}" class="btn btn-success">Change Password</a>
                    </div>
                </div>
                <form id="profile-form" action="{{ route('profile.update', $user->id) }}" method="POST"
                    style="display: none;">
                    @csrf
                    @method('PUT')
                    <div class="d-flex align-items-center justify-content-between admin-details">
                        <!-- Admin Avatar -->
                        <div class="admin-avatar">
                            <img src="{{ asset('public/assets/img/avatartest.svg') }}" alt="avatar1" />
                        </div>
                        <!-- Admin Data -->
                        <div class="admin-data">
                            <div class="d-flex align-items-center gap-3 justify-content-evenly my-2">
                                <label>
                                    <h4>Name</h4>
                                </label>
                                <div class="data-rows">
                                    <input type="text" name="name" class="form-control" value="{{ $user->name }}" />
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-3 justify-content-evenly my-2">
                                <label>
                                    <h4>Email</h4>
                                </label>
                                <div class="data-rows">
                                    <input type="email" name="email" class="form-control" value="{{ $user->email }}" />
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-3 justify-content-evenly my-2">
                                <label>
                                    <h4>Role</h4>
                                </label>
                                <div class="data-rows">
                                    @if ($user->role_id == 1)
                                        <select name="role_id" class="form-control">
                                            <option value="1" {{ $user->role_id == 1 ? 'selected' : '' }}>Admin
                                            </option>
                                            <option value="2" {{ $user->role_id == 2 ? 'selected' : '' }}>User</option>
                                        </select>
                                    @else
                                        <select name="role_id" class="form-control" disabled>
                                            <option value="1" {{ $user->role_id == 1 ? 'selected' : '' }}>Admin
                                            </option>
                                            <option value="2" {{ $user->role_id == 2 ? 'selected' : '' }}>User</option>
                                        </select>
                                    @endif
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success mt-3">Update</button>
                        </div>
                        <!-- Calendar -->
                        <div class="calendar-container">
                            <iframe
                                src="https://calendar.google.com/calendar/embed?src=d0bfe33165c2dd9d206426f7ace120071d4934ea1f80387dfef5af0aa3b27a0d%40group.calendar.google.com&ctz=Asia%2FKolkata"
                                style="border: 0" frameborder="0" scrolling="no"></iframe>
                        </div>
                    </div>
                </form>
                <div id="profile-view">
                    <div class="d-flex align-items-center justify-content-between admin-details">
                        <!-- Admin Avatar -->
                        <div class="admin-avatar">
                            <img src="{{ asset('public/assets/img/avatartest.svg') }}" alt="avatar" />
                        </div>
                        <!-- Admin Data -->
                        <div class="admin-data">
                            <div class="d-flex align-items-center gap-3 justify-content-evenly my-2">
                                <label>
                                    <h4>Name</h4>
                                </label>
                                <div class="data-rows">
                                    <h5>{{ $user ? $user->name : 'N/A' }}</h5>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-3 justify-content-evenly my-2">
                                <label>
                                    <h4>Email</h4>
                                </label>
                                <div class="data-rows">
                                    <h5>{{ $user ? $user->email : 'N/A' }}</h5>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-3 justify-content-evenly my-2">
                                <label>
                                    <h4>Role</h4>
                                </label>
                                <div class="data-rows">
                                    <h5>{{ $user ? ($user->role_id == 1 ? 'Admin' : 'User') : 'N/A' }}</h5>
                                </div>
                            </div>
                        </div>
                        <!-- Calendar -->
                        <div class="calendar-container">
                            <iframe
                                src="https://calendar.google.com/calendar/embed?src=d0bfe33165c2dd9d206426f7ace120071d4934ea1f80387dfef5af0aa3b27a0d%40group.calendar.google.com&ctz=Asia%2FKolkata"
                                style="border: 0" frameborder="0" scrolling="no"></iframe>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script>
        document.getElementById('edit-profile-btn').addEventListener('click', function(e) {
            e.preventDefault();
            const viewDiv = document.getElementById('profile-view');
            const formDiv = document.getElementById('profile-form');
            viewDiv.style.display = viewDiv.style.display === 'none' ? 'block' : 'none';
            formDiv.style.display = formDiv.style.display === 'none' ? 'block' : 'none';
        });
    </script>
    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: '{{ session('alertTitle') ?? 'Error' }}',
                text: '{{ session('error') }}',
            });
        </script>
    @endif
@endsection
