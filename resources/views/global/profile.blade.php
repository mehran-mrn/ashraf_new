@extends('layouts.global.global_layout')

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
                                        <div class="col-md-4 border-1px p-20">
                                            <span class="text-gray">{{__('messages.name_family')}}:</span>
                                            <span class="text-black">{{user_information('full')}}</span>
                                        </div>
                                        <div class="col-md-4 border-1px p-20">
                                            <span class="text-gray">{{__('messages.username')}}: </span>
                                            <span class="text-black">mk.kardgar@gmail.com</span>
                                        </div>
                                        <div class="col-md-4 border-1px p-20">
                                            <span class="text-gray">{{__('messages.national_code')}}: </span>
                                            <span class="text-black">2050101813</span>
                                        </div>
                                        <div class="col-md-4 border-1px p-20">
                                            <span class="text-gray">{{__('messages.sex')}}: </span>
                                            <span class="text-black">مرد</span>
                                        </div>
                                        <div class="col-md-4 border-1px p-20">
                                            <span class="text-gray">{{__('messages.phone')}}: </span>
                                            <span class="text-black">82202910</span>
                                        </div>
                                        <div class="col-md-4 border-1px p-20">
                                            <span class="text-gray">{{__('messages.mobile')}}: </span>
                                            <span class="text-black">09356070351</span>
                                        </div>
                                        <div class="col-md-12 border-1px p-20">
                                            <div class="row">
                                                <div class="col-md-2 col-xs-6 pt-xs-10">
                                                    <a href="{{route('global_profile_change_password')}}"
                                                       class="btn btn-success btn-block ajaxload-popup">{{__('messages.change_password')}}</a>
                                                </div>
                                                <div class="col-md-2 col-xs-6 pt-xs-10">
                                                    <a href="{{route('global_profile_edit_information')}}"
                                                       class="btn btn-danger btn-block ajaxload-popup">{{__('messages.edit_information')}}</a>
                                                </div>
                                                <div class="col-md-2 col-xs-6 pt-xs-10">
                                                    <button class="btn btn-default btn-block ">{{__('messages.payment_report')}}</button>
                                                </div>
                                                <div class="col-md-2 col-xs-6 pt-xs-10">
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
                                <li><a href="#periodic_payemnt"
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
                                                <th>{{__('messages.amount')}}</th>
                                                <th>{{__('messages.start_date')}}</th>
                                                <th>{{__('messages.description')}}</th>
                                                <th>{{__('messages.status')}}</th>
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
                                                    <td>{{$unpaid['amount']}}</td>
                                                    <td>{{miladi_to_shamsi_date($unpaid['payment_date'])}}</td>
                                                    <td>{{$unpaid['description']}}</td>
                                                    <td>
                                                        <span class="label {{$color}}">{{__("messages.".$unpaid['status'])}}</span>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-{{$btn_color}}  btn-delete"
                                                                data-id="{{$unpaid['id']}}">
                                                            {{__('messages.pay')}} <i class="fa fa-chevron-left"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="periodic_payemnt">
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

        <!-- Section: Divider call -->
        <section class="divider layer-overlay overlay-theme-colored" data-bg-img="images/bg/bg3.jpg">
            <div class="container pt-0 pb-0">
                <div class="row">
                    <div class="call-to-action">
                        <div class="col-md-9">
                            <h2 class="text-white font-opensans font-30 mt-0 mb-5">Please raise your hand</h2>
                            <h3 class="text-white font-opensans font-18 mt-0">for those helpless childrens who need
                                it</h3>
                        </div>
                        <div class="col-md-3 mt-30">
                            <a href="#" class="btn btn-default btn-circled btn-lg">Become a Fundraiser</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @csrf
        <section>
            <div class="container">
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="mt-0">Current Campaign</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus nostrum corporis qui
                                ut nesciunt voluptatibus excepturi eum quod facere et earum quas<br> explicabo rem est
                                Odit animi ipsam quo ad culpa in officiis qui voluptatem doloremque voluptatum nam.</p>
                        </div>
                    </div>
                    <div class="row mt-30">
                        <div class="col-sm-4 col-md-4 col-lg-4">
                            <div class="schedule-box maxwidth500 bg-lighter mb-30">
                                <div class="thumb">
                                    <img class="img-fullwidth" alt="" src="images/gallery/4.jpg">
                                </div>
                                <div class="schedule-details clearfix p-15 pt-10">
                                    <h4 class="title mt-0"><a href="#">Investing in Childhood</a></h4>
                                    <div class="clearfix"></div>
                                    <p class="mt-10">Lorem ipsum dolor sit amet elit. Cum veritatis sequi nulla nihil,
                                        dolor voluptatum nemo adipisci eligendi! Sed nisi perferendis, totam harum
                                        dicta.</p>
                                    <div class="mt-10">
                                        <a href="#" class="btn btn-theme-colored btn-sm mt-10">Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-4 col-lg-4">
                            <div class="schedule-box maxwidth500 bg-lighter mb-30">
                                <div class="thumb">
                                    <img class="img-fullwidth" alt="" src="images/gallery/1.jpg">
                                </div>
                                <div class="schedule-details clearfix p-15 pt-10">
                                    <h4 class="title mt-0"><a href="#">Investing in Childhood</a></h4>
                                    <div class="clearfix"></div>
                                    <p class="mt-10">Lorem ipsum dolor sit amet elit. Cum veritatis sequi nulla nihil,
                                        dolor voluptatum nemo adipisci eligendi! Sed nisi perferendis, totam harum
                                        dicta.</p>
                                    <div class="mt-10">
                                        <a href="#" class="btn btn-theme-colored btn-sm mt-10">Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-4 col-lg-4">
                            <div class="schedule-box maxwidth500 bg-lighter mb-30">
                                <div class="thumb">
                                    <img class="img-fullwidth" alt="" src="images/gallery/2.jpg">
                                </div>
                                <div class="schedule-details clearfix p-15 pt-10">
                                    <h4 class="title mt-0"><a href="#">Investing in Childhood</a></h4>
                                    <div class="clearfix"></div>
                                    <p class="mt-10">Lorem ipsum dolor sit amet elit. Cum veritatis sequi nulla nihil,
                                        dolor voluptatum nemo adipisci eligendi! Sed nisi perferendis, totam harum
                                        dicta.</p>
                                    <div class="mt-10">
                                        <a href="#" class="btn btn-theme-colored btn-sm mt-10">Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 col-md-4 col-lg-4">
                            <div class="schedule-box maxwidth500 bg-lighter mb-30">
                                <div class="thumb">
                                    <img class="img-fullwidth" alt="" src="images/gallery/3.jpg">
                                </div>
                                <div class="schedule-details clearfix p-15 pt-10">
                                    <h4 class="title mt-0"><a href="#">Investing in Childhood</a></h4>
                                    <div class="clearfix"></div>
                                    <p class="mt-10">Lorem ipsum dolor sit amet elit. Cum veritatis sequi nulla nihil,
                                        dolor voluptatum nemo adipisci eligendi! Sed nisi perferendis, totam harum
                                        dicta.</p>
                                    <div class="mt-10">
                                        <a href="#" class="btn btn-theme-colored btn-sm mt-10">Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-4 col-lg-4">
                            <div class="schedule-box maxwidth500 bg-lighter mb-30">
                                <div class="thumb">
                                    <img class="img-fullwidth" alt="" src="images/gallery/5.jpg">
                                </div>
                                <div class="schedule-details clearfix p-15 pt-10">
                                    <h4 class="title mt-0"><a href="#">Investing in Childhood</a></h4>
                                    <div class="clearfix"></div>
                                    <p class="mt-10">Lorem ipsum dolor sit amet elit. Cum veritatis sequi nulla nihil,
                                        dolor voluptatum nemo adipisci eligendi! Sed nisi perferendis, totam harum
                                        dicta.</p>
                                    <div class="mt-10">
                                        <a href="#" class="btn btn-theme-colored btn-sm mt-10">Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-4 col-lg-4">
                            <div class="schedule-box maxwidth500 bg-lighter mb-30">
                                <div class="thumb">
                                    <img class="img-fullwidth" alt="" src="images/gallery/6.jpg">
                                </div>
                                <div class="schedule-details clearfix p-15 pt-10">
                                    <h4 class="title mt-0"><a href="#">Investing in Childhood</a></h4>
                                    <div class="clearfix"></div>
                                    <p class="mt-10">Lorem ipsum dolor sit amet elit. Cum veritatis sequi nulla nihil,
                                        dolor voluptatum nemo adipisci eligendi! Sed nisi perferendis, totam harum
                                        dicta.</p>
                                    <div class="mt-10">
                                        <a href="#" class="btn btn-theme-colored btn-sm mt-10">Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

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
                                console.log(response);
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
