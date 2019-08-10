
<div class="form-group">
    <label for="blog_title">{{trans('messages.title')}}</label>
    <input type="text" class="form-control" required id="blog_title" aria-describedby="blog_title_help" name='title'
           value="{{old("title",$post->title)}}">
    <small id="blog_title_help" class="form-text text-muted">{{trans('messages.display_title')}}</small>
</div>

<div class="form-group">
    <label for="blog_subtitle">Subtitle</label>
    <input type="text" class="form-control" id="blog_subtitle" aria-describedby="blog_subtitle_help" name='subtitle'
           value='{{old("subtitle",$post->subtitle)}}'>
    <small id="blog_subtitle_help" class="form-text text-muted">{{trans('messages.display_subtitle')}}</small>
</div>


<div class='row'>


    <div class='col-sm-12 col-md-4'>


        <div class="form-group">
            <label for="blog_slug">{{trans('messages.post_slug')}}</label>
            <input type="text" class="form-control" id="blog_slug" aria-describedby="blog_slug_help" name='slug'
                   value="{{old("slug",$post->slug)}}">
            <small id="blog_slug_help" class="form-text text-muted">{{trans('messages.post_slug')}} ({{trans('messages.optional')}}) -
                {{trans('messages.i_e')}}. {{route("blogetc.single","")}}/<u><em>this_part</em></u></small>
        </div>

    </div>
    <div class='col-sm-6 col-md-4'>


        <div class="form-group">
            <label for="blog_is_published">{{trans('messages.is_published')}}</label>

            <select name='is_published' class='form-control' id='blog_is_published'
                    aria-describedby='blog_is_published_help'>

                <option @if(old("is_published",$post->is_published) == '1') selected='selected' @endif value='1'>
                    {{trans('messages.published')}}
                </option>
                <option @if(old("is_published",$post->is_published) == '0') selected='selected' @endif value='0'>
                    {{trans('messages.not_published')}}
                </option>

            </select>

        </div>

    </div>
    <div class='col-sm-6 col-md-4'>

        <div class="form-group">
            <label for="blog_posted_at">{{trans('messages.posted_at')}}</label>
            <input type="text" class="form-control" id="blog_posted_at" aria-describedby="blog_posted_at_help"
                   name='posted_at'
                   value="{{old("posted_at",$post->posted_at ?? \Carbon\Carbon::now())}}">
            <small id="blog_posted_at_help" class="form-text text-muted">
                {!! trans('messages.posted_at_help',['format'=>'<code dir="ltr">YYYY-MM-DD
                    HH:MM:SS</code>' ,'now'=> \Carbon\Carbon::now()]) !!}
            </small>
        </div>


    </div>
</div>


<div class="form-group">
    <label for="blog_post_body">{{trans('messages.post_text')}}
        @if(config("blogetc.echo_html"))
            (HTML)
        @else
         (Html will be escaped)
        @endif

    </label>
    <textarea style='min-height:600px;' id="post_text" class=" form-control" id="blog_post_body" aria-describedby="blog_post_body_help"
              name='post_body'>{{old("post_body",$post->post_body)}}</textarea>

</div>




@if(config("blogetc.use_custom_view_files",true))
    <div class="form-group">
        <label for="blog_use_view_file">{{__('messages.custom_view_file')}}</label>
        <input type="text" class="form-control" id="blog_use_view_file" aria-describedby="blog_use_view_file_help"
               name='use_view_file'
               value='{{old("use_view_file",$post->use_view_file)}}'>
        <small id="blog_use_view_file_help" class="form-text text-muted">{{__('messages.custom_view_file_help')}}
            <code>view("custom_blog_posts." . $use_view_file)</code>.
        </small>
    </div>
@endif



<div class="form-group">
    <label for="blog_seo_title">{{__('messages.tags')}}</label>
    <input class="form-control" id="blog_seo_title" aria-describedby="blog_seo_title_help"
              name='seo_title' tyoe='text' value='{{old("seo_title",$post->seo_title)}}' >
    <small id="blog_seo_title_help" class="form-text text-muted">{{trans('messages.tags_help')}}</small>
</div>

<div class="form-group">
    <label for="blog_meta_desc">{{__('messages.meta_desc')}}</label>
    <textarea class="form-control" id="blog_meta_desc" aria-describedby="blog_meta_desc_help"
              name='meta_desc'>{{old("meta_desc",$post->meta_desc)}}</textarea>
    <small id="blog_meta_desc_help" class="form-text text-muted">{{__('messages.optional')}}</small>
</div>

<div class="form-group">
    <label for="blog_short_description">{{__('messages.short_desc')}}</label>
    <textarea class="form-control" id="blog_short_description" aria-describedby="blog_short_description_help"
              name='short_description'>{{old("short_description",$post->short_description)}}</textarea>
    <small id="blog_short_description_help" class="form-text text-muted">{{__('messages.short_desc_help')}} {{__('messages.optional')}}</small>
</div>

@if(config("blogetc.image_upload_enabled",true))

    <div class='bg-white pt-4 px-4 pb-0 my-2 mb-4 rounded border'>
        <style>
            .image_upload_other_sizes {
                display: none;
            }
        </style>
        <h4>{{trans('messages.featured_images')}}</h4>


        @foreach(config("blogetc.image_sizes") as $size_key =>$size_info)
            <div class="form-group mb-4 p-2
        @if($loop->iteration>1)
                    image_upload_other_sizes
            @endif
                    ">
                @if($post->has_image($size_info['basic_key']))
                    <div style='max-width:55px;  ' class='float-right m-2'>
                        <a style='cursor: zoom-in;' target='_blank' href='{{$post->image_url($size_info['basic_key'])}}'>
                            <?=$post->image_tag($size_info['basic_key'], false, 'd-block mx-auto img-fluid '); ?>
                        </a>
                    </div>
                @endif

                <label for="blog_{{$size_key}}">{{trans('messages.image')}} - {{$size_info['name']}} ({{trans('messages.optional')}})</label>
                <small id="blog_{{$size_key}}_help" class="form-text text-muted">Upload {{$size_info['name']}} image -
                </small>
                <input class="form-control" type="file" name="{{$size_key}}" id="blog_{{$size_key}}"
                       aria-describedby="blog_{{$size_key}}_help">


            </div>
        @endforeach

        <p>
            <code>{{__('messages.auto_size_image_help')}}</code>

            <span onclick='$(this).parent().hide(); $(".image_upload_other_sizes").slideDown()'
                                           class='btn btn-light btn-sm'>{{trans('messages.more_size')}}</span>
        </p>

    </div>
@else
    <div class='alert alert-warning'>Image uploads were disabled in blogetc.php config</div>
@endif


<div class='bg-white pt-4 px-4 pb-0 my-2 mb-4 rounded border'>
    <h4>{{trans('messages.categories')}}</h4>
    <div class='row'>

        @forelse(\WebDevEtc\BlogEtc\Models\BlogEtcCategory::orderBy("category_name","asc")->limit(1000)->get() as $category)
            <div class="form-check col-sm-6">
                <input class="" type="checkbox" value="1"
                       @if(old("category.".$category->id, $post->categories->contains($category->id))) checked='checked'
                       @endif name='category[{{$category->id}}]' id="category_check{{$category->id}}">
                <label class="form-check-label" for="category_check{{$category->id}}">
                    {{$category->category_name}}
                </label>
            </div>
        @empty
            <div class='col-md-12'>
                {{trans('messages.no_categories')}}
            </div>
        @endforelse

        <div class='col-md-12 my-3 text-center'>

            <em><a target='_blank' href='{{route("blogetc.admin.categories.create_category")}}'><i class="icon-square-up-right" aria-hidden="true"></i>
                     {{trans('messages.add_new_category')}}</a></em>
        </div>
    </div>
</div>

