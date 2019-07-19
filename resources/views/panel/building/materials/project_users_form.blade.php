<?php $rand_id = rand(1, 8000); ?>
<script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>
<script>
    @for($lvl = 1 ;$lvl<=4 ;$lvl++)
    $("#slelect_{{$lvl}}{{$rand_id}}").select2();
    @endfor
</script>
<form method="POST" id="" class="form-ajax-submit" action="{{route('edit_project_users',['project_id'=>$project_id])}}"
      autocomplete="off">
    @csrf
    <input type="hidden" name="project_id" value="{{$project_id}}">

    <div class="form-group row">
        <div class="col-md-12">
            <div class="row">
                @for($lvl = 1 ;$lvl<=4 ;$lvl++)
                    <div class="col-md-12 mb-5">
                        <label for="users_lvl_{{$lvl}}" class="label label-info">
                            @switch($lvl)
                                @case("1")
                                {{__('messages.project_manager')}}
                                @break
                                @case("2")
                                {{__('messages.project_officer')}}
                                @break
                                @case("3")
                                {{__('messages.project_worker')}}
                                @break
                                @case("4")
                                {{__('messages.project_watcher')}}
                                @break

                                @default
                            @endswitch
                        </label>

                        <select id="slelect_{{$lvl}}{{$rand_id}}" name="users_id_{{$lvl}}[]" multiple="multiple" class="form-control select" data-fouc >
                            @foreach($users as $user)
                            <option value="{{$user['id']}}" {{(isset($user['building_users'][0]['level']) and $user['building_users'][0]['level'] == $lvl) ? "selected":""}}>{{$user['name']}}</option>
                            @endforeach
                        </select>

                    </div>
                    <hr>
                @endfor
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

