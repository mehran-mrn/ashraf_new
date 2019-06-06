<?php $rand_id = rand(1, 8000); ?>
<form method="POST" id="" class="form-ajax-submit" action="{{route('assign_role_to_user')}}">
    @csrf

    <div class="form-group row">

        <label for="role_id" class="col-md-4 col-form-label text-md-right">{{ __('messages.name') }}</label>

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
    $(document).ready(function () {
        $("#select_user_{{$rand_id}}").select2();
    });
</script>