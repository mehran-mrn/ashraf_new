<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class gateway_transaction extends Model
{
    //

    public function charity()
    {
        return $this->belongsTo('App\charity_transaction', 'id', 'module_id');
    }

    public function dayTrans($module, $startDate, $endDate)
    {
        return gateway_transaction::whereDate('created_at', [$startDate, $endDate])
            ->groupBy('module')
            ->where(
                [
                    ['status', '=', "SUCCESS"],
                ])->get();
    }
}
