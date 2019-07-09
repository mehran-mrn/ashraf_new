<section class="">
    <div class="container" style="max-width: 700px">
        <h3 class="bg-theme-colored text-center p-15 mb-0 text-white">{{trans('messages.edit_information')}}</h3>
        <div class="section-content bg-white p-30">
            <div class="row">
                <div class="col-md-10 col-md-push-1">
                    <form name="login-form" method="post" action="{{route('global_update_information')}}" class="clearfix">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-12 col-xs-12 ">
                                <label for="name_family" class="pull-right">{{__('messages.name_family')}}</label>
                                <input id="name_family" name="name_family" class="form-control left"
                                       type="text" value="{{$userInfo['name']}}">
                            </div>

                            <div class="form-group col-md-6 col-xs-12 ">
                                <label for="email" class="pull-right">{{__('messages.email')}}</label>
                                <input id="email" name="family" class="form-control left"
                                       type="email" value="{{$userInfo['email']}}">
                            </div>

                            <div class="form-group col-md-6 col-xs-12 ">
                                <label for="phone" class="pull-right">{{__('messages.phone')}}</label>
                                <input id="phone" name="phone" class="form-control left"
                                       type="text" value="">
                            </div>
                            <div class="form-group col-md-6 col-xs-12 ">
                                <label for="mobile" class="pull-right">{{__('messages.mobile')}}</label>
                                <input id="mobile" name="mobile" class="form-control left"
                                       type="text" value="">
                            </div>
                            <div class="form-group col-md-6 col-xs-12 ">
                                <label for="national_code" class="pull-right">{{__('messages.national_code')}}</label>
                                <input id="national_code" name="national_code" class="form-control left"
                                       type="text" value="">
                            </div>
                        </div>
                        <div class="clear text-center pt-10">
                            <button type="submit" class="btn btn-dark btn-lg btn-block no-border mt-15 mb-15"
                               data-bg-color="#3b5998">{{__('messages.edit_information')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
