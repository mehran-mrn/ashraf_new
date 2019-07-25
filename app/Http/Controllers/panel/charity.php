<?php

namespace App\Http\Controllers\panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class charity extends Controller
{
    public function charity_payment_title_add(Request $request){
        $this->validate($request, [
            'type_id' => 'nullable|exists:periods,period_id',
            'title' => 'required|max:150',
            'day_interval' => 'nullable|digits_between:1,365',
        ]);
    }

}
