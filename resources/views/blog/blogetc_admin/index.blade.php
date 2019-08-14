@extends("blog.blogetc_admin.layouts.admin_layout")
@section("content")
    <?php
    $active_sidbare = ['blog', 'blog_posts', 'blog_posts_list']
    ?>
    <section>
        <div class="content">
            @if(sizeof($posts)>=1)
                <div class="card">
                    <div class="card-header bg-light">
                        <span class="card-title">{{__('messages.post_list')}}</span>
                    </div>
                    <div class="card-body">
                        <table class="table table-scrollable table-striped">
                            <tr>
                                <th>{{__('messages.title')}}</th>
                                <th>{{__('messages.subtitle')}}</th>
                                <th>{{__('messages.author')}}</th>
                                <th>{{__('messages.posted_at')}}</th>
                                <th>{{__('messages.Categories')}}</th>
                                <th></th>
                            </tr>
                            @forelse($posts as $post)
                                <tr>
                                    <td><a href='{{$post->url()}}'>{{$post->title}}</a>
                                        {!!($post->is_published ? "" : 'Draft')!!}
                                    </td>
                                    <td>{{$post->subtitle}}</td>
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
                                        <a href="{{$post->url()}}" class="float-right btn alpha-success border-success-400 text-success-800 btn-icon rounded-round ml-2
                                             ">
                                            <i class="icon-eye8"></i>
                                        </a>
                                        <a href="{{$post->edit_url()}}" class="float-right btn alpha-info border-info-400 text-info-800 btn-icon rounded-round ml-2
                                             ">
                                            <i class="icon-pencil"></i>
                                        </a>


                                        <form onsubmit="return confirm('Are you sure you want to delete this blog post?\n You cannot undo this action!');"
                                              method='post' action='{{route("blogetc.admin.destroy_post", $post->id)}}'
                                              class='float-right'>
                                            @csrf
                                            <input name="_method" type="hidden" value="DELETE"/>
                                            <button type="submit"
                                                    class="legitRipple swal-alert float-right btn alpha-pink border-pink-400 text-pink-800 btn-icon rounded-round ml-2">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                        </table>
                        <div class='text-center'>
                            {{$posts->appends( [] )->links()}}
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