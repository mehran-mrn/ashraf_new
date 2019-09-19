<style>
    .col-print-1 {width:8%;  float:left;}
    .col-print-2 {width:16%; float:left;}
    .col-print-3 {width:25%; float:left;}
    .col-print-4 {width:33%; float:left;}
    .col-print-5 {width:42%; float:left;}
    .col-print-6 {width:50%; float:left;}
    .col-print-7 {width:58%; float:left;}
    .col-print-8 {width:66%; float:left;}
    .col-print-9 {width:75%; float:left;}
    .col-print-10{width:83%; float:left;}
    .col-print-11{width:92%; float:left;}
    .col-print-12{width:100%; float:left;}
</style>
<div class="tab-pane fade in active" id="tab_{{$caravan['id']}}">
    <div class="panel">
        <div class="panel-body bg-white-f9">
            <div class="row">
                <div class="col-print-12 m-2">
                        <div class="col-print-4 border-1px p-20">
                            <span class="text-gray">{{__('messages.title')}}:</span>
                            <span class="text-black">{{$caravan['title']}}</span>
                        </div>
                        <div class="col-print-4 border-1px p-20">
                            <span class="text-gray">{{__('words.executer')}}: </span>
                            <span class="text-black">{{$caravan['executer']}}</span>
                        </div>
                        <div class="col-print-4 border-1px p-20">
                            <span class="text-gray">{{__('messages.capacity')}}: </span>
                            <span class="text-black">{{$caravan['capacity']}}</span>
                        </div>
                        <div class="col-print-4 border-1px p-20">
                            <span class="text-gray">{{trans('messages.departure')}} </span>
                            <span class="text-black">{{get_provinces($caravan['dep_province'])['name']}} - {{get_cites($caravan['dep_city'])['name']}}</span>
                        </div>

                        <div class="col-print-4 border-1px p-20">
                            <span class="text-gray">{{trans('messages.transport_type')}}</span>
                            <span class="text-black">{{$caravan['transport']}}</span>
                        </div>
                        <div class="col-print-4 border-1px p-20">
                                                <span class="text-gray">{{trans('messages.date')}}
                                                    {{trans('messages.depart')}}</span>
                            <span class="text-black">{{jdate('j F Y',strtotime($caravan['start']))}}</span>
                        </div>

                        <div class="clearfix"></div>
                </div>
            </div>
        </div>

        <div class="panel-body bg-white-f9">
            <div class="table-responsive">
                <table class="table table-striped text-center table-bordered">

                    <thead class="text-center">
                    <tr>
                        <th class="text-center"></th>
                        <th class="text-center">{{trans('words.supervisor')}}</th>
                        <th class="text-center">{{trans('messages.name')}}</th>
                        <th class="text-center">{{trans('messages.national_code')}}</th>
                        <th class="text-center">{{trans('messages.birth_date')}}</th>
                        <th class="text-center">{{trans('messages.status')}}</th>

                    </tr>
                    </thead>
                    <tbody class="text-center">
                    <?php  $i =1;?>
                    @foreach($caravan['persons'] as $person_caravan)
                        <tr>
                            <td class="p-2">{{$i}}</td>
                            <?php  $i++;?>
                            <td class="p-2">{{$person_caravan->parent['person']['name'] ." - ".$person_caravan->parent['person']['family']}}</td>
                            <td class="p-2">{{$person_caravan['person']['name'] ." - ". $person_caravan['person']['family']}}</td>
                            <td class="p-2">{{$person_caravan['person']['national_code']}}</td>
                            <td class="p-2">{{miladi_to_shamsi_date($person_caravan['person']['birth_date'])}} </td>

                            <td class="p-2">
                                @if($person_caravan['accepted'] >='1')
                                    <span class="text-black-50">{{trans('messages.accepted')}}</span>
                                @elseif($person_caravan['accepted'] =='0')
                                    <span class="text-black-50">{{trans('messages.rejected')}}</span>
                                @else
                                    <span class="text-black-50">{{trans('messages.pending')}}</span>
                                @endif

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>





















