<?php $rand_id = rand(1, 8000); ?>
<script>
    function supervisor_status(val) {
        var parents =['supervisor','handler'];
        if (parents.includes(val))
        {
            document.getElementById("parent_id_{{$rand_id}}").disabled = true;
        }
        else
        {
            document.getElementById("parent_id_{{$rand_id}}").disabled = false;
        }

    }

</script>
<form method="POST" id="" class="form-ajax-submit" action="{{route('add_person_to_caravan')}}"
      autocomplete="off">
    @csrf
        <input type="hidden" name="caravan_id" value="{{$caravan['id']}}">
    @if(!empty($person))
        <input type="hidden" name="person_id" value="{{$person['id']}}">
    @endif
    <div class="row">
        <div class="col-md-12">

            <div class="form-group row">

                <label for="form_national_code"
                       class="col-md-4 col-form-label text-md-right">{{ __('messages.national_code') }}</label>

                <div class="col-md-6">
                    <input id="form_national_code"  class="form-control @error('capacity') is-invalid @enderror"
                           name="national_code"
                           value="{{isset($person)?$person['person']['national_code']:""}}" autocomplete="national_code" autofocus>

                </div>

            </div>

            <div class="form-group row">

                <label for="sh_code{{$rand_id}}" class="col-md-4 col-form-label text-md-right">{{ __('messages.sh_code') }}
                    <div class="text-small text-muted">{{trans('messages.optional')}}</div>
                </label>

                <div class="col-md-6">
                    <input id="sh_code{{$rand_id}}"  class="form-control"
                           name="sh_code" value="{{!empty($person)?$person['person']['sh_code']:""}}"
                           autocomplete="sh_code" autofocus>

                </div>

            </div>

            <div class="form-group row">

                <label for="sh_code{{$rand_id}}" class="col-md-4 col-form-label text-md-right">{{  __('messages.id')." ".__('messages.madadjoo') }}
                    <div class="text-small text-muted">{{trans('messages.optional')}}</div>
                </label>

                <div class="col-md-6">
                    <input id="madadjoo_id_{{$rand_id}}"  class="form-control"
                           name="madadjoo_id" value="{{!empty($person)?$person['person']['madadjoo_id']:""}}"
                           autocomplete="madadjoo_id" autofocus>

                </div>

            </div>

            <div class="form-group row">

                <label for="capacity" class="col-md-4 col-form-label text-md-right">{{ __('messages.gender') }}</label>

                <div class="col-md-6">

                    <div class="custom-control custom-radio custom-control-inline">
                        <input value="0" type="radio" class="custom-control-input" name="gender" id="custom_radio_inline_g1"
                                {{(!empty($person) and $person['person']['gender'] == 0 )?"checked":""}} >
                        <label class="custom-control-label" for="custom_radio_inline_g1">{{__('messages.mr')}}</label>
                    </div>

                    <div class="custom-control custom-radio custom-control-inline">
                        <input value="1"  {{(!empty($person) and $person['person']['gender'] == 1 )?"checked":""}}
                        type="radio" class="custom-control-input" name="gender" id="custom_radio_inline_g2"
                                >
                        <label class="custom-control-label" for="custom_radio_inline_g2">{{__('messages.mrs')}}</label>
                    </div>

                </div>
            </div>

            <div class="form-group row">

                <label for="name{{$rand_id}}"
                       class="col-md-4 col-form-label text-md-right">{{ __('messages.name') }}</label>
                <div class="col-md-6">
                    <input id="name{{$rand_id}}"  class="form-control"
                           name="name" value="{{!empty($person)?$person['person']['name']:""}}"
                           autocomplete="name" autofocus>

                </div>


            </div>

            <div class="form-group row">

                <label for="family{{$rand_id}}"
                       class="col-md-4 col-form-label text-md-right">{{  __('messages.family') }}</label>
                <div class="col-md-6">
                    <input id="family{{$rand_id}}" class="form-control"
                           name="family" value="{{!empty($person)?$person['person']['family']:""}}"
                           autocomplete="family" autofocus>

                </div>

            </div>

            <div class="form-group row">

                <label for="father_name{{$rand_id}}" class="col-md-4 col-form-label text-md-right">{{ __('messages.father_name') }}</label>

                <div class="col-md-6">
                    <input id="father_name{{$rand_id}}"  class="form-control"
                           name="father_name" value="{{!empty($person)?$person['person']['father_name']:""}}"
                           autocomplete="family" autofocus>

                </div>

            </div>

            <div class="form-group row">

                <label for="birth_date_{{$rand_id}}" class="col-md-4 col-form-label text-md-right">{{ __('messages.birth_date') }}</label>

                <div class="col-md-6">
                    <input id="birth_date_{{$rand_id}}{{!empty($person)?"0":""}}" type="text"
                    value="{{!empty($person)? miladi_to_shamsi_date($person['person']['birth_date']):""}}"
                           class="form-control" name="birth_date">

                </div>
            </div>

            <div class="form-group row">
                <label for="relation"
                       class="col-md-2 col-form-label text-md-right">{{ __('words.relation') }}</label>

                <div class="col-md-4">
                    <select class="select-item form-control" name="relation" onChange="supervisor_status(this.value);">
                        <option {{!empty($person) and $person['relation'] =="supervisor" ? "selected":""}}
                                value="supervisor">{{__('words.supervisor')}}</option>
                        <option {{!empty($person) and $person['relation'] =="child" ? "selected":""}}
                                value="child">{{__('words.child')}}</option>
                        <option {{!empty($person) and $person['relation'] =="grandchild" ? "selected":""}}
                                value="grandchild">{{__('words.grandchild')}}</option>
                        <option {{!empty($person) and $person['relation'] =="partner" ? "selected":""}}
                                value="partner">{{__('words.partner')}}</option>
                        <option {{!empty($person) and $person['relation'] =="handler" ? "selected":""}}
                                value="handler">{{__('words.handler')}}</option>
                    </select>

                </div>
                <label for="phone_number"
                       class="col-md-2 col-form-label text-md-right">{{ __('messages.name')." ".__('words.supervisor') }}</label>

                <div class="col-md-4">
                    <select id="parent_id_{{$rand_id}}" disabled class="select-item form-control" name="parent_id" >
                        <option value="">-</option>
                    @foreach(get_caravan_supervisor($caravan['id']) as $supervisor)
                            <option {{!empty($person) and $person['parent_id'] == $supervisor['id'] ? "selected":""}}
                                    value="{{$supervisor['id']}}">{{$supervisor['person']['name']}} {{$supervisor['person']['family']}}</option>
                        @endforeach
                    </select>

                </div>
            </div>

            <div class="form-group row">

                <label for="phone"
                       class="col-md-4 col-form-label text-md-right">{{ __('messages.phone') }}</label>

                <div class="col-md-6">
                    <input id="phone"  class="form-control @error('phone') is-invalid @enderror"
                           name="phone" value="{{!empty($person)?$person['person']['phone']:""}}"
                           autocomplete="phone" autofocus>

                </div>

            </div>

        </div>

    </div>
    <hr>
    <div class="form-group row ">
        <div class="col-md-4 ">
            <button type="submit" class="btn btn-block btn-info">
                {{ __('messages.save') }} <i class="icon-arrow-left5"></i>
            </button>
        </div>
    </div>
</form>

<script>
    $(document).ready(function () {

        $('#birth_date_{{$rand_id}}').MdPersianDateTimePicker({
            targetTextSelector: '#birth_date_{{$rand_id}}',
            selectedDate: new Date('1980/9/30'),
        });


    });
</script>