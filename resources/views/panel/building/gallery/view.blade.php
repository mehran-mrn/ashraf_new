@extends('layouts.panel.panel_layout')
@section('meta')
    <meta name="token" content="{{csrf_token()}}">
@stop
@section('css')
    <link rel="stylesheet" href="{{URL::asset('/public/assets/global/js/fancybox/dist/jquery.fancybox.min.css')}}"
          type="text/css" media="screen"/>
@stop
@section('js')
    <script src="{{ URL::asset('node_modules/pnotify/dist/iife/PNotify.js') }}"></script>
    <script src="{{URL::asset('/public/assets/panel/global_assets/js/plugins/uploaders/dropzone.min.js')}}"></script>
    <script src="{{URL::asset('/public/assets/global/js/fancybox/dist/jquery.fancybox.min.js')}}"></script>
    {{--    <script src="{{URL::asset('/public/assets/panel/global_assets/js/demo_pages/gallery.js')}}"></script>--}}
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
            }
        });
        var DropzoneUploader = function () {
            var _componentDropzone = function () {
                if (typeof Dropzone == 'undefined') {
                    console.warn('Warning - dropzone.min.js is not loaded.');
                    return;
                }
                var token = $('meta[name="token"]').attr('content');
                var cat_id = $('#cat_id').val();

                Dropzone.options.dropzoneRemove = {
                    url: "{{route('upload_files_building_project')}}",
                    paramName: "file",
                    dictDefaultMessage: 'Drop files to upload <span>or CLICK</span>',
                    maxFilesize: 5,
                    maxFiles: 30,
                    acceptedFiles: ".jpeg,.jpg,.png,.gif",
                    autoProcessQueue: false,
                    addRemoveLinks: true,
                    parallelUploads: 30,
                    sending: function (file, xhr, formData) {
                        formData.append("_token", token);
                        formData.append("cat_id", cat_id);
                    },
                    init: function () {
                        var myDropzone = this;
                        $("#frm_add_image").on('submit', function (e) {
                            e.preventDefault();
                            myDropzone.processQueue();
                        })
                        this.on('sending', function (file, xhr, formData) {
                            var data = $('#frm_add_image').serializeArray();
                            $.each(data, function (key, el) {
                                formData.append(el.name, el.value);
                            });
                        });
                        this.on("success", function (file, response) {
                            console.log(response);
                            var org_name = file.name;
                            var new_name = org_name.replace(".", "_");
                            $("#file_names").append(
                                '<input class="' + new_name + '" name="file_name[]" type="hidden" value="' + response + '" />'
                            );
                            new PNotify({
                                title: '',
                                text: response.message,
                                type: 'success'
                            });
                            setTimeout(function () {
                                location.reload();
                            }, 1000)

                        });
                        this.on("complete", function (file, response) {
                            $("input").remove(".dz-hidden-input");
                            $('.dz-hidden-input').hide();
                        });
                        this.on("removedfile", function (file) {
                            var org_name = file.name;
                            var new_name = org_name.replace(".", "_");
                            $('.' + new_name).remove();
                        });
                    }
                };
            };
            return {
                init: function () {
                    _componentDropzone();
                }
            }
        }();
        DropzoneUploader.init();

        function editMedia(id) {
            $.ajax({
                url: "{{route('gallery_media_info')}}",
                type: "POST",
                data: {id: id},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
                },
                success: function (response) {
                    $("#edit_modal").modal('show');
                    if (response.id) {
                        $("#frm_edit_image input[name='title']").val(response.title);
                        $("#frm_edit_image input[name='media_id']").val(response.id);
                    }
                }, error: function () {
                }
            });
        }

        $(document).ready(function () {
            $(document).on('submit', "#frm_edit_image", function (e) {
                e.preventDefault();
                $.ajax({
                    url: "{{route('gallery_media_edit')}}",
                    method: 'POST',
                    data: $(this).serialize(),

                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
                    },
                    success: function (response) {
                        if (response.message.status === 200) {
                            new PNotify({
                                title: '',
                                text: response.message.messages,
                                type: 'success'
                            });
                            setTimeout(function () {
                                location.reload();
                            }, 1000)
                        }
                    }, error: function () {
                    }
                });
            })

            $('[data-fancybox="images"]').fancybox({
                closeExisting: false,
                gutter: 50,
                keyboard: true,
                arrows: true,
                protect: true,
                image: {
                    preload: true
                },
                buttons: [
                    "zoom",
                    "slideShow",
                    "fullScreen",
                    "thumbs",
                    "close"
                ],
                thumbs: {
                    autoStart: true
                },
                afterLoad: function (instance, current) {
                    var pixelRatio = window.devicePixelRatio || 1;

                    if (pixelRatio > 1.5) {
                        current.width = current.width / pixelRatio;
                        current.height = current.height / pixelRatio;
                    }
                }
            })
        })

    </script>
