@extends("blog.blogetc_admin.layouts.admin_layout")
@section('js')
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>
    <script>
        var DatatableBasic = function () {
            var _componentDatatableBasic = function () {
                if (!$().DataTable) {
                    console.warn('Warning - datatables.min.js is not loaded.');
                    return;
                }
                $.extend($.fn.dataTable.defaults, {
                    autoWidth: true,
                    columnDefs: [{
                        orderable: true,
                        targets: [1, 3, 4]
                    }],
                    dom: '<"datatable-header"fl><"datatable-scroll"t><"datatable-footer"ip>',
                    language: {
                        search: '<span>{{__('messages.filter')}}:</span> _INPUT_',
                        searchPlaceholder: '{{__('messages.search')}}...',
                        lengthMenu: '<span>{{__('messages.show')}}:</span> _MENU_',
                        paginate: {
                            'first': '{{__('messages.first')}}',
                            'last': '{{__('messages.last')}}',
                            'next': $('html').attr('dir') == 'rtl' ? '&larr;' : '&rarr;',
                            'previous': $('html').attr('dir') == 'rtl' ? '&rarr;' : '&larr;'
                        }
                    }
                });
                $('.datatable-basic').DataTable({
                    paging: false,
                    pagingType: "full",
                    language: {
                        paginate: {
                            'next': $('html').attr('dir') == 'rtl' ? '{{__('messages.next')}} &larr;' : '{{__('messages.next')}} &rarr;',
                            'previous': $('html').attr('dir') == 'rtl' ? '&rarr; {{__('messages.prev')}}' : '&larr; {{__('messages.prev')}}'
                        }
                    },
                    stateSave: true,
                    autoWidth: true,
                });
                $('.sidebar-control').on('click', function () {
                    table.columns.adjust().draw();
                });
            };
            var _componentSelect2 = function () {
                if (!$().select2) {
                    console.warn('Warning - select2.min.js is not loaded.');
                    return;
                }
                $('.dataTables_length select').select2({
                    minimumResultsForSearch: Infinity,
                    dropdownAutoWidth: true,
                    width: 'auto'
                });
            };
            return {
                init: function () {
                    _componentDatatableBasic();
                    _componentSelect2();
                }
            }
        }();
        document.addEventListener('DOMContentLoaded', function () {
            DatatableBasic.init();
        });
    </script>
@stop
<?php
$active_sidbare = ['blog', 'blog_posts', 'blog_posts_list']
?>
@section("content")
    <section>
        <div class="content">
            @if(sizeof($posts)>=1)
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card ">
                            <div class="card-header bg-light">
                                <span class="card-title">{{__('messages.post_list')}}</span>
                            </div>
                            <div class="card-body ">
                                <table class="table datatable-basic">
                                    <thead class="fullwidth">
                                    <tr>
                                        <th>{{__('messages.title')}}</th>
                                        <th>{{__('messages.author')}}</th>
                                        <th>{{__('messages.posted_at')}}</th>
                                        <th>{{__('messages.Categories')}}</th>
                                        <th>{{__('messages.action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($posts as $post)
                                        <tr>
                                            <td><a href='{{$post->url()}}'>{!! substr($post->title,'0',100) !!}</a>
                                                <span class="badge badge-danger">{!!($post->is_published ? "" : "(".__('messages.draft').")")!!}</span>
                                            </td>
                                            <td>{{$post->author_string()}}</td>
                                            <td>{{miladi_to_shamsi_date($post->posted_at)}}</td>
                                            <td>
                                                @if(count($post->categories))
                                                    @foreach($post->categories as $category)
                                                        <a class='btn badge badge-primary btn-sm m-1'
                                                           href='{{$category->edit_url()}}'>
                                                            <small>{{$category->category_name}}</small>
                                                        </a>
                                                    @endforeach
                                                @endif

                                                @if(count($post->specificPage))
                                                    @foreach($post->specificPage as $specific)
                                                        <a class='btn badge badge-warning btn-sm m-1'
                                                           href='{{$specific->edit_url()}}'>
                                                            <small>{{$specific->category_name}}</small>
                                                        </a>
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href='{{route('post_page',$post->slug)}}' target="_blank"
                                                       class="float-right btn alpha-success border-success-400 text-success-800 btn-icon rounded-round ml-2">
                                                        <i class="icon-eye8"></i>
                                                    </a>
                                                    <a href="{{$post->edit_url()}}"
                                                       class="float-right btn alpha-info border-info-400 text-info-800 btn-icon rounded-round ml-2">
                                                        <i class="icon-pencil"></i>
                                                    </a>
                                                    <button type="submit"
                                                            class="legitRipple  float-right btn alpha-pink border-pink-400 text-pink-800 btn-icon rounded-round ml-2 swal-alert "
                                                            data-ajax-link="{{route("blogetc.admin.destroy_post", $post->id)}}"
                                                            data-method="delete"
                                                            data-csrf="{{csrf_token()}}"
                                                            data-title="{{trans('messages.delete_item',['item'=>trans('messages.post')])}}"
                                                            data-text="{{trans('messages.delete_item_text',['item'=>trans('messages.post')])}}"
                                                            data-type="warning"
                                                            data-cancel="true"
                                                            data-confirm-text="{{trans('messages.delete')}}"
                                                            data-cancel-text="{{trans('messages.cancel')}}">
                                                        <i class="icon-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr></tr>
                                    @endforelse
                                    </tbody>
                                </table>
                                <div class='text-center'>
                                    {{$posts->appends( [] )->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                @include('panel.not_found',['html'=>'<a class="btn btn-primary" href="'.route('blogetc.admin.create_post').'">
                '.__('messages.new_post').'</a>',
               'msg'=>__('messages.not_found_any_data'),
               'des'=>__('messages.please_insert_post')])
            @endif
        </div>
    </section>
@endsection