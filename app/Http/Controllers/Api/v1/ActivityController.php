<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ActivityRequest;
use App\Repositories\ActivityInterface;

class ActivityController extends Controller
{
    private $activityInterface;

    public function __construct(ActivityInterface $activityInterface)
    {
        return $this->activityInterface = $activityInterface;
    }

    // public function list()
    // {
    //     try {
    //         $data = $this->activityInterface->list();
    //         return response()->json($data, 200);
    //     } catch (\Exception $e) {
    //         return $e->getMessage();
    //     }
    // }

    public function add(ActivityRequest $request)
    {
        try {
            $data = $this->activityInterface->add($request);
            if ($data) {
                return response()->json(['message' => 'Create success'], 200);
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function update(ActivityRequest $request, $activity_id)
    {
        try {
            $data = $this->activityInterface->update($request, $activity_id);
            if ($data) {
                return response()->json(['message' => 'Update success'], 200);
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function delete($activity_id)
    {
        try {
            $data = $this->activityInterface->delete($activity_id);
            if ($data) {
                return response()->json(['message' => 'Delete success'], 200);
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function detail($skill_id)
    {
        try {
            $data = $this->activityInterface->detail($skill_id);
            return response()->json($data, 200);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function list(Request $request)
    {
        try {
            $data = $this->activityInterface->list($request);
            return response()->json($data, 200);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
