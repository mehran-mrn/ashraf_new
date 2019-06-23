<form action="{{route('store_items_category_update')}}" method="post" id="frm_store_items_category_add">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="title">{{__('messages.title')}}</label>
                <input type="text" class="form-control" name="title" id="title" value="{{$info['title']}}">
            </div>
        </div>
        <div class="col-12 pt-2">
            <button class="btn btn-primary btn-block" type="submit">{{__('messages.add')}}</button>
        </div>
    </div>
</form>
<script type="text/javascript" src="/node_modules/pnotify/dist/iife/PNotify.js"></script>
<script>

    $("#frm_store_items_category_add").validate({
        lang: "fa",
        rules: {
            title: {
                required: true,
            },
        },
        submitHandler: function (form, e) {
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
