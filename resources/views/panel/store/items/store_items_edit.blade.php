<form action="{{route('store_items_update',['item_id'=>$info['id']])}}" method="post" id="frm_store_items_add">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="title">{{__('messages.title')}}</label>
                <input type="text" class="form-control" name="title" id="title" value="{{$info['title']}}">
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="prefix">{{__('messages.prefix')}}</label>
                <input type="text" class="form-control" name="prefix" id="prefix" value="{{$info['prefix']}}">
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="suffix">{{__('messages.suffix')}}</label>
                <input type="text" class="form-control" name="suffix" id="suffix" value="{{$info['suffix']}}">
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label for="category">{{__('messages.category')}}</label>
                <select name="category_id" id="category_id" class="form-control">
                    @foreach($items_category as $cat)
                        <option value="{{$cat['id']}}" {{$info['category_id']==$cat['id']?'selected':''}} >{{$cat['title']}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label for="description">{{__('messages.suffix')}}</label>
                <textarea name="description" id="description" cols="30" rows="5"
                          class="form-control">{{$info['description']}}</textarea>
            </div>
        </div>
        <div class="col-12 pt-2">
            <button class="btn btn-primary btn-block" type="submit">{{__('messages.edit')}}</button>
        </div>
    </div>
</form>
<script type="text/javascript" src="/node_modules/pnotify/dist/iife/PNotify.js"></script>

<script>

    $("#frm_store_items_add").validate({
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
