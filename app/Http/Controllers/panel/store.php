<?php

namespace App\Http\Controllers\panel;

use App\discount_code;
use App\Http\Controllers\Controller;
use App\product_category;
use App\store_category;
use App\store_discount_code;
use App\store_item;
use App\store_item_category;
use Illuminate\Http\Request;

class store extends Controller
{
    //

    public function discount_add(Request $request)
    {

//        return $request->all();
        \Illuminate\Support\Facades\Validator::extend('valid_discount_code', function ($attr, $value) {
            return preg_match('/^\S*$/u', $value);
        });
        $request['expire_date'] = shamsi_to_miladi(latin_num($request['expire_date']));
        $this->validate($request,
            [
                "discount_code" => 'required|valid_discount_code|min:3|unique:store_discount_codes,code',
                'expire_date' => 'required',
                'discount_persent' => 'required|numeric|min:1|digits_between:1,100',
                'discount_max' => 'required|numeric|min:2|digits_between:1,1000000000',
                'count' => 'required|numeric|min:1|digits_between:1,100000',
                'usage_count' => 'required|numeric|min:1|digits_between:1,100',
            ]);
        store_discount_code::create([
            'code' => $request['discount_code'],
            'expire_date' => $request['expire_date'],
            'discount_persent' => $request['discount_persent'],
            'max_discount' => $request['discount_max'],
            'count' => $request['count'],
            'usage_count' => $request['usage_count'],
        ]);
        $message = trans("messages.item_created", ['item' => trans('messages.discount_code')]);
        return back_normal($request, $message);
    }

    public function discount_code_update(Request $request)
    {

        \Illuminate\Support\Facades\Validator::extend('valid_discount_code', function ($attr, $value) {
            return preg_match('/^\S*$/u', $value);
        });
        $request['expire_date'] = shamsi_to_miladi(latin_num($request['expire_date']));
        $this->validate($request,
            [
//                "discount_code" => 'required|valid_discount_code|min:3',
                'expire_date' => 'required',
                'discount_persent' => 'required|numeric|min:1|digits_between:1,100',
                'discount_max' => 'required|numeric|min:2|digits_between:1,1000000000',
                'count' => 'required|numeric|min:1|digits_between:1,100000',
                'usage_count' => 'required|numeric|min:1|digits_between:1,100',
            ]);
        store_discount_code::where(
            "id", $request['dis_id'])->update([
//            'code' => $request['discount_code'],
            'expire_date' => $request['expire_date'],
            'discount_persent' => $request['discount_persent'],
            'max_discount' => $request['discount_max'],
            'count' => $request['count'],
            'usage_count' => $request['usage_count'],
        ]);
        $message = trans("messages.item_edited", ['item' => trans('messages.discount_code')]);
        return back_normal($request, $message);


    }

    public function discount_code_delete(Request $request)
    {
        $dis_info = store_discount_code::find($request['dis_id']);
        $dis_info->delete();
        $message = trans("messages.discount_code_delete");
        return back_normal($request, $message);
    }

    public function discount_code_check(Request $request)
    {
        if (store_discount_code::where('code', $request['discount_code'])->exists()) {
            echo "false";
        } else {
            echo "true";
        }
    }

    public function store_category_add(Request $request)
    {
        $this->validate($request,
            [
                'title' => 'required|min:2|unique:store_categories,title',
                'filepath' => 'required',
            ]);
        store_category::create([
            'title' => $request['title'],
            'description' => $request['description'],
            'icon_id' => get_file_id($request['filepath']),
            'icon' => $request['filepath'],
        ]);
        $message = trans("messages.item_added", ['item' => trans('messages.category')]);
        return back_normal($request, $message);
    }

    public function store_category_update(Request $request)
    {
        $this->validate($request,
            [
                'title' => 'required|min:2|unique:store_categories,title',
//            'filepath' => 'required',
            ]);
        store_category::where('id', $request['cat_id'])->update([
            'title' => $request['title'],
            'description' => $request['description'],
//            'icon_id' => get_file_id($request['filepath']),
//            'icon' => $request['filepath'],
        ]);
        $message = trans("messages.item_updated", ['item' => trans('messages.category')]);
        return back_normal($request, $message);
    }

    public function store_category_check(Request $request)
    {
        if (store_category::where('title', $request['title'])->exists()) {
            echo "false";
        } else {
            echo "true";
        }
    }

    public function store_category_delete(Request $request)
    {
        $car = store_category::find($request['cat_id']);
        $car->delete();
        $message = trans("messages.category_delete");
        return back_normal($request, $message);

    }

    public function store_product_add(Request $request)
    {
        dd($request->all());
    }

    public function store_items_add(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:1',
            'category_id' => 'required|min:1'
        ]);
        store_item::create(
            [
                'title' => $request['title'],
                'prefix' => $request['prefix'],
                'suffix' => $request['suffix'],
                'description' => $request['description'],
                'category_id' => $request['category_id'],
            ]);
        $message = trans("messages.added", ['item' => trans('messages.item')]);
        return back_normal($request, $message);
    }

    public function store_items_update(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:1',
            'category_id' => 'required|min:1'
        ]);
        store_item::where('id', $request['item_id'])->update(
            [
                'title' => $request['title'],
                'prefix' => $request['prefix'],
                'suffix' => $request['suffix'],
                'description' => $request['description'],
                'category_id' => $request['category_id'],
            ]
        );
        $message = trans("messages.updated", ['item' => trans('messages.item')]);
        return back_normal($request, $message);
    }

    public function store_item_delete(Request $request)
    {
        $item = store_item::find($request['item_id']);
        $item->delete();
        $message = trans("messages.deleted", ['item' => trans('messages.item')]);
        return back_normal($request, $message);
    }

    public function store_items_category_add(Request $request)
    {
        store_item_category::create(
            [
                'title' => $request['title']
            ]
        );
        $message = trans("messages.added", ['item' => trans('messages.category')]);
        return back_normal($request, $message);
    }

    public function store_items_category_delete(Request $request)
    {
        $item_category = store_item_category::find($request['cat_id']);
        $item_category->deleteAllItems();
    }

}
