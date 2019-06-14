@extends('layouts.panel.panel_layout')

@section('content')
    <?php
    $active_sidbare = ['caravans', 'hosts_list']
    ?>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header bg-light">
                        <button type="button" class="btn btn-outline-info btn-lg modal-ajax-load"
                                data-ajax-link="{{route('load_host_form')}}" data-toggle="modal"
                                data-modal-title="{{trans('messages.add_new',['item'=>trans('messages.host')])}}"
                                data-target="#general_modal"><i
                                    class="icon-user-plus mr-2"></i> {{trans('messages.add_new',['item'=>trans('messages.host')])}}
                        </button>
                    </div>

                    <div class="card-body">

                        @foreach($hosts->chunk(3) as $chunk)
                            <div class="row">
                                @foreach($chunk as $host)
                                    <div class="col-md-4">
                                        <div class="card">

                                            <div class="card-img-actions px-1 pt-1">
                                                <img class="card-img img-fluid img-absolute "
                                                     src="{{'/'.$host['media']['url']}}" alt="">
                                                <div class="card-img-actions-overlay  card-img bg-dark-alpha">

                                                </div>
                                            </div>

                                            <div class="card-body">
                                                <h6 class="font-weight-semibold"><b>{{$host['name']}}</b></h6>
                                                {{$host['city_name']}} |
                                                <i class="icon-2x @if($host['gender'] ==1 )  icon-man @elseif($host['gender'] == 2) icon-woman @else icon-man-woman @endif"></i>
                                                |
                                                {{trans('messages.capacity')." : "}}@if($host['capacity']){{$host['capacity']}}@else {{trans('messages.no_limit')}}@endif
                                                <button type="button" class="float-right btn alpha-info border-info-400 text-info-800 btn-icon rounded-round ml-2
                                             modal-ajax-load"
                                                        data-ajax-link="{{route('load_host_form',[$host['id']])}}"
                                                        data-toggle="modal"
                                                        data-modal-title="{{trans('messages.edit_item',['item'=>trans('messages.host')])}}"
                                                        data-target="#general_modal">
                                                    <i class="icon-pencil"></i>
                                                </button>
                                                <button type="button"
                                                        class="legitRipple swal-alert float-right btn alpha-pink border-pink-400 text-pink-800 btn-icon rounded-round ml-2"
                                                        data-ajax-link="{{route('delete_caravan_host',['host_id'=>$host['id']])}}"
                                                        data-method="POST"
                                                        data-csrf="{{csrf_token()}}"
                                                        data-title="{{trans('messages.delete_item',['item'=>trans('messages.host')])}}"
                                                        data-text="{{trans('messages.delete_item_text',['item'=>trans('messages.host')])}}"
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
