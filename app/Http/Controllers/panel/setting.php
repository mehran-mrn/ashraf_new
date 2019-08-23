<?php

namespace App\Http\Controllers\panel;

use App\blog_option;
use App\gateway;
use App\Http\Controllers\Controller;
use App\setting_transportation;
use App\setting_transportation_cost;
use Illuminate\Http\Request;
use Image;


class setting extends Controller
{
    //

    public function gateway_add(Request $request)
    {

        $this->validate($request, [
            'title' => 'required',
//            'logo' => 'required',
        ]);
//        $file_id = get_file_id($request['filepath']);
        gateway::create([
            "title" => $request['title'],
            "bank_id" => $request['name'],
            "account_number" => $request['account_number'],
            "account_sheba" => $request['account_sheba'],
            "bank_branch" => $request['bank_branch'],
            "card_number" => str_replace("-", "", $request['card_number']),
            "status" => $request['status'],
            "merchant" => $request['merchant'],
            "public_key" => $request['public_key'],
            "terminal_id" => $request['terminal_id'],
            "private_key" => $request['private_key'],
            "username" => $request['username'],
            "password" => $request['password'],
//            "logo" => $request['logo'],
            "online" => $request['pay_online'],
            "account" => $request['pay_account'],
            "cart" => $request['pay_cart'],
//            "logo_id" => $file_id,
        ]);
        $message = trans("messages.item_created", ['item' => trans('messages.gateway')]);
        return back_normal($request, $message);
    }

    public function gateway_update(Request $request)
    {

        $this->validate($request, [
            'title' => 'required',
//            'logo' => 'required',
        ]);
//        $file_id = get_file_id($request['filepath']);
        gateway::where('id', $request['gat_id'])->update([
            "title" => $request['title'],
            "bank_id" => $request['name'],
            "account_number" => $request['account_number'],
            "account_sheba" => $request['account_sheba'],
            "bank_branch" => $request['bank_branch'],
            "card_number" => str_replace("-", "", $request['card_number']),
            "status" => $request['status'],
            "merchant" => $request['merchant'],
            "public_key" => $request['public_key'],
            "terminal_id" => $request['terminal_id'],
            "private_key" => $request['private_key'],
            "username" => $request['username'],
            "password" => $request['password'],
//            "logo" => $request['logo'],
            "online" => $request['pay_online'],
            "account" => $request['pay_account'],
            "cart" => $request['pay_cart'],
//            "logo_id" => $file_id,
        ]);
        $message = trans("messages.item_edited", ['item' => trans('messages.gateway')]);
        return back_normal($request, $message);
    }

    public function gateway_delete(Request $request)
    {
        $gateway = gateway::find($request['gateway_id']);
        $gateway->delete();
        $message = trans("messages.item_deleted", ['item' => trans('messages.gateway')]);
        return back_normal($request, $message);
    }

