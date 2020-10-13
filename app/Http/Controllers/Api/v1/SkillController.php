<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\SkillInterface;

class SkillController extends Controller
{
    private $skillInterface;

    public function __construct(SkillInterface $skillInterface)
    {
        return $this->skillInterface = $skillInterface;
    }

    public function list()
    {
        try {
            $data = $this->skillInterface->list();
            return response()->json($data, 200);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
