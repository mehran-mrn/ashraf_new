<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class building_ticket extends Model
{
    //notes.files

    public function notes()
    {
        return $this->hasMany('App\building_ticket_note','building_ticket_id');
    }
    public function histories()
    {
        return $this->hasMany('App\building_ticket_history','building_ticket_id');
    }
    public function building_item()
    {
        return $this->belongsTo('App\building_item','item_id');
    }
}
