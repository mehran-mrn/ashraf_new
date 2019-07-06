@extends('layouts.panel.panel_layout')
@section('js')
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>
    <script src="{{ URL::asset('/node_modules/md.bootstrappersiandatetimepicker/src/jquery.md.bootstrap.datetimepicker.js') }}"></script>
@endsection
@section('css')
    <link href="{{ URL::asset('/node_modules/md.bootstrappersiandatetimepicker/src/jquery.md.bootstrap.datetimepicker.style.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('content')
    <?php
    $active_sidbare = ['building','building_types']
    ?>

    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header bg-light">
                        <button type="button" class="btn btn-outline-info btn-lg modal-ajax-load"
                                data-ajax-link="{{route('load_building_type_form')}}" data-toggle="modal"
                                data-modal-title="{{trans('messages.add_new',['item'=>trans('messages.building_type')])}}"
                                data-target="#general_modal"><i
                                    class="icon-home8 mr-2"></i> {{trans('messages.add_new',['item'=>trans('messages.building_type')])}}
                        </button>
                    </div>

                    <div class="card-body">
                        @foreach($building_types->chunk(3) as $chunk)
                            <div class="row">
                                @foreach($chunk as $building_type)
                                    <div class="col-md-4">
                                        <div class="card">

                                            <div class="card-img-actions px-1 pt-1">
                                                <img class="card-img img-fluid img-absolute "
                                                     src="{{'/'.$building_type['media']['url']}}" alt="">
                                                <div class="card-img-actions-overlay  card-img bg-dark-alpha">

                                                </div>
                                            </div>

                                            <div class="card-body">
                                                <a href="{{route('building_type_page',['building_type_id'=>$building_type['id']])}}" class="text-indigo-800 font-weight-semibold"><b>{{$building_type['title']}}</b></a>

                                                <button type="button" class="float-right btn alpha-info border-info-400 text-info-800 btn-icon rounded-round ml-2
                                             modal-ajax-load"
                                                        data-ajax-link="{{route('load_building_type_form',[$building_type['id']])}}"
                                                        data-toggle="modal"
                                                        data-modal-title="{{trans('messages.edit_item',['item'=>trans('messages.building_type')])}}"
                                                        data-target="#general_modal">
                                                    <i class="icon-pencil"></i>
                                                </button>
                                                <button type="button"
                                                        class="legitRipple swal-alert float-right btn alpha-pink border-pink-400 text-pink-800 btn-icon rounded-round ml-2"
                                                        data-ajax-link="{{route('delete_building_type',['host_id'=>$building_type['id']])}}"
                                                        data-method="POST"
                                                        data-csrf="{{csrf_token()}}"
                                                        data-title="{{trans('messages.delete_item',['item'=>trans('messages.building_type')])}}"
                                                        data-text="{{trans('messages.delete_item_text',['item'=>trans('messages.building_type')])}}"
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
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection