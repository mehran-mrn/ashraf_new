<?php $rand_id = rand(1, 8000); ?>
<form method="POST" id="register_role_panel" class="form-ajax-submit" action="{{route('assign_role_to_permission')}}">
    @csrf

    <div class="form-group row">

        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('messages.name') }}</label>

        <div class="col-md-6">
            <select id="select_user_{{$rand_id}}" name="role_id" class="form-control select-search" data-fouc>
                <option value="">|</option>
                @foreach($roles as $role)
                    <option value="{{$role['id']}}">{{$role['display_name']}}</option>
                @endforeach
            </select>
        </div>

    </div>
    <div class="form-group row">

        <label for="team_id" class="col-md-4 col-form-label text-md-right">{{ __('messages.team') }}</label>

        <div class="col-md-6">
            <select id="select_team_{{$rand_id}}" name="team_id" class="form-control select-search" data-fouc>
                <option value="">همه تیم ها</option>
                @foreach($teams as $team)
                    <option value="{{$team['id']}}">{{$team['display_name']}}</option>
                @endforeach
            </select>
        </div>

    </div>
    <div class="form-group row">
        <input type="hidden" name="permission_id" value="{{$permission_id}}">
    </div>

    <div class="form-group row ">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-block btn-info">
                {{ __('messages.add') }}
            </button>
        </div>
    </div>

</form>

<script>
    $(document).ready(function () {
        $("#select_user_{{$rand_id}}").select2();
        $("#select_team_{{$rand_id}}").select2();
    });
</script>