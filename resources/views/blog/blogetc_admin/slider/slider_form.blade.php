<?php $rand_id = rand(1, 8000); ?>
<div class="card">
    <div class="card-body">
        <div class="col-12">
            <span class="input-group-btn">
                <a id="lfmMain" data-input="thumbnail" data-preview="holder"
                   class="btn btn-outline-primary m-2"><i class="icon-image2"></i> {{__('messages.select_image')}}</a>
            </span>
            <input id="thumbnail" class="form-control" type="text" name="filepath"
                   readonly="readonly">
            <img id="holder" style="margin-top:15px;max-height:100px;">
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="image">{{__('messages.image')}}</label>
                <input type="file" class="file-input-ajax" multiple="multiple" id="image"
                       name="image[]" data-fouc>
            </div>
        </div>

        <div class="form-group">
            <div class="form-group row">
                <label class=" col-md-3"
                       for="text_1_dir">{{__('messages.hor_position')." ".__('messages.text')." ".__('messages.one')}}</label>
                <select id="text_1_dir" name="text_1_dir" class="form-control col-md-3">
                    <option value="left">{{__('messages.left')}}</option>
                    <option value="right">{{__('messages.right')}}</option>
                    <option value="center">{{__('messages.center')}}</option>
                </select>
            </div>

            <div class="form-group">
                <label for="text_1">{{__('messages.text')." ".__('messages.one')}}</label>
                <textarea name="text_1" id="text_1" cols="30" rows="10"></textarea>
            </div>
        </div>
        <div class="form-group">
            <div class="form-group row">
                <label class=" col-md-3"
                       for="text_2_dir">{{__('messages.hor_position')." ".__('messages.text')." ".__('messages.two')}}</label>
                <select id="text_2_dir" name="text_2_dir" class="form-control col-md-3">
                    <option value="left">{{__('messages.left')}}</option>
                    <option value="right">{{__('messages.right')}}</option>
                    <option value="center">{{__('messages.center')}}</option>
                </select>
            </div>
            <div class="form-group">
                <label for="description">{{__('messages.text')." ".__('messages.two')}}</label>
                <textarea name="text_2" id="text_2" cols="30" rows="10"></textarea>
            </div>
        </div>
        <div class="form-group">
            <div class="form-group row">
                <label class="col-md-3"
                       for="text_3_dir">{{__('messages.hor_position')." ".__('messages.text')." ".__('messages.tree')}}</label>
                <select id="text_3_dir" name="text_3_dir" class="form-control  col-md-3">
                    <option value="left">{{__('messages.left')}}</option>
                    <option value="right">{{__('messages.right')}}</option>
                    <option value="center">{{__('messages.center')}}</option>
                </select>
            </div>

            <div class="form-group">
                <label for="description">{{__('messages.text')." ".__('messages.tree')}}</label>
                <textarea name="description" id="text_3" cols="30" rows="10"></textarea>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-md-2">{{__('messages.btn_text')}}</label>
            <input class="form-control col-md-10" name="btn_text">
        </div>
        <div class="form-group row">
            <label class="col-md-2">{{__('messages.btn_link')}}</label>
            <input class="form-control col-md-10" name="btn_link">

        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

        CKEDITOR.replace('text_1', {
            language: 'fa',
            uiColor: '#9AB8F3',
            extraPlugins: 'filebrowser',
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
        });
        CKEDITOR.replace('text_2', {
            language: 'fa',
            uiColor: '#9AB8F3',
            extraPlugins: 'filebrowser',
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
        });
        CKEDITOR.replace('text_3', {
            language: 'fa',
            uiColor: '#9AB8F3',
            extraPlugins: 'filebrowser',
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
        });

    });
</script>