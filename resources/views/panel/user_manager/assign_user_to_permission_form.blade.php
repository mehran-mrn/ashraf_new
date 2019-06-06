<?php $rand_id = rand(1, 8000); ?>
<form method="POST" id="register_role_panel" class="form-ajax-submit" action="{{route('assign_user_to_permission')}}">
    @csrf

    <div class="form-group row">

        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('messages.name') }}</label>

        <div class="col-md-6">
            <select id="select_user_{{$rand_id}}" name="user_id" class="form-control select-search" data-fouc>
                <option value="">|</option>
                @foreach($users as $user)
                    <option value="{{$user['id']}}">{{$user['name'].' | '.$user['phone'].' | '.$user['email']}}</option>
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
    });
</script>