@extends('layouts.panel.panel_layout')
@section('css')
    <link href="{{ URL::asset('/public/assets/global/css/pe-icon-7-stroke.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('js')
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>
@endsection
@section('content')
    <?php
    $active_sidbare = ['blog','blog_setting' , 'display_statistics' ,'']
    ?>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header bg-light">
                        <button type="button" class="btn btn-outline-info btn-lg modal-ajax-load"
                                data-ajax-link="{{route('load_display_statistics_form')}}" data-toggle="modal"
                                data-modal-size="modal-lg"

                                data-modal-title="{{trans('messages.add_new',['item'=>trans('messages.display_statistics')])}}"
                                data-target="#general_modal"><i
                                    class="icon-user-plus mr-2"></i> {{trans('messages.add_new',['item'=>trans('messages.display_statistics')])}}
                        </button>
                    </div>

                </div>
            </div>
            <div class="col-md-12">
                <div class="card pt-3">
                    <div class="row">

                    @foreach($statistics as $statistic)
                        <div class="col-md-4">
                            <div class="card">

                                <div class="text-center card-img-actions px-1 pt-1">
                                    <i style="font-size: 150px;" class="text-center {{json_decode($statistic['value'],true)['icon']}}"></i>

                                </div>

                                <div class="card-body text-center">
                                    <h1 >{{json_decode($statistic['value'],true)['value']}}</h1>

                                    <h3>{{json_decode($statistic['value'],true)['title']}}</h3>

                                    <button type="button" class="float-right btn alpha-info border-info-400 text-info-800 btn-icon rounded-round ml-2
                                             modal-ajax-load"
                                            data-ajax-link="{{route('load_display_statistics_form',[$statistic['id']])}}"
                                            data-toggle="modal"
                                            data-modal-size="modal-lg"
                                            data-modal-title="{{trans('messages.edit_item',['item'=>trans('messages.display_statistics')])}}"
                                            data-target="#general_modal">
                                        <i class="icon-pencil"></i>
                                    </button>
                                    <button type="button"
                                            class="legitRipple swal-alert float-right btn alpha-pink border-pink-400 text-pink-800 btn-icon rounded-round ml-2"
                                            data-ajax-link="{{route('delete_display_statistics',[$statistic['id']])}}"
                                            data-method="POST"
                                            data-csrf="{{csrf_token()}}"
                                            data-title="{{trans('messages.delete_item',['item'=>trans('messages.display_statistics')])}}"
                                            data-text="{{trans('messages.delete_item_text',['item'=>trans('messages.display_statistics')])}}"
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





@endsection