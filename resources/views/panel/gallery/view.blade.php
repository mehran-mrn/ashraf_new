@extends('layouts.panel.panel_layout')
@section('meta')
    <meta name="token" content="{{csrf_token()}}">
@stop
@section('js')
    <script src="{{ URL::asset('node_modules/pnotify/dist/iife/PNotify.js') }}"></script>
    <script src="{{URL::asset('/public/assets/panel/global_assets/js/plugins/uploaders/dropzone.min.js')}}"></script>
    <script src="{{URL::asset('/public/assets/panel/global_assets/js/plugins/media/fancybox.min.js')}}"></script>
    <script src="{{URL::asset('/public/assets/panel/global_assets/js/demo_pages/gallery.js')}}"></script>
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
                    url: "{{route('upload_files_category')}}",
                    paramName: "file",
                    dictDefaultMessage: 'Drop files to upload <span>or CLICK</span>',
                    maxFilesize: 5,
                    maxFiles: 10,
                    autoProcessQueue: false,
                    addRemoveLinks: true,
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
    </script>
@endsection
@section('content')
    <?php $active_sidbare = ['gallery', 'gallery_add']?>
    <section>
        <div class="content">
            <div class="container-fluid">
                <section>
                    <a href="{{route('gallery_add')}}"
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
                                                <img class="card-img img-responsive " width="200" height="250"
                                                     src="/{{$media['url']}}" alt="">
                                                <div class="card-img-actions-overlay card-img">
                                                    <a href="/{{$media['url']}}"
                                                       class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round"
                                                       data-popup="lightbox" rel="group">
                                                        <i class="icon-plus3"></i>
                                                    </a>
                                                    <a href="javascript:;"
                                                       class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round swal-alert "
                                                       data-ajax-link="{{route('gallery_category_image_remove',['id'=>$media['id']])}}"
                                                       data-method="DELETE"
                                                       data-csrf="{{csrf_token()}}"
                                                       data-title="{{trans('messages.delete_item',['item'=>trans('messages.file')])}}"
                                                       data-text="{{trans('messages.delete_item_text',['item'=>trans('messages.file')])}}"
                                                       data-type="warning"
                                                       data-cancel="true"
                                                       data-confirm-text="{{trans('messages.delete')}}"
                                                       data-cancel-text="{{trans('messages.cancel')}}"><i class="icon-trash"></i>
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

    <div id="general_modal" class="modal fade ">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h6 class="modal-title">{{__('messages.add_category')}}</h6>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="frm_add_image">
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
                            <button type="submit" id="button" class="btn btn-primary">{{__('messages.add')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection