<form method="POST" id="" class="form-ajax-submit" action="{{route('assign_role_to_user')}}">
    @csrf

    <div class="form-group row">

        <label for="role_id" class="col-md-4 col-form-label text-md-right">{{ __('messages.name') }}</label>

        <div class="col-md-6">

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
    <div class="form-group row">
        <input type="hidden" name="user_id" value="{{$user_id}}">
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

</script>