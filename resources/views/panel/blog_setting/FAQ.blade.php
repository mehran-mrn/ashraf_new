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
    $active_sidbare = ['blog','blog_setting','faq']
    ?>

    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-light">
                        <button type="button" class="btn btn-outline-info btn-lg modal-ajax-load"
                                data-ajax-link="{{route('faq.create')}}" data-toggle="modal"
                                data-modal-title="{{trans('messages.add_new',['item'=>trans('messages.question')])}}"
                                data-modal-size="modal-lg"
                                data-target="#general_modal"><i
                                    class="icon-home8 mr-2"></i> {{trans('messages.add_new',['item'=>trans('messages.question')])}}
                        </button>
                    </div>
                    <div class="card-body table-responsive">

<table class="table table-bordered">
    @foreach($faqs as $faq)
    <tr class="p-1">
        <?php $value = json_decode($faq['value']); ?>
        <td>{!! isset($value->question)? $value->question : ""!!}</td>
        <td>{!! isset($value->answer) ? $value->answer :"" !!}</td>
        <td>
            <button class="float-right btn alpha-info border-info-400 text-info-800 btn-icon rounded-round ml-2 modal-ajax-load"
                    data-ajax-link="{{route('faq.edit',['faq'=>$faq['id']])}}" data-toggle="modal"
                    data-modal-title="{{trans('messages.edit',['item'=>trans('messages.faq')])}}"
                    data-modal-size="modal-lg"
                    data-target="#general_modal"><i
                        class="icon-pencil"></i>
            </button>

            <button type="button"
                    class="legitRipple swal-alert float-right btn alpha-pink border-pink-400 text-pink-800 btn-icon rounded-round ml-2"
                    data-ajax-link="{{route('faq.destroy',['faq'=>$faq['id']])}}"
                    data-method="DELETE"
                    data-csrf="{{csrf_token()}}"
                    data-title="{{trans('messages.delete_item',['item'=>trans('messages.FAQ')])}}"
                    data-text="{{trans('messages.delete_item_text',['item'=>trans('messages.FAQ')])}}"
                    data-type="warning"
                    data-redirect="{{route('faq.index')}}"
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
                </div>
            </div>
        </div>
    </div>
@endsection