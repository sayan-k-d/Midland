@extends('cms.layout.admin')
@section('title', 'Contact Details')
@section('content')

<div class="mt-3 main-container dashboard-table">
    <div class="d-flex align-items-center justify-content-between admin-details">
        {{-- <h3> Department Details</h3> --}}
        <h2 class="text-center my-4 text-uppercase fw-bold flex-grow-1">Contact Details</h2>

    </div>

    <div class="table-responsive">
        @include('\cms\layout\dashboard-table', [
            'columns' => [
                'id' => '#',
                'name' => 'Name',
                'phone' => 'Phone',
                'email' => 'Email',
                'subject' => 'Subject',
                'message' => 'Message',
            ],
            'data' => $contactData,
            'actions' => [
                // [
                //     'url' => fn($id) => "/edit/$id",
                //     'class' => 'btn-warning',
                //     'label' => 'Edit',
                // ],
                [
                    'url' => fn($id) => "/contact/delete/$id",
                    'route_name' => 'contact.destroy',
                    'class' => 'btn-danger',
                    'label' => 'Delete',
                ],
            ],
            'totalData' => $totalContacts,
            'maxPageLimit' => $maxPageLimit,
        ])
    </div>
</div>
@endsection
