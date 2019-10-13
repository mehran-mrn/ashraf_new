@extends('layouts.panel.panel_layout')
@section('js')
    <!-- Theme JS files -->
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/extensions/rowlink.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/demo_pages/mail_list.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/panel/js/nestable/jquery.nestable-rtl.js') }}"></script>
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
                                url: "{{route('update_nestable_roles')}}",
                                type: "post",
                                data: {sortval: $("#nestable_list_ajax_output_1").val(), table: "roles"},
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
@section('css')
    <link href="{{ URL::asset('/public/assets/panel/js/nestable/jquery.nestable.css') }}" rel="stylesheet"
          type="text/css">
@endsection
@section('content')
    <?php
    $active_sidbare = ['user_manager', 'roles_list']
    ?>

    <section>
        <div class="content">
            <div class="container-fluid">
                <section>
                    <button type="button" class="btn btn-outline-dark m-2 py-2 px-3 modal-ajax-load"
                            data-ajax-link="{{route('panel_register_role_form')}}" data-toggle="modal"
                            data-modal-title="{{trans('messages.add_new',['item'=>trans('messages.role')])}}"
                            data-target="#general_modal"><i
                                class="icon-user-plus mr-2"></i> {{trans('messages.add_new',['item'=>trans('messages.role')])}}
                    </button>
                </section>
                <section>
                    <div class="card">
                        <div class="card-header bg-light">
                            <h4 class="card-title">{{__('messages.roles_list')}}</h4>
                        </div>
                        <div class="card-body">
                            <div id="res"></div>
                            {{csrf_field()}}
                            <div class="dd" id="nestable_ajax_1">
                                {!! NestableTableGetData(1,0,'','','roles',true,false,true)!!}
                            </div>
                            <div id="nestable_sort_result_1"></div>
                            <textarea
                                    title="nestable_list_ajax_output_1"
                                    id="nestable_list_ajax_output_1"
                                    class="d-none"></textarea>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
@endsection