<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class caravan_doc extends Model
{
    public function doc()
    {
        return $this->belongsTo('App\uploaded_doc','doc_id');
    }


}