    public function setting_how_to_send_store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'time' => 'required',
        ]);
        $trans_info = setting_transportation::create([
            'title' => $request['title'],
            'time' => $request['time'],
            'status' => $request['status'],
        ]);
        $trans_id = $trans_info->id;
        foreach ($request->all() as $item => $value) {
            if ((strpos($item, "city_") !== false) && $value != "") {
                $pro_id = explode("_", $item);
                setting_transportation_cost::create([
                    't_id' => $trans_id,
                    'c_id' => $pro_id[1],
                    'cost' => str_replace(",", '', $value)
                ]);
            }
        }

        $message = trans("messages.item_created", ['item' => trans('messages.transportation')]);

        return back_normal($request, $message);
    }

    public function setting_how_to_send_delete(Request $request)
    {

        $t = setting_transportation::find($request['t_id']);
        $t->deleteAll();
        $message = trans("messages.item_deleted", ['item' => trans('messages.transportation')]);
        return back_normal($request, $message);
    }

    public function setting_how_to_send_update(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'time' => 'required',
        ]);
        setting_transportation::where('id', $request['t_id'])->update([
            'title' => $request['title'],
            'time' => $request['time'],
            'status' => $request['status'],
        ]);
        $trans_id = $request['t_id'];
        setting_transportation_cost::where('t_id', $trans_id)->delete();
        foreach ($request->all() as $item => $value) {
            if ((strpos($item, "city_") !== false) && $value != "") {
                $pro_id = explode("_", $item);
                setting_transportation_cost::create([
                    't_id' => $trans_id,
                    'c_id' => $pro_id[1],
                    'cost' => str_replace(",", '', $value)
                ]);
            }
        }

        $message = trans("messages.item_updated", ['item' => trans('messages.transportation')]);

        return back_normal($request, $message);
    }

    public function submit_display_statistics(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'icon' => 'required',
            'value' => 'required',
        ]);
        $value = [
            'title'=>$request['title'],
            'icon'=>$request['icon'],
            'value'=>$request['value'],
        ];
        if (!empty($request['option_id'])){
            $option = blog_option::find($request['option_id']);
        }
        else{
            $option = new blog_option();
        }
        $option->name = 'display_statistic';
        $option->key = $request['title'];
        $option->value = json_encode($value);
        $option->json = true;
        $option->save();

        $message = trans("messages.item_updated", ['item' => trans('messages.display_statistics')]);
        return back_normal($request, $message);
    }

    public function delete_display_statistics($option_id ,Request $request)
    {
        $option = blog_option::find($option_id);

        if ($option != 'display_statistic'){
            $errors[]='invalid';
        }
        $option->delete();

        $message = trans("messages.item_deleted", ['item' => trans('messages.display_statistics')]);
        return back_normal($request, $message);
    }

    public function submit_adv_bar(Request $request)
    {
        if (!empty($request['option_id'])){
            $option = blog_option::find($request['option_id']);
            $this->validate($request, [
                'link' => 'required',
            ]);
        }
        else{
            $option = new blog_option();
            $this->validate($request, [
                'link' => 'required',
                'image' => 'required|image|dimensions:ratio=5/3|mimes:jpeg,png,jpg,gif,svg|max:512',
            ]);
        }

        if (!empty($request['image'])){
            $image = $request['image'];
            $destinationPath = 'public/assets/global/images/adv';
            $image_name = mt_rand() . time() . '.' . $image->getClientOriginalExtension();
            $image->move($destinationPath, $image_name);
            $img = Image::make($destinationPath.'/'.$image_name)->resize(200, 120);
            $img->save($destinationPath.'/'.$image_name);

            $value = [
                'link'=>$request['link'],
                'image'=>$destinationPath.'/'.$image_name,
            ];
        }
        else{
            $value = [
                'link'=>$request['link'],
                'image'=>json_decode($option['value'],true)['image'],
            ];
        }

        $option->name = 'adv_bar';
        $option->key = $request['link'];
        $option->value = json_encode($value);
        $option->json = true;
        $option->save();

        $message = trans("messages.item_updated", ['item' => trans('messages.adv_bar')]);
        return back_normal($request, $message);
    }

    public function delete_adv_bar($option_id ,Request $request)
    {
        $option = blog_option::find($option_id);

        if ($option != 'adv_bar'){
            $errors[]='invalid';
        }
        $option->delete();

        $message = trans("messages.item_deleted", ['item' => trans('messages.adv_bar')]);
        return back_normal($request, $message);
    }

    public function submit_adv_card(Request $request)
    {
        $this->validate($request, [
            'link' => 'required',
        ]);

        if (!empty($request['option_id'])){
            $option = blog_option::find($request['option_id']);
            $old_image =json_decode($option['value'],true)['image'];
            $old_title =json_decode($option['value'],true)['title'];
        }
        else{
            $option = new blog_option();
        }
        $title = "";
        if (!empty($request['title'])){
            $title = $request['title'];

        }
        elseif(isset($old_title)){
            $title = $old_title;

        }
        else{
            $title = "";

        }
        if (!empty($request['image'])){
            $image = $request['image'];
            $destinationPath = 'public/assets/global/images/adv';
            $image_name = mt_rand() . time() . '.' . $image->getClientOriginalExtension();
            $image->move($destinationPath, $image_name);
            $value = [
                'title'=>$title,
                'link'=>$request['link'],
                'image'=>$destinationPath.'/'.$image_name
            ];
        }
        else{
            $value = [
                'title'=>$title,
                'link'=>$request['link'],
                'image'=>(isset($old_image)?$old_image:"")
            ];
        }

        $option->name = 'adv_card';
        $option->key = $request['link'];
        $option->value = json_encode($value);
        $option->json = true;
        $option->save();

        $message = trans("messages.item_updated", ['item' => trans('messages.adv_card')]);
        return back_normal($request, $message);
    }

    public function delete_adv_card($option_id ,Request $request)
    {
        $option = blog_option::find($option_id);

        if ($option != 'adv_card'){
            $errors[]='invalid';
        }
        $option->delete();

        $message = trans("messages.item_deleted", ['item' => trans('messages.adv_card')]);
        return back_normal($request, $message);
    }
}
