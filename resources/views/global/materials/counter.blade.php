<!-- Divider: Funfact -->
<section class="parallax "
         data-parallax-ratio="0.7">
    <div class="container ">
        <div class="section-content">

    <?php $counters = get_option('display_statistic', 4, true)?>
    <div class="row equal-height-inner home-boxes" data-margin-top="-100px" style="margin-top: -100px;">
        <div class="col-sm-6 col-md-3 pl-0 pl-sm-15 pr-0 pr-sm-15 sm-height-auto mt-sm-0 wow fadeInLeft animation-delay1"
             style="min-height: 14.36em; visibility: visible;">
            <div class="sm-height-auto bg-theme-colored" style="min-height: 201.04px;">
                <div class="text-center pt-10 pb-30">
                    @if(isset($counters[0]))
                        <i class="{{json_decode($counters[0]['value'],true)['icon']}} text-white font-64"></i>
                        <h2 data-animation-duration="2000"
                            data-value="{{json_decode($counters[0]['value'],true)['value']}}"
                            class="animate-number text-white font-42 font-weight-500 mt-0 mb-0">0</h2>
                        <h4 class="text-uppercase mt-0">{{json_decode($counters[0]['value'],true)['title']}}</h4>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3 pl-0 pl-sm-15 pr-0 pr-sm-15 sm-height-auto mt-sm-0 wow fadeInLeft animation-delay2"
             style="min-height: 14.36em; visibility: visible;">
            <div class="sm-height-auto bg-theme-colored-darker2" style="min-height: 201.04px;">
                <div class="text-center pt-10 pb-30">
                    @if(isset($counters[1]))

                        <i class="{{json_decode($counters[1]['value'],true)['icon']}} text-white font-64"></i>
                        <h2 data-animation-duration="2000"
                            data-value="{{json_decode($counters[1]['value'],true)['value']}}"
                            class="animate-number text-white font-42 font-weight-500 mt-0 mb-0">0</h2>

                        <h4 class="text-uppercase mt-0">{{json_decode($counters[1]['value'],true)['title']}}</h4>

                    @endif

                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3 pl-0 pl-sm-15 pr-0 pr-sm-15 sm-height-auto mt-sm-0 wow fadeInLeft animation-delay3"
             style="min-height: 14.36em; visibility: visible;">
            <div class="sm-height-auto bg-theme-colored-darker3" style="min-height: 201.04px;">
                <div class="text-center pt-10 pb-30">
                    @if(isset($counters[2]))

                        <i class="{{json_decode($counters[2]['value'],true)['icon']}} text-white font-64"></i>
                        <h2 data-animation-duration="2000"
                            data-value="{{json_decode($counters[2]['value'],true)['value']}}"
                            class="animate-number text-white font-42 font-weight-500 mt-0 mb-0">0</h2>

                        <h4 class="text-uppercase mt-0">{{json_decode($counters[2]['value'],true)['title']}}</h4>
                    @endif

                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3 pl-0 pl-sm-15 pr-0 pr-sm-15 sm-height-auto mt-sm-0 wow fadeInLeft animation-delay4"
             style="min-height: 14.36em; visibility: visible;">
            <div class="sm-height-auto bg-theme-colored-darker4" style="min-height: 201.04px;">
                <div class="text-center pt-10 pb-30">
                    @if(isset($counters[3]))

                        <i class="{{json_decode($counters[3]['value'],true)['icon']}} text-white font-64"></i>
                        <h2 data-animation-duration="2000"
                            data-value="{{json_decode($counters[3]['value'],true)['value']}}"
                            class="animate-number text-white font-42 font-weight-500 mt-0 mb-0">0</h2>

                        <h4 class="text-uppercase mt-0">{{json_decode($counters[3]['value'],true)['title']}}</h4>
                    @endif

                </div>
            </div>
        </div>
    </div>
    </div>
    </div>


</section>



