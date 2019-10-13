@extends('layouts.global.global_layout')
@section('title',__('messages.my_profile'). " |")

@section('content')
    <div class="main-content">
        <section>
            <div class="container pb-0">
                <div class="section-content">
                    <div class="panel">
                        <div class="panel-heading bg-dark-transparent-1">
                            <h3 class="panel-title">{{user_information('full')." ".__('messages.welcome')}}</h3>
                        </div>
                        <div class="panel-body bg-white-fe">
                            <div class="row">
                                <div class="col-md-12 mb-sm-40">
                                    <div class="row">
                                        <div class="col-md-3 border-1px p-20">
                                            <span class="text-gray">{{__('messages.name_family')}}:</span>
                                            <span class="text-black">{{$userInfo['people']['name']}} {{$userInfo['people']['family']}}</span>
                                        </div>
                                        <div class="col-md-3 border-1px p-20">
                                            <span class="text-gray">{{__('messages.username')}}: </span>
                                            <span class="text-black">{{$userInfo['phone']}}</span>
                                            @if(!$userInfo['phone_verified_at'])
                                                <span class="badge badge-danger">{{__('messages.not_valid')}}</span>
                                                <a href="{{route('global_profile_send_sms')}}"
                                                   class="btn btn-success btn-block ajaxload-popup">{{__('messages.send_verify_sms')}}</a>
                                                @else
                                                <i class="fa fa-check text-success"></i>
                                            @endif
                                        </div>
                                        <div class="col-md-3 border-1px p-20">
                                            <span class="text-gray">{{__('messages.national_code')}}: </span>
                                            <span class="text-black">{{$userInfo['people']['national_code']}}</span>
                                        </div>

                                        <div class="col-md-3 border-1px p-20">
                                            <span class="text-gray">{{__('messages.email')}}: </span>
                                            <span class="text-black">{{$userInfo['email']}}</span>
                                            @if(!$userInfo['email_verified_at'])
                                                <span class="badge badge-danger">{{__('messages.not_valid')}}</span>
                                                <a href="{{route('global_profile_send_email')}}"
                                                   class="btn btn-success btn-block ajaxload-popup">{{__('messages.send_verify_email')}}</a>
                                            @else
                                                <i class="fa fa-check text-success"></i>
                                            @endif
                                        </div>
                                        <div class="col-md-12 border-1px p-20">
                                            <div class="row">
                                                <div class="col-md-3 col-xs-6 pt-xs-10">
                                                    <a href="{{route('global_profile_completion')}}"
                                                       class="btn btn-info btn-block">{{__('messages.completion_edit_information')}}</a>
                                                </div>
                                                <div class="col-md-3 col-xs-6 pt-xs-10">
                                                    <a href="{{route('global_profile_change_password')}}"
                                                       class="btn btn-success btn-block ajaxload-popup">{{__('messages.change_password')}}</a>
                                                </div>

                                                <div class="col-md-3 col-xs-6 pt-xs-10">
                                                    <a href="{{route('global_profile_addresses')}}"
                                                       class="btn btn-info btn-block">{{__('messages.edit_add_addresses')}}</a>
                                                </div>
                                                <div class="col-md-3 col-xs-6 pt-xs-10">
                                                    <button class="btn btn-default btn-block">{{__('messages.buy_report')}}</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container pt-0">
                <div class="section-content">
                    <div class="panel">
                        <div class="panel-body bg-white-fe">
                            <ul id="myTab" class="nav nav-tabs boot-tabs">
                                <li class="active">
                                    <a href="#payment_list" data-toggle="tab">{{__('messages.payment_list')}}</a></li>
                                <li><a href="#periodic_payment"
                                       data-toggle="tab">{{__('messages.periodic_payment')}}</a></li>

                                <li><a href="#paid"
                                       data-toggle="tab">{{__('messages.paid')}}</a></li>
                            </ul>
                            <div id="myTabContent" class="tab-content">
                                <div class="tab-pane fade in active" id="payment_list">
                                    <div class="table-responsive">
                                        <table class="table table-striped text-center table-bordered">
                                            <thead class="text-center">
                                            <tr>
                                                <th class="text-center">{{__('messages.amount')}}
                                                    <small>({{__('messages.rial')}})</small>
                                                </th>
                                                <th class="text-center">{{__('messages.start_date')}}</th>
                                                <th class="text-center">{{__('messages.description')}}</th>
                                                <th class="text-center">{{__('messages.status')}}</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody class="text-center">
                                            @foreach($unpaidPeriod as $unpaid)
                                                <?php $color = "label-warning" ?>
                                                <?php $text = "unpaid" ?>
                                                <?php $btn_color = "success" ?>
                                                @if($unpaid['status']=='paid')
                                                    <?php $color = "label-success" ?>
                                                    <?php $text = "paid" ?>
                                                    <?php $btn_color = "warning" ?>
                                                @endif
                                                <tr>
                                                    <td>{{number_format($unpaid['amount'])}}</td>
                                                    <td>{{miladi_to_shamsi_date($unpaid['payment_date'])}}</td>
                                                    <td>{{$unpaid['description']}}</td>
                                                    <td>
                                                        <span class="label {{$color}}">{{__("messages.".$unpaid['status'])}}</span>
                                                    </td>
                                                    <td>
                                                        <a href="{{route('vow_cart',['id'=>$unpaid['id']])}}"
                                                           class="btn btn-xs btn-{{$btn_color}} btn-pay">
                                                            {{__('messages.pay')}} <i class="fa fa-chevron-left"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="periodic_payment">
                                    <div class="table-responsive">
                                        <table class="table table-striped text-center table-bordered">
                                            <thead class="text-center">
                                            <tr>
                                                <th>{{__('messages.amount')}}</th>
                                                <th>{{__('messages.start_date')}}</th>
                                                <th>{{__('messages.period')}}</th>
                                                <th>{{__('messages.description')}}</th>
                                                <th>{{__('messages.status')}}</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody class="text-center">
                                            @foreach($periods as $period)
                                                <?php $color = "label-warning" ?>
                                                <?php $text = "activate" ?>
                                                <?php $btn_color = "success" ?>
                                                @if($period['status']=='active')
                                                    <?php $color = "label-success" ?>
                                                    <?php $text = "inactivate" ?>
                                                    <?php $btn_color = "danger" ?>
                                                @endif
                                                <tr>
                                                    <td>{{$period['amount']}}</td>
                                                    <td>{{miladi_to_shamsi_date($period['start_date'])}}</td>
                                                    <td>{{$period['period']}}</td>
                                                    <td>{{$period['description']}}</td>
                                                    <td>
                                                        <span class="label {{$color}}">{{__("messages.".$period['status'])}}</span>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-{{$btn_color}} btn-xs btn-delete"
                                                                data-id="{{$period['id']}}">{{__('messages.'.$text)}}</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="paid">
                                    <div class="table-responsive">
                                        <table class="table table-striped text-center table-bordered">
                                            <thead class="text-center">
                                            <tr>
                                                <th>{{__('messages.amount')}}</th>
                                                <th>{{__('messages.start_date')}}</th>
                                                <th>{{__('messages.period')}}</th>
                                                <th>{{__('messages.description')}}</th>
                                                <th>{{__('messages.status')}}</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody class="text-center">
                                            @foreach($periods as $period)
                                                <?php $color = "label-warning" ?>
                                                <?php $text = "activate" ?>
                                                <?php $btn_color = "success" ?>
                                                @if($period['status']=='active')
                                                    <?php $color = "label-success" ?>
                                                    <?php $text = "inactivate" ?>
                                                    <?php $btn_color = "danger" ?>
                                                @endif
                                                <tr>
                                                    <td>{{$period['amount']}}</td>
                                                    <td>{{miladi_to_shamsi_date($period['start_date'])}}</td>
                                                    <td>{{$period['period']}}</td>
                                                    <td>{{$period['description']}}</td>
                                                    <td>
                                                        <span class="label {{$color}}">{{__("messages.".$period['status'])}}</span>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-{{$btn_color}} btn-xs btn-delete"
                                                                data-id="{{$period['id']}}">{{__('messages.'.$text)}}</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @csrf
    </div>
@endsection
@section('js')
    <script src="{{ URL::asset('/node_modules/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $(document).on('click', '.btn-delete', function () {
                var id = $(this).data('id');
                Swal.fire({
                    title: '{{__('messages.change_status')}}',
                    text: "{{__('messages.are_you_sure')}}",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '{{__('messages.yes_i_sure')}}',
                    cancelButtonText: '{{__('messages.cancel')}}'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: "{{route('global_profile_delete_period')}}",
                            type: "post",
                            data: {id: id},
                            headers: {
                                'X-CSRF-TOKEN': $('input[name="_token"]').val()
                            },
                            success: function (response) {
                                $.each(response, function (index, value) {
                                    PNotify.success({
                                        text: value.message,
                                        delay: 3000,
                                    });
                                })
                                setTimeout(function () {
                                    location.reload();
                                }, 3000);
                            }, error: function (response) {
                                var errors = response.responseJSON.errors;
                                $.each(errors, function (index, value) {
                                    PNotify.error({
                                        delay: 3000,
                                        title: index,
                                        text: value,
                                    });
                                });
                            }
                        });
                    }
                })
            })
        })
    </script>
@stop
