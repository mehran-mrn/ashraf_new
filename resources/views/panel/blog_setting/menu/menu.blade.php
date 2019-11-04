@extends('layouts.panel.panel_layout')
@section('js')
    <!-- Theme JS files -->
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/extensions/rowlink.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/demo_pages/mail_list.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/panel/js/nestable/jquery.nestable-rtl.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/forms/styling/switch.min.js') }}"></script>

    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/forms/styling/switchery.min.js') }}"></script>
    <script>
        $(document).ready(function () {

            document.addEventListener('DOMContentLoaded', function () {
                Fancytree.init();
            });

            var UINestable = function () {
                var t = function (t) {
                    var e = t.length ? t : $(t.target), a = e.data("output");
                    window.JSON ? a.val(window.JSON.stringify(e.nestable("serialize"))) : a.val("JSON browser support required for this demo.")
                };
                return {
                    init: function () {
                        $("#nestable_ajax_1").nestable({group: 1, maxDepth: 5}).on("change", function (e) {
                            t($("#nestable_ajax_1").data("output", $("#nestable_list_ajax_output_1")));
                            $.ajax({
                                url: "{{route('update_nestable_roles')}}",
                                type: "post",
                                data: {sortval: $("#nestable_list_ajax_output_1").val(), table: "menus"},
                                headers: {
                                    'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
                                },
                                success: function (response) {
                                    new PNotify({
                                        title: '',
                                        text: response.message,
                                        type: 'success'
                                    });
                                }, error: function () {
                                }
                            });
                        });

                        $("#list_ajax_menu").on("click", function (t) {
                            var e = $(t.target), a = e.data("action");
                        });
                    }
                }
            }();

            UINestable.init();
        });
    </script>
@endsection
@section('css')
    <link href="{{ URL::asset('/public/assets/panel/js/nestable/jquery.nestable.css') }}" rel="stylesheet"
          type="text/css">
@endsection
@section('content')
    <?php
    $active_sidbare = ['blog', 'blog_setting', 'menu'];

    $menu = \App\charity_payment_patern::get();
    $menu_blog = \WebDevEtc\BlogEtc\Models\BlogEtcCategory::where("lang", "fa")->orderBy("category_name")->get();
    $menu_special = \WebDevEtc\BlogEtc\Models\BlogEtcSpecificPages::orderBy("category_name")->get();
    ?>
    <section>
        <div class="content">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-5">
                        <div class="sidebar sidebar-light sidebar-component position-static w-100 d-block">
                            <div class="sidebar-content position-static">

                                <!-- User menu -->
                                <div class="card sidebar-user">
                                    <div class="card-body">
                                        <div class="media">
                                            <a href="#" class="mr-3">
                                                <img src="../../../../global_assets/images/placeholders/placeholder.jpg" width="38" height="38" class="rounded-circle" alt="">
                                            </a>

                                            <div class="media-body">
                                                <div class="media-title font-weight-semibold">Available Options</div>
                                                <div class="font-size-xs opacity-50"></div>
                                                <div class="float-right"><button type="submit" class="btn btn-info">{{trans('messages.add')}} <i class="icon-add"></i> </button></div>

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
                                                <li class="nav-item"> <label class="nav-link"><input type="checkbox"  value="{{route('index',[],false)}}"/> {{trans('messages.home')}} </label> </li>
                                                <li class="nav-item"> <label class="nav-link"><input type="checkbox"  value="{{route('gallery',[],false)}}"/> {{trans('messages.photos')}} </label> </li>
                                                <li class="nav-item"> <label class="nav-link"><input type="checkbox"  value="{{route('video_gallery',[],false)}}"/> {{trans('messages.videos')}} </label> </li>
                                                <li class="nav-item"> <label class="nav-link"><input type="checkbox"  value="{{route('faq',[],false)}}"/> {{trans('messages.faq')}} </label> </li>
                                                <li class="nav-item"> <label class="nav-link"><input type="checkbox"  value="{{route('contact.create',[],false)}}"/> {{trans('messages.contact_to_we')}} </label> </li>


                                            </ul>
                                        </li>
                                        <li class="nav-item nav-item-submenu">
                                            <a href="#" class="nav-link"><i class="icon-cabinet"></i> categories</a>
                                            <ul class="nav nav-group-sub">
                                                <li class="nav-item nav-item-submenu">
                                                    <a href="#" class="nav-link">{{trans('messages.Introducing_us')}}</a>
                                                    <ul class="nav nav-group-sub">
                                                        @foreach($menu_special as $m_s)
                                                            <li class="nav-item"> <label class="nav-link"><input type="checkbox"  value="{{route('blogetc.view_SpecificPages',['categorySlug'=>$m_s['slug']],false)}}"/> {{$m_s['category_name']}} </label> </li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                                <li class="nav-item nav-item-submenu">
                                                    <a href="#" class="nav-link">{{trans('messages.categories')}}</a>
                                                    <ul class="nav nav-group-sub">
                                                        @foreach($menu_blog as $m_b)
                                                        <li class="nav-item"> <label class="nav-link"><input type="checkbox"  value="{{route('blogetc.view_category',['categorySlug'=>$m_s['slug']],false)}}"/> {{$m_b['category_name']}} </label> </li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        <?php $pages = \App\page::where('local',App()->getLocale())->where('link',true)->get(); ?>
                                        <li class="nav-item nav-item-submenu">
                                            <a href="#" class="nav-link"><i class="icon-display"></i> Custom pages</a>

                                            <ul class="nav nav-group-sub">
                                                @foreach($pages as $page)
                                                    <li class="nav-item"> <label class="nav-link"><input type="checkbox"  value="/{{App()->getLocale()}}/p/{{$page['slug']}}"/> {{$page['name']}} </label> </li>
                                                @endforeach
                                            </ul>
                                        </li>

                                    </ul>
                                </div>
                                <!-- /navigation -->

                            </div>
                        </div>
                        <div class="card mt-2 bg-slate">
                            <div class="card-header collapsed" data-toggle="collapse" data-target="#collapse-button-collapsed" aria-expanded="false">
                                <a class="text-white" href="#">add custom Label</a> <i class="icon-plus2"></i> </div>
                            <div class="card-body collapse" id="collapse-button-collapsed">
                                <div class="form-group">
                                    <label for="menu_name" >{{trans('messages.name')}}</label>
                                    <input class="form-control" type="text" id="menu_name" name="name">
                                </div>
                                <div class="form-group">
                                    <label for="menu_url" >URL</label>
                                    <input class="form-control" type="text" id="menu_url" name="URL">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-success" type="submit">{{trans('messages.add')}} <i class="icon-floppy-disk"></i> </button>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="card ">
                            <div class="card-header"></div>
                            <div class="card-body"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection