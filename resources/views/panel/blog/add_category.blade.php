<form action="{{route('panel_category_add')}}" method="post">
<div class="form-row">
    <div class="col-md-12">
        <div class="form-group">
        <label for="title">{{__('messages.tile')}}</label>
        <input type="text" class="form-control" name="title" id="title" placeholder="{{__('enter_category_title')}}">
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
        <button type="submit" class="btn btn-success float-left">{{__('messages.add')}}</button>
        </div>
    </div>
</div>
</form>
