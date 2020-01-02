@extends('layouts.global.global_layout')
@section('js')
    <script
        src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/forms/validation/validate.min.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/global/js/localization/messages_fa.js') }}"></script>
    <script src="{{ URL::asset('/node_modules/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            $(document).on('click', '.btn-delete', function () {
                var id = $(this).data('id');
                Swal.fire({
                    title: '{{__('messages.delete')}}',
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
                            url: "{{route('store_order_delete_address')}}",
                            type: "DELETE",
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
                                    return window.location.reload();
                                }, 1000);
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
@section('css')

    <style>
        .border {
            border: 2px solid #88e0a1 !important;
        }
    </style>
@stop
@section('content')
    <!-- Start main-content -->
    <div class="main-content">
        {{@csrf_field()}}
        <section class="">
            <div class="container mt-30 mb-30 p-30">
                <div class="row">
                    <div class="col-md-4 text-center step_one">
                        <h3 class="badge badge-danger">1</h3><br>
                        <i class="fa fa-user fa-3x mb-10"></i>
                        <h5>{{__('messages.user_information')}}</h5>
                    </div>
                    <div class="col-md-4 bg-success text-center step_two">
                        <h3 class="badge badge-danger">2</h3><br>
                        <i class="fa fa-truck fa-3x text-success  mb-10"></i>
                        <h5>{{__('messages.send_information')}}</h5>
                    </div>
                    <div class="col-md-4 text-center step_three">
                        <h3 class="badge badge-danger">3</h3><br>
                        <i class="fa fa-amazon fa-3x mb-10"></i>
                        <h5>{{__('messages.payment_information')}}</h5>
                    </div>
                </div>
                <div class="clearfix"></div>
                <hr>
                <div class="row">
                    <form action="{{route('store_order_submit')}}" method="post" id="frm_order">
                        @csrf
                        <div class="col-md-12">
                            <label><i class="fa fa-angle-left"></i> {{__('messages.address')}}</label>
                            <table class="table table-bordered border text-center" style="vertical-align: middle">
                                <tbody>
                                @foreach($userInfo['addresses'] as $tra)
                                    <tr>
                                        <td colspan="1" class="col-md-1 success" style="vertical-align: middle">
                                            <i class="fa fa-check-square-o fa-3x text-success align-middle text-center"></i>
                                        </td>
                                        <td class="align-middle" style="vertical-align: middle">
                                            <i class="fa fa-map-pin fa-2x pull-right mr-20"></i>
                                            <span
                                                class="pull-right btn  btn-sm align-middle mr-20">{{$tra['address']}}</span>
                                            <button class="btn btn-default btn-sm pull-right btn-delete"
                                                    data-id="{{$tra['id']}}">{{__('messages.delete')}}</button>
                                            <span
                                                class="pull-left btn  btn-sm align-middle ml-20 text-success">{{$tra["receiver"]}}</span><strong
                                                class="pull-left btn  btn-sm">{{__('messages.receiver_name').": "}} </strong>
                                        </td>
                                        <td>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="address" id="address_radio_{{$tra['id']}}"
                                                           value="{{$tra['id']}}"
                                                        {{$tra['default']==1?'checked':''}}>
                                                    {{__('messages.select')}}
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
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
                                            <span
                                                class="pull-left align-middle ml-20 text-success">{{__("messages.free")}}</span>
                                        </td>
                                        <td>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="transportation" required="required"
                                                           id="trans_radio_{{$tra['id']}}" value="{{$tra['id']}}">
                                                    {{__('messages.select')}}
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <label><i class="fa fa-angle-left"></i> {{__('messages.payment_type')}}</label>
                            <table class="table table-bordered border text-center" style="vertical-align: middle">
                                <tbody>
                                @php $pays = []; @endphp
                                @foreach($gateways as $gat)
                                    @if($gat['online']==1 && !in_array('online',$pays))
                                        <tr>
                                            <td colspan="1" class="col-md-1 success" style="vertical-align: middle">
                                                <i class="fa fa-check-square-o fa-3x text-success align-middle text-center"></i>
                                            </td>
                                            <td class="align-middle" style="vertical-align: middle">
                                                <i class="fa fa-anchor fa-2x pull-right mr-20"></i>
                                                <span
                                                    class="pull-right align-middle mr-20">{{__('messages.online')}}</span>
                                                <span class="pull-left align-middle ml-20 text-success"></span>
                                            </td>
                                            <td>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="payment" id="payment_radio_online"
                                                               value="online" checked>
                                                        {{__('messages.select')}}
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                        @php array_push($pays,'online')@endphp
                                    @endif
                                    @if($gat['cart']==1 && !in_array('cart',$pays))
                                        <tr>
                                            <td colspan="1" class="col-md-1 success" style="vertical-align: middle">
                                                <i class="fa fa-check-square-o fa-3x text-success align-middle text-center"></i>
                                            </td>
                                            <td class="align-middle" style="vertical-align: middle">
                                                <i class="fa fa-credit-card fa-2x pull-right mr-20"></i>
                                                <span
                                                    class="pull-right align-middle mr-20">{{__('messages.cart_to_cart')}}</span>
                                                <span class="pull-left align-middle ml-20 text-success"></span>
                                            </td>
                                            <td>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="payment" id="payment_radio_cart"
                                                               value="cart">
                                                        {{__('messages.select')}}
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                        @php array_push($pays,'cart')@endphp
                                    @endif
                                    @if($gat['account']==1 && !in_array('account',$pays))
                                        <tr>
                                            <td colspan="1" class="col-md-1 success" style="vertical-align: middle">
                                                <i class="fa fa-check-square-o fa-3x text-success align-middle text-center"></i>
                                            </td>
                                            <td class="align-middle" style="vertical-align: middle">
                                                <i class="fa fa-money fa-2x pull-right mr-20"></i>
                                                <span
                                                    class="pull-right align-middle mr-20">{{__('messages.send_to_account')}}</span>
                                                <span class="pull-left align-middle ml-20 text-success"></span>
                                            </td>
                                            <td>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="payment" id="payment_radio_account"
                                                               value="account">
                                                        {{__('messages.select')}}
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                        @php array_push($pays,'account')@endphp
                                    @endif
                                @endforeach
                                <tr>
                                    <td colspan="1" class="col-md-1 success" style="vertical-align: middle">
                                        <i class="fa fa-check-square-o fa-3x text-success align-middle text-center"></i>
                                    </td>
                                    <td class="align-middle" style="vertical-align: middle">
                                        <i class="fa fa-map-pin fa-2x pull-right mr-20"></i>
                                        <span
                                            class="pull-right align-middle mr-20">{{__('messages.pay_on_place')}}</span>
                                        <span class="pull-left align-middle ml-20 text-success"></span>
                                    </td>
                                    <td>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="payment" id="payment_radio_account"
                                                       value="place">
                                                {{__('messages.select')}}
                                            </label>
                                        </div>
                                    </td>
                                </tr>
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
                                @if(session('cart')['order'])
                                    @foreach(session('cart')['order'] as $id => $details)
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
                                        <span
                                            class="pull-right align-middle mr-20">{{__('messages.max_send_time_your_order')}}</span>
                                        <span
                                            class="pull-left align-middle ml-20 text-success">{{$time."  ". __("messages.work_day")}}</span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <button type="submit"
                                class="btn btn-success pull-left p-10 pr-20 pl-20">{{__('messages.continue_shopping')}}
                            <i class="fa fa-caret-left pr-10"></i></button>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
