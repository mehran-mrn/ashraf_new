@extends('layouts.panel.panel_layout')
@section('js')
    <script src="{{URL::asset('/public/assets/panel/js/ckeditor/ckeditor.js')}}"></script>
    <script>
        $(document).ready(function () {
            $(function () {
                $('.message_text').each(function (e) {
                    CKEDITOR.replace(this.id, {
                        language: 'fa',
                        uiColor: '#9AB8F3',
                        extraPlugins: 'filebrowser',
                        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                        filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
                        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
                    });
                });
            });

        });
    </script>
@endsection
@section('content')
    <?php
    $active_sidbare = ['setting', 'notification_template']
    ?>
    <div class="content">
        <div class="row">
            <div class="col-md-12">

                @foreach($templates as $template)
                    <div class="card" id="card_{{$template['id']}}">

                        <div class="card-header bg-teal">
                            <span class="font-size-lg label label-warning">{{$template['module']}} <label class="text-white">{{$template['description']}}</label></span>
                        </div>
                        <div class="card-body ">

                            <div class="row">
                            <div class="col-md-6">

                            <form method="post" action="{{route('notification_template.update',[$template['id']])}}">
                                @csrf
                                @method('patch')
                                <input type="hidden" name=id value="{{$template['id']}}">
                                <div class="form-group">
                                    <input type="text" name="subject" class="form-control"
                                           value="{!! $template['subject'] !!}">
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control message_text" name="text"
                                              id="msg_txt_{{$template['id']}}">{!! $template['text'] !!}</textarea>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-info" type="submit">{{__('words.update')}}</button>
                                </div>
                            </form>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header">
                                        {{__('words.variables')}}
                                    </div>
                                    <div class="card-body">
                                        <?php $variables = explode(',',$template['variables'])?>
                                        <ul class="list-unstyled">
                                        @foreach($variables as $vriable)
                                            <li class="m-2">
                                            <i class=" badge badge-dark">
                                            <i class="font-size-lg text-white">{ {{$vriable}} }</i>
                                        </i>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>


                @endforeach

            </div>
        </div>
    </div>
@endsection
