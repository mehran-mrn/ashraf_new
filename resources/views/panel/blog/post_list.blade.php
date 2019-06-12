@extends('layouts.panel.panel_layout')
@section('js')
    <script src="{{URL::asset('/public/assets/panel/global_assets/js/plugins/extensions/rowlink.js')}}"></script>
    <script src="{{URL::asset('/public/assets/panel/global_assets/js/plugins/forms/styling/uniform.min.js')}}"></script>
    <script src="{{URL::asset('/public/assets/panel/global_assets/js/demo_pages/mail_list.js')}}"></script>

@endsection
@section('content')
    <?php
    $active_sidbare = ['blog', 'post_list']
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

        <!-- Single line -->
        <div class="card">
            <div class="card-header bg-transparent header-elements-inline">
                <h6 class="card-title">My Inbox (single line)</h6>

                <div class="header-elements">
                    <span class="badge bg-blue">259 new today</span>
                </div>
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
                                <button type="button" class="btn btn-light"><i class="icon-pencil7"></i> <span
                                        class="d-none d-lg-inline-block ml-2">Compose</span></button>
                                <button type="button" class="btn btn-light"><i class="icon-bin"></i> <span
                                        class="d-none d-lg-inline-block ml-2">Delete</span></button>
                                <button type="button" class="btn btn-light"><i class="icon-spam"></i> <span
                                        class="d-none d-lg-inline-block ml-2">Spam</span></button>
                            </div>
                        </div>

                        <div class="navbar-text ml-lg-auto"><span class="font-weight-semibold">1-50</span> of <span
                                class="font-weight-semibold">528</span></div>

                        <div class="ml-lg-3 mb-3 mb-lg-0">
                            <div class="btn-group">
                                <button type="button" class="btn btn-light btn-icon disabled"><i
                                        class="icon-arrow-right13"></i></button>
                                <button type="button" class="btn btn-light btn-icon"><i class="icon-arrow-left12"></i>
                                </button>
                            </div>

                            <div class="btn-group ml-3">
                                <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown"><i
                                        class="icon-cog3"></i></button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="#" class="dropdown-item">Action</a>
                                    <a href="#" class="dropdown-item">Another action</a>
                                    <a href="#" class="dropdown-item">Something else here</a>
                                    <a href="#" class="dropdown-item">One more line</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /action toolbar -->


            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-inbox">
                    <tbody data-link="row" class="rowlink">
                    @foreach($posts as $post)
                        <tr class="unread">
                            <td class="table-inbox-checkbox rowlink-skip">
                                <input type="checkbox" class="form-input-styled" data-fouc>
                            </td>
                            <td class="table-inbox-star rowlink-skip">
                                <a href="#">
                                    <i class="icon-star-empty3 text-muted"></i>
                                </a>
                            </td>
                            <td class="table-inbox-image">
                                <img src="{{URL::asset(user_information('avatar',$post['user_id']))}}"
                                     class="rounded-circle"
                                     width="32" height="32" alt="">
                            </td>
                            <td class="table-inbox-name">
                                <a href="mail_read.html">
                                    <div class="letter-icon-title text-default">{{$post['title']}}</div>
                                </a>
                            </td>
                            <td class="table-inbox-message">
                                <span class="table-inbox-subject"></span>
                                <span class="text-muted font-weight-normal">{{$post['description']}}</span>
                            </td>
                            <td class="table-inbox-message">
                                @foreach($post['blog_categories'] as $cat)
                                    <span class="badge badge-info">{{$cat['category']['title']}}</span>
                                @endforeach
                            </td>
                            <td class="table-inbox-message"><span class="text-muted">{{$post['publish_time']}}</span></td>
                            <td class="table-inbox-message">
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
