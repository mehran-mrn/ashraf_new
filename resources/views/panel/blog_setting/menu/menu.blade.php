@extends('layouts.panel.panel_layout')
@section('js')
    <!-- Theme JS files -->
    {{--    <script src="{{ URL::asset('/node_modules/nestable2/jquery.nestable.js') }}"></script>--}}
    <script src="{{ URL::asset('/public/assets/panel/js/nestable/jquery.nestable-rtl.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/panel/js/Xeditable/bootstrap-editable.min.js') }}"></script>


@endsection
@section('css')
    <link href="{{ URL::asset('/public/assets/panel/js/nestable/jquery.nestable.css') }}" rel="stylesheet"
          type="text/css">
    <link href="{{ URL::asset('/public/assets/panel/css/Xeditable/bootstrap-editable.css') }}" rel="stylesheet"
          type="text/css">
@endsection
@section('content')
    <?php
    $active_sidbare = ['blog', 'blog_setting', 'menu'];

    $menu_items = \App\menu::where('parent_id', '0')->orderBy('order')->get();
    $menu_charities = \App\charity_payment_patern::get();
    $menu_blog = \WebDevEtc\BlogEtc\Models\BlogEtcCategory::where("lang", $id)->orderBy("category_name")->get();
    $menu_special = \WebDevEtc\BlogEtc\Models\BlogEtcSpecificPages::orderBy("category_name")->get();
    ?>
    <section>
        <div class="content">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-5">
                        <div class="sidebar sidebar-light sidebar-component position-static w-100 d-block">
                            <div class="sidebar-content position-static">
                                <form method="post" action="{{route('menu.store')}}">
                                    @csrf
                                    <input type="hidden" name="preDefined" value="1">
                                    <input type="hidden" name="local" value="{{$id}}">

                                    <!-- User menu -->
                                    <div class="card sidebar-user">
                                        <div class="card-body">
                                            <div class="media">
                                                <a href="#" class="mr-3">
                                                    <img src=""
                                                         width="38" height="38" class="rounded-circle" alt="">
                                                </a>

                                                <div class="media-body">
                                                    <div class="media-title font-weight-semibold">Available Options
                                                    </div>
                                                    <div class="font-size-xs opacity-50"></div>

                                                </div>

                                                <div class="ml-3 align-self-center">
                                                    <a href="#" class="text-white"><i class="icon-cog3"></i></a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- /user menu -->

                                    <!-- Navigation -->
                                    <div class="card">


                                        <ul class="nav nav-sidebar nav-sidebar-bordered" data-nav-type="accordion">

                                                <li class="nav-item nav-item-submenu">
                                                    <a href="#" class="nav-link"><i class="icon-cube3"></i> System pages</a>

                                                    <ul class="nav nav-group-sub">
                                                        <li class="nav-item"><label class="nav-link"><input
                                                                        name="system[]"
                                                                        type="checkbox"
                                                                        value="{{route('index',[],false)}}||{{trans('messages.home')}}"/> {{trans('messages.home')}}
                                                            </label></li>
                                                        <li class="nav-item"><label class="nav-link"><input
                                                                        name="system[]"
                                                                        type="checkbox"
                                                                        value="{{route('gallery',[],false)}}||{{trans('messages.photos')}}"/> {{trans('messages.photos')}}

                                                            </label></li>
                                                        <li class="nav-item"><label class="nav-link"><input
                                                                        name="system[]"
                                                                        type="checkbox"
                                                                        value="{{route('video_gallery',[],false)}}||{{trans('messages.videos')}}"/> {{trans('messages.videos')}}

                                                            </label></li>
                                                        <li class="nav-item"><label class="nav-link"><input
                                                                        name="system[]"
                                                                        type="checkbox"
                                                                        value="{{route('faq',[],false)}}||{{trans('messages.faq')}}"/> {{trans('messages.faq')}}

                                                            </label></li>
                                                        <li class="nav-item"><label class="nav-link"><input
                                                                        name="system[]"
                                                                        type="checkbox"
                                                                        value="{{route('contact.create',[],false)}}||{{trans('messages.contact_to_we')}}"/> {{trans('messages.contact_to_we')}}
                                                            </label></li>


                                                    </ul>
                                                </li>
                                                <li class="nav-item nav-item-submenu">
                                                    <a href="#" class="nav-link"><i class="icon-cabinet"></i> categories</a>
                                                    <ul class="nav nav-group-sub">
                                                        <li class="nav-item nav-item-submenu">
                                                            <a href="#"
                                                               class="nav-link">{{trans('messages.Introducing_us')}}</a>
                                                            <ul class="nav nav-group-sub">
                                                                @foreach($menu_special as $m_s)
                                                                    <li class="nav-item"><label class="nav-link"><input
                                                                                    name="system[]"
                                                                                    type="checkbox"
                                                                                    value="{{route('blogetc.view_SpecificPages',['categorySlug'=>$m_s['slug']],false)}}||{{$m_s['category_name']}}"/> {{$m_s['category_name']}}
                                                                        </label></li>
                                                                @endforeach
                                                            </ul>
                                                        </li>
                                                        <li class="nav-item nav-item-submenu">
                                                            <a href="#"
                                                               class="nav-link">{{trans('messages.categories')}}</a>
                                                            <ul class="nav nav-group-sub">
                                                                @foreach($menu_blog as $m_b)
                                                                    <li class="nav-item"><label class="nav-link"><input
                                                                                    name="system[]"
                                                                                    type="checkbox"
                                                                                    value="{{route('blogetc.view_category',['categorySlug'=>$m_b['slug']],false)}}||{{$m_b['category_name']}}"/> {{$m_b['category_name']}}
                                                                        </label></li>
                                                                @endforeach
                                                            </ul>
                                                        </li>
                                                        <li class="nav-item nav-item-submenu">
                                                            <a href="#"
                                                               class="nav-link">{{trans('messages.cooperation')}}</a>
                                                            <ul class="nav nav-group-sub">
                                                                <li class="nav-item"><label class="nav-link"><input
                                                                                name="system[]"
                                                                                type="checkbox"
                                                                                value="{{route('global_shop')}}||{{$m_s['tableau_and_wreath']}}"/> {{__("messages.tableau_and_wreath")}}

                                                                    </label></li>

                                                                @foreach($menu_charities as $menu_charity)
                                                                    @if($menu_charity['type']=="vow")
                                                                        <li class="nav-item"><label
                                                                                    class="nav-link"><input
                                                                                        name="system[]"
                                                                                        type="checkbox"
                                                                                        value="{{route('vows',['id'=>$menu_charity['id']])}}||{{$menu_charity['title']}}"/> {{$menu_charity['title']}}

                                                                            </label></li>
                                                                    @endif
                                                                @endforeach
                                                                <li class="nav-item"><label class="nav-link"><input
                                                                                name="system[]"
                                                                                type="checkbox"
                                                                                value="{{route('vow_donate')}}||{{__("messages.financial_aids")}}"/> {{__("messages.financial_aids")}}
                                                                    </label></li>
                                                                <li class="nav-item"><label class="nav-link"><input
                                                                                name="system[]"
                                                                                type="checkbox"
                                                                                value="{{route('vow_periodic')}}||{{__("messages.Periodic_assistance")}}"/> {{__("messages.Periodic_assistance")}}
                                                                    </label></li>

                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <?php $pages = \App\page::where('local', App()->getLocale())->where('link', true)->get(); ?>
                                                <li class="nav-item nav-item-submenu">
                                                    <a href="#" class="nav-link"><i class="icon-display"></i> Custom
                                                        pages</a>

                                                    <ul class="nav nav-group-sub">
                                                        @foreach($pages as $page)
                                                            <li class="nav-item"><label class="nav-link"><input
                                                                            name="system[]"
                                                                            type="checkbox"
                                                                            value="/{{App()->getLocale()}}/p/{{$page['slug']}}||{{$page['name']}}"/> {{$page['name']}}
                                                                </label></li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                        </ul>
                                        <div class="card-footer">
                                            <div class="float-right">
                                                <button type="submit"
                                                        class="btn btn-info">{{trans('messages.add')}} <i
                                                            class="icon-add"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /navigation -->
                                </form>

                            </div>
                        </div>
                        <div class="card mt-2 bg-slate">
                            <div class="card-header collapsed" data-toggle="collapse"
                                 data-target="#collapse-button-collapsed" aria-expanded="false">
                                <a class="text-white" href="#">add custom Label</a> <i class="icon-plus2"></i></div>
                            <div class="card-body collapse" id="collapse-button-collapsed">
                                <form method="post" action="{{route('menu.store')}}">
                                    @csrf
                                    <input type="hidden" name="preDefined" value="0">
                                    <input type="hidden" name="local" value="{{$id}}">
                                    <div class="form-group">
                                        <label for="menu_name">{{trans('messages.name')}}</label>
                                        <input class="form-control" type="text" id="menu_name" name="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="menu_url">URL</label>
                                        <input class="form-control" type="text" id="menu_url" name="url">
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-success" type="submit">{{trans('messages.add')}} <i
                                                    class="icon-floppy-disk"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-header"></div>
                            <div class="card-body">
                                <div class="dd">
                                    <ol class="dd-list dd-list-rtl">
                                        @foreach($menu_items as $menu_item)
                                            <li class="dd-item dd3-item" data-id="{{$menu_item['id']}}">
                                                <div class="dd-handle dd3-handle ">

                                                </div>

                                                <div class="dd3-content bg-info">
                                                    <a href="#"
                                                       class=" editable text-white"
                                                       data-name="menu_item"
                                                       data-type="text"
                                                       data-pk="{{$menu_item['id']}}"
                                                       data-url="{{route('menu.update',['menu'=>$menu_item['id']])}}"
                                                       data-title="{{trans('messages.display_title')}}">{{$menu_item['name']}}</a>
                                                    <span class=" text-muted ">{{substr($menu_item['url'],0,30)}}</span>

                                                    <button class="btn btn-sm btn-danger p-0 m-0 badge float-right swal-alert"
                                                            data-ajax-link="{{route('menu.destroy',['menu'=>$menu_item['id']])}}"
                                                            data-method="DELETE"
                                                            data-csrf="{{csrf_token()}}"
                                                            data-title="{{trans('messages.delete_item',['item'=>$menu_item['name']])}}"
                                                            data-text="{{trans('messages.delete_item_text',['item'=>$menu_item['name']])}}"
                                                            data-type="warning"
                                                            data-cancel="true"
                                                            data-confirm-text="{{trans('messages.delete')}}"
                                                            data-cancel-text="{{trans('messages.cancel')}}"><i
                                                                class="icon-cross font-size-xs"></i></button>
                                                </div>
                                                @if($menu_item->subMenu()->exists())
                                                    @include('panel.blog_setting.menu.nested_items',['items'=>$menu_item->subMenu->sortBy('order')])
                                                @endif
                                            </li>
                                        @endforeach
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('footer_js')
    <script>

        $(document).ready(function () {
            $(document).ready(function() {
                $.fn.editable.defaults.ajaxOptions = {type: "PATCH"};
                $.fn.editable.defaults.params = function (params) {
                    params._token = $("meta[name=csrf-token]").attr("content");
                    return params;
                };
                $('.editable').editable();

            });

            var updateOutput = function (e) {
                var list = e.length ? e : $(e.target);

                if (window.JSON) {
                    console.log(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
                    $.ajax({
                        url: '{{route('menu.create')}}',
                        type: 'Get',
                        data: {data: window.JSON.stringify(list.nestable('serialize'))},
                        success: function (response) {
                            new PNotify({
                                title: '',
                                text: response.message,
                                type: 'success'
                            });
                            setTimeout(function () {
                                if (redirect) {
                                    window.location.replace(redirect);
                                } else {
                                    location.reload();
                                }
                            }, 1000)
                        },
                        error: function (response) {
                            new PNotify({
                                title: 'oops',
                                text: ' Unable to load',
                                type: 'error'
                            });

                        }
                    });

                } else {

                    alert('JSON browser support required for this demo.');
                }
            };


            $('.dd').nestable('').on('change', updateOutput);

        });

    </script>
@endsection