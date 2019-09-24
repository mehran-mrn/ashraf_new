@extends('layouts.global.global_layout')
@section('content')
    <div class="main-content">


        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-md-push-3">
                        <h4 class="text-gray mt-0 pt-5"> {{__('messages.login_page_title')}}</h4>
                        <hr>
                        @if(session()->has('message'))
                            <div class="alert alert-success text-center">
                                {{ session()->get('message') }}
                            </div>
                        @endif
                        @php
                        session()->remove('message')
                        @endphp
                        <p>
                            @if (Auth::check())
                                {{Auth::user()->created_at}}
                                @php \Illuminate\Support\Facades\Auth::logout() @endphp
                            @else
                            @endif
                        </p>
                        <form name="login-form" class="clearfix" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="name">{{__('messages.email_or_mobile')}}</label>
                                    <input id="name" name="name" class="form-control" type="text">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="password">{{__('messages.password')}}</label>
                                    <input id="password" name="password" class="form-control" type="text">
                                </div>
                                <div class="form-group col-md-12 col-xs-12">
                                    <div class="checkbox pull-right mt-15">
                                        <label for="remember">
                                            <input id="remember" name="remember" type="checkbox">
                                            {{__('messages.remember_me')}} </label>
                                    </div>
                                </div>
                                <div class=" col-md-6 col-md-offset-3">
                                    <button type="submit"
                                            class="btn btn-colored  btn-theme-colored p-10 mt-15 btn-block">{{__('messages.login')}}</button>
                                    <a href="{{route('global_register_page')}}"
                                       class="btn btn-default btn-sm p-10 btn-block">{{__('messages.register')}}</a>
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="clear text-center pt-10">
                                        <a class="text-theme-colored font-weight-600 font-12"
                                           href="#">{{__('messages.forgot_password')}}</a>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

