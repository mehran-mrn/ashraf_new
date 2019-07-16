<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class building_ticket_history extends Model
{
    //
    public function note()
    {
        return $this->belongsTo('App\building_ticket_note','building_ticket_note_id');
    }
}
