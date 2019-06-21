@extends('layouts.panel.panel_layout')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('js')
    <script
        src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
@endsection
@section('css')
    <link rel="stylesheet" href="{{URL::asset('/public/assets/panel/css/iranBanks/ibl.css')}}">
    <link rel="stylesheet" href="{{URL::asset('/public/assets/panel/global_assets/css/extras/animate.min.css')}}">
@endsection
@section('content')
    <?php
    $active_sidbare = ['setting', 'gateway_setting']
    ?>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-light">
                        <button type="button" class="btn btn-outline-info btn-lg modal-ajax-load"
                                data-ajax-link="{{route('gateway_add')}}" data-toggle="modal"
                                data-modal-title="{{trans('messages.add_new',['item'=>trans('messages.gateway_pay')])}}"
                                data-target="#general_modal"><i
                                class="icon-user-plus mr-2"></i> {{trans('messages.add_new',['item'=>trans('messages.gateway_pay')])}}
                        </button>
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
            </div>
        </div>
    </div>
@endsection
