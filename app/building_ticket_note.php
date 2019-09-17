<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class building_ticket_note extends Model
{
    //
    public function files()
    {
        return $this->hasMany('App\building_ticket_file','building_ticket_note_id');
    }
    public function history()
    {
        return $this->hasOne('App\building_ticket_history','building_ticket_note_id');
    }
}
