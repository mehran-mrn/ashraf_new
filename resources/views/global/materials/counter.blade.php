<!-- Divider: Funfact -->
<section class="divider parallax layer-overlay overlay-theme-colored-9" data-bg-img="{{ URL::asset('/public/assets/global/images/bg/bg24.jpg') }}" data-parallax-ratio="0.7">
    <div class="container pt-15 pb-15">
        <div class="row">
            @forelse(get_option('display_statistic',4,true) as $statistic)
                <div class="col-xs-6 col-sm-3 col-md-3 mb-md-20">
                    <div class="funfact text-center">
                        <i class="{{json_decode($statistic['value'],true)['icon']}} mt-5 text-white"></i>
                        <h2 data-animation-duration="2000" data-value="{{json_decode($statistic['value'],true)['value']}}" class="animate-number text-white font-42 font-weight-500 mt-0 mb-0">0</h2>
                        <h5 class="text-white text-uppercase font-weight-600">{{json_decode($statistic['value'],true)['title']}}</h5>
                    </div>
                </div>

            @empty
            <div class="col-xs-6 col-sm-3 col-md-3 mb-md-20">
                <div class="funfact text-center">
                    <i class="pe-7s-smile mt-5 text-white"></i>
                    <h2 data-animation-duration="2000" data-value="754" class="animate-number text-white font-42 font-weight-500 mt-0 mb-0">0</h2>
                    <h5 class="text-white text-uppercase font-weight-600">Happy Donators</h5>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3 col-md-3 mb-md-20">
                <div class="funfact text-center">
                    <i class="pe-7s-rocket mt-5 text-white"></i>
                    <h2 data-animation-duration="2000" data-value="675" class="animate-number text-white font-42 font-weight-500 mt-0 mb-0">0</h2>
                    <h5 class="text-white text-uppercase font-weight-600">Success Mission</h5>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3 col-md-3 mb-md-20">
                <div class="funfact text-center">
                    <i class="pe-7s-add-user mt-5 text-white"></i>
                    <h2 data-animation-duration="2000" data-value="1248" class="animate-number text-white font-42 font-weight-500 mt-0 mb-0">0</h2>
                    <h5 class="text-white text-uppercase font-weight-600">Volunteer Reached</h5>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3 col-md-3 mb-md-20">
                <div class="funfact text-center">
                    <i class="pe-7s-global mt-5 text-white"></i>
                    <h2 data-animation-duration="2000" data-value="24" class="animate-number text-white font-42 font-weight-500 mt-0 mb-0">0</h2>
                    <h5 class="text-white text-uppercase font-weight-600">Globalization Work</h5>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>
