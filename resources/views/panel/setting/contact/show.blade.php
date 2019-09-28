@extends('layouts.panel.panel_layout')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('js')

@endsection
@section('css')
@stop
@php
    $active_sidbare = ['setting', 'contact'];
@endphp
@section('content')
    <section>
        <div class="content">
            <div class="container-fluid">
                <section>
                    <a href="{{route('contact.index')}}"
                       class="btn btn-outline-dark m-2 py-2 px-3">{{__('messages.back')}}</a>
                </section>
            </div>
            <section>
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title text-black">{{__('messages.contact_to_we')}}
                            | {{$info['name'] ? $info['name'] : ''}}</h6>
                        <hr>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-3 py-2">
                            <h4 class="font-weight-semibold mb-1">{{$info['subject']}}</h4>
                            <span class="text-muted d-block"
                                  dir='ltr'>{{__('messages.message')}}:  {{$info['message']}}</span>
                        </div>
                        <div class="container">
                            <hr>
                            <div class="row">
                                <div class="col-6 py-2">
                                    <label for="">{{__('messages.email')}}</label>
                                    <span>{{$info['email']}}</span>
                                </div>
                                <div class="col-6 py-2">
                                    <label for="">{{__('messages.phone')}}</label>
                                    <span>{{$info['phone']}}</span>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <form action="" method="post">
                            <div class="row text-center">
                                <div class="col-12 form-group">
                                    <label for="">{{__('messages.response')}}</label>
                                    <textarea name="response" id="response" cols="30" rows="10"
                                              class="form-control"></textarea>
                                </div>
                                <div class="col-12 form-group">
                                    <button type="submit"
                                            class="btn btn-primary float-right">{{__('messages.send_message')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </section>
@stop