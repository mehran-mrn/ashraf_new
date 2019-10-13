@extends('layouts.panel.panel_layout')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('css')
    <link href="{{ URL::asset('/public/assets/global/css/pe-icon-7-stroke.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('js')
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>


@endsection
@section('content')
    <?php
    $active_sidbare = ['blog','blog_setting' , 'adv_links' ]
    ?>
    <div class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card">

                    <div class="card-header bg-light">
                        <button type="button" class="btn btn-outline-info btn-lg modal-ajax-load"
                                data-ajax-link="{{route('adv_bar_form')}}" data-toggle="modal"
                                data-modal-size="modal-lg"

                                data-modal-title="{{trans('messages.add_new',['item'=>trans('messages.adv_bar')])}}"
                                data-target="#general_modal"><i
                                    class="icon-user-plus mr-2"></i> {{trans('messages.add_new',['item'=>trans('messages.adv_bar')])}}
                        </button>
                    </div>

                    <div class="card-body row">
                        @foreach(get_option('adv_bar') as $adv_bar)
                            <div class="col-md-4">
                                <div class="card">

                                    <div class="card-img-actions px-1 pt-1">
                                        <img class="card-img img-fluid img-absolute "
                                             src="{{url(json_decode($adv_bar['value'],true)['image'])}}" alt="">
                                        <div class="card-img-actions-overlay  card-img bg-dark-alpha">

                                        </div>
                                    </div>

                                    <div class="card-body">
                                        {{url(json_decode($adv_bar['value'],true)['link'])}}
                                        <br>
                                        <button type="button" class="float-right btn alpha-info border-info-400 text-info-800 btn-icon rounded-round ml-2
                                             modal-ajax-load"
                                                data-ajax-link="{{route('adv_bar_form',[$adv_bar['id']])}}"
                                                data-toggle="modal"
                                                data-modal-title="{{trans('messages.edit_item',['item'=>trans('messages.host')])}}"
                                                data-target="#general_modal">
                                            <i class="icon-pencil"></i>
                                        </button>
                                        <button type="button"
                                                class="legitRipple swal-alert float-right btn alpha-pink border-pink-400 text-pink-800 btn-icon rounded-round ml-2"
                                                data-ajax-link="{{route('delete_adv_bar',[$adv_bar['id']])}}"
                                                data-method="POST"
                                                data-csrf="{{csrf_token()}}"
                                                data-title="{{trans('messages.delete_item',['item'=>trans('messages.adv_bar')])}}"
                                                data-text="{{trans('messages.delete_item_text',['item'=>trans('messages.adv_bar')])}}"
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
            <div class="col-md-6">
                <div class="card">

                    <div class="card-header bg-light">
                        <button type="button" class="btn btn-outline-info btn-lg modal-ajax-load"
                                data-ajax-link="{{route('adv_card_form')}}" data-toggle="modal"
                                data-modal-size="modal-lg"

                                data-modal-title="{{trans('messages.add_new',['item'=>trans('messages.adv_card')])}}"
                                data-target="#general_modal"><i
                                    class="icon-user-plus mr-2"></i> {{trans('messages.add_new',['item'=>trans('messages.adv_card')])}}
                        </button>
                    </div>

                    <div class="card-body">
                        @foreach(get_option('adv_card') as $adv_card)
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-img-actions px-1 pt-1">
                                        <img class="card-img img-fluid img-absolute "
                                             src="{{url(json_decode($adv_card['value'],true)['image'])}}" alt="">
                                        <div class="card-img-actions-overlay  card-img bg-dark-alpha">

                                        </div>
                                    </div>

                                    <div class="card-body">
                                        {{json_decode($adv_card['value'],true)['title']}}
                                        <b>{{json_decode($adv_card['value'],true)['link']}}</b>
                                        <br>
                                        <button type="button" class="float-right btn alpha-info border-info-400 text-info-800 btn-icon rounded-round ml-2
                                             modal-ajax-load"
                                                data-ajax-link="{{route('adv_card_form',[$adv_card['id']])}}"
                                                data-toggle="modal"
                                                data-modal-title="{{trans('messages.edit_item',['item'=>trans('messages.adv_card')])}}"
                                                data-target="#general_modal">
                                            <i class="icon-pencil"></i>
                                        </button>
                                        <button type="button"
                                                class="legitRipple swal-alert float-right btn alpha-pink border-pink-400 text-pink-800 btn-icon rounded-round ml-2"
                                                data-ajax-link="{{route('delete_adv_card',[$adv_card['id']])}}"
                                                data-method="POST"
                                                data-csrf="{{csrf_token()}}"
                                                data-title="{{trans('messages.delete_item',['item'=>trans('messages.adv_card')])}}"
                                                data-text="{{trans('messages.delete_item_text',['item'=>trans('messages.adv_card')])}}"
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