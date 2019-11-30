<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class charity_supportForm_file extends Model
{
    public function fields()
    {
        return $this->hasMany('App\charity_sForm_file_fild', 'ch_s_form_file_id');
    }
}
