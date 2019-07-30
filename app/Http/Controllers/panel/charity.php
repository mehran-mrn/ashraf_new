<?php

namespace App\Http\Controllers\panel;

use App\charity_payment_title;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class charity extends Controller
{
    public function charity_payment_title_add($payment_pattern_id=null,Request $request){
        $this->validate($request, [
            'payment_pattern_id' => 'required|exists:charity_payment_paterns,id',
            'payment_title_id' => 'nullable|exists:charity_payment_titles,id',
            'title' => 'required|max:150',
        ]);
        if ($request['payment_title_id']){
            $payment_title = charity_payment_title::find($request['payment_title_id']);
        }
        else{
            $payment_title = new charity_payment_title();
            $payment_title->ch_pay_pattern_id=$request['payment_pattern_id'];
        }
        $payment_title->title=$request['title'];
        $payment_title->save();
        return back_normal($request);
    }
    public function charity_payment_title_delete($payment_pattern_id,$payment_title_id,Request $request){
        $payment_title =charity_payment_title::where('id',$payment_title_id)->where('ch_pay_pattern_id',$payment_pattern_id)->delete();
        return back_normal($request);
    }
    public function charity_payment_title_recover($payment_pattern_id,$payment_title_id,Request $request){
        $payment_title =charity_payment_title::withTrashed()->where('id',$payment_title_id)->where('ch_pay_pattern_id',$payment_pattern_id)->restore();
        return back_normal($request);
    }

}
