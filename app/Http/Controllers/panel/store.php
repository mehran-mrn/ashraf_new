<?php

namespace App\Http\Controllers\panel;

use App\discount_code;
use App\Http\Controllers\Controller;
use App\product_category;
use App\store_category;
use App\store_discount_code;
use App\store_item;
use App\store_item_category;
use App\store_product;
use App\store_product_category;
use App\store_product_gateway;
use App\store_product_image;
use App\store_product_inventory;
use App\store_product_inventory_size;
use App\store_product_item;
use App\store_product_tag;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $this->validate($request,
            [
                'title' => 'required|min:1',
                'slug' => 'required|min:1|unique:store_products,slug',
                'description' => 'required|min:1',
                'filepath' => 'required',
            ]);
        $mainFileID = get_file_id($request['filepath']);
        $product_info = store_product::create([
            'title' => $request['title'],
            'slug' => $request['slug'],
            'description' => $request['description'],
            'properties' => $request['properties'],
            'main_image' => $request['filepath'],
            'main_image_id' => $mainFileID,
            'price' => 0,
            'off' => 0,
            'ready' => $request['ready'] OR 1
        ]);
        $product_id = $product_info->id;

        if ($request['inv_type'] == "bycolor") {
            if (isset($request['color-name']) && sizeof($request['color-name']) >= 1) {
                foreach ($request['color-name'] as $item => $val) {
                    $colorInfo = store_product_inventory::create(
                        [
                            'product_id' => $product_id,
                            'color_code' => trim($val[0]),
                            'count' => trim($val[1]),
                            'price' => str_replace(",", "", trim($val[2])),
                            'off' => trim($val[3]),
                            'type' => 'p',
                            'user_id' => Auth::id(),
                        ]
                    );
                    $colorID = $colorInfo->id;
                    if (isset($request['size'][$item]) && sizeof($request['size'][$item]) >= 1) {
                        foreach ($request['size'][$item] as $valSize) {
                            $off = 0;
                            if (isset($valSize[3])) {
                                $off = $valSize[3];
                            }
                            store_product_inventory_size::create([
                                'size' => trim($valSize[0]),
                                'count' => trim($valSize[2]),
                                'price' => str_replace(",", "", $valSize[3]),
                                'off' => trim($off),
                                'inventory_id' => $colorID,
                                'product_id' => $product_id,
                            ]);
                        }
                    }
                }
            }
        } elseif ($request['inv_type'] == "withoutcolor") {
            $colorInfo = store_product_inventory::create(
                [
                    'product_id' => $product_id,
                    'count' => $request['inventories'],
                    'price' => str_replace(",", "", $request['price']),
                    'off' => $request['off'],
                    'type' => 'p',
                    'user_id' => Auth::id(),
                ]
            );
            $colorID = $colorInfo->id;
            if (isset($request['size']) && sizeof($request['size']) >= 1) {
                foreach ($request['size'] as $valSize) {
                    $off = 0;
                    if (isset($valSize[3])) {
                        $off = $valSize[3];
                    }
                    store_product_inventory_size::create([
                        'size' => trim($valSize[0]),
                        'count' => trim($valSize[1]),
                        'price' => str_replace(",", "", $valSize[2]),
                        'off' => trim($off),
                        'inventory_id' => $colorID,
                        'product_id' => $product_id
                    ]);
                }
            }
        }
        if ($request['tags'] != "") {
            $tags = explode(',', $request['tags']);
            if (sizeof($tags) >= 1) {
                foreach ($tags as $tag) {
                    store_product_tag::create([
                        'product_id' => $product_id,
                        'tag' => $tag
                    ]);
                }
            }
        }
        if (sizeof($request['cats']) >= 1) {
            foreach ($request['cats'] as $cat) {
                store_product_category::create(
                    [
                        'product_id' => $product_id,
                        'category_id' => $cat
                    ]
                );
            }
        }
        if (sizeof($request['items_id']) >= 1) {
            foreach ($request['items_id'] as $item) {
                store_product_item::create(
                    [
                        "product_id" => $product_id,
                        "item_id" => $item,
                        'value' => $request['items_' . $item]
                    ]
                );
            }
        }

        if (isset($request['pay_online'])) {
            if (is_array($request['online_gateway_online']) AND sizeof($request['online_gateway_online']) >= 1) {
                foreach ($request['online_gateway_online'] as $item) {
                    store_product_gateway::create(
                        [
                            'product_id' => $product_id,
                            'gateway_id' => $item,
                            'type' => 'online'
                        ]
                    );
                }
            }
        }

        if (isset($request['pay_cart'])) {
            if (is_array($request['online_gateway_cart']) AND sizeof($request['online_gateway_cart']) >= 1) {
                foreach ($request['online_gateway_cart'] as $item) {
                    store_product_gateway::create(
                        [
                            'product_id' => $product_id,
                            'gateway_id' => $item,
                            'type' => 'cart'
                        ]
                    );
                }
            }
        }
        if (isset($request['pay_account'])) {
            if (is_array($request['online_gateway_account']) AND sizeof($request['online_gateway_account']) >= 1) {
                foreach ($request['online_gateway_account'] as $item) {
                    store_product_gateway::create(
                        [
                            'product_id' => $product_id,
                            'gateway_id' => $item,
                            'type' => 'account'
                        ]
                    );
                }
            }
        }
        if (isset($request['pay_place'])) {
            store_product_gateway::create(
                [
                    'product_id' => $product_id,
                    'gateway_id' => "0",
                    'type' => 'place'
                ]
            );
        }

