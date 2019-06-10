@extends('layouts.panel.panel_layout')
@section('js')

@endsection
@section('content')
    <?php
    $active_sidbare = ['blog', 'add_post']
    ?>
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <button type="button" class="btn btn-outline-info btn-lg modal-ajax-load"
                        data-ajax-link="{{route('panel_register_role_form')}}" data-toggle="modal"
                        data-modal-title="{{trans('messages.add_new',['item'=>trans('messages.role')])}}"
                        data-target="#general_modal"><i
                        class="icon-user-plus mr-2"></i> {{trans('messages.add_new',['item'=>trans('messages.role')])}}
                </button>
            </div>
        </div>
    </div>
    <!-- Content area -->
    <div class="content">
        <!-- Basic responsive configuration -->
        <div class="card">

            <div class="card-body">

            </div>
            <!-- /basic responsive configuration -->
        </div>
    </div>
    <!-- /content area -->

@endsection
