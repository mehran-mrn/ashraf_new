<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class charity_transaction extends Model
{
    //
    protected $guarded = [];
    use SoftDeletes;


    public function values()
    {
        return $this->hasMany('App\charity_transactions_value', 'trans_id', 'id');
    }
}
