<form action="{{route('discount_update',['dis_id'=>$dis_info['id']])}}" method="post" id="frm_discount_add">
    <div class="row">
        <div class="col-12 col-md-6">
            <label for="discount_code">{{__('messages.discount_code')}}</label>
            <div class="form-group">
                <div class="input-group">
                    <input type="text" class="form-control" disabled name="discount_code" id="discount_code"
                           value="{{$dis_info['code']}}">
                    <span class="input-group-append">
                    <button class="btn btn-light btn-rand" type="button">G</button>
                </span>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <label for="expire_date">{{__('messages.expire_date')}}</label>
            <div class="form-group form-group-feedback form-group-feedback-right">
                <input type="text" class="form-control" readonly name="expire_date" id="expire_date"
                       value="{{ jdate("Y-m-d H:i:s",strtotime($dis_info['expire_date']))}}">
                <div class="form-control-feedback form-control-feedback-lg">
                    <i class="icon-database-time2"></i>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <label for="discount_persent">{{__('messages.discount_persent')}}</label>
            <div class="form-group form-group-feedback form-group-feedback-right">
                <input type="number" min="1" max="100" class="form-control" name="discount_persent"
                       id="discount_persent" value="{{$dis_info['discount_persent']}}">
                <div class="form-control-feedback form-control-feedback-lg">
                    <i class="icon-percent"></i>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <label for="discount_max">{{__('messages.discount_maximum')}}</label>
            <div class="form-group form-group-feedback form-group-feedback-right">
                <input type="number" min="1" max="900000000" class="form-control" name="discount_max" id="discount_max"
                value="{{$dis_info['max_discount']}}">
                <div class="form-control-feedback form-control-feedback-lg">
                    <i class="icon-up-big"></i>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <label for="count">{{__('messages.count')}}</label>
            <div class="form-group form-group-feedback form-group-feedback-right">
                <input type="number" min="1" max="1000" class="form-control" name="count" id="count" value="{{$dis_info['count']}}">
                <div class="form-control-feedback form-control-feedback-lg">
                    <i class="icon-list-numbered"></i>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <label for="usage_count">{{__('messages.usage_count_per_user')}}</label>
            <div class="form-group form-group-feedback form-group-feedback-right">
                <input type="number" min="1" max="1000" class="form-control" name="usage_count" id="usage_count" value="{{$dis_info['usage_count']}}">
                <div class="form-control-feedback form-control-feedback-lg">
                    <i class="icon-sort-numeric-asc"></i>
                </div>
            </div>
        </div>
        <div class="col-12 pt-2">
            <button class="btn btn-primary btn-block" type="submit">{{__('messages.edit')}}</button>
        </div>
    </div>
</form>
<script type="text/javascript" src="/node_modules/pnotify/dist/iife/PNotify.js"></script>

<script>
    $(".btn-rand").on("click", function () {
        var length = 5;
        var result = '';
        var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        var charactersLength = characters.length;
        for (var i = 0; i < length; i++) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
        $("#discount_code").val(result);
    });

    $('#expire_date').MdPersianDateTimePicker({
        targetTextSelector: '#expire_date',
        enableTimePicker:true,
        disableBeforeToday:true
    });
    $("#frm_discount_add").validate({
        lang:"fa",
        rules: {
            discount_code: {
                required: true,
                minlength: 3,
                remote:{
                    url:"{{route('check_discount_code')}}",
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
                    },
                    type:"post"
                },
            },
        },
        messages:
            {
                discount_code:{
                    remote:"{{__('messages.duplicate_email')}}"
                }
            },
        errorElement : 'div',
        submitHandler: function(form,e) {
            e.preventDefault();
            var form_btn = $(form).find('button[type="submit"]');
            var form_result_div = '#form-result';
            $(form_result_div).remove();
            form_btn.before('<div id="form-result" class="alert alert-success" role="alert" style="display: none;"></div>');
            var form_btn_old_msg = form_btn.html();
            form_btn.html(form_btn.prop('disabled', true).data("loading-text"));
            $(form).ajaxSubmit({
                dataType:  'json',
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
                },
                success: function(response) {
                    PNotify.success({
                        text: response.message,
                        delay: 5000,
                    });
                    setTimeout(function(){
                        location.reload();
                    }, 3000);
                    $(form).find('.form-control').val('');
                    $(form_btn).html(form_btn_old_msg);
                    $(form_result_div).html(response.message).fadeIn('slow');
                    setTimeout(function(){ $(form_result_div).fadeOut('slow') }, 3000);
                },
                error:function (response){
                    var errors = response.responseJSON.errors;
                    $.each( errors, function( index, value ) {
                    console.log(index,value);
                        PNotify.error({
                            delay: 3000,
                            title: index,
                            text: value,
                        });
                    });
                }

            });
            setTimeout(function(){
                $('[type="submit"]').prop('disabled', false);
            }, 2500);
            $(form_btn).html(form_btn_old_msg);

        }
    });
</script>
<?php
