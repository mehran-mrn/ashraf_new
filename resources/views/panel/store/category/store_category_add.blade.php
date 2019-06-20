<form action="{{route('store_category_add')}}" method="post" id="frm_product_category_add">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="title">{{__('messages.title')}}</label>
                <input type="text" class="form-control" name="title" id="title">
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label for="description">{{__('messages.description')}}</label>
                <input type="text" class="form-control" name="description" id="description">
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
            <span class="input-group-btn">
                    <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary"><i
                            class="fa fa-picture-o"></i>{{__('messages.select_image')}}</a>
                </span>
                <input id="thumbnail" readonly="readonly" class="form-control" type="text" name="filepath">
                <img id="holder" style="margin-top:15px;max-height:100px;" src="">
            </div>
        </div>
        <div class="col-12 pt-2">
            <button class="btn btn-primary btn-block" type="submit">{{__('messages.submit')}}</button>
        </div>
    </div>
</form>
<script type="text/javascript" src="/node_modules/pnotify/dist/iife/PNotify.js"></script>

<script>

    var route_prefix = {{env('url')}}"/laravel-filemanager";

    (function ($) {

        $.fn.filemanager = function (type, options) {
            type = type || 'file';

            this.on('click', function (e) {
                var route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
                var target_input = $('#' + $(this).data('input'));
                var target_preview = $('#' + $(this).data('preview'));
                window.open(route_prefix + '?type=' + type, 'FileManager', 'width=900,height=600');
                window.SetUrl = function (items) {
                    var file_path = items.map(function (item) {
                        console.log(item.url);
                        return item.url;
                    }).join(',');

                    // set the value of the desired input to image url
                    target_input.val('').val(file_path).trigger('change');

                    // clear previous preview
                    target_preview.html('');

                    // set or change the preview image src
                    items.forEach(function (item) {
                        target_preview.append(
                            $('<img>').css('height', '5rem').attr('src', item.thumb_url)
                        );
                    });

                    // trigger change event
                    target_preview.trigger('change');
                };
                return false;
            });
        }

    })(jQuery);

    $('#lfm').filemanager('image', {prefix: route_prefix});


    $("#frm_product_category_add").validate({
        lang: "fa",
        rules: {
            title: {
                required: true,
                remote:{
                    url:"{{route('store_category_check')}}",
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
                    },
                    type:"post"
                },
            },
            filepath: {
                required: true,
            },
        },
        submitHandler: function (form,e) {
            e.preventDefault();
            var form_btn = $(form).find('button[type="submit"]');
            var form_result_div = '#form-result';
            $(form_result_div).remove();
            form_btn.before('<div id="form-result" class="alert alert-success" role="alert" style="display: none;"></div>');
            var form_btn_old_msg = form_btn.html();
            form_btn.html(form_btn.prop('disabled', true).data("loading-text"));
            $(form).ajaxSubmit({
                dataType: '',
                success: function (data) {
                    PNotify.success({
                        text: data.message,
                        delay: 3000,
                    });
                    setTimeout(function () {
                        location.reload();
                    }, 3000);
                    $(form).find('.form-control').val('');
                    $(form_btn).html(form_btn_old_msg);
                    $(form_result_div).html(data.message).fadeIn('slow');
                    setTimeout(function () {
                        $(form_result_div).fadeOut('slow')
                    }, 3000);
                }, error: function (response) {
                    var errors = response.responseJSON.errors;
                    $.each(errors, function (index, value) {
                        PNotify.error({
                            delay: 3000,
                            title: index,
                            text: value,
                        });
                    });
                }
            });
            setTimeout(function () {
                $('[type="submit"]').prop('disabled', false);
            }, 2500);
            $(form_btn).html(form_btn_old_msg);
        }
    });
</script>
