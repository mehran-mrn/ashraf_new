<form method="POST" id="register_role_panel" class="form-ajax-submit" action="{{route('assign_role_to_permission')}}">
    @csrf

    <div class="form-group row">

        {{--<label for="name" class="col-md-4 col-form-label text-md-right">{{ __('messages.name') }}</label>--}}

        {{--<div class="col-md-6">--}}
        {{--<select id="select_user_{{$rand_id}}" name="role_id" class="form-control select-search" data-fouc>--}}
        {{--<option value="">|</option>--}}
        {{--@foreach($roles as $role)--}}
        {{--<option value="{{$role['id']}}">{{$role['display_name']}}</option>--}}
        {{--@endforeach--}}
        {{--</select>--}}
        <div class="col-md-6">
            <div class="card ">
                <div class="card-header ">
                <span class="badge badge-flat"><label
                            class="d-block font-weight-semibold">{{ __('messages.teams') }}</label></span>
                </div>
                <div class="card-body ">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="teams_id[]"
                               value="0"
                               id="team_id_0" {{(count($old_team) != 0 and $checked_team == 0 ) ? "checked":""}} >
                        <label class="custom-control-label"
                               for="team_id_0">{{trans('messages.all_teams')}}</label>
                    </div>
                    <hr>
                    @foreach($teams as $team)
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="teams_id[]" value="{{$team['id']}}"
                                   id="team_id{{$team['id']}}" {{$team['id'] == $checked_team ?"checked":""}} >
                            <label class="custom-control-label"
                                   for="team_id{{$team['id']}}">{{$team['display_name']}}</label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card ">
                <div class="card-header ">
                    <span class="badge badge-flat"><label
                                class="d-block font-weight-semibold">{{ __('messages.roles') }}</label></span>
                </div>
                <div class="card-body ">

                    @foreach($roles as $role)
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="roles_id[]"
                                   value="{{$role['id']}}"
                                   id="roles_id_{{$role['id']}}" {{in_array($role['id'],$checked_roles)?"checked":""}}>
                            <label class="custom-control-label"
                                   for="roles_id_{{$role['id']}}">{{$role['display_name']}}</label>
                        </div>
                    @endforeach
                </div>
            </div>
            @foreach($old_team as $team_role)
                <input type="hidden" name="old_team[]" value="{{$team_role}}">
            @endforeach
        </div>

    </div>
    <div class="form-group row">
        <input type="hidden" name="permission_id" value="{{$permission_id}}">
    </div>

    <div class="form-group row ">
        <div class="col-md-6 offset-md-3">
            <button type="submit" class="btn btn-block btn-info">
                {{ __('messages.save') }}
            </button>
        </div>
    </div>

</form>

