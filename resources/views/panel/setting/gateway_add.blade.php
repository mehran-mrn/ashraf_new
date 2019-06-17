<form action="" method="post">
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
                <input type="number" class="form-control text-right" name="account_number" id="account_number">
                <div class="form-control-feedback form-control-feedback-lg">
                    <i class="icon-check"></i>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <label for="account_sheba">{{__('messages.sheba_number')}}</label>
            <div class="form-group form-group-feedback form-group-feedback-right">
                <input type="text" class="form-control text-right" name="account_sheba" id="account_sheba">
                <div class="form-control-feedback form-control-feedback-lg">
                    IR
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="bank_branch">{{__('messages.branch')}}</label>
                <div class="form-group form-group-feedback form-group-feedback-right">
                    <input type="number" name="bank_branch" id="bank_branch" class="form-control">
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
                    <span class="text-success">فعال</span>
                </label>
            </div>
            <div class="form-check form-check-inline">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input-styled" name="status" id="status2" value="inactive"
                           data-fouc>
                    <span class="text-danger">غیر فعال</span>
                </label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="input-group">
                <span class="input-group-btn">
                    <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary"><i class="fa fa-picture-o"></i> انتخاب لوگو</a>
                </span>
                <input id="thumbnail" class="form-control" type="text" name="filepath">
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
    </div>

</form>
<script>
    $('.form-check-input-styled').uniform();
    var route_prefix = {{env('url')}}"/laravel-filemanager";
        $.fn.filemanager = function (type, options) {
            type = type || 'file';
            this.on('click', function (e) {
                var route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
                localStorage.setItem('target_input', $(this).data('input'));
                localStorage.setItem('target_preview', $(this).data('preview'));
                window.open(route_prefix + '?type=' + type, 'FileManager', 'width=900,height=600');
                return false;
            });
        }

    function SetUrl(url, file_path) {
        //set the value of the desired input to image url
        var target_input = $('#' + localStorage.getItem('target_input'));
        target_input.val(file_path);

        //set or change the preview image src
        var target_preview = $('#' + localStorage.getItem('target_preview'));
        target_preview.attr('src', url);
    }

    $('#lfm').filemanager('image', {prefix: route_prefix});

</script>
<?php
