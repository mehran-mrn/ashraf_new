@extends('layouts.panel.panel_layout')
@section('js')

@endsection
@section('content')
    <?php
    $active_sidbare = ['blog_category', 'blog']
    ?>

    <!-- Content area -->
    <div class="content">
        <!-- Basic responsive configuration -->
        <div class="card">
            <div class="card-header bg-light">
                <button type="button" class="btn btn-outline-info btn-lg modal-ajax-load"
                        data-ajax-link="{{route('panel_category_add_form')}}" data-toggle="modal"
                        data-modal-title="{{trans('messages.add_new',['item'=>trans('messages.category')])}}"
                        data-target="#general_modal"><i
                        class="icon-user-plus mr-2"></i> {{trans('messages.add_category',['item'=>trans('messages.category')])}}
                </button>
            </div>
            <div class="card-body">
                <table class="table text-nowrap">
                    <thead>
                    <tr>
                        <th class="w-75">{{__('messages.title')}}</th>
                        <th>{{__('messages.status')}}</th>
                        <th>{{__('messages.post_count')}}</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cats as $cat)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="mr-3">
                                    <a href="#" class="btn bg-primary-400 rounded-round btn-icon btn-sm">
                                        <span class="letter-icon"></span>
                                    </a>
                                </div>
                                <div>
                                    <a href="#" class="text-default font-weight-semibold letter-icon-title">{{$cat->title}}</a>
                                    <div class="text-muted font-size-sm"><i class="icon-checkmark3 font-size-sm mr-1"></i></div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="text-muted font-size-sm">{{$cat->status}}</span>
                        </td>
                        <td>
                            <span class="text-muted font-size-sm">0</span>
                        </td>
                        <td>
                            <a href="{{route('delete_category',$cat['id'])}}"
                               class="legitRipple float-right btn alpha-success border-success-400 text-success-800 btn-icon rounded-round ml-2">
                                <i class="icon-database-edit2"></i>
                            </a>

                            <button
                                class="legitRipple swal-alert float-right btn alpha-pink border-pink-400 text-pink-800 btn-icon rounded-round ml-2"
                                data-ajax-link="{{route('delete_category',['id'=>$cat['id']])}}"
                                data-method="get"
                                data-csrf="{{csrf_token()}}"
                                data-title="{{trans('messages.delete_item',['item'=>trans('messages.category')])}}"
                                data-text="{{trans('messages.delete_item_text',['item'=>trans('messages.category')])}}"
                                data-type="warning"
                                data-cancel="true"
                                data-confirm-text="{{trans('messages.delete')}}"
                                data-cancel-text="{{trans('messages.cancel')}}">
                                <i class="icon-trash"></i>
                            </button>
                        </td>
                    </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /basic responsive configuration -->
        </div>
    </div>
    <!-- /content area -->

@endsection
