@extends('layouts.panel.panel_layout')
@section('js')

@endsection
@section('content')
    <?php
    $active_sidbare = ['category_list', 'blog']
    ?>

    <!-- Content area -->
    <div class="content">
        <!-- Basic responsive configuration -->
        <div class="card">
            <div class="card-header bg-indigo">
                <h6 class="card-title">{{__('messages.categories_list')}}</h6>
            </div>
            <div class="card-header">
                <button type="button" class="btn btn-light modal-ajax-load"
                        data-ajax-link="{{route('category_add_form')}}" data-toggle="modal"
                        data-modal-title="{{trans('messages.add_new',['item'=>trans('messages.category')])}}"
                        data-target="#general_modal">
                    <i class="icon-pencil7"></i>
                    <span
                        class="d-none d-lg-inline-block ml-2">{{trans('messages.add_category',['item'=>trans('messages.category')])}}</span>
                </button>
            </div>
            <div class="card-body">
                <div class="card-body">
                    <hr>
                    <div class="row">
                        @foreach($cats as $cat)
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body text-center bg-light border-radius-5px">
                                        <i class="icon-blogger"></i> <span class="text-black"><b>{{$cat['title']}}</b></span>
                                    </div>
                                    <div class="card-footer">
                                        <button type="button"
                                                class="legitRipple float-right btn alpha-primary border-primary-400 text-primary-800 btn-icon rounded-round ml-2 modal-ajax-load"
                                                data-ajax-link="{{route('category_edit_form',['cat_id'=>$cat['id']])}}"
                                                data-toggle="modal"
                                                data-modal-title="{{trans('messages.edit',['item'=>trans('messages.category')])}}"
                                                data-target="#general_modal"><i class="icon-database-edit2"></i>
                                        </button>
                                        <button
                                            class="legitRipple swal-alert float-right btn alpha-pink border-pink-400 text-pink-800 btn-icon rounded-round ml-2"
                                            data-ajax-link="{{route('category_delete',['id'=>$cat['id']])}}"
                                            data-method="get"
                                            data-csrf="{{csrf_token()}}"
                                            data-title="{{trans('messages.delete',['item'=>trans('messages.category')])}}"
                                            data-text="{{trans('messages.delete_item_text',['item'=>trans('messages.category')])}}"
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
            <!-- /basic responsive configuration -->
        </div>
    </div>
    <!-- /content area -->

@endsection
