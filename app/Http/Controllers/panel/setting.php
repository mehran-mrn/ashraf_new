<?php

namespace App\Http\Controllers\panel;

use App\bank;
use App\gateway;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class setting extends Controller
{
    //

    public function gateway_add(Request $request)
    {

        $this->validate($request, [
            'merchant' => 'required|min:3|numeric',
            'public_key' => 'required|min:3',
            'terminal_id' => '',
            'filepath' => 'required',
        ]);
        $file_id = get_file_id($request['filepath']);
        gateway::create([
            "bank_id" => $request['name'],
            "account_number" => $request['account_number'],
            "account_sheba" => $request['account_sheba'],
            "bank_branch" => $request['bank_branch'],
            "card_number" => $request['card_number'],
            "status" => $request['status'],
            "merchant" => $request['merchant'],
            "public_key" => $request['public_key'],
            "terminal_id" => $request['terminal_id'],
            "logo" => $request['filepath'],
            "logo_id" => $file_id,
        ]);
        $message = trans("messages.item_created", ['item' => trans('messages.gateway')]);
        return back_normal($request,$message);
    }

    public function gateway_delete(Request $request)
    {
        $gateway = gateway::find($request['gateway_id']);
        $gateway->delete();
        $message = trans("messages.item_deleted", ['item' => trans('messages.gateway')]);
        return back_normal($request,$message);

    }
}
