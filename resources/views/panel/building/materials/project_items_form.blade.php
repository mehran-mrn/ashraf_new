<?php $rand_id = rand(1, 8000); ?>

<form method="POST" id="" class="form-ajax-submit" action="{{route('edit_project_items',['project_id'=>$project_id])}}"
      autocomplete="off">
    @csrf
    <input type="hidden" name="project_id" value="{{$project_id}}">

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <table class="table table-striped">
                    <tr>
                        <th>{{trans('messages.action')}}</th>
                        <th>{{trans('messages.title')}}</th>
                        <th>{{trans('messages.weight')}}</th>
                    </tr>
                    @foreach($building_items as $building_item)
                        <tr>
                            <td>
                                <button type="button"
                                        class="legitRipple swal-alert float-right btn alpha-pink border-pink-400 text-pink-800 btn-icon rounded-round ml-2"
                                        data-ajax-link="{{route('delete_project_item',['project_id'=>$project_id,'item_id'=>$building_item['id']])}}"
                                        data-method="POST"
                                        data-csrf="{{csrf_token()}}"
                                        data-title="{{trans('messages.delete_item',['item'=>$building_item['title']])}}"
                                        data-text="{{trans('messages.delete_item_text',['item'=>$building_item['title']])}}"
                                        data-type="warning"
                                        data-cancel="true"
                                        data-confirm-text="{{trans('messages.delete')}}"
                                        data-cancel-text="{{trans('messages.cancel')}}">
                                    <i class="icon-trash"></i>
                                </button>
                            </td>
                            <td>
                                <input type="hidden" name="item_id[{{$building_item['id']}}]" value="{{$building_item['id']}}" id="randomNumber">

                                <input class="form-control" value="{{$building_item['title']}}"
                                       name="title[{{$building_item['id']}}]">
                            </td>
                            <td>
                                <input class="form-control" value="{{$building_item['percent']}}"
                                       name="percent[{{$building_item['id']}}]">
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <div class="row mt-2 mb-2">
                <input type="hidden" value="1" id="randomNumber">

                <button type="button"
                        class="btn btn-outline-success add-color float-right"><i
                            class="icon-plus2"></i> {{__('messages.add_new',['item'=>trans('messages.item')])}}
                </button>
            </div>
            <div class="row">
                <div class="col-md-12">

                <div class="color-box">
                </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="form-group row ">
        <div class="col-md-6 ">
            <button type="submit" class="btn btn-block btn-info">
                {{ __('messages.save') }} <i class="icon-floppy-disk"></i>
            </button>
        </div>
    </div>
</form>
<script>
    $(document).ready(function () {

        $(".add-color").on('click', function () {
            var x = +$("#randomNumber").val() + 1;


                $(".color-box").append(
                '<div class="row pb-1 pt-1 counter-row-' + x + '">' +
                    '<div class="d-inline-block">' +
                        '<div class="col-md-2">' +
                            '<button type="button" data-row-id="' + x + '" onclick="removeRow(' + x + ')" class="btn btn-outline-danger btn-xs"><i class="icon-x"></i></button>' +
                        '</div>' +
                    '</div>' +
                    '<div class="col-md-5">' +
                        '<input type="text" placeholder="{{__('messages.title')}}" required="required" class="form-control" name="new_item_title[' + x + ']">' +
                    '</div>' +
                    '<div class="col-md-5">' +
                        '<input type="number" min="0" max="100" placeholder="{{__('messages.weight')}}"  value="" class="form-control" required="required" name="new_item_percent[' + x + ']">' +
                    '</div>' +
                '</div>'
            );
            $("#randomNumber").val(x);
            ColorPicker.init();
        })

    });

    function removeRow(x) {
        var rowID = x;
        $(".counter-row-" + rowID).remove();
    };
</script>
