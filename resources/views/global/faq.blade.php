@extends('layouts.global.global_layout')
@section('title',__('messages.home'). " |")

@section('content')


    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div id="accordion1" class="panel-group accordion transparent">
                        @foreach($faqs as $key => $faq)
                        <div class="panel">
                            <div class="panel-title"> <a data-parent="#accordion-0" data-toggle="collapse" href="#accordion-{{$key}}" class=" {{$key ==0?"active":"collapsed"}}" aria-expanded="true">
                                    <span class=" open-sub"></span>
                                    <strong class="text-theme-colored">{{$faq['question']}}</strong></a>
                            </div>
                            <div id="accordion-{{$key}}" class="panel-collapse collapse {{$key ==0?"in":""}}" role="tablist" aria-expanded="{{$key ==0?"true":"false"}}" style="{{$key !=0?"height: 0px;":""}}">
                                <div class="panel-content">
                                    {!! $faq['answer'] !!}
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
