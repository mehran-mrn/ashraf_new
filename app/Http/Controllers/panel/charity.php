<?php

namespace App\Http\Controllers\panel;

use App\charity_champion;
use App\charity_champions_projects;
use App\charity_champions_tags;
use App\charity_payment_field;
use App\charity_payment_patern;
use App\charity_payment_title;
use App\charity_period;
use App\charity_periods_transaction;
use App\gateway_transaction;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

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
        $min = 0;
        $max = 0;
        if ($request['min']) {
            $min = str_replace(',', '', $request['min']);
        }
        if ($request['max']) {
            $max = str_replace(',', '', $request['max']);
        }
        if ($request['payment_pattern_id']) {
            $payment_pattern = charity_payment_patern::find($request['payment_pattern_id']);
        } else {
            $payment_pattern = new charity_payment_patern();
        }
        $payment_pattern->title = $request['title'];
        $payment_pattern->description = $request['description'];
        $payment_pattern->min = $min;
        $payment_pattern->max = $max;
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
            ->with('gateway')->get();
        $periodInfo = charity_period::find($request['id']);
        $userInfo = User::find($request['user_id']);
        return view('panel.charity.period.show', compact('paymentList', 'userInfo', 'periodInfo'));
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

    public function charity_champion_add_store(Request $request)
    {
        $this->validate($request,
            [
                'title' => 'required|min:3|max:254|string',
                'start_date' => 'required',
                'end_date' => 'required',
                'target' => 'required',
                'small_description' => 'required|string',
                'file' => 'required',
                'status' => 'required'
            ]);
        $request['target'] = str_replace(',', '', $request['target']);
        $startDate = shamsi_to_miladi($request['start_date']);
        $endDate = shamsi_to_miladi($request['end_date']);
        $champion = charity_champion::create([
            'title' => $request['title'],
            'slug' => str_slug_persian($request['title']),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'target_amount' => $request['target'],
            'meta' => $request['meta_description'],
            'description_small' => $request['small_description'],
            'description' => $request['description']
        ]);
        if ($request['tags']) {
            $tags = explode(",", $request['tags']);
            foreach ($tags as $tag) {
                charity_champions_tags::create(
                    [
                        'champion_id' => $champion['id'],
                        'tag' => $tag
                    ]
                );
            }
        }
        if ($request['file']) {
            uploadGallery($request['file'], 'champion', ['category_id' => $champion['id'], 'title' => $request['title']]);
        }
        if ($request['projects']) {
            foreach ($request['projects'] as $project) {
                charity_champions_projects::create(
                    [
                        'champion_id' => $champion['id'],
                        'project_id' => $project
                    ]
                );
            }
        }
        $return = trans('messages.item_created');
        return back_normal($request, ['message' => $return, 'status' => 200]);
    }

    public function charity_champion_delete(Request $request)
    {
        if (isset($request['id']) && $champion = charity_champion::find($request['id'])) {
            $champion->status = 0;
            $champion->save();
            $return = trans('messages.item_deleted', ['item' => trans('messages.champion')]);
        } else {
            $return = __("messages.not_found_any_data");
        }
        return back_normal($request, $return);
    }

    public function charity_periods_delete(Request $request)
    {
        $charity = charity_period::find($request->id);
        $charity->forceDelete();
        return back_normal($request, __('messages.item_deleted'));
    }

    public function charity_periods_inactive(Request $request)
    {

        $charity = charity_period::find($request->id);
        if ($charity['status'] == "active") {
            $charity->status = 'inactive';
        } else {
            $charity->status = 'active';
        }
        $charity->save();
        return back_normal($request, __('messages.item_updated'));
    }

    public function charity_champion_update(Request $request)
    {
        $this->validate($request,
            [
                'title' => 'required|min:3|max:254|string',
                'start_date' => 'required',
                'end_date' => 'required',
                'target' => 'required',
                'small_description' => 'required|string',
                'file' => 'required',
                'status' => 'required'
            ]);
        $request['target'] = str_replace(',', '', $request['target']);
        $startDate = shamsi_to_miladi($request['start_date']);
        $endDate = shamsi_to_miladi($request['end_date']);
        $champion = charity_champion::find($request['id']);
        if ($champion['id']) {
            $champion->title = $request['title'];
            $champion->slug = str_slug_persian($request['title']);
            $champion->start_date = $startDate;
            $champion->end_date = $endDate;
            $champion->target_amount = $request['target'];
            $champion->meta = $request['meta_description'];
            $champion->description_small = $request['small_description'];
            $champion->description = $request['description'];
            $champion->save();
        }

        if ($request['tags']) {
            $tags = explode(",", $request['tags']);
            charity_champions_tags::where(
                [
                    ['champion_id', '=', $champion['id']],
                ]
            )->delete();
            foreach ($tags as $tag) {
                charity_champions_tags::create(
                    [
                        'champion_id' => $champion['id'],
                        'tag' => $tag
                    ]
                );
            }
        }
        if ($request['file']) {
            \App\media::where(
                [
                    ['category_id', '=', $champion['id']],
                    ['module', '=', 'champion']
                ]
            )->delete();
            uploadGallery($request['file'], 'champion', ['category_id' => $champion['id'], 'title' => $request['title']]);
        }
        if ($request['projects']) {
            foreach ($request['projects'] as $project) {
                charity_champions_projects::create(
                    [
                        'champion_id' => $champion['id'],
                        'project_id' => $project
                    ]
                );
            }
        }
        $return = trans('messages.item_created');
        return back_normal($request, ['message' => $return, 'status' => 200]);
    }

    public function reports(Request $request)
    {

        $explodeStart = str_replace("   ", " ", $request['start_date']);
        $explodeStart = explode(" ", $explodeStart);
        $date = explode("/", $explodeStart[0]);
        $startDate = jalali_to_gregorian($date[0], $date[1], $date[2], '-');
        $startDate = $startDate . " " . $explodeStart[1];

        $explodeEnd = str_replace("   ", " ", $request['end_date']);
        $explodeEnd = explode(" ", $explodeEnd);
        $endDate = explode("/", $explodeEnd[0]);
        $endDate = jalali_to_gregorian($endDate[0], $endDate[1], $endDate[2], '-');
        $endDate = $endDate . " " . $explodeEnd[1];


        $reportPort = gateway_transaction::query();
        $reportPort->select(DB::raw('sum(price) as price'), DB::raw('port'));
        $reportPort->whereIn('module', $request['type']);
        $reportPort->whereIn('port', $request['gateway']);
        $reportPort->whereBetween('created_at', [$startDate, $endDate]);
        $reportPort->where('status', '=', 'SUCCEED');
        if (in_array('charity_donate', $request['type'])) {
            $reportPort->whereHas('charityInfo', function ($q) use ($request) {
                $q->whereIn('title_id', $request['chType']);
            });
        }
        $reportPort->groupBy('port');
        $reportPort = $reportPort->get();

        $report = gateway_transaction::query();
        $report->select(DB::raw('module as mo'), DB::raw('DATE(created_at) as date'), DB::raw('price'), DB::raw('port'));
        $report->whereIn('module', $request['type']);
        $report->whereIn('port', $request['gateway']);
        $report->whereBetween('created_at', [$startDate, $endDate]);
        $report->where('status', '=', 'SUCCEED');
        if (in_array('charity_donate', $request['type'])) {
            $report->whereHas('charityInfo', function ($q) use ($request) {
                $q->whereIn('title_id', $request['chType']);
            });
        }
        $report = $report->get();

        $reportRowQuery = gateway_transaction::query();
        $reportRowQuery->with('charityInfo');
        $reportRowQuery->whereIn('module', $request['type']);
        $reportRowQuery->whereBetween('created_at', [$startDate, $endDate]);
        $reportRowQuery->whereIn('port', $request['gateway']);
        $reportRowQuery->whereIn('module', $request['type']);
        $reportRowQuery->where('status', '=', 'SUCCEED');
        if (in_array('charity_donate', $request['type'])) {
            $reportRowQuery->whereHas('charityInfo', function ($q) use ($request) {
                $q->whereIn('title_id', $request['chType']);
            });
        }
        $reportRow = $reportRowQuery->get();

        $reports = $report->groupBy(['mo', 'date']);
        $reportPort = json_decode($reportPort, true);
        $reports = json_decode($reports, true);
        $reportRow = json_decode($reportRow, true);
        return view('panel.charity.reports.ajax', compact('reports', 'reportPort', 'reportRow'));
    }
}
