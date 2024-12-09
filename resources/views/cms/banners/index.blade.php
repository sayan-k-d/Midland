@extends('cms.layout.admin')
@section('title', 'Banner')
@section('content')

    <div class="mt-3 main-container dashboard-table">
        <div class="d-flex align-items-center justify-content-between admin-details">
            {{-- <h3> Department Details</h3> --}}
            <h2 class="text-center my-4 text-uppercase fw-bold flex-grow-1">Banner Details</h2>
            <div><a class="btn btn-success" href="/addBanners">Add Banner</a></div>
        </div>

        <div class="table-responsive">
            @include('\cms\layout\dashboard-table', [
                'columns' => [
                    'id' => '#',
                    'banner_title' => 'Banner Title',
                    'page' => 'Page Name',
                    'image' => 'Image',
                    'description' => 'Description',
                    'is_active' => 'Active',
                ],
                'data' => $banners,
                'wrapContent' => true,
                'actions' => [
                    [
                        'url' => fn($id) => "/banners/edit/$id",
                        'class' => 'btn-warning',
                        'label' => 'Edit',
                    ],
                    [
                        'url' => fn($id) => "/banners/delete/$id",
                        'route_name' => 'banners.destroy',
                        'class' => 'btn-danger',
                        'label' => 'Delete',
                    ],
                ],
                'totalData' => $totalbanner,
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


@endsection
