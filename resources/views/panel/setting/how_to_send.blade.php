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
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
