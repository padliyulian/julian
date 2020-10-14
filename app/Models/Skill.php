<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    public function activities()
    {
        return $this->hasMany('App\Models\Activity');
    }

    public function users()
    {
        return $this->hasMany('App\Models\User');
    }
}
