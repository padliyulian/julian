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
        return $this->userInterface->register($request);
    }
}
