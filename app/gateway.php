<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class gateway extends Model
{
    //
    protected $guarded=[];
    use SoftDeletes;

    public function bank(){
        return $this->belongsTo('App\bank','bank_id');
    }

    public function media()
    {
        return $this->belongsTo('App\bank','bank_id');
    }
}
