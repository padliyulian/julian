<?php

namespace App\Repositories;

use App\Models\Skill;
use App\Repositories\SkillInterface;

class SkillRepository implements SkillInterface
{
    private $skill;

    public function __construct(Skill $skill)
    {
        return $this->skill = $skill;
    }

    public function list()
    {
        return $this->skill->select('id','name')->get();
    }
}
