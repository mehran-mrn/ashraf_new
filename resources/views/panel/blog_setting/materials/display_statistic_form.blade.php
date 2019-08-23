<?php $rand_id = rand(1, 8000); ?>
<form method="POST" id="" enctype="multipart/form-data" class="form-ajax-submit" action="{{route('submit_display_statistics')}}">
    @csrf
    <?php
            $selected_icon ="0";
    ?>
    @if(!empty($option))
        <?php
        $value = json_decode($option['value'],true);
        $selected_icon = $value['icon'];
        ?>
    <input type="hidden" name="option_id" value="{{$option['id']}}">
    @endif
        <div class="form-group row">

        <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('messages.title')}}</label>

        <div class="col-md-6">
            <input id="title" type="text" class="form-control" name="title"
                   value="{{!empty($value)?$value['title']:""}}"  autocomplete="name" autofocus>
        </div>
    </div>

    <div class="form-group row">

        <label for="icon" class="col-md-4 col-form-label text-md-right">{{ __('messages.icon')}}</label>

        <div class="col-md-6">
            <select id="select_icon_{{$rand_id}}" class="form-control select-icons" name="icon">

                @foreach($icons as $key => $icon)
                    <option {{$selected_icon==$icon ? "selected" :""}} value="{{$icon}}" data-icon="{{$icon}}">{{$key}}</option>
                @endforeach
            </select>

        </div>
    </div>

    <div class="form-group row">

        <label for="capacity" class="col-md-4 col-form-label text-md-right">{{ __('messages.value') }}</label>

        <div class="col-md-6">
            <input id="capacity" type="number" class="form-control " name="value"
                   value="{{!empty($value)?$value['value']:""}}"  autocomplete="capacity" autofocus>

        </div>

    </div>


    <div class="form-group row ">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-block btn-info">
                {{ __('messages.save') }}
            </button>
        </div>
    </div>


</form>

<script>
    $(document).ready(function () {
        // Format icon
        function iconFormat(icon) {
            var originalOption = icon.element;
            if (!icon.id) { return icon.text; }
            var $icon = '<i class="' + $(icon.element).data('icon') + '"></i>' + icon.text;

            return $icon;
        }

        // Initialize with options
        $('.select-icons').select2({
            templateResult: iconFormat,
            minimumResultsForSearch: Infinity,
            templateSelection: iconFormat,
            escapeMarkup: function(m) { return m; }
        });


    });
</script>