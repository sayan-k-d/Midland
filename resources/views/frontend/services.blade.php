@extends('frontend.layouts.main')
@section('title', 'Services Page')
@section('content')

    <div class="st-content">
        <div class="st-page-heading st-size-md st-dynamic-bg" data-src="{{ asset('assets/img/hero-bg6.jpg') }}">
            <div class="container">
                <div class="st-page-heading-in text-center">
                    <h1 class="st-page-heading-title">Our Services</h1>

                </div>
            </div>
        </div><!-- .st-page-heading -->
        <div class="st-height-b100 st-height-lg-b80"></div>
        <div class="container">
            <div class="row">
                @if ($totalServices > 0)
                    @foreach ($services as $service)
                        <div class="col-lg-4">
                            <div
                                class="st-post st-style3 st-zoom st_departments_otr services-card d-flex flex-column justify-content-between overflow-hidden">
                                <a href="{{ route('service.details', ['id' => $service->id]) }}" class="st-post-thumb">
                                    <img class="st-zoom-in" src="{{ $service->image }}" alt="blog1">
                                </a>
                                <div class="st-post-info">
                                    <h2 class="st-post-title"><a
                                            href="{{ route('service.details', ['id' => $service->id]) }}">{{ $service->service_name }}</a>
                                    </h2>
                                    <!-- <div class="st-post-meta">
                                                <span>
                                                <a href="#" class="st-post-avatar">
                                                    <span class="st-post-avatar-text">Admin</span>
                                                </a>
                                                </span>
                                                <span class="st-post-date">August 07, 2020</span>
                                            </div> -->
                                    <div class="st-post-text">
                                        {{ \Illuminate\Support\Str::limit($service->short_details, 150, '...') }}
                                    </div>
                                </div>
                                <div class="st-post-footer">
                                    <a href="{{ route('service.details', ['id' => $service->id]) }}"
                                        class="st-btn st-style2 st-color1 st-size-medium">View
                                        Detail</a>
                                </div>
                            </div>
                            <div class="st-height-b30 st-height-lg-b30"></div>
                        </div>
                    @endforeach
                @else
                    <div>
                        <h1 class="no-data text-center">No Services Available <svg xmlns="http://www.w3.org/2000/svg"
                                width="16" height="16" fill="currentColor" class="bi bi-database-slash"
                                viewBox="0 0 16 16">
                                <path
                                    d="M13.879 10.414a2.501 2.501 0 0 0-3.465 3.465zm.707.707-3.465 3.465a2.501 2.501 0 0 0 3.465-3.465m-4.56-1.096a3.5 3.5 0 1 1 4.949 4.95 3.5 3.5 0 0 1-4.95-4.95Z" />
                                <path
                                    d="M12.096 6.223A5 5 0 0 0 13 5.698V7c0 .289-.213.654-.753 1.007a4.5 4.5 0 0 1 1.753.25V4c0-1.007-.875-1.755-1.904-2.223C11.022 1.289 9.573 1 8 1s-3.022.289-4.096.777C2.875 2.245 2 2.993 2 4v9c0 1.007.875 1.755 1.904 2.223C4.978 15.71 6.427 16 8 16c.536 0 1.058-.034 1.555-.097a4.5 4.5 0 0 1-.813-.927Q8.378 15 8 15c-1.464 0-2.766-.27-3.682-.687C3.356 13.875 3 13.373 3 13v-1.302c.271.202.58.378.904.525C4.978 12.71 6.427 13 8 13h.027a4.6 4.6 0 0 1 0-1H8c-1.464 0-2.766-.27-3.682-.687C3.356 10.875 3 10.373 3 10V8.698c.271.202.58.378.904.525C4.978 9.71 6.427 10 8 10q.393 0 .774-.024a4.5 4.5 0 0 1 1.102-1.132C9.298 8.944 8.666 9 8 9c-1.464 0-2.766-.27-3.682-.687C3.356 7.875 3 7.373 3 7V5.698c.271.202.58.378.904.525C4.978 6.711 6.427 7 8 7s3.022-.289 4.096-.777M3 4c0-.374.356-.875 1.318-1.313C5.234 2.271 6.536 2 8 2s2.766.27 3.682.687C12.644 3.125 13 3.627 13 4c0 .374-.356.875-1.318 1.313C10.766 5.729 9.464 6 8 6s-2.766-.27-3.682-.687C3.356 4.875 3 4.373 3 4" />
                            </svg></h1>
                    </div>

                @endif
                {{-- <div class="col-lg-4">
                    <div class="st-post st-style3 st-zoom st_departments_otr">
                        <a href="service-details.html" class="st-post-thumb">
                            <img class="st-zoom-in"
                                src="https://midlandhealthcare.org/wp-content/uploads/2021/06/Ambulance-service.jpg"
                                alt="blog1">
                        </a>
                        <div class="st-post-info">
                            <h2 class="st-post-title"><a href="service-details.html">Ambulance Service</a></h2>
                            <!-- <div class="st-post-meta">
                      <span>
                        <a href="#" class="st-post-avatar">
                          <span class="st-post-avatar-text">Admin</span>
                        </a>
                      </span>
                      <span class="st-post-date">August 07, 2020</span>
                    </div> -->
                            <div class="st-post-text">Midland Healthcare offers
                                fully-equipped ambulance in Lucknow staffed with trained
                                paramedics, nurses and drivers to manage all the day-to-day
                                fleet operations as well as those midnight emergencies.
                            </div>
                        </div>
                        <div class="st-post-footer">
                            <a href="service-details.html" class="st-btn st-style2 st-color1 st-size-medium">View
                                Detail</a>
                        </div>
                    </div>
                    <div class="st-height-b30 st-height-lg-b30"></div>
                </div> --}}



                <div class="col-lg-12">
                    @if ($totalServices > $maxPageLimit)
                        <div class="text-center pagination-container">
                            {{ $services->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="st-height-b100 st-height-lg-b80"></div>
    </div>
@endsection
