@extends('layouts.global.global_layout')
@section('content')

    <section>
        <div class="content">
            <div class="container-fluid">
                <h4 class="text-center">{{__('messages.please_waite')}}</h4>
                <div>
                    {!! $form !!}
                </div>
            </div>
        </div>
    </section>
@stop
