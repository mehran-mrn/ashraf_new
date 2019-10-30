<form action="" id="frm_gallery_category_edit">
    @csrf
    <input type="hidden" name="id" value="{{$info['id']}}">
    <div class="form-group row">
        <label class="label">{{__("messages.title")}}</label>
        <input type="text" class="form-control" name="title" value="{{$info['title']}}">
    </div>
    <div class="form-group row">
        <label class="description">{{__("messages.description")}}</label>
        <textarea class="form-control" name="description">{{$info['description']}}</textarea>
    </div>
    <div class="form-group row">
        <label class="more_description">{{__("messages.description_more")}}</label>
        <textarea class="form-control" name="more_description">{{$info['more_description']}}</textarea>
    </div>
    <div class="form-group row pull-left">
        <button class="btn btn-default" type="button" data-dismiss="modal">{{__('messages.cancel')}}</button>
        <button class="btn btn-primary btn-submit" type="submit">{{__('messages.edit')}}</button>
    </div>
</form>
<script>

    CKEDITOR.replace('more_description', {
        language: 'fa',
        uiColor: '#9AB8F3',
        extraPlugins: 'filebrowser',
        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
    });


    $("#frm_gallery_category_edit").on('submit', function (e) {
        e.preventDefault();
        CKEDITOR.instances['more_description'].updateElement();
        $(".btn-submit").attr("disabled", true);
        $.ajax({
            url: "{{route('gallery_category_update')}}",
            type: "post",
            data: $(this).serialize(),
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
            },
            success: function (response) {
                console.log(response)
                new PNotify({
                    title: '',
                    text: response.message,
                    type: 'success'
                });
                setTimeout(function () {
                    location.reload();
                }, 1000)
            }, error: function () {
                console.log(response)

            }
        });
        setTimeout(function () {
            $(".btn-submit").attr("disabled", false);
        },2000)
    })
</script>
<?php
