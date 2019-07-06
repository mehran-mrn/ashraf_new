@extends('layouts.panel.panel_layout')
@section('js')
    <script
        src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/panel/js/nestable/jquery.nestable-rtl.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/panel/js/jquery_form.js') }}"></script>

    <script>
        $(document).ready(function () {
            var UINestable = function () {
                var t = function (t) {
                    var e = t.length ? t : $(t.target), a = e.data("output");
                    window.JSON ? a.val(window.JSON.stringify(e.nestable("serialize"))) : a.val("JSON browser support required for this demo.")
                };
                return {
                    init: function () {
                        $("#nestable_ajax_1").nestable({group: 1, maxDepth: 5}).on("change", function (e) {
                            t($("#nestable_ajax_1").data("output", $("#nestable_list_ajax_output_1")));
                            $.ajax({
                                url: "{{route('update_nestable_teams')}}",
                                type: "post",
                                data: {sortval: $("#nestable_list_ajax_output_1").val(),table:'store_categories'},
                                headers: {
                                    'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
                                },
                                success: function (response) {
                                    new PNotify({
                                        title: '',
                                        text: response.message,
                                        type: 'success'
                                    });
                                }, error: function () {
                                }
                            });
                        });

                        $("#list_ajax_menu").on("click", function (t) {
                            var e = $(t.target), a = e.data("action");
                        });
                    }
                }
            }();

            UINestable.init();
        });
    </script>
@endsection
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('css')
    <link href="{{ URL::asset('/public/assets/panel/js/nestable/jquery.nestable.css') }}" rel="stylesheet"
    type="text/css">
@endsection
@section('content')
    @php
        $active_sidbare = ['store', 'store_category']
    @endphp
    <div class="content">
        <div class="card">
            <div class="card-header bg-light">
                <span class="card-title">{{__('messages.product_category')}}</span>
            </div>
            <div class="card-body">
                @csrf
                <button type="button" class="btn btn-light modal-ajax-load"
                        data-ajax-link="{{route('store_category_add_form')}}" data-toggle="modal"
                        data-modal-title="{{trans('messages.add_new',['item'=>trans('messages.product_category')])}}"
                        data-target="#general_modal">
                    <i class="icon-pencil7"></i>
                    <span
                        class="d-none d-lg-inline-block ml-2">{{trans('messages.add_product_category',['item'=>trans('messages.product_category')])}}</span>
                </button>


                <hr>
                <div class="dd" id="nestable_ajax_1">
                    {!! NestableTableGetData(1,0,'','','store_categories')!!}
                </div>
                <div id="nestable_sort_result_1"></div>
                <textarea title="nestable_list_ajax_output_1" id="nestable_list_ajax_output_1" class="d-none"></textarea>
                <div class="row pt-3">
                    @foreach($product_categories as $cat)
                        <div class="col-12 col-md-4">
                            <div class="card">
                                <div class="card-header text-center bg-light">
                                    <span class="card-title">{{$cat['title']}}</span>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-center">
                                        <div class="">
                                            <img src="{{$cat['icon']}}" width="100" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="button" class="legitRipple float-right btn alpha-primary border-primary-400 text-primary-800 btn-icon rounded-round ml-2 modal-ajax-load"
                                            data-ajax-link="{{route('store_category_edit_form',['cat_id'=>$cat['id']])}}" data-toggle="modal"
                                            data-modal-title="{{trans('messages.edit',['item'=>trans('messages.store_category')])}}"
                                            data-target="#general_modal">
                                        <i class="icon-pencil7"></i>
                                    </button>

                                    <button
                                        class="legitRipple swal-alert float-right btn alpha-pink border-pink-400 text-pink-800 btn-icon rounded-round ml-2"
                                        data-ajax-link="{{route('store_category_delete',['cat_id'=>$cat['id']])}}"
                                        data-method="get"
                                        data-csrf="{{csrf_token()}}"
                                        data-title="{{trans('messages.delete_item',['item'=>trans('messages.product_category')])}}"
                                        data-text="{{trans('messages.delete_item_text',['item'=>trans('messages.product_category')])}}"
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
