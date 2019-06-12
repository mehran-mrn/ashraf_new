@extends('layouts.panel.panel_layout')
@section('js')

@endsection
@section('content')
    <?php
    $active_sidbare = ['blog_category', 'blog']
    ?>
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <button type="button" class="btn btn-outline-info btn-lg modal-ajax-load"
                        data-ajax-link="{{route('panel_category_add_form')}}" data-toggle="modal"
                        data-modal-title="{{trans('messages.add_new',['item'=>trans('messages.category')])}}"
                        data-target="#general_modal"><i
                        class="icon-user-plus mr-2"></i> {{trans('messages.add_category',['item'=>trans('messages.category')])}}
                </button>
            </div>
        </div>
    </div>
    <!-- Content area -->
    <div class="content">
        <!-- Basic responsive configuration -->
        <div class="card">

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
                            <button type="button" class="btn btn-outline-danger btn-xs"><i class="icon-trash icon-xs text-danger"></i></button>
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
