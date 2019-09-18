@extends("blog.blogetc_admin.layouts.admin_layout")
@section('js')
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/tables/datatables/extensions/responsive.min.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>
    <script src="{{ URL::asset('/public/assets/panel/global_assets/js/demo_pages/datatables_responsive.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#tablePost').dataTable({
                "columnDefs": [
                    {"orderable": false, "targets": 5}
                ],
                "order": [[3, 'desc']],
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
        })
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
                                <table class="table table-scrollable  table-striped" id="tablePost">
                                    <thead class="fullwidth">
                                    <tr>
                                        <th>{{__('messages.title')}}</th>
                                        <th>{{__('messages.subtitle')}}</th>
                                        <th>{{__('messages.author')}}</th>
                                        <th>{{__('messages.posted_at')}}</th>
                                        <th>{{__('messages.Categories')}}</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($posts as $post)
                                        <tr>
                                            <td><a href='{{$post->url()}}'>{{substr($post->title,0,100)}}</a>
                                                {!!($post->is_published ? "" : 'Draft')!!}
                                            </td>
                                            <td>{{substr($post->subtitle,0,100)}}</td>
                                            <td>{{$post->author_string()}}</td>
                                            <td>{{miladi_to_shamsi_date($post->posted_at)}}</td>
                                            <td>
                                                @if(count($post->categories))
                                                    @foreach($post->categories as $category)
                                                        <a class='btn btn-outline-secondary btn-sm m-1'
                                                           href='{{$category->edit_url()}}'>
                                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>

                                                            {{$category->category_name}}
                                                        </a>
                                                    @endforeach
                                                @else
                                                    No Categories
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
                                        @endforeach
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