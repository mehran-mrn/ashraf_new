@extends('layouts.panel.panel_layout')
@section('js')
    <script src="{{URL::asset('/public/assets/panel/js/ckeditor/ckeditor.js')}}"></script>

@endsection
@section('content')
    <?php     $active_sidbare = ['charity', 'charity_payment_titles', 'charity_setting']?>
    <div class="content">
        {{--    <div class="row">--}}
        {{--        <div class="col-md-12">--}}
        {{--            <div class="card">--}}
        {{--                <div class="card-header bg-light">--}}
        {{--                    <button type="button" class="btn btn-outline-info btn-lg modal-ajax-load"--}}
        {{--                            data-ajax-link="{{route('charity_payment_title_add')}}" data-toggle="modal"--}}
        {{--                            data-modal-title="{{trans('messages.add_new',['item'=>trans('messages.payment_title')])}}"--}}
        {{--                            data-modal-size="modal-full"--}}
        {{--                            data-target="#general_modal"><i--}}
        {{--                                class="icon-user-plus mr-2"></i> {{trans('messages.add_new',['item'=>trans('messages.payment_title')])}}--}}
        {{--                    </button>--}}
        {{--                </div>--}}
        {{--                <div class="card-body">--}}
        {{--                    <div class="row">--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}
        {{--    </div>--}}

        <div class="row">
            <div class="col-md-12">

                <div class="card">


                    <div class="card-body">
                        <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                            <li class="nav-item"><a href="#custom_payment_types" class="nav-link active"
                                                    data-toggle="tab">
                                    {{trans('messages.custom_payment_types')}}
                                </a></li>
                            <li class="nav-item"><a href="#system_title" class="nav-link" data-toggle="tab">
                                    {{$system_title['title']}}
                                </a></li>
                            <li class="nav-item"><a href="#periodic_title" class="nav-link" data-toggle="tab">
                                    {{$periodic_title['title']}}
                                </a></li>


                        </ul>

                        <div class="tab-content">

                            <div class="tab-pane fade  show active" id="custom_payment_types">
                                <div class="row mb-2">
                                    <button type="button" class="btn btn-outline-warning btn-lg modal-ajax-load"
                                            data-ajax-link="{{route('charity_payment_pattern_add')}}"
                                            data-toggle="modal"
                                            data-modal-title="{{trans('messages.add_new',['item'=>trans('messages.payment_pattern')])}}"
                                            data-modal-size="modal-full"
                                            data-target="#general_modal"><i
                                                class="icon-folder-plus mr-2"></i> {{trans('messages.add_new',['item'=>trans('messages.payment_pattern')])}}
                                    </button>
                                </div>
                                <div class="row mb-2">

                                    @foreach($other_titles as $title)
                                        <div class="col-md-6">
                                            <div class="card">
                                                <div class="card-header p-1 bg-info">
                                                    <span class="font-size-lg">{{$title['title']}}</span>
                                                    <button type="button" class="float-right btn alpha-info m-0 border-info-800 text-info-800 btn-icon rounded-round ml-2
                                             modal-ajax-load"
                                                            data-ajax-link="{{route('charity_payment_pattern_add',['payment_pattern_id'=>$title['id']])}}"
                                                            data-toggle="modal"
                                                            data-modal-size="modal-full"
                                                            data-modal-title="{{trans('messages.edit_item',['item'=>trans('messages.payment_pattern')])}}"
                                                            data-target="#general_modal">
                                                        <i class="icon-pencil"></i>
                                                    </button>


                                                    <button type="button"
                                                            class="legitRipple swal-alert float-right m-0 btn alpha-pink border-pink-400 text-pink-800 btn-icon rounded-round ml-2"
                                                            data-ajax-link="{{route('charity_payment_pattern_delete',['payment_pattern_id'=>$title['id']])}}"
                                                            data-method="POST"
                                                            data-csrf="{{csrf_token()}}"
                                                            data-title="{{trans('messages.delete_item',['item'=>trans('messages.payment_pattern')])}}"
                                                            data-text="{{trans('messages.delete_item_text',['item'=>trans('messages.payment_pattern')])}}"
                                                            data-type="warning"
                                                            data-cancel="true"
                                                            data-confirm-text="{{trans('messages.delete')}}"
                                                            data-cancel-text="{{trans('messages.cancel')}}">
                                                        <i class="icon-trash"></i>
                                                    </button>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        {!! $title['description'] !!}


                                                        @if(count($title['fields'])>0)
                                                            <table class="table">
                                                                <tr>
                                                                    <th>{{trans('messages.title')}}</th>
                                                                    <th>{{trans('messages.type')}}</th>
                                                                    <th></th>
                                                                </tr>
                                                                @foreach($title['fields'] as $field)
                                                                    <tr>
                                                                        <td>{{$field['label']}}</td>
                                                                        <td>
                                                                            @switch($field['type'])
                                                                                @case(0)
                                                                                {{trans('messages.input')}}
                                                                                @break
                                                                                @case(1)
                                                                                {{trans('messages.textarea')}}
                                                                                @break
                                                                                @case(2)
                                                                                {{trans('messages.number')}}
                                                                                @break
                                                                                @case(3)
                                                                                {{trans('messages.date_input')}}
                                                                                @break
                                                                                @case(4)
                                                                                {{trans('messages.time_input')}}
                                                                                @break
                                                                            @endswitch
                                                                            </td>
                                                                        <td>
                                                                            @switch($field['require'])
                                                                                @case(0)
                                                                                {{trans('messages.optional')}}
                                                                                @break
                                                                                @case(1)
                                                                                {{trans('messages.required')}}
                                                                                @break
                                                                            @endswitch
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            </table>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>

                            <div class="tab-pane fade" id="system_title">
                                <div class="card border-secondary">
                                    <div class="card-body">
                                        {!! $system_title['description'] !!}
                                        <span class="text-danger-300 float-right">
                                            <a href="#"  class=" m-0 ml-2
                                             modal-ajax-load"
                                                    data-ajax-link="{{route('charity_payment_pattern_add',['payment_pattern_id'=>$system_title['id']])}}"
                                                    data-toggle="modal"
                                                    data-modal-size="modal-full"
                                                    data-modal-title="{{trans('messages.edit_item',['item'=>trans('messages.payment_pattern')])}}"
                                                    data-target="#general_modal">
                                                        {{trans('messages.edit')}}
                                                    </a>
                                        </span>
                                        @if(count($system_title['fields'])>0)
                                            <table class="table">
                                                <tr>
                                                    <th>{{trans('messages.title')}}</th>
                                                    <th>{{trans('messages.type')}}</th>
                                                    <th></th>
                                                </tr>
                                                @foreach($system_title['fields'] as $field)
                                                    <tr>
                                                        <td>{{$field['label']}}</td>
                                                        <td>
                                                            @switch($field['type'])
                                                                @case(0)
                                                                {{trans('messages.input')}}
                                                                @break
                                                                @case(1)
                                                                {{trans('messages.textarea')}}
                                                                @break
                                                                @case(2)
                                                                {{trans('messages.number')}}
                                                                @break
                                                                @case(3)
                                                                {{trans('messages.date_input')}}
                                                                @break
                                                                @case(4)
                                                                {{trans('messages.time_input')}}
                                                                @break
                                                            @endswitch
                                                        </td>
                                                        <td>
                                                            @switch($field['require'])
                                                                @case(0)
                                                                {{trans('messages.optional')}}
                                                                @break
                                                                @case(1)
                                                                {{trans('messages.required')}}
                                                                @break
                                                            @endswitch
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        @endif

                                    </div>
                                </div>
                                <hr>
                                <button type="button" class="btn btn-outline-primary btn-lg modal-ajax-load"
                                        data-ajax-link="{{route('charity_payment_title_add',['payment_pattern_id'=>$system_title['id']])}}"
                                        data-toggle="modal"
                                        data-modal-title="{{trans('messages.add_new',['item'=>trans('messages.payment_selection')])}}"
                                        data-target="#general_modal"><i
                                            class="icon-file-plus2 mr-2"></i> {{trans('messages.add_new',['item'=>trans('messages.payment_selection')])}}
                                </button>

                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        <span class="text-info">{{trans('messages.display_items')}}</span>
                                        <table class="table table-bordered table-striped">
                                            <tr class="font-size-lg font-weight-black header">
                                                <th>{{trans('messages.title')}}</th>
                                                <th></th>
                                            </tr>
                                            @foreach($system_title['titles'] as $title)
                                                <tr>
                                                    <td>{{$title['title']}}</td>
                                                    <td>
                                                        <button type="button" class="float-right btn alpha-info border-info-400 text-info-800 btn-icon rounded-round ml-2
                                             modal-ajax-load"
                                                                data-ajax-link="{{route('charity_payment_title_add',['payment_pattern_id'=>$system_title['id'],'payment_title_id'=>$title['id']])}}"
                                                                data-toggle="modal"
                                                                data-modal-title="{{trans('messages.edit_item',['item'=>trans('messages.payment_selection')])}}"
                                                                data-target="#general_modal">
                                                            <i class="icon-pencil"></i>
                                                        </button>


                                                        <button type="button"
                                                                class="legitRipple swal-alert float-right btn alpha-pink border-pink-400 text-pink-800 btn-icon rounded-round ml-2"
                                                                data-ajax-link="{{route('charity_payment_title_delete',['payment_pattern_id'=>$system_title['id'],'payment_title_id'=>$title['id']])}}"
                                                                data-method="POST"
                                                                data-csrf="{{csrf_token()}}"
                                                                data-title="{{trans('messages.delete_item',['item'=>trans('messages.payment_selection')])}}"
                                                                data-text="{{trans('messages.delete_item_text',['item'=>trans('messages.payment_selection')])}}"
                                                                data-type="warning"
                                                                data-cancel="true"
                                                                data-confirm-text="{{trans('messages.delete')}}"
                                                                data-cancel-text="{{trans('messages.cancel')}}">
                                                            <i class="icon-trash"></i>
                                                        </button>
                                                    </td>

                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <span class="text-danger">{{trans('messages.deleted_items')}}</span>
                                        <table class="table border-danger table-bordered table-striped">
                                            <tr class="font-size-lg font-weight-black header">
                                                <th>{{trans('messages.title')}}</th>
                                                <th></th>
                                            </tr>
                                            @foreach($deleted_titles as $deleted_title)
                                                <tr>
                                                    <td>{{$deleted_title['title']}}</td>
                                                    <td>
                                                        <button type="button" class="float-right btn alpha-success border-success-400 text-success-800 btn-icon rounded-round ml-2
                                             modal-ajax-load"
                                                                data-ajax-link="{{route('charity_payment_title_recover',['payment_pattern_id'=>$system_title['id'],'payment_title_id'=>$deleted_title['id']])}}"
                                                                data-toggle="modal"
                                                                data-modal-title="{{trans('messages.recover_item',['item'=>trans('messages.payment_selection')])}}"
                                                                data-target="#general_modal">
                                                            <i class="icon-rotate-cw2"></i>
                                                        </button>


                                                    </td>

                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="periodic_title">
                                <div class="card border-secondary">
                                    <div class="card-body">
                                        {!! $periodic_title['description'] !!}
                                        <span class="text-danger-300 float-right"><a href="#"  class=" m-0 ml-2
                                             modal-ajax-load"
                                                                                     data-ajax-link="{{route('charity_payment_pattern_add',['payment_pattern_id'=>$periodic_title['id']])}}"
                                                                                     data-toggle="modal"
                                                                                     data-modal-size="modal-full"
                                                                                     data-modal-title="{{trans('messages.edit_item',['item'=>trans('messages.payment_pattern')])}}"
                                                                                     data-target="#general_modal">
                                                        {{trans('messages.edit')}}
                                                    </a> </span>
                                        @if(count($periodic_title['fields'])>0)
                                            <table class="table">
                                                <tr>
                                                    <th>{{trans('messages.title')}}</th>
                                                    <th>{{trans('messages.type')}}</th>
                                                    <th></th>
                                                </tr>
                                                @foreach($periodic_title['fields'] as $field)
                                                    <tr>
                                                        <td>{{$field['label']}}</td>
                                                        <td>
                                                            @switch($field['type'])
                                                                @case(0)
                                                                {{trans('messages.input')}}
                                                                @break
                                                                @case(1)
                                                                {{trans('messages.textarea')}}
                                                                @break
                                                                @case(2)
                                                                {{trans('messages.number')}}
                                                                @break
                                                                @case(3)
                                                                {{trans('messages.date_input')}}
                                                                @break
                                                                @case(4)
                                                                {{trans('messages.time_input')}}
                                                                @break
                                                            @endswitch
                                                        </td>
                                                        <td>
                                                            @switch($field['require'])
                                                                @case(0)
                                                                {{trans('messages.optional')}}
                                                                @break
                                                                @case(1)
                                                                {{trans('messages.required')}}
                                                                @break
                                                            @endswitch
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        @endif

                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>

@endsection