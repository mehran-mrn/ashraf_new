<!-- Section: home-boxes -->
<section class="">
    <div class="container pt-10 pb-10">
        <div class="section-content">
            <div class="row equal-height-inner home-boxes">
                @forelse(get_option('adv_card') as $adv_card)
                    <div class="col-sm-6 col-xs-6 col-md-3 p-0 sm-height-auto wow fadeInUp" data-wow-duration="1.2s" data-wow-delay="0.3s">
                        <a href="{{json_decode($adv_card['value'],true)['link']}}" >
                        <div class="sm-height-auto p-5 rounded">

                            <img class="img-absolute-parent" src="{{URL::asset(json_decode($adv_card['value'],true)['image'])}}">
                        </div>
                        </a>
                    </div>
                @empty
                <div class="col-sm-12 col-md-4 pr-0 pr-sm-15 sm-height-auto mt-sm-0 wow fadeInUp" data-wow-duration="0.6s" data-wow-delay="0.1s">
                    <div class="sm-height-auto bg-theme-colored">
                        <div class="p-30 mb-sm-30">
                            <h3 class="text-uppercase text-white mt-0">عنوان</h3>
                            <p class="text-white">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.</p>
                            <a href="page-become-a-volunteer.html" class="btn btn-border btn-circled btn-transparent btn-s pull-left">Join us Now</a>
                        </div>
                        <i class=" bg-icon"></i>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 pr-0 pr-sm-15 sm-height-auto mt-sm-0 wow fadeInUp" data-wow-duration="0.6s" data-wow-delay="0.1s">
                    <div class="sm-height-auto bg-theme-colored-darker2">
                        <div class="p-30 mb-sm-30">
                            <h3 class="text-uppercase text-white mt-0">Adopt a Child</h3>
                            <p class="text-white">Lorem ipsum dolor sit amet, consectetur adipisicing.</p>
                            <a href="#" class="btn btn-border btn-circled btn-transparent btn-sm pull-left">Contact us</a>
                        </div>
                        <i class=" bg-icon"></i>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 pr-0 pr-sm-15 sm-height-auto mt-sm-0 wow fadeInUp" data-wow-duration="0.6s" data-wow-delay="0.1s">
                    <div class="sm-height-auto bg-theme-colored-darker3">
                        <div class="p-30 mb-sm-30">
                            <h3 class="text-uppercase text-white mt-0">Get Involved</h3>
                            <p class="text-white">Lorem ipsum dolor sit amet, consectetur adipisicing.</p>
                            <a href="page-donate.html" class="btn btn-border btn-circled btn-transparent btn-sm pull-left">Donate Us</a>
                        </div>
                        <i class=" bg-icon"></i>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</section>
