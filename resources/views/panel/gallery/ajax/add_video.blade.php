<form action="{{route('add_video')}}" method="post" id="frm_gallery_category_add" class="form_form_ajax_submit">
    @csrf
    <div class="form-group row">
        <label class="label">{{__("messages.title")}}</label>
        <input type="text" class="form-control" name="title">
    </div>
    <div class="form-group row">
        <label class="label">{{__("messages.description")}}</label>
        <textarea class="form-control" name="description"></textarea>
    </div>
    <div class="form-group row">
        <label class="label">< Iframe ></label>
        <div class="help-block text-muted">{{trans('messages.iframe_help')}}</div>
        <textarea class="form-control" name="iframe"></textarea>
    </div>
    <div class="form-group row pull-left">
        <button class="btn btn-default" type="button" data-dismiss="modal">{{__('messages.cancel')}}</button>
        <button class="btn btn-primary" type="submit">{{__('messages.add')}}</button>
    </div>
</form>

<?php
