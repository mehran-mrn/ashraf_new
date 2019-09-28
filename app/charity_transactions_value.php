<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class charity_transactions_value extends Model
{
    //
    protected $guarded = [];
    use SoftDeletes;

    public function charity_field()
    {
        return $this->hasOne('App\charity_payment_field', 'id', 'field_id');
    }
}
