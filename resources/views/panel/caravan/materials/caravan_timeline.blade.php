@foreach($caravan['workflow'] as $workflow)
<span class="list-group-item list-group-item-action legitRipple m-0">
        <span class="icon-history "></span>
            @switch($workflow['status'])
                @case(1)
                <span class="text-info">{{trans("messages.start")}} {{jdate("Y/m/d",strtotime($workflow['created_at']))}}</span>
                @case(2)
                @case(3)
                @case(4)
                @case(5)
                @case(6)
                @case(7)
                @case(8)
                @case(9)
            @endswitch


</span>
@endforeach

