@extends('layouts.panel.panel_layout')
@section('js')
    <script src="{{URL::asset('/node_modules/ckeditor/ckeditor.js')}}"></script>
    <script src="{{URL::asset('/public/assets/panel/global_assets/js/plugins/forms/tags/tagsinput.min.js')}}"></script>
    <script src="{{URL::asset('/public/assets/panel/global_assets/js/plugins/forms/tags/tokenfield.min.js')}}"></script>
    <script>
        $( document ).ready(function() {

            CKEDITOR.replace('text');
            $('.tokenfield').tokenfield();
        });
    </script>
@endsection
@section('content')
    <?php
    $active_sidbare = ['blog', 'add_post']
    ?>
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
            </div>
        </div>
    </div>
    <!-- Content area -->
    <div class="content">
        <!-- Basic responsive configuration -->
        <div class="card">

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">{{__('messages.title')}}</label>
                            <input type="text" class="form-control" name="title" id="title" placeholder="{{__('messages.enter_title')}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="slug">{{__('messages.slug')}}</label>
                            <input type="text" class="form-control" name="slug" id="slug" disabled>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                        <label for="text">{{__('messages.text')}}</label>
                        <textarea name="text" id="text" class="textarea" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">{{__('messages.description')}}</label>
                            <textarea name="description" id="description" class="form-control" cols="30" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="publish_time">{{__('messages.publish_time')}}</label>
                            <input type="text" class="form-control" name="publis_time" id="publish_time" value="{{date("Y-m-d H:I:s")}}">
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="form-group">
                            <label for="tages">{{__('messages.tages')}}</label>
                            <input type="text" class="form-control tokenfield" placeholder="{{__('messages.add_tag')}}" data-fouc name="tages" id="tages">
                        </div>
                    </div>
                </div>
            </div>
            <!-- /basic responsive configuration -->
        </div>
    </div>
    <!-- /content area -->

@endsection
