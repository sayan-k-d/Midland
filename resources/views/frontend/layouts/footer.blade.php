 <!-- Start Footer -->
 <footer class="st-site-footer st-dynamic-bg"data-src="{{ asset('assets/img/footer-bg.png') }}">
     <div class="st-main-footer">
         <div class="container">
             <div class="row">
                 <div class="col-lg-3">
                     <div class="st-footer-widget">
                         <div class="st-text-field">
                             <img src="{{ asset('assets/img/footer-logo.png') }}" alt="Nischinto" class="st-footer-logo">
                             <div class="st-height-b25 st-height-lg-b25"></div>
                             <div class="st-footer-text">Midland Healthcare & Research
                                 Center is one of the best hospitals in Lucknow. The
                                 service’s primary comprises of hospital, diagnostics and day
                                 care specialty facilities. Contact us now!</div>
                             <div class="st-height-b25 st-height-lg-b25"></div>
                             <ul class="st-social-btn st-style1 st-mp0">
                                 <li><a href="#"><i class="fab fa-facebook-square"></i></a></li>
                                 <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                                 <li><a href="#"><i class="fab fa-pinterest-square"></i></a></li>
                                 <li><a href="#"><i class="fab fa-twitter-square"></i></a></li>
                             </ul>
                         </div>
                     </div>
                 </div><!-- .col -->
                 <div class="col-lg-3">
                     <div class="st-footer-widget">
                         <h2 class="st-footer-widget-title">Useful Links</h2>
                         <ul class="st-footer-widget-nav st-mp0">
                             <li><a href="/" class="st-smooth-move active"><i
                                         class="fas fa-chevron-right"></i>Home</a></li>
                             <li><a href="/frontend/about" class="st-smooth-move active"><i
                                         class="fas fa-chevron-right"></i>About</a></li>
                             <li><a href="/frontend/departments" class="st-smooth-move active"><i
                                         class="fas fa-chevron-right"></i>Department</a></li>
                             <li><a href="/frontend/services" class="st-smooth-move active"><i
                                         class="fas fa-chevron-right"></i>Services</a></li>
                             <li><a href="/frontend/doctors" class="st-smooth-move active"><i
                                         class="fas fa-chevron-right"></i>
                                     Find a Doctor</a></li>
                             <li><a href="/frontend/blogs" class="st-smooth-move active"><i
                                         class="fas fa-chevron-right"></i>Blog</a></li>
                             <li><a href="/frontend/contact" class="st-smooth-move active"><i
                                         class="fas fa-chevron-right"></i>Contact</a></li>
                         </ul>
                     </div>
                 </div><!-- .col -->
                 <div class="col-lg-3">
                     <div class="st-footer-widget">
                         <h2 class="st-footer-widget-title">Departments</h2>
                         <ul class="st-footer-widget-nav st-mp0">
                             @foreach ($footerData['departments'] as $department)
                                 <li><a href="/frontend/departmentDetails/{{ $department->id }}"><i
                                             class="fas fa-chevron-right"></i>{{ $department->department_name }}</a>
                                 </li>
                             @endforeach
                         </ul>
                     </div>
                 </div><!-- .col -->
                 <div class="col-lg-3">
                     <div class="st-footer-widget">
                         <h2 class="st-footer-widget-title">Contacts</h2>
                         <ul class="st-footer-contact-list st-mp0">
                             <li><span class="st-footer-contact-title">Address:</span>
                                 Mandir Marg, Mahanagar Lucknow, U.P.
                             </li>
                             <li><span class="st-footer-contact-title">Email:</span>
                                 info.midlandhealthcare@gmail.com</li>
                             <li><span class="st-footer-contact-title">Phone:</span> <a href="tel:0522-4655555">
                                     0522-4655555</a></li>
                             <li><span class="st-footer-contact-title"></span> <a href="tel:0522-4655555">
                                     8004024365</a></li>
                             <li><span class="st-footer-contact-title"></span> <a href="tel:0522-4655555">
                                     0522-4042888</a></li>
                         </ul>
                     </div>
                 </div><!-- .col -->
             </div>
         </div>
     </div>
     <div class="st-copyright-wrap">
         <div class="container">
             <div class="st-copyright-in">
                 <div class="st-left-copyright">
                     <div class="st-copyright-text">© Copyright Midland Healthcare 2024
                         - All Rights Reserved</div>
                 </div>
                 <div class="st-right-copyright">
                     <div id="st-backtotop"><i class="fas fa-angle-up"></i></div>
                 </div>
             </div>
         </div>
     </div>
 </footer>
 <!-- End Footer -->

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

 <!-- Swiper JS -->
 <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
 <!-- Scripts -->
 <script src="{{ asset('assets/js/vendor/modernizr-3.5.0.min.js') }}"></script>
 <script src="{{ asset('assets/js/vendor/jquery-1.12.4.min.js') }}"></script>
 <script src="{{ asset('assets/js/isotope.pkg.min.js') }}"></script>
 <script src="{{ asset('assets/js/jquery.slick.min.js') }}"></script>
 <script src="{{ asset('assets/js/mailchimp.min.js') }}"></script>
 <script src="{{ asset('assets/js/counter.min.js') }}"></script>
 <script src="{{ asset('assets/js/lightgallery.min.js') }}"></script>
 <script src="{{ asset('assets/js/ripples.min.js') }}"></script>
 <script src="{{ asset('assets/js/wow.min.js') }}"></script>
 <script src="{{ asset('assets/js/jQueryUi.js') }}"></script>
 <script src="{{ asset('assets/js/textRotate.min.js') }}"></script>
 <script src="{{ asset('assets/js/select2.min.js') }}"></script>
 <script src="{{ asset('assets/js/main.js') }}"></script>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
     integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
 </script>
 </body>

 <!-- Mirrored from html.laralink.com/nischinto/nischinto/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 10 Sep 2024 08:24:11 GMT -->

 </html>
