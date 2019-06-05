@extends('layouts.global.global_layout')
@section('content')
    <div class="main-content">
        <!-- Section: inner-header -->
        <section class="inner-header divider parallax layer-overlay overlay-dark-6" data-bg-img="{{URL::asset('/public/assets/global/images/bg/bg6.jpg')}}">
            <div class="container pt-60 pb-60">
                <!-- Section Content -->
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h3 class="font-28 text-white">{{__('messages.account')}}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-md-push-3">
                        <form name="reg-form" class="register-form" method="post">
                            <div class="icon-box mb-0 p-0">
                                <a href="#" class="icon icon-bordered icon-rounded icon-sm pull-left mb-0 mr-10">
                                    <i class="pe-7s-users"></i>
                                </a>
                                <h4 class="text-gray pt-10 mt-0 mb-30">{{__('messages.register_page_title')}}</h4>
                            </div>
                            <hr>
                            <p class="text-gray">{{__('messages.register_page_description')}}</p>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>{{__('messages.name')}}</label>
                                    <input name="form_name" class="form-control" type="text">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>{{__('messages.email')}}</label>
                                    <input name="form_email" class="form-control" type="email">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="form_choose_username">{{__('messages.email_or_phone')}}</label>
                                    <input id="form_choose_username" name="form_choose_username" class="form-control" type="text">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="form_choose_password">{{__('messages.password')}}</label>
                                    <input id="form_choose_password" name="form_choose_password" class="form-control" type="text">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>{{__('messages.repeat_password')}}</label>
                                    <input id="form_re_enter_password" name="form_re_enter_password"  class="form-control" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-dark btn-lg btn-block mt-15" type="submit">{{__('messages.register')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

