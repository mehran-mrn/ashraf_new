<?php

namespace App\Http\Controllers\panel;

use App\blog_categories;
use App\blog_tag;
use App\category;
use App\blog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Image;

class blogs extends Controller
{
    //

    public function post_add_store(Request $request)
    {
        $request['publish_time'] = shamsi_to_miladi(latin_num($request['publish_time']));
        $this->validate($request, [
            'image' => 'bail|image|mimes:jpeg,png,jpg,gif|max:5000|dimensions:min_width=200,min_height=100',
            'title' => 'required|min:3',
            'text' => 'required|min:3',
            'slug' => 'required|min:3'
        ]);
        $image_id = image_saver($request['image'], "blog", "blog");
        if (isset($image_id)) {
            $blog_info = \App\blog::create([
                'title' => $request['title'],
                'slug' => $request['slug'],
                'text' => $request['text'],
                'description' => $request['description'],
                'image' => $image_id,
                'publish_time' => $request['publish_time'],
                'publish_status' => $request['publish_status'],
                'user_id' => Auth::id()
            ]);
            $tags = explode(',', $request['tags']);
            foreach ($tags as $tag) {
                blog_tag::create([
                    'blog_id' => $blog_info['id'],
                    'tag' => trim($tag),
                ]);
            }
            foreach ($request['cats'] as $cat) {
                blog_categories::create([
                    'blog_id' => $blog_info['id'],
                    'category_id' => $cat
                ]);
            }
        }

        $message = trans("messages.item_created", ['item' => trans('messages.post')]);
        return back_normal($request, $message);

    }

    public function post_update(Request $request)
    {

        $this->validate($request, [
            'image' => 'bail|image|mimes:jpeg,png,jpg,gif|max:5000|dimensions:min_width=200,min_height=100',
            'title' => 'required|min:3',
            'text' => 'required|min:3',
            'slug' => 'required|min:3'
        ]);
        \App\blog::where('id', $request['post_id'])->update(
            [
                'title' => $request['title'],
                'slug' => $request['slug'],
                'text' => $request['text'],
                'description' => $request['description'],
                'publish_time' => $request['publish_time'],
                'publish_status' => $request['publish_status'],
                'user_id' => Auth::id()
            ]
        );
        $post_tags = blog_tag::where('blog_id', $request['post_id'])->get();
        $tags = [];
        if ($request['tags'] != "") {
            $tags = explode(',', $request['tags']);
        }
        $tags_id = [];
        foreach ($tags as $tag) {
            if ($tag != "") {
                $con = true;
                foreach ($post_tags as $post_tag) {
                    if (trim($tag) == $post_tag['tag']) {
                        $con = false;
                        $tags_id[] = $post_tag['id'];
                    }
                }
                if ($con) {
                    $tag_info = blog_tag::create([
                        'blog_id' => $request['post_id'],
                        'tag' => trim($tag),
                    ]);
                    $tags_id[] = $tag_info['id'];
                }
            }
        }
        if (sizeof($tags_id) >= 1 || $request['tags'] == "") {
            blog_tag::whereNotIn('id', $tags_id)->delete();
        }
        $post_cats = blog_categories::where('blog_id', $request['post_id'])->get();
        $category_id = [];
        if (isset($request['cats'])) {
            foreach ($request['cats'] as $cat) {
                $con = true;
                foreach ($post_cats as $post_cat) {
                    if ($cat == $post_cat['category_id']) {
                        $con = false;
                        $category_id[] = $post_cat['id'];
                    }
                }
                if ($con) {
                    $cat_info = blog_categories::create([
                        'blog_id' => $request['post_id'],
                        'category_id' => $cat
                    ]);
                    $category_id[] = $cat_info['id'];
                }
            }
        }
        if (sizeof($category_id) >= 1 || !isset($request['cats'])) {
            blog_categories::whereNotIn('id', $category_id)->delete();
        }
        $message = trans("messages.item_created", ['item' => trans('messages.post')]);
        return back_normal($request, $message);
    }

    public function post_delete(Request $request)
    {
        $blog = blog::find($request['post_id']);
        $blog->deleteAll();
        $message = trans("messages.item_deleted", ['item' => trans('messages.post')]);
        return back_normal($request, $message);
    }

    //Category
    public function category_add(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:categories|min:2',
        ]);
        category::create([
            'title' => $request['title']
        ]);
        $message = trans("messages.item_created", ['item' => trans('messages.category')]);
        return back_normal($request, $message);
    }

    public function category_delete(Request $request)
    {
        $cat = category::find($request['id']);
        $cat->deleteAll();
        $message = trans("messages.item_deleted", ['item' => trans('messages.category')]);
        return back_normal($request, $message);
    }

    public function category_update(Request $request)
    {

        $this->validate($request, [
            'title' => 'required|min:2|unique:categories',
            'cat_id' => 'required',
        ]);
        category::where('id', $request['cat_id'])->update(["title" => $request['title']]);
        $message = trans("messages.item_updated", ['item' => trans('messages.category')]);
        return back_normal($request, $message);
    }
    //End Category

}
