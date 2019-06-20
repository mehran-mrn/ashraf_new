@foreach($caravan['workflow'] as $workflow)
    <span class="list-group-item list-group-item-action legitRipple pb-0 pr-1 pl-1">
        <span class="icon-history "></span> - <span class="text-muted p-0">
            @switch($workflow['status'])
            @case(0)
             <i class="float-left">{{jdate("Y/m/d",strtotime($workflow['created_at']))}}</i> - {{trans("messages.canceled")}}
            @break
            @case(1)
             <i class="float-left">{{jdate("Y/m/d",strtotime($workflow['created_at']))}}</i> - {{trans("messages.registering")}}
            @break
            @case(2)
             <i class="float-left">{{jdate("Y/m/d",strtotime($workflow['created_at']))}}</i> - {{trans("messages.ready")}}
            @break
            @case(3)
             <i class="float-left">{{jdate("Y/m/d",strtotime($workflow['created_at']))}}</i> - {{trans("messages.arrived")}}
            @break
            @case(4)
             <i class="float-left">{{jdate("Y/m/d",strtotime($workflow['created_at']))}}</i> - {{trans("messages.exited")}}
            @break
            @case(5)
             <i class="float-left">{{jdate("Y/m/d",strtotime($workflow['created_at']))}}</i> - {{trans("messages.archived")}}
            @break
        @endswitch
</span>

</span>
@endforeach

