<?php

namespace App;

use Laratrust\Models\LaratrustPermission;

class Permission extends laratrustPermission
{
    protected $fillable = [
        'name', 'display_name', 'category','description'
    ];
}
