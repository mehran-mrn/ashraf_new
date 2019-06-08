<?php

namespace App;

use Laratrust\Models\LaratrustTeam;
use Nestable\NestableTrait;

class Team extends LaratrustTeam
{

    use NestableTrait;

    protected $parent = 'parent_id';

    protected $fillable = [
        'name', 'display_name','description'
    ];
}
