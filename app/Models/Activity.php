<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    public function skill()
    {
        return $this->belongsTo('App\Models\Skill');
    }

    public function skill_name()
    {
        return $this->belongsTo('App\Models\Skill');
    }

    public function participans()
    {
        return $this->hasMany('App\Models\User');
    }
}
