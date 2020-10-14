<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Repositories\UserInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegRequest;

class UserController extends Controller
{
    private $userInterface;

    public function __construct(UserInterface $userInterface)
    {
        return $this->userInterface = $userInterface;
    }

    public function register(UserRegRequest $request)
    {
        try {
            $data = $this->userInterface->register($request);
            if ($data) {
                return response()->json(['message' => 'Create success'], 200);
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
