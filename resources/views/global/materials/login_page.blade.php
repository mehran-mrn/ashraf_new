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
                    <h4 class="text-gray mt-0 pt-5"> {{__('messages.login')}}</h4>
                    <hr>
                    <p>{{__('messages.login_page_title')}}</p>
                    <form name="login-form" class="clearfix">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="form_username_email">{{__('messages.email_or_mobile')}}</label>
                                <input id="form_username_email" name="form_username_email" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="form_password">{{__('messages.password')}}</label>
                                <input id="form_password" name="form_password" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="checkbox pull-left mt-15">
                            <label for="form_checkbox">
                                <input id="form_checkbox" name="form_checkbox" type="checkbox">
                                {{__('messages.remember_me')}} </label>
                        </div>
                        <div class="form-group pull-right mt-10">
                            <button type="submit" class="btn btn-dark btn-sm">{{__('messages.login')}}</button>
                        </div>
                        <div class="clear text-center pt-10">
                            <a class="text-theme-colored font-weight-600 font-12" href="#">{{__('messages.forgot_password')}}</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

