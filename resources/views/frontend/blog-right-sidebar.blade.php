@extends('frontend.layouts.main')
@section('title', 'Blogs Page')
@section('content')
    <div class="st-content">
        <div class="st-page-heading st-size-md st-dynamic-bg"
            data-src="{{ $blog->innerImage ?? asset('public/assets/img/hero-bg6.jpg') }}"
            style="background-size: auto;background-repeat: no-repeat;">
            <div class="container">
                <div class="st-page-heading-in text-center">
                    <h1 class="st-page-heading-title">Our Latest News</h1>
                    <div class="st-page-heading-subtitle">Gate all update news here</div>
                </div>
            </div>
        </div><!-- .st-page-heading -->
        <div class="st-height-b100 st-height-lg-b80"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="st-height-b0 st-height-lg-b40"></div>
                    <div class="row">
                        @if ($totalBlogs > 0)
                            @foreach ($blogs as $recentBlog)
                                <div class="col-lg-6">
                                    <div class="st-post st-style3 st-zoom">
                                        <a href="{{ route('blog.details', ['id' => $recentBlog->id]) }}"
                                            class="st-post-thumb">
                                            <img class="st-zoom-in" src="{{ $recentBlog->image }}" alt="blog1">
                                        </a>
                                        <div class="st-post-info">
                                            <h2 class="st-post-title"><a
                                                    href="{{ route('blog.details', ['id' => $recentBlog->id]) }}">{{ $recentBlog->title }}</a>
                                            </h2>
                                            <div class="st-post-meta">
                                                <span>
                                                    <a href="#" class="st-post-avatar">
                                                        <span
                                                            class="st-post-avatar-text">{{ $recentBlog->created_by }}</span>
                                                    </a>
                                                </span>
                                                <span
                                                    class="st-post-date">{{ \Carbon\Carbon::parse($recentBlog->created_at)->format('F j, Y') }}</span>
                                            </div>
                                            <div class="st-post-text">
                                                {{ \Illuminate\Support\Str::limit($recentBlog->short_description, 150, '...') }}
                                            </div>
                                        </div>
                                        <div class="st-post-footer">
                                            <a href="{{ route('blog.details', ['id' => $recentBlog->id]) }}"
                                                class="st-btn st-style2 st-color1 st-size-medium">Read More</a>
                                        </div>
                                    </div>
                                    <div class="st-height-b30 st-height-lg-b30"></div>
                                </div>
                            @endforeach
                        @else
                            <div>
                                <h1 class="no-data text-center">No Blogs Available <svg xmlns="http://www.w3.org/2000/svg"
                                        width="16" height="16" fill="currentColor" class="bi bi-database-slash"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M13.879 10.414a2.501 2.501 0 0 0-3.465 3.465zm.707.707-3.465 3.465a2.501 2.501 0 0 0 3.465-3.465m-4.56-1.096a3.5 3.5 0 1 1 4.949 4.95 3.5 3.5 0 0 1-4.95-4.95Z" />
                                        <path
                                            d="M12.096 6.223A5 5 0 0 0 13 5.698V7c0 .289-.213.654-.753 1.007a4.5 4.5 0 0 1 1.753.25V4c0-1.007-.875-1.755-1.904-2.223C11.022 1.289 9.573 1 8 1s-3.022.289-4.096.777C2.875 2.245 2 2.993 2 4v9c0 1.007.875 1.755 1.904 2.223C4.978 15.71 6.427 16 8 16c.536 0 1.058-.034 1.555-.097a4.5 4.5 0 0 1-.813-.927Q8.378 15 8 15c-1.464 0-2.766-.27-3.682-.687C3.356 13.875 3 13.373 3 13v-1.302c.271.202.58.378.904.525C4.978 12.71 6.427 13 8 13h.027a4.6 4.6 0 0 1 0-1H8c-1.464 0-2.766-.27-3.682-.687C3.356 10.875 3 10.373 3 10V8.698c.271.202.58.378.904.525C4.978 9.71 6.427 10 8 10q.393 0 .774-.024a4.5 4.5 0 0 1 1.102-1.132C9.298 8.944 8.666 9 8 9c-1.464 0-2.766-.27-3.682-.687C3.356 7.875 3 7.373 3 7V5.698c.271.202.58.378.904.525C4.978 6.711 6.427 7 8 7s3.022-.289 4.096-.777M3 4c0-.374.356-.875 1.318-1.313C5.234 2.271 6.536 2 8 2s2.766.27 3.682.687C12.644 3.125 13 3.627 13 4c0 .374-.356.875-1.318 1.313C10.766 5.729 9.464 6 8 6s-2.766-.27-3.682-.687C3.356 4.875 3 4.373 3 4" />
                                    </svg></h1>
                            </div>

                        @endif
                        <div class="col-lg-12">
                            @if ($totalBlogs > $maxPageLimit)
                                <div class="text-center pagination-container">
                                    {{ $recentBlogs->links() }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="st-height-b0 st-height-lg-b40"></div>
                    <div class="st-widget st-sidebar-widget d-none">
                        <h3 class="st-widget-title">Categories</h3>
                        <ul class="st-widget-list">
                            <li><a href="#">Audio</a></li>
                            <li><a href="#">Video</a></li>
                            <li><a href="#">Gallery</a></li>
                            <li><a href="#">Doctors</a></li>
                            <li><a href="#">Patients</a></li>
                        </ul>
                    </div>
                    <div class="st-height-b30 st-height-lg-b30 d-none"></div>
                    <div class="st-widget st-sidebar-widget d-none">
                        <h3 class="st-widget-title">Arachives</h3>
                        <ul class="st-widget-list">
                            <li><a href="#">March 2020</a></li>
                            <li><a href="#">May 2020</a></li>
                            <li><a href="#">June 2020</a></li>
                            <li><a href="#">August 2020</a></li>
                            <li><a href="#">September 2020</a></li>
                            <li><a href="#">October 2020</a></li>
                        </ul>
                    </div>
                    <div class="st-height-b30 st-height-lg-b30 d-none"></div>
                    <div class="st-widget st-sidebar-widget">
                        <h3 class="st-widget-title">Recent Post</h3>
                        <ul class="st-post-widget-list st-mp0">
                            @foreach ($recentBlogs as $recentBlog)
                                <li>
                                    <div class="st-post st-style1">
                                        <a href="{{ route('blog-details-right', ['id' => $recentBlog->id]) }}"
                                            class="st-post-thumb st-zoom"><img src="{{ $recentBlog->image }}"
                                                alt="post1" class="st-zoom-in"></a>
                                        <div class="st-post-info">
                                            <h2 class="st-post-title"><a
                                                    href="{{ route('blog-details-right', ['id' => $recentBlog->id]) }}">{{ $recentBlog->title }}</a>
                                            </h2>
                                            <div class="st-post-date">
                                                {{ \Carbon\Carbon::parse($recentBlog->created_at)->format('F j, Y') }}
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="st-height-b30 st-height-lg-b30"></div>
                    <div class="st-widget st-sidebar-widget">
                        <h3 class="st-widget-title">Popular Tags</h3>
                        <div class="st-tagcloud">
                            @php
                                $tags = explode(',', $blog->tags);
                            @endphp
                            @foreach ($tags as $tag)
                                <a href="#" class="st-tag">{{ $tag }}</a>
                            @endforeach
                            {{-- <a href="#" class="st-tag">Gallery</a>
                            <a href="#" class="st-tag">Quote</a>
                            <a href="#" class="st-tag">Video</a>
                            <a href="#" class="st-tag">Quote</a>
                            <a href="#" class="st-tag">Audio</a>
                            <a href="#" class="st-tag">Doctor</a>
                            <a href="#" class="st-tag">Link</a>
                            <a href="#" class="st-tag">Ipsum</a>
                            <a href="#" class="st-tag">Enviroment</a>
                            <a href="#" class="st-tag">Corporate</a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="st-height-b100 st-height-lg-b80"></div>
    </div>

    <!-- Start Video Popup -->
    <div class="st-video-popup">
        <div class="st-video-popup-overlay"></div>
        <div class="st-video-popup-content">
            <div class="st-video-popup-layer"></div>
            <div class="st-video-popup-container">
                <div class="st-video-popup-align">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="about:blank"></iframe>
                    </div>
                </div>
                <div class="st-video-popup-close"></div>
            </div>
        </div>
    </div>
    <!-- End Video Popup -->

    <!-- Scripts -->
    <script src="assets/js/vendor/modernizr-3.5.0.min.js"></script>
    <script src="assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="assets/js/isotope.pkg.min.js"></script>
    <script src="assets/js/jquery.slick.min.js"></script>
    <script src="assets/js/mailchimp.min.js"></script>
    <script src="assets/js/counter.min.js"></script>
    <script src="assets/js/lightgallery.min.js"></script>
    <script src="assets/js/ripples.min.js"></script>
    <script src="assets/js/wow.min.js"></script>
    <script src="assets/js/select2.min.js"></script>
    <script src="assets/js/main.js"></script>
@endsection
