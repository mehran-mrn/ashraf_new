<ul class="dropdown">
    @foreach($sub_menu as $sub_menu_item)
    <li><a href="{{$sub_menu_item['url']}}">{{$sub_menu_item['name']}}</a>
        @if($sub_menu_item->subMenu()->exists())
            @include('layouts.global.nested_menu',['sub_menu'=>$sub_menu_item->subMenu])
        @endif
    </li>
    @endforeach
</ul>