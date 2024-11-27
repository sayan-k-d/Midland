@extends('frontend.layouts.main')
@section('title', 'Blogs Page')
@section('content')
    <div class="st-content">
        <div class="st-page-heading st-dynamic-bg" data-src="{{ asset('assets/img/hero-bg2.jpg') }}">
            <div class="container">
                <div class="st-page-heading-in text-center">
                    <h1 class="st-page-heading-title">Midland Healthcare: {{ $blog->title }}</h1>
                    <div class="st-post-label">
                        <!-- <span>By <a href="#">Jhon Doe</a></span> -->
                        <span>{{ \Carbon\Carbon::parse($blog->date)->format('F j, Y') }}</span>
                    </div>
                </div>
            </div>
        </div><!-- .st-page-heading -->
        <div class="st-height-b100 st-height-lg-b80"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="st-post-details st-style1">
                        <p>{{ $blog->content }}</p>

                        <img class="st-zoom-in" src="{{ $blog->content_image }}" alt="blog1">
                        <h2>{{ $blog->intro_heading }}</h2>
                        <div class="st-post-info">
                            <div class="st-post-text">
                                <p>{{ $blog->introduction }}
                                </p>
                                <h2>{{ $blog->video_heading }}</h2>
                                <!-- For Youtube -->
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe class="embed-responsive-item" width="816" height="459"
                                        src="{{ $blog->video_link }}" allowfullscreen>
                                    </iframe>
                                </div>
                                <!-- For Vimeo -->
                                <!-- <div class="embed-responsive embed-responsive-16by9">
                                                                                                    <iframe class="embed-responsive-item" width="816" height="459" src="https://player.vimeo.com/video/172077385?title=0&st-byline=0&portrait=0&color=EE5A3F&autoplay=0&loop=0&wmode=transparent" allowfullscreen></iframe>
                                                                                                </div> -->
                                <p>{{ $blog->video_content }}
                                </p>

                                <h2>{{ $blog->diet_heading }} </h2>
                                <p>{{ $blog->diet_description }}

                                </p>
                                <div class="st-slider st-style1">
                                    <div class="slick-container" data-autoplay="0" data-loop="1" data-speed="800"
                                        data-autoplay-timeout="1000" data-center="0" data-slides-per-view="1">
                                        <div class="slick-wrapper">
                                            <div class="slick-slide-in">
                                                <div class="st-gallery-img st-style1 st-dynamic-bg st-bg"
                                                    data-src="{{ $blog->diet_image }}"></div>
                                            </div>
                                            <div class="slick-slide-in">
                                                <div class="st-gallery-img st-style1 st-dynamic-bg st-bg"
                                                    data-src="{{ asset('assets/img/hero-bg3.jpg') }}"></div>
                                            </div>
                                            <div class="slick-slide-in">
                                                <div class="st-gallery-img st-style1 st-dynamic-bg st-bg"
                                                    data-src="{{ asset('assets/img/hero-bg5.jpg') }}"></div>
                                            </div>
                                        </div>
                                    </div><!-- .slick-container -->
                                    <div class="pagination st-style2"></div>
                                    <!-- If dont need Pagination then add class .st-hidden -->
                                    <div class="swipe-arrow st-style1 st-hidden">
                                        <!-- If dont need navigation then add class .st-hidden -->
                                        <div class="slick-arrow-left"><i class="fa fa-angle-left"></i></div>
                                        <div class="slick-arrow-right"><i class="fa fa-angle-right"></i></div>
                                    </div>
                                </div><!-- .st-slider -->

                                <div class="st-height-b20 st-height-lg-b20"></div>

                                <ul>
                                    @foreach ($diets as $diet)
                                        <li><b>{{ $diet[0] }}:</b>{{ $diet[1] }}</li>
                                    @endforeach
                                </ul>

                                <p>
                                    {{ $blog->diet_advice }}
                                </p>
                            </div>
                            <div class="st-height-b35 st-height-lg-b35"></div>

                            <h2>{{ $blog->test_heading }} </h2>
                            <p>{{ $blog->test_content }}
                            </p>

                            <div class="st-post-meta">
                                <div class="st-post-share">
                                    <h4 class="st-post-share-title">Share:</h4>
                                    <div class="st-post-share-btn-list">
                                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                                        <a href="#"><i class="fab fa-twitter"></i></a>
                                        <a href="#"><i class="fab fa-behance"></i></a>
                                        <a href="#"><i class="fab fa-instagram"></i></a>
                                        <a href="#"><i class="fab fa-pinterest-p"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="st-height-b60 st-height-lg-b60"></div>
                        </div>
                        <div class="st-post-btn-gropu">
                            @if ($prevBlog)
                                <a href="{{ route('blog.details', ['id' => $prevBlog->id]) }}"
                                    class="st-btn st-style2 st-color1 st-size-medium">
                                    Previous Post
                                </a>
                            @else
                                <script>
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: 'No More Blogs',
                                        confirmButtonColor: '#d33',
                                        confirmButtonText: 'Try Again'
                                    });
                                </script>
                            @endif
                            @if ($nextBlog)
                                <a href="{{ route('blog.details', ['id' => $nextBlog->id]) }}"
                                    class="st-btn st-style2 st-color1 st-size-medium">
                                    Next Post
                                </a>
                            @else
                                <script>
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: 'No More Blogs',
                                        confirmButtonColor: '#d33',
                                        confirmButtonText: 'Try Again'
                                    });
                                </script>
                            @endif
                        </div>
                    </div>
                    <div class="st-height-b60 st-height-lg-b60"></div>
                    <div class="comments-area d-none">
                        <div class="comment-list-outer">
                            <h2 class="comments-title">Comments(3)</h2>
                            <ol class="comment-list">
                                <li class="comment">
                                    <div class="comment-body">
                                        <div class="comment-meta">
                                            <div class="comment-author">
                                                <img src="{{ asset('assets/img/comment1.jpg') }}" alt="comment1"
                                                    class="avatar">
                                                <a href="#" class="nm">Smith Jhon</a>
                                            </div><!-- .comment-author -->
                                            <div class="comment-metadata">
                                                <a href="#"><span>15 Jan, 2020</span></a>
                                            </div><!-- .comment-metadata -->
                                        </div><!-- .comment-meta -->
                                        <div class="comment-content">
                                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing
                                                elit.</p>
                                        </div>
                                        <div class="reply"><a href="#" class="comment-reply-link">Reply</a></div>
                                    </div>
                                    <ol class="children">
                                        <li class="comment">
                                            <div class="comment-body">
                                                <div class="comment-meta">
                                                    <div class="comment-author">
                                                        <img src="{{ asset('assets/img/comment2.jpg') }}" alt="comment1"
                                                            class="avatar">
                                                        <span class="nm"><a href="#">Robat
                                                                Newman</a></span>
                                                    </div><!-- .comment-author -->
                                                    <div class="comment-metadata">
                                                        <a href="#"><span>15 Jan, 2020</span></a>
                                                    </div><!-- .comment-metadata -->
                                                </div><!-- .comment-meta -->
                                                <div class="comment-content">
                                                    <p>Consectetuer adipiscing elit. Lorem ipsum dolor
                                                        sit amet, consectetuer.</p>
                                                </div>
                                                <div class="reply"><a href="#"
                                                        class="comment-reply-link">Reply</a></div>
                                            </div>
                                        </li>
                                    </ol><!-- .children -->
                                </li>
                                <li class="comment">
                                    <div class="comment-body">
                                        <div class="comment-meta">
                                            <div class="comment-author">
                                                <img src="{{ asset('assets/img/comment1.jpg') }}" alt="comment1"
                                                    class="avatar">
                                                <span class="nm"><a href="#">Hannibal
                                                        Lecter</a></span>
                                            </div><!-- .comment-author -->
                                            <div class="comment-metadata">
                                                <a href="#"><span>26 Jan, 2016</span></a>
                                            </div><!-- .comment-metadata -->
                                        </div><!-- .comment-meta -->
                                        <div class="comment-content">
                                            <p>Lorem ipsum dolor sit amet. Lorem ipsum adipiscing
                                                elit.</p>
                                        </div>
                                        <div class="reply"><a href="#" class="comment-reply-link">Reply</a></div>
                                    </div>
                                </li>
                            </ol><!-- .comment-list -->
                        </div><!-- .comment-list-outer -->
                        <div class="comment-respond">
                            <h2 class="comment-reply-title">Add your comment</h2>
                            <form method="post" class="comment-form">
                                <p class="comment-form-author">
                                    <input name="author" type="text" placeholder="Name*" required>
                                </p>
                                <p class="comment-form-email">
                                    <input name="email" type="email" placeholder="E-mail*" required>
                                </p>
                                <p class="comment-form-url">
                                    <input id="url" name="url" type="url" placeholder="Website">
                                </p>
                                <p class="comment-form-comment">
                                    <textarea name="comment" cols="40" rows="5" placeholder="Write here...*" required></textarea>
                                </p>
                                <p class="form-submit">
                                    <button type="submit" class="st-btn st-style1 st-color1 st-size-medium">Send
                                        Message</button>
                                </p>
                            </form>
                        </div><!-- .comment-respond -->
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
                                            class="st-post-thumb st-zoom"><img src="{{ $recentBlog->content_image }}"
                                                alt="post1" class="st-zoom-in" loading="lazy"></a>
                                        <div class="st-post-info">
                                            <h2 class="st-post-title"><a
                                                    href="{{ route('blog-details-right', ['id' => $recentBlog->id]) }}">{{ $recentBlog->title }}</a>
                                            </h2>
                                            <div class="st-post-date">
                                                {{ \Carbon\Carbon::parse($recentBlog->date)->format('F j, Y') }}</div>
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
                                $tags = $blog->tags ? explode(',', $blog->tags) : [];
                            @endphp
                            @foreach ($tags as $tag)
                                <a href="#" class="st-tag">{{ $tag }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="st-height-b100 st-height-lg-b80 d-none"></div>
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
