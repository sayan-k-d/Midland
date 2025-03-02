@extends('cms.layout.admin')
@section('title', 'Contact Details')
@section('content')

    <div class="mt-3 main-container dashboard-table">
        <div class="d-flex align-items-center justify-content-between admin-details">
            {{-- <h3> Department Details</h3> --}}
            <h2 class="text-center my-4 text-uppercase fw-bold flex-grow-1">Contact Details</h2>

        </div>

        <div class="table-responsive mb-5">
            @include('cms.layout.dashboard-table', [
                'columns' => [
                    'id' => '#',
                    'name' => 'Name',
                    'phone' => 'Phone',
                    'email' => 'Email',
                    'subject' => 'Subject',
                    // 'message' => 'Message',
                ],
                'data' => $contactData,
                'actions' => [
                    // [
                    //     'url' => fn($id) => "/edit/$id",
                    //     'class' => 'btn-warning',
                    //     'label' => 'Edit',
                    // ],
                    [
                        'class' => 'btn-primary',
                        'label' => 'view',
                    ],
                    [
                        'url' => fn($id) => route('contact.destroy', ['id' => $id]),
                        'route_name' => 'contact.destroy',
                        'class' => 'btn-danger',
                        'label' => 'Delete',
                    ],
                ],
                'modalTitle' => 'Customer Details',
                'totalData' => $totalContacts,
                'maxPageLimit' => $maxPageLimit,
            ])
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
