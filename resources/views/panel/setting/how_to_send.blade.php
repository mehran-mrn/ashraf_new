@extends('layouts.panel.panel_layout')
@section('js')
@endsection
@section('css')
@endsection
@section('content')
    @php
        $active_sidbare = ['store', 'store_setting']
    @endphp
    <div class="content">
        <div class="card">
            <div class="card-header bg-light"><span class="card-title">{{__('messages.how_to_send')}}</span></div>
            <div class="card-body">

                <button class="btn bg-success btn-float modal-ajax-load"
                        data-ajax-link="{{route('setting_how_to_send_add')}}"
                        data-toggle="modal"
                        data-modal-title="{{trans('messages.add_transport')}}"
                        data-target="#general_modal"
                        data-popup="tooltip"
                        data-placement="bottom"
                        data-container="body"
                        data-original-title="{{trans('messages.add_transport')}}">
                    <i class="icon-plus2 icon-2x"></i>
                    <span>{{trans('messages.add_transport')}}</span>
                </button>
                <hr>
                <div class="row">
                    @foreach($trans as $tran)
                        <?php
                        $statusColor = 'success';
                        if ($tran['status'] == "inactive") {
                            $statusColor = 'danger';
                        }
                        ?>
                        <div class="col-4">
                            <div class="card">
                                <div class="card-header bg-{{$statusColor}}">
                                    <span class="card-title">{{$tran['title']}}</span>
                                </div>
                                <div class="card-body">
                                    <div class="text-center">
                                        <i class="icon-truck text-{{$statusColor}} icon-3x"></i>
                                    </div>
                                    <table class="table table-striped">
                                        <tr>
                                            <td>
                                                <h5>{{__('messages.send_time')}}</h5>
                                            </td>
                                            <td class="text-center">
                                                <span>{{$tran['time']." ".__('messages.day')}}</span>
                                            </td>
                                        </tr>
                                    </table>

                                </div>
                                <div class="card-footer">
                                    <button type="button"
                                            class="legitRipple float-right btn alpha-primary border-primary-400 text-primary-800 btn-icon rounded-round ml-2 modal-ajax-load"
                                            data-ajax-link="{{route('setting_how_to_send_edit',['t_id'=>$tran['id']])}}"
                                            data-toggle="modal"
                                            data-modal-title="{{trans('messages.edit',['item'=>trans('messages.transportation')])}}"
                                            data-target="#general_modal"><i class="icon-database-edit2"></i>
                                    </button>
                                    <button
                                            class="legitRipple swal-alert float-right btn alpha-pink border-pink-400 text-pink-800 btn-icon rounded-round ml-2"
                                            data-ajax-link="{{route('setting_how_to_send_delete',['t_id'=>$tran['id']])}}"
                                            data-method="get"
                                            data-csrf="{{csrf_token()}}"
                                            data-title="{{trans('messages.delete',['item'=>trans('messages.transportation')])}}"
                                            data-text="{{trans('messages.delete_item_text',['item'=>trans('messages.transportation')])}}"
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
@endsection
