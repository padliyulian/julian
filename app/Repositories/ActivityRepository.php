<?php

namespace App\Repositories;

use App\Models\Skill;
use App\Models\Activity;
use Illuminate\Support\Facades\DB;
use App\Repositories\ActivityInterface;

class ActivityRepository implements ActivityInterface
{
    private $activity;

    public function __construct(Activity $activity)
    {
        return $this->activity = $activity;
    }

    public function add($request)
    {
        $activity = new $this->activity;
        $activity->skill_id = $request->skill_id;
        $activity->title = $request->title;
        $activity->description = $request->description;
        $activity->startdate = $request->startdate;
        $activity->enddate = $request->enddate;

        if ($activity->save()) {
            return $activity;
        }
    }

    public function update($request, $activity_id)
    {
        $activity = $this->activity->findOrFail($activity_id);
        $activity->skill_id = $request->skill_id;
        $activity->title = $request->title;
        $activity->description = $request->description;
        $activity->startdate = $request->startdate;
        $activity->enddate = $request->enddate;

        if ($activity->update()) {
            return $activity;
        }
    }

    public function delete($activity_id){
        $activity = $this->activity->findOrFail($activity_id);
        if ($activity->delete()) {
            return $activity;
        }
    }

    public function detail($skill_id)
    {
        return $this->activity->select('id','skill_id','title','description','startdate','enddate')->where('skill_id', $skill_id)->orderBy('startdate', 'ASC')->with('skill:id,name')->get();
    }
}
