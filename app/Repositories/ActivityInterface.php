<?php

namespace App\Repositories;

interface ActivityInterface
{
    public function list($request);
    public function add($request);
    public function update($request, $activity_id);
    public function delete($activity_id);
    public function detail($skill_id);
}