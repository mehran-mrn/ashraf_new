<form action="{{route('setting_how_to_send_add')}}" method="post" id="frm_setting_how_to_send_add">
    @csrf
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="title">{{__('messages.title')}}</label>
                <input type="text" class="form-control" name="title" required id="title">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="title">{{__('messages.send_time')}}</label>
                <input type="number" class="form-control" name="time" required id="time">
            </div>
        </div>
        <div class="col-12">
            <label class="d-block font-weight-semibold">{{__('messages.cost')}}</label>
        </div>
        @foreach($province as $pro)
            <div class="col-3">
                <div class="form-group">
                    <label for="">{{$pro['name']}}</label>
                    <input type="text" class="form-control price" name="city_{{$pro['id']}}"
                           placeholder="{{__('messages.cost')}}">
                </div>
            </div>
        @endforeach
        <div class="col-md-12 text-center">
            <div class="form-group mb-3 mb-md-2">
                <label class="d-block font-weight-semibold">{{__('messages.status')}}</label>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input"
                           name="status"
                           id="custom_radio_inline_unchecked" checked
                           value="active">
                    <label class="custom-control-label"
                           for="custom_radio_inline_unchecked">{{__("messages.active")}}</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input"
                           name="status"
                           id="custom_radio_inline_checked" value="inactive">
                    <label class="custom-control-label"
                           for="custom_radio_inline_checked">{{__("messages.inactive")}}</label>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary float-right"><i class="icon-plus2"></i> {{__('messages.add')}}</button>
        </div>
    </div>
</form>

<script type="text/javascript" src="/node_modules/pnotify/dist/iife/PNotify.js"></script>
<script src="http://malsup.github.com/jquery.form.js"></script>
<script type="text/javascript">
    $(document).on("keyup", '.price', function (event) {
        // skip for arrow keys
        if (event.which >= 37 && event.which <= 40) return;

        // format number
        $(this).val(function (index, value) {
            return value
                .replace(/\D/g, "")
                .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                ;
        });
    });

    $("#frm_setting_how_to_send_add").validate({
        lang: "fa",
        rules: {
            title: {
                required: true,
            },
            time: {
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
<?php
