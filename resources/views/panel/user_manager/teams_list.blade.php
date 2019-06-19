@extends('layouts.panel.panel_layout')
@section('css')
    <link href="{{ URL::asset('/public/assets/panel/js/nestable/jquery.nestable.css') }}" rel="stylesheet"
          type="text/css">
@endsection
@section('js')
    <!-- Theme JS files -->
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
                                url: "{{route('update_nestable_teams')}}",
                                type: "post",
                                data: {sortval: $("#nestable_list_ajax_output_1").val(),table:"teams"},
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
    <!-- /theme JS files -->
@endsection
@section('content')
    <?php
    $active_sidbare = ['user_manager', 'teams_list']
    ?>
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <button type="button" class="btn btn-outline-info btn-lg modal-ajax-load"
                        data-ajax-link="{{route('panel_register_team_form')}}" data-toggle="modal"
                        data-modal-title="{{trans('messages.add_new',['item'=>trans('messages.team')])}}"
                        data-target="#general_modal"><i
                            class="icon-user-plus mr-2"></i> {{trans('messages.add_new',['item'=>trans('messages.team')])}}
                </button>
            </div>
        </div>
    </div>

    <div id="res"></div>
    <!-- Content area -->
    <div class="content">
        <!-- Basic responsive configuration -->
        <div class="card">
            {{--<div class="card-header header-elements-inline">--}}

            {{--</div>--}}

            <div class="card-body">
                {{csrf_field()}}
                <div class="dd" id="nestable_ajax_1">
                    {!! NestableTableGetData(1,0,'','','teams',true)!!}
                </div>
                <div id="nestable_sort_result_1"></div>
                <textarea title="nestable_list_ajax_output_1" id="nestable_list_ajax_output_1"
                          class="d-none"></textarea>

            </div>


        </div>
        <!-- /basic responsive configuration -->
    </div>
    <!-- /content area -->

@endsection
