<?php $rand_id=rand(2122,9222222);?>
<div class="container">

    <div class="row">
    <div class="header">{{trans('messages.history')}}</div>
        <ul>
        @forelse($person_history as $history)
            <li>{{miladi_to_shamsi_date($history['caravan']['start'])}}</li>
            @empty
                <li class="text-success">{{__('long_msg.not_use_of_caravan')}}</li>
            @endforelse
        </ul>
    </div>
    <div class="row">

        <div class="col-md-12">
            <form name="accept_form" method="POST" id="" class="form-ajax-submit" action="{{route('action_to_person_caravan_status')}}"
                  autocomplete="off">
                @csrf
                <input type="hidden" name="person_caravan_id" value="{{$person_caravan['id']}}">
                <input type="hidden" name="accept" value="1">

                <div class="form-group">
                    <label for="description">{{__('messages.description')}}</label>
                    <textarea name="comment" id="description" class="form-control"
                              onblur="document.getElementById('hidden_comment_{{$rand_id}}').value= this.value;">
                        {{$person_caravan['comment']}}
                    </textarea>
                </div>
                <div class="row">
                <div class="col-md-6">

                    <button type="submit" class="btn btn-success" name="accept"
                            value="1">{{__('messages.accept')}}</button>
                </div>
            </form>

            <div class="col-md-6">
                <form name="reject_form" method="POST" id="" class="form-ajax-submit" action="{{route('action_to_person_caravan_status')}}"
                      autocomplete="off">
                    @csrf
                    <input type="hidden" name="person_caravan_id" value="{{$person_caravan['id']}}">
                    <input type="hidden" name="reject" value="1">
                    <input type="hidden" id="hidden_comment_{{$rand_id}}" name="comment" value="{{$person_caravan['comment']}}"/>
                    <button type="submit" class="btn btn-danger" name="reject"
                            value="1">{{__('messages.reject')}}</button>
                </form>

            </div>

        </div>
        </div>
    </div>
</div>

