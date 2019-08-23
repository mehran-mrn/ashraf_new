<?php $rand_id = rand(1, 8000); ?>
<form method="POST" id="" enctype="multipart/form-data" class="form-ajax-submit"
      action="{{route('submit_display_statistics')}}">
    @csrf
    <?php
    $selected_icon = "0";
    ?>
    @if(!empty($option))
        <?php
        $value = json_decode($option['value'], true);
        $selected_icon = $value['icon'];
        ?>
        <input type="hidden" name="option_id" value="{{$option['id']}}">
    @endif
    <div class="form-group row">
        <div class="col-md-12">
            <div class=" row">


                <div class="col-md-6">
                    <label for="title" class="col-form-label text-md-right">{{ __('messages.title')}}</label>

                    <input id="title" type="text" class="form-control" name="title"
                           value="{{!empty($value)?$value['title']:""}}" autocomplete="name" autofocus>
                </div>


                <div class="col-md-6">
                    <label for="capacity" class=" col-form-label text-md-right">{{ __('messages.value') }}</label>

                    <input id="capacity" type="number" class="form-control " name="value"
                           value="{{!empty($value)?$value['value']:""}}" autocomplete="capacity" autofocus>

                </div>

            </div>
        </div>
    </div>
    <label for="icon" class="col-form-label text-md-right">{{ __('messages.icon')}}</label>
    <input type="hidden" id="selected_icon" name="icon" value="">

    <div class="form-group row">

        @foreach(array_chunk($icons,36) as $chunk)
            <div class="col-md-6">
                <div class=" row">
                @foreach($chunk as $key => $icon)

                    <div class="col-sm-2">
                        <a href="#" value="{{$icon}}" id="{{$icon}}" class="icon-selection text-dark card bordered {{$selected_icon==$icon ? " bg-white border-2 " :""}}" style="background-color: #{{substr(md5(rand()), 0, 6)}}2e">
                            <div class="card-body p-1">
                                <i style="font-size: 25px;"  class="text-black text-center {{$icon}}"></i>
                            </div>
                        </a>
                    </div>
                @endforeach
                </div>
            </div>

        @endforeach

    </div>


    <div class="form-group row ">
        <div class="col-md-12">
            <button type="submit" class="btn btn-block btn-info">
                {{ __('messages.save') }}
            </button>
        </div>
    </div>


</form>

<script>
    $(document).ready(function () {
        // Format icon
        $('.icon-selection').on('click', function () {
            document.getElementById("selected_icon").value = $(this).attr('value');
            $('.icon-selection').removeClass("bg-white");
            $('.icon-selection').removeClass("border-2");
            document.getElementById($(this).attr('value')).classList.add("bg-white");
            document.getElementById($(this).attr('value')).classList.add("border-2");
        });

        function iconFormat(icon) {
            var originalOption = icon.element;
            if (!icon.id) {
                return icon.text;
            }
            var $icon = '<i class="' + $(icon.element).data('icon') + '"></i>' + icon.text;

            return $icon;
        }

        // Initialize with options
        $('.select-icons').select2({
            templateResult: iconFormat,
            minimumResultsForSearch: Infinity,
            templateSelection: iconFormat,
            escapeMarkup: function (m) {
                return m;
            }
        });


    });
</script>