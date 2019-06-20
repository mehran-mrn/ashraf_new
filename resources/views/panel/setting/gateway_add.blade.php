<form action="{{route('gateway_add_store')}}" method="post" id="frm_gateway_add">
    @csrf
    <div class="row">
        <div class="col-md-12">
            <h5>{{__('messages.bank_information')}}</h5>
        </div>
        <div class="col-md-6">
            <div class="form-group"><label for="name">{{__('messages.bank_name')}}</label>
                <select name="name" id="name" class="form-control">
                    @foreach($banks as $bank)
                        <option value="{{$bank['id']}}">{{$bank['name']}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <label for="account_number">{{__('messages.account_number')}}</label>
            <div class="form-group form-group-feedback form-group-feedback-right">
                <input type="number" class="form-control text-right" maxlength="15" name="account_number" id="account_number">
                <div class="form-control-feedback form-control-feedback-lg">
                    <i class="icon-check"></i>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <label for="account_sheba">{{__('messages.sheba_number')}}</label>
            <div class="form-group form-group-feedback form-group-feedback-right">
                <input type="number" class="form-control text-right" maxlength="24" name="account_sheba" id="account_sheba">
                <div class="form-control-feedback form-control-feedback-lg">
                    IR
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="bank_branch">{{__('messages.branch')}}</label>
                <div class="form-group form-group-feedback form-group-feedback-right">
                    <input type="text" name="bank_branch" id="bank_branch" class="form-control">
                    <div class="form-control-feedback form-control-feedback-lg">
                        <i class="icon-git-branch"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <label for="card_number">{{__('messages.card_number')}}</label>
            <div class="form-group form-group-feedback form-group-feedback-right">
                <input type="text" class="form-control text-right" name="card_number" id="card_number">
                <div class="form-control-feedback form-control-feedback-lg">
                    <i class="icon-credit-card"></i>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <h6 for="status">{{__('messages.status')}}</h6>
            <div class="form-check form-check-inline">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input-styled" name="status" id="status" value="active" checked
                           data-fouc>
                    <span class="text-success">{{__('messages.active')}}</span>
                </label>
            </div>
            <div class="form-check form-check-inline">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input-styled" name="status" id="status2" value="inactive"
                           data-fouc>
                    <span class="text-danger">{{__('messages.inactive')}}</span>
                </label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h5>{{__('messages.gateway_pay_info')}}</h5>
        </div>
        <div class="col-md-6">
            <label for="merchent_id">{{__('messages.merchent_id')}}</label>
            <div class="form-group form-group-feedback form-group-feedback-right">
                <input type="number" name="merchent" id="merchent_id" class="form-control text-right">
                <div class="form-control-feedback form-control-feedback-lg">
                    <i class="icon-atom"></i>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <label for="public_key">{{__('messages.public_key')}}</label>
            <div class="form-group form-group-feedback form-group-feedback-right">
                <input type="text" name="public_key" id="public_key" class="form-control text-right">
                <div class="form-control-feedback form-control-feedback-lg">
                    <i class="icon-key"></i>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <label for="terminal_id">{{__('messages.terminal_id')}}</label>
            <div class="form-group form-group-feedback form-group-feedback-right">
                <input type="number" name="terminal_id" id="terminal_id" class="form-control text-right">
                <div class="form-control-feedback form-control-feedback-lg">
                    <i class="icon-terminal"></i>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="input-group">
                <span class="input-group-btn">
                    <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary"><i
                            class="fa fa-picture-o"></i>{{__('messages.select_image')}}</a>
                </span>
                <input id="thumbnail" class="form-control" type="text" name="filepath">
                <img id="holder" style="margin-top:15px;max-height:100px;">
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <div class="p-3">
            <button type="submit" class="btn btn-primary px-5">{{__('messages.submit')}}</button>
        </div>
    </div>
</form>
<script>
    $('.form-check-input-styled').uniform();


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


    $("#frm_gateway_add").validate({
        lang: "fa",
        rules: {
            name: {
                required: true,
            },
            account_number: {
                required: false,
                number: true,
                minlength: 5,
                maxlength: 100,
            },
            account_sheba: {
                required: false,
                number: true,
                minlength: 24,
                maxlength: 24,
            },
            bank_branch: {
                required: false,
            },
            card_number: {
                required: false,
                minlength: 16,
                maxlength: 16
            },
            merchent_id: {
                required: true,
                minlength: 5,
                maxlength: 50,
                number: true,
            },
            public_key: {
                required: true,
                minlength: 5,
                maxlength: 50
            },
            terminal_id: {
                required: true,
                minlength: 5,
                maxlength: 50,
                number: true,
            }
        },
        submitHandler: function (form) {
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
                    setTimeout(function () {
                        $('[type="submit"]').prop('disabled', false);
                    }, 2500);
                    $(form_btn).html(form_btn_old_msg);

                }
            });
        }
    });
</script>
<?php
