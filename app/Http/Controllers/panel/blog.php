<?php

namespace App\Http\Controllers\panel;

use App\blog_categories;
use App\blog_tag;
use App\category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Image;

class blog extends Controller
{
    //

    public function category_add(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:categories',
        ]);
        category::create([
            'title' => $request->title
        ]);
        $message = trans("messages.item_created", ['item' => trans('messages.category')]);
        return back_normal($request, $message);
    }

    public function add_post_store(Request $request)
    {

        $this->validate($request, [
            'image' => 'bail|image|mimes:jpeg,png,jpg,gif|max:5000|dimensions:min_width=200,min_height=100',
            'title'=>'required|min:3',
            'text'=>'required|min:3',
            'slug'=>'required|min:3'
        ]);
        $image_id = image_saver($request['image'],"blog","blog");
        if(isset($image_id)){
            $blog_info = \App\blog::create([
                'title'=>$request['title'],
                'slug'=>$request['slug'],
                'text'=>$request['text'],
                'description'=>$request['description'],
                'image'=>$image_id,
                'publish_time'=>$request['publish_time'],
                'publish_status'=>$request['publish_status'],
                'user_id'=>Auth::id()
            ]);
            $tags = explode(',',$request['tags']);
            foreach ($tags as $tag){
                blog_tag::create([
                    'blog_id'=>$blog_info['id'],
                    'tag'=>trim($tag),
                ]);
            }
            foreach ($request['cats'] as $cat){
                blog_categories::create([
                    'blog_id'=>$blog_info['id'],
                    'category_id'=>$cat
                ]);
            }
        }

        $message = trans("messages.item_created", ['item' => trans('messages.post')]);
        return back_normal($request, $message);

    }



}
