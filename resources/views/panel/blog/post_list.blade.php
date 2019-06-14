@extends('layouts.panel.panel_layout')
@section('js')
    {{--    <script src="{{URL::asset('/public/assets/panel/global_assets/js/plugins/extensions/rowlink.js')}}"></script>--}}
    <script src="{{URL::asset('/public/assets/panel/global_assets/js/plugins/forms/styling/uniform.min.js')}}"></script>
    <script src="{{URL::asset('/public/assets/panel/global_assets/js/demo_pages/mail_list.js')}}"></script>

@endsection
@section('content')
    <?php
    $active_sidbare = ['blog', 'post_list']
    ?>
    <!-- Content area -->
    <div class="content">
        <!-- Single line -->
        <div class="card">
            <div class="card-header bg-transparent header-elements-inline">
                <h6 class="card-title">{{__('messages.post_list')}}</h6>
            </div>
            <!-- Action toolbar -->
            <div class="bg-light">
                <div class="navbar navbar-light bg-light navbar-expand-lg py-lg-2">
                    <div class="text-center d-lg-none w-100">
                        <button type="button" class="navbar-toggler w-100" data-toggle="collapse"
                                data-target="#inbox-toolbar-toggle-single">
                            <i class="icon-circle-down2"></i>
                        </button>
                    </div>

                    <div class="navbar-collapse text-center text-lg-left flex-wrap collapse"
                         id="inbox-toolbar-toggle-single">
                        <div class="mt-3 mt-lg-0">
                            <div class="btn-group">
                                <button type="button" class="btn btn-light btn-icon btn-checkbox-all">
                                    <input type="checkbox" class="form-input-styled" data-fouc>
                                </button>

                                <button type="button" class="btn btn-light btn-icon dropdown-toggle"
                                        data-toggle="dropdown"></button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="#" class="dropdown-item">Select all</a>
                                    <a href="#" class="dropdown-item">Select read</a>
                                    <a href="#" class="dropdown-item">Select unread</a>
                                    <div class="dropdown-divider"></div>
                                    <a href="#" class="dropdown-item">Clear selection</a>
                                </div>
                            </div>

                            <div class="btn-group ml-3 mr-lg-3">
                                <a class="btn btn-light" href="{{route('add_post')}}"><i class="icon-pencil7"></i> <span
                                        class="d-none d-lg-inline-block ml-2">{{__('messages.new_post')}}</span></a>
                                <button type="button" class="btn btn-light"><i class="icon-bin"></i> <span
                                        class="d-none d-lg-inline-block ml-2">{{__('messages.delete')}}</span></button>
                            </div>
                        </div>

                        <div class="navbar-text ml-lg-auto"><span class="font-weight-semibold">۱۲</span> <span
                                class="font-weight-semibold"></span></div>
                    </div>
                </div>
            </div>
            <!-- /action toolbar -->
            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-inbox">
                    <tbody data-link="row">
                    @foreach($posts as $post)
                        <tr>
                            <td class="table-inbox-checkbox rowlink-skip">
                                <input type="checkbox" class="form-input-styled" data-fouc>
                            </td>
                            <td class="table-inbox-image"
                                data-popup="tooltip" title="" data-placement="bottom"
                                data-container="body" data-original-title="{{user_information(['name'])}}">
                                <img src="{{URL::asset(user_information('avatar',$post['user_id']))}}"
                                     class="rounded-circle"
                                     width="32" height="32" alt="">
                            </td>
                            <td class="table-inbox-name">
                                <div class="letter-icon-title text-default">{{$post['title']}}</div>
                            </td>
                            <td class="table-inbox-message">
                                <span class="table-inbox-subject"></span>
                                <span
                                    class="text-muted font-weight-normal">{{__('messages.'.$post['publish_status'])}}</span>
                            </td>
                            <td class="table-inbox-message">
                                @foreach($post['blog_categories'] as $cat)
                                    <span class="badge badge-info">{{$cat['category']['title']}}</span>
                                @endforeach
                            </td>
                            <td class="table-inbox-name"><span class="text-muted">{{$post['publish_time']}}</span>
                            </td>
                            <td class="table-inbox-message">
                                <a href="{{route('edit_post',$post['id'])}}"
                                   class="legitRipple float-right btn alpha-success border-success-400 text-success-800 btn-icon rounded-round ml-2">
                                    <i class="icon-database-edit2"></i>
                                </a>
                                <button
                                    class="legitRipple swal-alert float-right btn alpha-pink border-pink-400 text-pink-800 btn-icon rounded-round ml-2"
                                    data-ajax-link="{{route('delete_post',['post_id'=>$post['id']])}}"
                                    data-method="get"
                                    data-csrf="{{csrf_token()}}"
                                    data-title="{{trans('messages.delete_item',['item'=>trans('messages.post')])}}"
                                    data-text="{{trans('messages.delete_item_text',['item'=>trans('messages.post')])}}"
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
            <!-- /table -->

        </div>
    </div>
    <!-- /content area -->

@endsection