//        if (sizeof($request['image']) >= 1) {
//            foreach ($request['image'] as $item) {
//                $file_id = file_saver($request['image']);
//                store_product_image::create(
//                    [
//                        'product_id' => $product_id,
//                        'media_id' => $file_id,
//                    ]
//                );
//            }
//        }

        $message = trans("messages.add", ['item' => trans('messages.product')]);
        return back_normal($request, $message);
    }

    public function store_product_delete(Request $request)
    {
        $product = store_product::find($request['pro_id']);
        $product_categories = store_product_category::where('product_id', $request['pro_id']);
        $product_gateway = store_product_gateway::where('product_id', $request['pro_id']);
        $product_image = store_product_image::where('product_id', $request['pro_id']);
        $product_in = store_product_inventory::where('product_id', $request['pro_id']);
        $product_in_size = store_product_inventory_size::where('product_id', $request['pro_id']);
        $product_item = store_product_item::where('product_id', $request['pro_id']);
        $product_tag = store_product_tag::where('product_id', $request['pro_id']);
        if (isset($product)) {
            $product->delete();
        }
        if (isset($product_categories)) {
            $product_categories->delete();
        }
        if (isset($product_gateway)) {
            $product_gateway->delete();
        }
        if (isset($product_image)) {
            $product_image->delete();
        }
        if (isset($product_in)) {
            $product_in->delete();
        }
        if (isset($product_in_size)) {
            $product_in_size->delete();
        }
        if (isset($product_item)) {
            $product_item->delete();
        }
        if (isset($product_tag)) {
            $product_tag->delete();
        }
        $message = trans("messages.item_deleted", ['item' => trans('messages.product')]);
        return back_normal($request, $message);
    }

    public function store_product_update(Request $request)
    {

        $this->validate($request,
            [
                'title' => 'required|min:1',
                'description' => 'required|min:1',
                'filepath' => 'required',
            ]);

        $mainFileID = get_file_id($request['filepath']);
        store_product::where('id', $request['pro_id'])->update([
            'title' => $request['title'],
            'description' => $request['description'],
            'properties' => $request['properties'],
            'main_image' => $request['filepath'],
            'main_image_id' => $mainFileID,
            'price' => $request['price'],
            'off' => $request['off'],
            'ready' => $request['ready'],
            'status' => $request['status']
        ]);

        $product_id = $request['pro_id'];
        if ($request['tags'] != "") {
            $tags = explode(',', $request['tags']);
            if (sizeof($tags) >= 1) {
                store_product_tag::where('product_id', $product_id)->forceDelete();
                foreach ($tags as $tag) {
                    store_product_tag::create([
                        'product_id' => $product_id,
                        'tag' => $tag
                    ]);
                }
            }
        }
        if (sizeof($request['cats']) >= 1) {
            store_product_category::where('product_id', $product_id)->forceDelete();
            foreach ($request['cats'] as $cat) {
                store_product_category::create(
                    [
                        'product_id' => $product_id,
                        'category_id' => $cat
                    ]
                );
            }
        }
        if (sizeof($request['items_id']) >= 1) {
            store_product_item::where('product_id', $product_id)->forceDelete();
            foreach ($request['items_id'] as $item) {
                store_product_item::create(
                    [
                        "product_id" => $product_id,
                        "item_id" => $item,
                        'value' => $request['items_' . $item]
                    ]
                );
            }
        }

        store_product_gateway::where('product_id', $product_id)->forceDelete();
        if (isset($request['pay_online'])) {
            if (sizeof($request['online_gateway_online']) >= 1) {
                foreach ($request['online_gateway_online'] as $item) {
                    store_product_gateway::create(
                        [
                            'product_id' => $product_id,
                            'gateway_id' => $item,
                            'type' => 'online'
                        ]
                    );
                }
            }
        }
        if (isset($request['pay_cart'])) {
            if (sizeof($request['online_gateway_cart']) >= 1) {
                foreach ($request['online_gateway_cart'] as $item) {
                    store_product_gateway::create(
                        [
                            'product_id' => $product_id,
                            'gateway_id' => $item,
                            'type' => 'cart'
                        ]
                    );
                }
            }
        }
        if (isset($request['pay_account'])) {
            if (sizeof($request['online_gateway_account']) >= 1) {
                foreach ($request['online_gateway_account'] as $item) {
                    store_product_gateway::create(
                        [
                            'product_id' => $product_id,
                            'gateway_id' => $item,
                            'type' => 'account'
                        ]
                    );
                }
            }
        }
        if (isset($request['pay_place'])) {
            store_product_gateway::create(
                [
                    'product_id' => $product_id,
                    'gateway_id' => "0",
                    'type' => 'place'
                ]
            );
        }

        $message = trans("messages.updated", ['item' => trans('messages.product')]);
        return back_normal($request, $message);
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
