<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class setting_transportation extends Model
{
    //
    protected $guarded = [];
    use SoftDeletes;
    protected $table = 'setting_transportations';


    public function cities() {
        return $this->belongsToMany('App\city', 'setting_transportation_costs','t_id','c_id')->withPivot('cost');
    }


    public function deleteAll()
    {
        $this->setting_transportation_cost()->delete();
        return parent::delete();
    }
}
