@extends('layouts.global.global_layout')
@section('content')
<div class="main-content">
    <!-- Section: inner-header -->
    <section class="inner-header divider parallax layer-overlay overlay-dark-6" data-bg-img="images/bg/bg6.jpg">
        <div class="container pt-60 pb-60">
            <!-- Section Content -->
            <div class="section-content">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h3 class="font-28 text-white">{{__('messages.my_account')}}</h3>
                            <ol class="breadcrumb text-center text-black mt-10">
                                <li><a href="#">{{__('messages.home')}}</a></li>
                                <li><a href="#">{{__('pages')}}</a></li>
                                <li class="active text-theme-colored">{{__('page_title')}}</li>
                            </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-push-3">
                    <h4 class="text-gray mt-0 pt-5"> Login</h4>
                    <hr>
                    <p>Lorem ipsum dolor sit amet, consectetur elit.</p>
                    <form name="login-form" class="clearfix">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="form_username_email">Username/Email</label>
                                <input id="form_username_email" name="form_username_email" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="form_password">Password</label>
                                <input id="form_password" name="form_password" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="checkbox pull-left mt-15">
                            <label for="form_checkbox">
                                <input id="form_checkbox" name="form_checkbox" type="checkbox">
                                Remember me </label>
                        </div>
                        <div class="form-group pull-right mt-10">
                            <button type="submit" class="btn btn-dark btn-sm">Login</button>
                        </div>
                        <div class="clear text-center pt-10">
                            <a class="text-theme-colored font-weight-600 font-12" href="#">Forgot Your Password?</a>
                        </div>
                        <div class="clear text-center pt-10">
                            <a class="btn btn-dark btn-lg btn-block no-border mt-15 mb-15" href="#" data-bg-color="#3b5998">Login with facebook</a>
                            <a class="btn btn-dark btn-lg btn-block no-border" href="#" data-bg-color="#00acee">Login with twitter</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

