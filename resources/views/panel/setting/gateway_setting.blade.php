@extends('layouts.panel.panel_layout')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('js')
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/forms/validation/validate.min.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/global/js/localization/messages_fa.js') }}"></script>
    <script src="{{URL::asset('/public/assets/panel/global_assets/js/plugins/uploaders/dropzone.min.js')}}"></script>
    <script>


        $(document).ready(function () {
            $(document).on('change', '#name', function () {
                var logo = $(this).find(':selected').data('logo');
                console.log(logo);
                logo = logo.replace("ibl64", "ibl128");
                $("#bank_logo_htm").html(logo);
            })
            $(document).on('keyup', "#card_number", function () {
                var num = $("#card_number").val();
                $("#card_number").val(numberWithDash(num));
            });

            $('form[id="frm_gateway_add"]').validate({
                lang: "fa",
                rules: {
                    name: {
                        required: true,
                    },
                    account_number: {
                        required: false,
                        number: true,
                        minlength: 5,
                        maxlength: 100,
                    },
                    account_sheba: {
                        required: false,
                        number: true,
                        minlength: 24,
                        maxlength: 24,
                    },
                    bank_branch: {
                        required: false,
                    },
                    card_number: {
                        required: false,
                        minlength: 19,
                        maxlength: 19
                    },
                    merchant_id: {
                        required: false,
                        minlength: 5,
                        maxlength: 50,
                        number: true,
                    },
                    public_key: {
                        required: false,
                        minlength: 5,
                        maxlength: 50
                    },
                    terminal_id: {
                        required: false,
                        minlength: 5,
                        maxlength: 50,
                        number: true,
                    },
                    username: {
                        required: false,
                        minlength: 1,
                        maxlength: 50,
                    },
                    private_key: {
                        required: false,
                        minlength: 1,
                        maxlength: 50,
                    },
                    password: {
                        required: false,
                        minlength: 1,
                        maxlength: 50,
                    }
                },
                submitHandler: function (e, form) {
                    e.preventDefault();
                    var form_btn = $(form).find('button[type="submit"]');
                    var form_result_div = '#form-result';
                    $(form_result_div).remove();
                    form_btn.before('<div id="form-result" class="alert alert-success" role="alert" style="display: none;"></div>');
                    var form_btn_old_msg = form_btn.html();
                    form_btn.html(form_btn.prop('disabled', true).data("loading-text"));
                    $(form).ajaxSubmit({
                        dataType: '',
                        success: function (data) {
                            PNotify.success({
                                text: data.message,
                                delay: 3000,
                            });
                            setTimeout(function () {
                                location.reload();
                            }, 3000);
                            $(form).find('.form-control').val('');
                            $(form_btn).html(form_btn_old_msg);
                            $(form_result_div).html(data.message).fadeIn('slow');
                            setTimeout(function () {
                                $(form_result_div).fadeOut('slow')
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
                            setTimeout(function () {
                                $('[type="submit"]').prop('disabled', false);
                            }, 2500);
                            $(form_btn).html(form_btn_old_msg);
                        }
                    });
                }
            });

        })

    </script>
@endsection
@section('css')
    <link rel="stylesheet" href="{{URL::asset('/public/assets/panel/css/iranBanks/ibl.css')}}">
    <link rel="stylesheet" href="{{URL::asset('/public/assets/panel/global_assets/css/extras/animate.min.css')}}">
    <style>
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
@endsection
@section('content')
    <?php
    $active_sidbare = ['setting', 'gateway_setting']
    ?>
    <section>
        <div class="content">
            <div class="container-fluid">
                <button

                        class="btn btn-primary m-2 py-2 px-3"
                        data-toggle="modal"
                        data-modal-title="{{trans('messages.add',['item'=>trans('messages.gateway')])}}"
                        data-target="#general_modal"><i
                            class="icon-user-plus mr-2"></i> {{trans('messages.add_new',['item'=>trans('messages.gateway_pay')])}}
                </button>
            </div>
            <section>
                <div class="card">
                    <div class="card-header">
                        <span class="card-title text-black">{{__("messages.gateway")}}</span>
                        <hr>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($gateways as $gateway)
                                @php
                                    $logo = $gateway->bank->logo;
                                    $logo = str_replace('ibl64','ibl128',$logo);
                                @endphp
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    {!! $logo !!}
                                                </div>
                                                <div class="col-md-7 pt-3">
                                                    <h5 class="pt-2 text-center">{{$gateway->bank->name}}</h5>
                                                    <h5 class="pt-3 text-center">{{$gateway->title}}</h5>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-4">
                                                    <h6 class="text-left text-muted">{{__('messages.merchant_id')}}</h6>
                                                </div>
                                                <div class="col-8">
                                                    <h6 class="text-right">{{$gateway['merchant']}}</h6>
                                                </div>
                                            </div>
                                            <div class="row bg-light pt-2">
                                                <div class="col-4">
                                                    <h6 class="text-left text-muted">{{__('messages.terminal_id')}}</h6>
                                                </div>
                                                <div class="col-8">
                                                    <h6 class="text-right">{{$gateway['terminal_id']}}</h6>
                                                </div>
                                            </div>
                                            <div class="row pt-2">
                                                <div class="col-4">
                                                    <h6 class="text-left text-muted">{{__('messages.public_key')}}</h6>
                                                </div>
                                                <div class="col-8">
                                                    <h6 class="text-right">{{$gateway['public_key']}}</h6>
                                                </div>
                                            </div>
                                            <div class="row pt-2">
                                                <div class="col-6">
                                                    <h6 class="text-left text-muted">{{__('messages.sheba_number')}}</h6>
                                                </div>
                                                <div class="col-6">
                                                    <h6 class="text-right">{{$gateway['account_sheba']}}</h6></div>
                                            </div>
                                            <div class="row pt-2 bg-light">
                                                <div class="col-6">
                                                    <h6 class="text-left text-muted">{{__('messages.account_number')}}</h6>
                                                </div>
                                                <div class="col-6">
                                                    <h6 class="text-right">{{$gateway['account_number']}}</h6>
                                                </div>
                                            </div>
                                            <div class="row pt-2">
                                                <div class="col-6">
                                                    <h6 class="text-left text-muted">{{__('messages.card_number')}}</h6>
                                                </div>
                                                <div class="col-6">
                                                    <h6 class="text-right">{{$gateway['card_number']}}</h6></div>
                                            </div>
                                            <div class="row pt-2 bg-light">
                                                <div class="col-6">
                                                    <h6 class="text-left text-muted">{{__('messages.branch')}}</h6>
                                                </div>
                                                <div class="col-6">
                                                    <h6 class="text-right">{{$gateway['bank_branch']}}</h6></div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <button type="button"
                                                    class="egitRipple float-right btn alpha-primary border-primary-400 text-primary-800 btn-icon rounded-round ml-2 modal-ajax-load"
                                                    data-ajax-link="{{route('gateway_edit',['gat_id'=>$gateway['id']])}}"
                                                    data-toggle="modal"
                                                    data-modal-title="{{trans('messages.edit',['item'=>trans('messages.gateway')])}}"
                                                    data-target="#general_modal">
                                                <i class="icon-pencil7"></i>
                                            </button>
                                            <button
                                                    class="legitRipple swal-alert float-right btn alpha-pink border-pink-400 text-pink-800 btn-icon rounded-round ml-2"
                                                    data-ajax-link="{{route('gateway_delete',['gateway_id'=>$gateway['id']])}}"
                                                    data-method="get"
                                                    data-csrf="{{csrf_token()}}"
                                                    data-title="{{trans('messages.delete_item',['item'=>trans('messages.gateway_pay')])}}"
                                                    data-text="{{trans('messages.delete_item_text',['item'=>trans('messages.gateway_pay')])}}"
                                                    data-type="warning"
                                                    data-cancel="true"
                                                    data-confirm-text="{{trans('messages.delete')}}"
                                                    data-cancel-text="{{trans('messages.cancel')}}">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>



    <div id="general_modal" class="modal fade">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h6 class="modal-title">{{__('messages.add_image')}}</h6>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="frm_gateway_add">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <h5>{{__('messages.bank_information')}}</h5>
                            </div>
                            <div class="col-md-6">
                                <label for="title">{{__('messages.title')}}</label>
                                <div class="form-group form-group-feedback form-group-feedback-right">
                                    <input type="text" class="form-control" name="title" id="title">
                                    <div class="form-control-feedback form-control-feedback-lg">
                                        <i class="icon-ticket"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">{{__('messages.bank_name')}}</label>
                                    <select name="name" id="name" class="form-control">
                                        <option value="">{{__('messages.please_select')}}</option>
                                        @foreach($banks as $bank)
                                            <option value="{{$bank['id']}}"
                                                    data-logo="{{$bank['logo']}}">{{$bank['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="account_number">{{__('messages.account_number')}}</label>
                                <div class="form-group form-group-feedback form-group-feedback-right">
                                    <input type="number" class="form-control text-right" maxlength="15"
                                           name="account_number"
                                           id="account_number">
                                    <div class="form-control-feedback form-control-feedback-lg">
                                        <i class="icon-check"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="account_sheba">{{__('messages.sheba_number')}}</label>
                                <div class="form-group form-group-feedback form-group-feedback-right">
                                    <input type="number" class="form-control text-right" maxlength="24"
                                           name="account_sheba"
                                           id="account_sheba">
                                    <div class="form-control-feedback form-control-feedback-lg">
                                        IR
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="bank_branch">{{__('messages.branch')}}</label>
                                    <div class="form-group form-group-feedback form-group-feedback-right">
                                        <input type="text" name="bank_branch" id="bank_branch" class="form-control">
                                        <div class="form-control-feedback form-control-feedback-lg">
                                            <i class="icon-git-branch"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="card_number">{{__('messages.card_number')}}</label>
                                <div class="form-group form-group-feedback form-group-feedback-right">
                                    <input type="text" class="form-control text-right" name="card_number"
                                           id="card_number">
                                    <div class="form-control-feedback form-control-feedback-lg">
                                        <i class="icon-credit-card"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="status">{{__('messages.status')}}</label><br>
                                <div class="d-flex justify-content-center">
                                    <div class="p-3">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" class="custom-control-input" name="status" id="status"
                                                   value="active"
                                                   checked data-fouc>
                                            <label class="custom-control-label text-success"
                                                   for="status">{{__('messages.active')}}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="p-3">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" class="custom-control-input" name="status" id="status2"
                                                   value="inactive">
                                            <label class="custom-control-label text-danger"
                                                   for="status2">{{__('messages.inactive')}}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <center>
                                    <div id="bank_logo_htm"></div>
                                </center>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <h5>{{__('messages.gateway_pay_info')}}</h5>
                            </div>
                            <div class="col-md-6">
                                <label for="merchant_id">{{__('messages.merchant_id')}}</label>
                                <div class="form-group form-group-feedback form-group-feedback-right">
                                    <input type="number" name="merchant" id="merchant_id"
                                           class="form-control text-right">
                                    <div class="form-control-feedback form-control-feedback-lg">
                                        <i class="icon-atom"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="public_key">{{__('messages.public_key')}}</label>
                                <div class="form-group form-group-feedback form-group-feedback-right">
                                    <input type="text" name="public_key" id="public_key"
                                           class="form-control text-right">
                                    <div class="form-control-feedback form-control-feedback-lg">
                                        <i class="icon-key"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="private_key">{{__('messages.private_key')}}</label>
                                <div class="form-group form-group-feedback form-group-feedback-right">
                                    <input type="text" name="private_key" id="private_key"
                                           class="form-control text-right">
                                    <div class="form-control-feedback form-control-feedback-lg">
                                        <i class="icon-key"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="terminal_id">{{__('messages.terminal_id')}}</label>
                                <div class="form-group form-group-feedback form-group-feedback-right">
                                    <input type="number" name="terminal_id" id="terminal_id"
                                           class="form-control text-right">
                                    <div class="form-control-feedback form-control-feedback-lg">
                                        <i class="icon-terminal"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="username">{{__('messages.username')}}</label>
                                <div class="form-group form-group-feedback form-group-feedback-right">
                                    <input type="text" name="username" id="username" class="form-control text-right">
                                    <div class="form-control-feedback form-control-feedback-lg">
                                        <i class="icon-user-tie"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="password">{{__('messages.password')}}</label>
                                <div class="form-group form-group-feedback form-group-feedback-right">
                                    <input type="text" name="password" id="password" class="form-control text-right">
                                    <div class="form-control-feedback form-control-feedback-lg">
                                        <i class="icon-star-full2"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 form-group">
                                <label for="">{{__('messages.transaction_file')}}</label>
                                <div class="dropzone" id="dropzone_remove">
                                    <div class="fallback">
                                        <input name="file" type="file" multiple/>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="d-flex justify-content-center">
                                    <div class="p-3">
                                        <div class="custom-control custom-checkbox custom-control-inline">
                                            <input type="checkbox" class="custom-control-input" id="pay_online"
                                                   name="pay_online" value="1" checked>
                                            <label class="custom-control-label"
                                                   for="pay_online">{{__('messages.online')}}</label>
                                        </div>
                                    </div>
                                    <div class="p-3">
                                        <div class="custom-control custom-checkbox custom-control-inline">
                                            <input type="checkbox" class="custom-control-input" id="pay_cart"
                                                   name="pay_cart" value="1" checked>
                                            <label class="custom-control-label"
                                                   for="pay_cart">{{__('messages.cart_to_cart')}}</label>
                                        </div>
                                    </div>

                                    <div class="p-3">
                                        <div class="custom-control custom-checkbox custom-control-inline">
                                            <input type="checkbox" class="custom-control-input" id="pay_account"
                                                   name="pay_account" value="1" checked>
                                            <label class="custom-control-label"
                                                   for="pay_account">{{__('messages.send_to_account')}}</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-12">
                                    <input type="hidden" name="logo" id="logo" value="">
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <div class="p-3">
                                    <button type="submit"
                                            class="btn btn-primary btn-block px-5">{{__('messages.submit')}}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
