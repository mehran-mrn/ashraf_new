<!-- Divider: Clients -->
<section class="clients bg-theme-colored">
    <div class="container pt-0 pb-0">
        <div class="row">
            <div class="col-md-12">
                <!-- Section: Clients -->
                <div class="owl-carousel-6col clients-logo transparent text-center">
                    @forelse(get_option('adv_bar') as $adv_bar)

                        <div class="item"> <a href="{{url(json_decode($adv_bar['value'],true)['link'])}}"><img src="{{url(json_decode($adv_bar['value'],true)['image'])}}" alt=""></a></div>

                    @empty
                    <div class="item"> <a href="#"><img src="{{ URL::asset('/public/assets/global/images/clients/w1.png') }}" alt=""></a></div>
                    <div class="item"> <a href="#"><img src="{{ URL::asset('/public/assets/global/images/clients/w2.png') }}" alt=""></a></div>
                    <div class="item"> <a href="#"><img src="{{ URL::asset('/public/assets/global/images/clients/w3.png') }}" alt=""></a></div>
                    <div class="item"> <a href="#"><img src="{{ URL::asset('/public/assets/global/images/clients/w4.png') }}" alt=""></a></div>
                    <div class="item"> <a href="#"><img src="{{ URL::asset('/public/assets/global/images/clients/w5.png') }}" alt=""></a></div>
                    <div class="item"> <a href="#"><img src="{{ URL::asset('/public/assets/global/images/clients/w6.png') }}" alt=""></a></div>
                    <div class="item"> <a href="#"><img src="{{ URL::asset('/public/assets/global/images/clients/w3.png') }}" alt=""></a></div>
                    <div class="item"> <a href="#"><img src="{{ URL::asset('/public/assets/global/images/clients/w4.png') }}" alt=""></a></div>
                    <div class="item"> <a href="#"><img src="{{ URL::asset('/public/assets/global/images/clients/w5.png') }}" alt=""></a></div>
                    <div class="item"> <a href="#"><img src="{{ URL::asset('/public/assets/global/images/clients/w6.png') }}" alt=""></a></div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>