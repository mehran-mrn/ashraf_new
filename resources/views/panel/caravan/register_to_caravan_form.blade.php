@if(empty($person_caravan))
<form id="register_national_code">
@csrf
<input type="hidden" id="caravan_id" name="caravan_id" value="{{$caravan['id']}}">
<div class="form-group row">

        <label for="national_code"
               class="col-md-3 text-muted col-form-label ">{{ __('messages.national_code') }}</label>

        <input id="national_code" type="text" class="col-md-5 form-control"
               name="national_code"
               value="{{empty($national_code)?"":$national_code}}" autocomplete="national_code" autofocus>


    <button type="button"
            class="col-md-2 btn btn-outline-info modal-ajax-load-from "
            data-ajax-link="{{route('register_to_caravan_post')}}"
            data-form-id="register_national_code"
            data-method="POST"
            data-modal-title="{{trans('messages.register_form_title')}}"
            data-target="#general_modal">
            <i class="icon-spinner9 mr-2"></i>
        {{trans('messages.check')}}
    </button>

</div>

</form>
@if(!empty($person))
    <hr>

    @include('panel.caravan.materials.register_to_caravan_subform')
@elseif(!empty($national_code))
    <hr>

    @include('panel.caravan.materials.register_to_caravan_subform')
@endif
<script type="text/javascript">
    $("#register_national_code").validate({
        lang: "fa",
        rules: {

            national_code: {
                required: true,
                maxlength: 10,
                remote:{
                    url:"{{route('validate_national_code')}}",
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').attr('value'),
                        'national_code': $('input[name="caravan_id"]').attr('value'),
                    },
                    type:"post"
                }
            },
        },
        submitHandler: function (form) {
            var form_btn = $(form).find('button[type="submit"]');
            var form_result_div = '#form-result';
            $(form_result_div).remove();
            form_btn.before('<div id="form-result" class="alert alert-success" role="alert" style="display: none;"></div>');
            var form_btn_old_msg = form_btn.html();
            form_btn.html(form_btn.prop('disabled', true).data("loading-text"));
            $(form).ajaxSubmit({
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    if (data.status == 'true') {
                        $(form).find('.form-control').val('');
                    }
                    form_btn.prop('disabled', false).html(form_btn_old_msg);
                    $(form_result_div).html(data.message).fadeIn('slow');
                    setTimeout(function () {
                        $(form_result_div).fadeOut('slow')
                    }, 6000);
                }
            });
        }
    });
</script>
@else
    <div class="row">
        <div class="col-md-6">
            <li class="list">
                <span class="text-muted">{{trans('messages.name')}} :</span>
                <span class="text-black">{{$person_caravan['person']['name']}} </span>
            </li>
            <li class="list">
                <span class="text-muted">{{trans('messages.family')}} :</span>
                <span class="text-black">{{$person_caravan['person']['family']}} </span>
            </li>
            <li class="list">
                <span class="text-muted">{{trans('messages.father_name')}} :</span>
                <span class="text-black">{{$person_caravan['person']['father_name']}} </span>
            </li>
        </div>
        <div class="col-md-6">
            <li class="list">
                <span class="text-muted">{{trans('messages.age')}} :</span>
                <span class="text-black">{{get_age($person_caravan['person']['birth_date'])}} </span>
            </li>
            <li class="list">
                <span class="text-muted">{{trans('messages.use_count')}} :</span>
                <span class="text-black">{{count_caravan_useage_history($person_caravan['person']['id'],$person_caravan['caravan_id'])}} </span>
            </li>
        </div>
    </div>
    <hr>

    <div class="row">

<div class="col-md-6">
    <form method="post" action="{{route('action_to_person_caravan_status')}}">
        @csrf
        <input type="hidden" name="accept" value="1">
        <input type="hidden" name="person_caravan_id" value="{{$person_caravan['id']}}">
    <button type="submit" class="btn btn-outline-success btn-lg"><i
                class="icon-checkmark mr-2"></i> {{trans('messages.accept')}}
    </button>
        </form>
</div>
<div class="col-md-6">
    <form method="post" action="{{route('action_to_person_caravan_status')}}">
        @csrf
        <input type="hidden" name="reject" value="1">
        <input type="hidden" name="person_caravan_id" value="{{$person_caravan['id']}}">
        <button type="submit" class="btn btn-outline-danger btn-lg"><i
                class="icon-cross2 mr-2"></i> {{trans('messages.reject')}}
    </button>
    </form>

</div>
</div>
@endif
