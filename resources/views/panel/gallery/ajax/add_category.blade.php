<form action="" id="frm_gallery_category_add">
    @csrf
    <div class="form-group row">
        <label class="label">{{__("messages.title")}}</label>
        <input type="text" class="form-control" name="title">
    </div>
    <div class="form-group row">
        <label class="label">{{__("messages.description")}}</label>
        <textarea class="form-control" name="description"></textarea>
    </div>
    <div class="form-group row pull-left">
        <button class="btn btn-default" type="button" data-dismiss="modal">{{__('messages.cancel')}}</button>
        <button class="btn btn-primary" type="submit">{{__('messages.add')}}</button>
    </div>
</form>

<script>
    $("#frm_gallery_category_add").on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: "{{route('gallery_category_add')}}",
            type: "post",
            data: $(this).serialize(),
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
            },
            success: function (response) {
                new PNotify({
                    title: '',
                    text: response.message,
                    type: 'success'
                });
                setTimeout(function () {
                    location.reload();
                }, 1000)
            }, error: function () {
            }
        });
    })
</script>
<?php
