<ul>
    @foreach($cities as $child)
        <li class="expanded {{$selected_city == $child['id'] ?"selected":""}}">
            {{ $child->name }}
            @if(count($child->city))
                @include('panel.building.materials.sub_tree',['cities' => $child->city])
            @endif
        </li>
    @endforeach
</ul>