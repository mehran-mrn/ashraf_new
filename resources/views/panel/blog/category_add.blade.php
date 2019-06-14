<form action="{{route('category_add')}}" method="post">
    @csrf
<div class="form-row">
    <div class="col-md-12">
        <div class="form-group">
        <label for="title">{{__('messages.title')}}</label>
        <input type="text" class="form-control" name="title" id="title" placeholder="{{__('messages.enter_category_title')}}" required="required">
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
        <button type="submit" class="btn btn-success float-left">{{__('messages.add')}}</button>
        </div>
    </div>
</div>
</form>
