@extends('layouts.global.global_layout')
@section('js')
    <script>
    </script>
@endsection
@section('css')
    <style>
        .border {
            border: 2px solid #88e0a1 !important;
        }

    </style>
@endsection
@section('content')
    <!-- Start main-content -->
    <div class="main-content">

        <section class="">
            <div class="container mt-30 mb-30 p-30">

                <div class="row">
                    <div class="col-md-4 text-center step_one">
                        <h3 class="badge badge-success text-success">1</h3><br>
                        <i class="fa fa-user fa-3x mb-10"></i>
                        <h5>{{__('messages.login/register')}}</h5>
                    </div>
                    <div class="col-md-4 text-center step_two">
                        <h3 class="badge badge-danger">2</h3><br>
                        <i class="fa fa-truck fa-3x  mb-10"></i>
                        <h5>{{__('messages.send_information')}}</h5>
                    </div>
                    <div class="col-md-4 bg-success text-center step_three">
                        <h3 class="badge badge-danger">3</h3><br>
                        <i class="fa fa-amazon fa-3x text-success mb-10"></i>
                        <h5>{{__('messages.payment_information')}}</h5>

                    </div>
                </div>
                <div class="clearfix"></div>
                <hr>

                <div class="row">
                    <div class="col-md-12">
                        <label><i class="fa fa-angle-left"></i> {{__('messages.order_title')}}</label>
                        <div class="row">
                            @if(session('cart'))
                                @foreach(session('cart') as $id => $details)
                                    <div class="col-md-6 col-xs-12 text-center">
                                        <img src="{{$details['photo']}}" alt="{{$details['title']}}" width="100"
                                             height="100"
                                             class=" center text-center mr-auto ml-auto">
                                        <h6 class="text-center">{{$details['title']}}</h6>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label><i class="fa fa-angle-left"></i> {{__('messages.customer_information')}}</label>
                        <table class="table table-bordered border">
                            <tbody>
                            <tr>
                                <td rowspan="2" colspan="1" class="col-md-1 success"><i
                                            class="fa fa-check-square-o fa-3x text-success mr-20 mt-10"></i></td>
                                <td colspan="4">
                                    <label class="text-secondary">{{__('messages.name_family')}}: </label>
                                    <span>{{Auth::id()}}</span>
                                </td>
                                <td colspan="4">
                                    <label class="text-secondary">{{__('messages.phone')}}: </label>
                                    <span>{{Auth::id()}}</span>
                                </td>
                                <td colspan="4">
                                    <label class="text-secondary">{{__('messages.mobile')}}: </label>
                                    <span>{{Auth::id()}}</span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <label class="text-secondary">{{__('messages.zip_code')}}: </label>
                                    <span>{{Auth::id()}}</span>
                                </td>
                                <td colspan="8">
                                    <label class="text-secondary">{{__('messages.address')}}: </label>
                                    <span>{{Auth::id()}}</span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <button class="btn btn-xs btn-success pull-left">{{__('messages.change_address')}}</button>
                    </div>
                    <div class="col-md-12">
                        <label><i class="fa fa-angle-left"></i> {{__('messages.how_to_send')}}</label>
                        <table class="table table-bordered border text-center" style="vertical-align: middle">
                            <tbody>
                            @foreach($tran as $tra)
                                <tr>
                                    <td colspan="1" class="col-md-1 success" style="vertical-align: middle">
                                        <i class="fa fa-check-square-o fa-3x text-success align-middle text-center"></i>
                                    </td>
                                    <td class="align-middle" style="vertical-align: middle">
                                        <i class="fa fa-truck fa-2x pull-right mr-20"></i>
                                        <span class="pull-right align-middle mr-20">{{$tra['title']}}</span>
                                        <span class="pull-left align-middle ml-20 text-success">{{__("messages.free")}}</span>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-12">
                        <label><i class="fa fa-angle-left"></i> {{__('messages.send_time')}}</label>
                        <table class="table table-bordered border text-center" style="vertical-align: middle">
                            <tbody>
                            <?php
                            $time = 0;
                            ?>
                            @if(session('cart'))
                                @foreach(session('cart') as $id => $details)
                                    <?php
                                    if ($details['time'] > $time) {
                                        $time = $details['time'];
                                    }
                                    ?>
                                @endforeach
                            @endif
                            <tr>
                                <td colspan="1" class="col-md-1 success" style="vertical-align: middle">
                                    <i class="fa fa-check-square-o fa-3x text-success align-middle text-center"></i>
                                </td>
                                <td class="align-middle" style="vertical-align: middle">
                                    <i class="fa fa-truck fa-2x pull-right mr-20"></i>
                                    <span class="pull-right align-middle mr-20">{{__('messages.max_send_time_your_order')}}</span>
                                    <span class="pull-left align-middle ml-20 text-success">{{$time."  ". __("messages.work_day")}}</span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div>

                <a href="" class="btn btn-success pull-left p-10 pr-20 pl-20">{{__('messages.continue_shopping')}} <i
                            class="fa fa-caret-left pr-10"></i></a>

            </div>
        </section>
        <!-- end main-content -->

@endsection
