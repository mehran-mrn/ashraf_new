<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class building_ticket_file extends Model
{
    public function doc()
    {
        return $this->belongsTo('App\uploaded_doc','doc_id');
    }
}
