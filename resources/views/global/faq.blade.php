@extends('layouts.global.global_layout')
@section('title',__('messages.home'). " |")

@section('content')

    <section class="position-inherit">
        <div class="container">
            <div class="row">
                <div class="col-md-3 scrolltofixed-container">
                    <div class="list-group scrolltofixed z-index-0">
                        @foreach($faqs as $faq)
                        <a href="#section-{{$faq['id']}}" class="list-group-item smooth-scroll-to-target">{{$faq['question']}}</a>
                        @endforeach

                    </div>
                </div>
                <div class="col-md-9">
                    @foreach($faqs as $faq)
                        <div id="section-{{$faq['id']}}" class="mb-50">
                        <h3>{{$faq['question']}}</h3>
                        <hr>
                            {!! $faq['answer'] !!}
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>
@endsection
