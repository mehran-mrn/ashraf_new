<?php

namespace App\Http\Controllers\panel;

use App\charity_payment_field;
use App\charity_payment_patern;
use App\charity_payment_title;
use App\charity_period;
use App\charity_periods_transaction;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class charity extends Controller
{
    public function charity_payment_title_add($payment_pattern_id = null, Request $request)
    {
        $this->validate($request, [
            'payment_pattern_id' => 'required|exists:charity_payment_paterns,id',
            'payment_title_id' => 'nullable|exists:charity_payment_titles,id',
            'title' => 'required|max:150',
        ]);
        if ($request['payment_title_id']) {
            $payment_title = charity_payment_title::find($request['payment_title_id']);
        } else {
            $payment_title = new charity_payment_title();
            $payment_title->ch_pay_pattern_id = $request['payment_pattern_id'];
        }
        $payment_title->title = $request['title'];
//        $payment_title->type="online";
        $payment_title->save();
        return back_normal($request);
    }

    public function charity_payment_title_delete($payment_pattern_id, $payment_title_id, Request $request)
    {
        $payment_title = charity_payment_title::where('id', $payment_title_id)->where('ch_pay_pattern_id', $payment_pattern_id)->delete();
        return back_normal($request);
    }

    public function charity_payment_title_recover($payment_pattern_id, $payment_title_id, Request $request)
    {
        $payment_title = charity_payment_title::withTrashed()->where('id', $payment_title_id)->where('ch_pay_pattern_id', $payment_pattern_id)->restore();
        return back_normal($request);
    }

    public function charity_payment_pattern_add($payment_pattern_id = null, Request $request)
    {
        $this->validate($request, [
            'payment_pattern_id' => 'nullable|exists:charity_payment_paterns,id',
            'title' => 'required|max:150',
        ]);
        if ($request['payment_pattern_id']) {
            $payment_pattern = charity_payment_patern::find($request['payment_pattern_id']);
        } else {
            $payment_pattern = new charity_payment_patern();
        }
        $payment_pattern->title = $request['title'];
        $payment_pattern->description = $request['description'];
        $payment_pattern->min = $request['min'] or null;
        $payment_pattern->max = $request['max'] or null;
        $payment_pattern->type = "vow";
        $payment_pattern->save();

        $old_ids = [];
        if ($request['new_field_id']) {
            foreach ($request['new_field_id'] as $key => $field_id) {
                $old_ids[] = $field_id;
            };
        };
        charity_payment_field::where('ch_pay_pattern_id', $payment_pattern['id'])
            ->whereNotIn('id', $old_ids)->delete();

        if ($request['new_field_title']) {
            foreach ($request['new_field_title'] as $key => $title) {
                if ($title) {
                    if ($request['new_field_id'][$key]) {
                        $payment_field = charity_payment_field::find($request['new_field_id'][$key]);
                    } else {
                        $payment_field = new charity_payment_field();
                    }
                    $payment_field->label = $title;
                    $payment_field->type = $request['field_type'][$key];
                    $payment_field->require = $request['field_requirement'][$key];
                    $payment_field->ch_pay_pattern_id = $payment_pattern['id'];
                    $payment_field->save();
                }
            }
        }

        return back_normal($request);
    }

    public function charity_payment_pattern_delete($payment_pattern_id, Request $request)
    {
        charity_payment_patern::where('id', $payment_pattern_id)->where('system', 0)->delete();
        return back_normal($request);
    }

    public function charity_periods_show(Request $request)
    {
        $paymentList = charity_periods_transaction::where(
            [
                ['period_id', '=', $request['id']],
                ['user_id', '=', $request['user_id']]
            ])
            ->get();
        $periodInfo = charity_period::find($request['id']);
        $userInfo = User::find($request['user_id']);
        return view('panel.charity.pages.show', compact('paymentList', 'userInfo', 'periodInfo'));
    }

    public function charity_payment_approve(Request $request)
    {
        $charity = charity_periods_transaction::find($request['id']);
        if ($charity) {
            $charity->review = 'approved';
            $charity->review_datetime = date("Y-m-d H:i:s");
            $charity->review_user_id = \Auth::id();
            $charity->save();
            $message = trans('messages.payment_approved');
            return back_normal($request, $message);
        }
    }
}
