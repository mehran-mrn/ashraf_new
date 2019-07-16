<?php

namespace App\Http\Controllers\panel;

use App\gateway;
use App\Http\Controllers\Controller;
use App\setting_transportation;
use Illuminate\Http\Request;

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

    public function setting_how_to_send_add(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'time' => 'required',
        ]);
        setting_transportation::create([
            'title' => $request['title'],
            'time' => $request['time'],
            'status' => $request['status'],
        ]);

        return back_normal($request, "OK");
    }
}
