<!-- Section: Gallery -->
<section id="gallery">
    <div class="container">
        <div class="section-content">
            <div class="row">
                <div class="col-md-7 wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.1s">
                    <h3 class="text-uppercase title line-bottom mt-0 mb-30"><i class="fa fa-photo text-gray-darkgray mr-10"></i>{!! trans('messages.random_photos') !!}</h3>
                    <!-- Portfolio Gallery Grid -->

                    <div class="gallery-isotope grid-4 gutter-small clearfix" data-lightbox="gallery">
                        @forelse(get_random_photo(12) as $photo)

                            <!-- Portfolio Item Start -->
                                <div class="gallery-item">
                                    <div class="thumb">
                                        <img alt="project" src="{{ URL::asset($photo['url']) }}" class="img-fullwidth">
                                        <div class="overlay-shade"></div>
                                        <div class="icons-holder">
                                            <div class="icons-holder-inner">
                                                <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">
                                                    <a href="{{ URL::asset($photo['url']) }}"  data-lightbox-gallery="gallery"  data-title="My caption"><i class="fa fa-picture-o"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Portfolio Item End -->
                        @empty
                        <!-- Portfolio Item Start -->
                        <div class="gallery-item">
                            <div class="thumb">
                                <img alt="project" src="{{ URL::asset('/public/assets/global/images/gallery/gallery-sm5.jpg') }}" class="img-fullwidth">
                                <div class="overlay-shade"></div>
                                <div class="icons-holder">
                                    <div class="icons-holder-inner">
                                        <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">
                                            <a href="{{ URL::asset('/public/assets/global/images/gallery/gallery-lg5.jpg') }}"  data-lightbox-gallery="gallery"><i class="fa fa-picture-o"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Portfolio Item End -->

                        <!-- Portfolio Item Start -->
                        <div class="gallery-item">
                            <div class="thumb">
                                <img alt="project" src="{{ URL::asset('/public/assets/global/images/gallery/gallery-sm3.jpg') }}" class="img-fullwidth">
                                <div class="overlay-shade"></div>
                                <div class="icons-holder">
                                    <div class="icons-holder-inner">
                                        <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">
                                            <a href="{{ URL::asset('/public/assets/global/images/gallery/gallery-lg3.jpg') }}"  data-lightbox-gallery="gallery"><i class="fa fa-picture-o"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Portfolio Item End -->

                        <!-- Portfolio Item Start -->
                        <div class="gallery-item">
                            <div class="thumb">
                                <img alt="project" src="{{ URL::asset('/public/assets/global/images/gallery/gallery-sm3.jpg') }}" class="img-fullwidth">
                                <div class="overlay-shade"></div>
                                <div class="icons-holder">
                                    <div class="icons-holder-inner">
                                        <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">
                                            <a href="{{ URL::asset('/public/assets/global/images/gallery/gallery-lg3.jpg') }}"  data-lightbox-gallery="gallery"><i class="fa fa-picture-o"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Portfolio Item End -->

                        <!-- Portfolio Item Start -->
                        <div class="gallery-item">
                            <div class="thumb">
                                <img alt="project" src="{{ URL::asset('/public/assets/global/images/gallery/gallery-sm4.jpg') }}" class="img-fullwidth">
                                <div class="overlay-shade"></div>
                                <div class="icons-holder">
                                    <div class="icons-holder-inner">
                                        <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">
                                            <a href="{{ URL::asset('/public/assets/global/images/gallery/gallery-lg4.jpg') }}"  data-lightbox-gallery="gallery"><i class="fa fa-picture-o"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Portfolio Item End -->

                        <!-- Portfolio Item Start -->
                        <div class="gallery-item">
                            <div class="thumb">
                                <img alt="project" src="{{ URL::asset('/public/assets/global/images/gallery/gallery-sm5.jpg') }}" class="img-fullwidth">
                                <div class="overlay-shade"></div>
                                <div class="icons-holder">
                                    <div class="icons-holder-inner">
                                        <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">
                                            <a href="{{ URL::asset('/public/assets/global/images/gallery/gallery-lg5.jpg') }}"  data-lightbox-gallery="gallery"><i class="fa fa-picture-o"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Portfolio Item End -->

                        <!-- Portfolio Item Start -->
                        <div class="gallery-item">
                            <div class="thumb">
                                <img alt="project" src="{{ URL::asset('/public/assets/global/images/gallery/gallery-sm6.jpg') }}" class="img-fullwidth">
                                <div class="overlay-shade"></div>
                                <div class="icons-holder">
                                    <div class="icons-holder-inner">
                                        <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">
                                            <a href="{{ URL::asset('/public/assets/global/images/gallery/gallery-lg6.jpg') }}"  data-lightbox-gallery="gallery"><i class="fa fa-picture-o"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Portfolio Item End -->

                        <!-- Portfolio Item Start -->
                        <div class="gallery-item">
                            <div class="thumb">
                                <img alt="project" src="{{ URL::asset('/public/assets/global/images/gallery/gallery-sm7.jpg') }}" class="img-fullwidth">
                                <div class="overlay-shade"></div>
                                <div class="icons-holder">
                                    <div class="icons-holder-inner">
                                        <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">
                                            <a href="{{ URL::asset('/public/assets/global/images/gallery/gallery-lg7.jpg') }}"  data-lightbox-gallery="gallery"><i class="fa fa-picture-o"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Portfolio Item End -->

                        <!-- Portfolio Item Start -->
                        <div class="gallery-item">
                            <div class="thumb">
                                <img alt="project" src="{{ URL::asset('/public/assets/global/images/gallery/gallery-sm8.jpg') }}" class="img-fullwidth">
                                <div class="overlay-shade"></div>
                                <div class="icons-holder">
                                    <div class="icons-holder-inner">
                                        <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">
                                            <a href="{{ URL::asset('/public/assets/global/images/gallery/gallery-lg8.jpg') }}"  data-lightbox-gallery="gallery"><i class="fa fa-picture-o"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Portfolio Item End -->

                        <!-- Portfolio Item Start -->
                        <div class="gallery-item">
                            <div class="thumb">
                                <img alt="project" src="{{ URL::asset('/public/assets/global/images/gallery/gallery-sm9.jpg') }}" class="img-fullwidth">
                                <div class="overlay-shade"></div>
                                <div class="icons-holder">
                                    <div class="icons-holder-inner">
                                        <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">
                                            <a href="{{ URL::asset('/public/assets/global/images/gallery/gallery-lg9.jpg') }}"  data-lightbox-gallery="gallery"><i class="fa fa-picture-o"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Portfolio Item End -->

                        <!-- Portfolio Item Start -->
                        <div class="gallery-item">
                            <div class="thumb">
                                <img alt="project" src="{{ URL::asset('/public/assets/global/images/gallery/gallery-sm10.jpg') }}" class="img-fullwidth">
                                <div class="overlay-shade"></div>
                                <div class="icons-holder">
                                    <div class="icons-holder-inner">
                                        <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">
                                            <a href="{{ URL::asset('/public/assets/global/images/gallery/gallery-lg10.jpg') }}"  data-lightbox-gallery="gallery"><i class="fa fa-picture-o"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Portfolio Item End -->

                        <!-- Portfolio Item Start -->
                        <div class="gallery-item">
                            <div class="thumb">
                                <img alt="project" src="{{ URL::asset('/public/assets/global/images/gallery/gallery-sm11.jpg') }}" class="img-fullwidth">
                                <div class="overlay-shade"></div>
                                <div class="icons-holder">
                                    <div class="icons-holder-inner">
                                        <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">
                                            <a href="{{ URL::asset('/public/assets/global/images/gallery/gallery-lg11.jpg') }}"  data-lightbox-gallery="gallery"><i class="fa fa-picture-o"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Portfolio Item End -->

                        <!-- Portfolio Item Start -->
                        <div class="gallery-item">
                            <div class="thumb">
                                <img alt="project" src="{{ URL::asset('/public/assets/global/images/gallery/gallery-sm12.jpg') }}" class="img-fullwidth">
                                <div class="overlay-shade"></div>
                                <div class="icons-holder">
                                    <div class="icons-holder-inner">
                                        <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">
                                            <a href="{{ URL::asset('/public/assets/global/images/gallery/gallery-lg12.jpg') }}"  data-lightbox-gallery="gallery"><i class="fa fa-picture-o"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Portfolio Item End -->
                            @endforelse

                    </div>
                    <!-- End Portfolio Gallery Grid -->
                </div>
                <div class="col-md-5 wow fadeInUp" data-wow-duration="0.8s" data-wow-delay="0.1s">
                    <h3 class="text-uppercase title line-bottom mt-0 mb-30 mt-sm-40"><i class="fa fa-photo text-gray-darkgray mr-10"></i>{!! trans('messages.photos_gallery') !!}</h3>

                    <div class="bxslider bx-nav-top">
                        <div class="testimonial media sm-maxwidth400 p-15 mt-0 mb-15">
                            <div class="pt-10">
                                <div class="thumb pull-left mb-0 mr-0 pr-20">
                                    <img width="75" class="img-circle" alt="" src="{{ URL::asset('/public/assets/global/images/testimonials/1.jpg') }}">
                                </div>
                                <div class="ml-100 ">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas vel sint, ut. Quisquam doloremque minus possimus eligendi dolore ad.</p>
                                    <p class="author mt-10">- <span class="text-theme-colored">Catherine Grace,</span> <small><em>CEO apple.inc</em></small></p>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial media sm-maxwidth400 p-15 mt-0 mb-15">
                            <div class="pt-10">
                                <div class="thumb pull-left mb-0 mr-0 pr-20">
                                    <img width="75" class="img-circle" alt="" src="{{ URL::asset('/public/assets/global/images/testimonials/1.jpg') }}">
                                </div>
                                <div class="ml-100 ">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas vel sint, ut. Quisquam doloremque minus possimus eligendi dolore ad.</p>
                                    <p class="author mt-10">- <span class="text-theme-colored">Catherine Grace,</span> <small><em>CEO apple.inc</em></small></p>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial media sm-maxwidth400 p-15 mt-0 mb-15">
                            <div class="pt-10">
                                <div class="thumb pull-left mb-0 mr-0 pr-20">
                                    <img width="75" class="img-circle" alt="" src="{{ URL::asset('/public/assets/global/images/testimonials/1.jpg') }}">
                                </div>
                                <div class="ml-100 ">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas vel sint, ut. Quisquam doloremque minus possimus eligendi dolore ad.</p>
                                    <p class="author mt-10">- <span class="text-theme-colored">Catherine Grace,</span> <small><em>CEO apple.inc</em></small></p>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial media sm-maxwidth400 p-15 mt-0 mb-15">
                            <div class="pt-10">
                                <div class="thumb pull-left mb-0 mr-0 pr-20">
                                    <img width="75" class="img-circle" alt="" src="{{ URL::asset('/public/assets/global/images/testimonials/1.jpg') }}">
                                </div>
                                <div class="ml-100 ">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas vel sint, ut. Quisquam doloremque minus possimus eligendi dolore ad.</p>
                                    <p class="author mt-10">- <span class="text-theme-colored">Catherine Grace,</span> <small><em>CEO apple.inc</em></small></p>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial media sm-maxwidth400 p-15 mt-0 mb-15">
                            <div class="pt-10">
                                <div class="thumb pull-left mb-0 mr-0 pr-20">
                                    <img width="75" class="img-circle" alt="" src="{{ URL::asset('/public/assets/global/images/testimonials/1.jpg') }}">
                                </div>
                                <div class="ml-100 ">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas vel sint, ut. Quisquam doloremque minus possimus eligendi dolore ad.</p>
                                    <p class="author mt-10">- <span class="text-theme-colored">Catherine Grace,</span> <small><em>CEO apple.inc</em></small></p>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial media sm-maxwidth400 p-15 mt-0 mb-15">
                            <div class="pt-10">
                                <div class="thumb pull-left mb-0 mr-0 pr-20">
                                    <img width="75" class="img-circle" alt="" src="{{ URL::asset('/public/assets/global/images/testimonials/1.jpg') }}">
                                </div>
                                <div class="ml-100 ">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas vel sint, ut. Quisquam doloremque minus possimus eligendi dolore ad.</p>
                                    <p class="author mt-10">- <span class="text-theme-colored">Catherine Grace,</span> <small><em>CEO apple.inc</em></small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
