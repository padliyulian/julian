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

    public function participants()
    {
        return $this->hasMany('App\Models\User', 'skill_id')->with('skill:id,name');
    }
}
