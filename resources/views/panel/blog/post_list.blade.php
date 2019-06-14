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
            <div class="card-header bg-indigo">
                <h6 class="card-title">{{__('messages.post_list')}}</h6>
            </div>
            <div class="card-header">
                <a class="btn btn-light m-0" href="{{route('post_add')}}"><i class="icon-pencil7"></i> <span
                        class="d-none d-lg-inline-block ml-2">{{__('messages.new_post')}}</span></a>
            </div>
            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-inbox">
                    <tbody data-link="row">
                    @foreach($posts as $post)
                        <tr class="unread">
                            <td class="table-inbox-checkbox rowlink-skip">
                                <img src="{{URL::asset(user_information('avatar',$post['user_id']))}}"
                                     class="rounded-circle"
                                     width="32" height="32" alt=""  data-popup="tooltip" title="" data-placement="bottom"
                                     data-container="body" data-original-title="{{user_information(['name'])}}">
                            </td>
                            <td class="table-inbox-image">
                            </td>
                            <td class="table-inbox-name">
                                <div class="letter-icon-title text-default">{{$post['title']}}</div>
                            </td>
                            <td class="table-inbox-message">
                                <span class="table-inbox-subject"></span>
                                <span
                                    class="text-muted font-weight-normal">{{__('messages.'.$post['publish_status'])}}</span>
                            </td>
                            <td class="table-inbox-name">
                                @foreach($post['blog_categories'] as $cat)
                                    <span class="badge badge-info">{{$cat['category']['title']}}</span>
                                @endforeach
                            </td>
                            <td class="table-inbox-name"><span class="text-muted">{{jdate("Y/m/d-H:i",strtotime($post['publish_time']))}}</span></td>
                            <td class="table-inbox-name">
                                <a href="{{route('post_edit_form',$post['id'])}}"
                                   class="legitRipple float-right btn alpha-success border-success-400 text-success-800 btn-icon rounded-round ml-2">
                                    <i class="icon-database-edit2"></i>
                                </a>
                                <button
                                    class="legitRipple swal-alert float-right btn alpha-pink border-pink-400 text-pink-800 btn-icon rounded-round ml-2"
                                    data-ajax-link="{{route('post_delete',['post_id'=>$post['id']])}}"
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
