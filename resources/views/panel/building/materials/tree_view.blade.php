
<script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/extensions/jquery_ui/core.min.js') }}"></script>
<script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/extensions/jquery_ui/effects.min.js') }}"></script>
<script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/extensions/jquery_ui/interactions.min.js') }}"></script>
<script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/extensions/cookie.js') }}"></script>
<script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/forms/styling/switchery.min.js') }}"></script>
<script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/forms/styling/uniform.min.js') }}"></script>

<script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/trees/fancytree_all.min.js') }}"></script>
<script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/trees/fancytree_childcounter.js') }}"></script>

<script src="{{ URL::asset('/public/assets/panel/global_assets/js/demo_pages/extra_trees.js') }}"></script>





<div class="tree-default card card-body border-left-info border-left-2">

<ul id="tree1" class="d-none mb-0">
    @foreach($provinces as $province)
        <li class="folder expanded {{$selected_city == $province['id'] ?"selected":""}}">
            {{ $province->name }}
            @if(count($province->city))
                @include('panel.building.materials.sub_tree',['cities' => $province->city])
            @endif
        </li>
    @endforeach
</ul>
</div>