@extends('cms.layout.admin')
@section('title', 'Receiver Email')
@section('content')
    <div class="mt-3 main-container dashboard-table">
        <div class="d-flex align-items-center justify-content-between admin-details">
            {{-- <h3> Department Details</h3> --}}
            <h2 class="text-center my-4 text-uppercase fw-bold flex-grow-1">Enter Reciever Email</h2>
        </div>
        <div class="card m-auto" style="width: 600px">
            <div class="card-body">
                <form action="{{ route('setemail') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" name="receiverEmail" id="exampleInputEmail1"
                            aria-describedby="emailHelp" value="{{ $receiverEmail ? $receiverEmail->receiver_email : '' }}">
                    </div>
                    <button type="submit" class="btn btn-primary">
                        {{ $receiverEmail ? 'Update' : 'Submit' }}
                    </button>
                </form>
            </div>
        </div>
    </div>
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
@endsection
