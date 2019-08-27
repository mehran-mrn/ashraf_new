<script>
    SHOULD_AUTO_GEN_SLUG = false;

    function populate_slug_field() {
        var cat_slug = document.getElementById('category_slug');
        if (cat_slug.value.length < 1) {
            SHOULD_AUTO_GEN_SLUG = true;
        }
        if (SHOULD_AUTO_GEN_SLUG) {
            cat_slug.value = document.getElementById("category_category_name").value.toLowerCase()
                .replace(/[_ ]+/g, '-') // replace _ and spaces with -
                .substring(0, 99); // limit str length

        }

    }
</script>
<div class="row">
    <div class="col-12 col-md-6">
        <div class="form-group">
            <label for="category_category_name">{{trans('messages.category_name')}}</label>
            <input type="text"
                   class="form-control"
                   id="category_category_name"
                   oninput="populate_slug_field();"
                   required
                   aria-describedby="category_category_name_help"
                   name='category_name'
                   value="{{old("category_name",$category->category_name)}}">
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="form-group">
            <label for="category_slug">{{trans('messages.slug')}}</label>
            <input
                    maxlength='100'
                    type="text"
                    required
                    class="form-control"
                    id="category_slug"
                    oninput="SHOULD_AUTO_GEN_SLUG=false;"
                    aria-describedby="category_slug_help"
                    name='slug'
                    value="{{old("slug",$category->slug)}}"
            >

            <small id="category_slug_help" class="form-text text-muted">
                Letters, numbers, dash only. The slug
                i.e. {{route("blogetc.view_category","")}}/<u><em>this_part</em></u>. This must be unique (two
                categories
                can't
                share the same slug).

            </small>
        </div>
    </div>
    <div class="col-12 col-md-12">
        <div class="form-group">
            <label for="category_description">{{trans('messages.description')}} - ({{trans('messages.optional')}}
                )</label>
            <textarea name='category_description'
                      class='form-control'
                      id='category_description'>{{old("category_description",$category->category_description)}}</textarea>

        </div>
    </div>
    <div class="col-12 col-md-12">
        <div class="form-group">
            <label for="lang">{{__('messages.language')}}</label>
            <select name="lang" id="lang" class="form-control">
                <option value="fa">FA</option>
                <option value="en">EN</option>
                <option value="ar">AR</option>
            </select>
        </div>
    </div>
</div>

<script>
    if (document.getElementById("category_slug").value.length < 1) {
        SHOULD_AUTO_GEN_SLUG = true;
    } else {
        SHOULD_AUTO_GEN_SLUG = false; // there is already a value in #category_slug, so lets pretend it was changed already.
    }
</script>
