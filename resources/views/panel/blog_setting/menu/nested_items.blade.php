<ol class="dd-list dd-list-rtl">
    @foreach($items as $item)
        <li class="dd-item dd3-item " data-id="{{$item['id']}}">
            <div class="dd-handle dd3-handle"><i class="icon-dots"></i> </div>
            <div class="dd3-content bg-info">

                <a href="#"
                   class="editable text-white"
                   data-name="menu_item"
                   data-type="text"
                   data-pk="{{$item['id']}}"
                   data-url="{{route('menu.update',['menu'=>$item['id']])}}"
                   data-title="{{trans('messages.display_title')}}">{{$item['name']}}</a>
                <span class=" text-muted ">{{substr($item['url'],0,30)}}</span>


                <button class="btn btn-sm btn-danger p-0 m-0 badge float-right swal-alert"
                        data-ajax-link="{{route('menu.destroy',['menu'=>$item['id']])}}"
                        data-method="DELETE"
                        data-csrf="{{csrf_token()}}"
                        data-title="{{trans('messages.delete_item',['item'=>$item['name']])}}"
                        data-text="{{trans('messages.delete_item_text',['item'=>$item['name']])}}"
                        data-type="warning"
                        data-cancel="true"
                        data-confirm-text="{{trans('messages.delete')}}"
                        data-cancel-text="{{trans('messages.cancel')}}"><i class="icon-cross font-size-xs"></i> </button>
            </div>
            @if($item->subMenu()->exists())
                @include('panel.blog_setting.menu.nested_items',['items'=>$item->subMenu])
            @endif
        </li>
    @endforeach
</ol>