@endsection
@section('content')
    <?php $active_sidbare = ['building', 'collapse']?>
    <section>
        <div class="content">
            <div class="container-fluid">
                <section>
                    <a href="{{route('building_project',['id'=>$catInfo['id']])}}"
                       class="btn btn-outline-dark m-2 py-2 px-3">{{__('messages.back')}}</a>

                    <button
                            class="btn btn-primary m-2 py-2 px-3"
                            data-toggle="modal"
                            data-modal-title="{{trans('messages.add_category',['item'=>trans('messages.category')])}}"
                            data-target="#general_modal">
                        {{__('messages.add_image')}}
                    </button>


                </section>
            </div>
            <section>
                <div class="card">
                    <div class="card-header">
                        <span class="card-title text-black">{{$catInfo['title']}}</span>
                        <hr>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($medias as $media)
                                @if(file_exists($media['url']))
                                    <div class="col-sm-6 col-lg-3">
                                        <div class="card">
                                            <div class="card-img-actions m-1">
                                                <img class="card-img img-responsive" width="267" height="178"
                                                     src="/{{$media['path']."/600/".$media['name']}}"
                                                     alt="">
                                                <div class="card-img-actions-overlay card-img">
                                                    <a href="/{{$media['url']}}"
                                                       class="btn btn-outline fancybox-thumb bg-white text-white border-white border-2 btn-icon rounded-round "
                                                       data-fancybox="images"
                                                       data-caption="{{$media['title']}}">
                                                        <i class="icon-eye"></i>
                                                    </a>

                                                    <a href="javascript:;" onclick="editMedia({{$media['id']}})"
                                                       class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round m-1">
                                                        <i class="icon-database-edit2"></i>
                                                    </a>

                                                    <a href="javascript:;"
                                                       class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round swal-alert m-1"
                                                       data-ajax-link="{{route('gallery_category_image_remove',['id'=>$media['id']])}}"
                                                       data-method="DELETE"
                                                       data-csrf="{{csrf_token()}}"
                                                       data-title="{{trans('messages.delete_item',['item'=>trans('messages.file')])}}"
                                                       data-text="{{trans('messages.delete_item_text',['item'=>trans('messages.file')])}}"
                                                       data-type="warning"
                                                       data-cancel="true"
                                                       data-confirm-text="{{trans('messages.delete')}}"
                                                       data-cancel-text="{{trans('messages.cancel')}}"><i
                                                                class="icon-trash"></i>
                                                    </a>

                                                </div>
                                                <div class="caption">
                                                    <h6 class="caption text-center pt-1">{{$media['title']}}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>

    <div id="general_modal" class="modal fade">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h6 class="modal-title">{{__('messages.add_image')}}</h6>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="frm_add_image" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="">{{__('messages.title')}}</label>
                            <input type="text" name="title" class="form-control">
                        </div>
                        <input type="hidden" name="cat_id" id="cat_id" value="{{$catInfo['id']}}">
                        <div class="dropzone" id="dropzone_remove">
                            <div class="fallback">
                                <input name="file" type="file" multiple/>
                            </div>
                        </div>
                        <div class="form-group pull-left pt-2">
                            <button type="button" id="button" class="btn btn-default" class="close"
                                    data-dismiss="modal">{{__('messages.cancel')}}</button>
                            <button type="submit" id="button" class="btn btn-primary">{{__('messages.add')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="edit_modal" class="modal fade ">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h6 class="modal-title">{{__('messages.edit')}}</h6>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="frm_edit_image">
                        <div class="form-group">
                            <label for="">{{__('messages.title')}}</label>
                            <input type="text" name="title" class="form-control">
                        </div>
                        <input type="hidden" name="media_id" id="media_id" value="">
                        <div class="form-group pull-left pt-2">
                            <button type="button" id="button" class="btn btn-default" class="close"
                                    data-dismiss="modal">{{__('messages.cancel')}}</button>
                            <button type="submit" class="btn btn-primary">{{__('messages.add')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection