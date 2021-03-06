<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use App\Repositories\AuthInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\TokenRequest;

class AuthController extends Controller
{
    private $authInterface;

    public function __construct(AuthInterface $authInterface)
    {
        return $this->authInterface = $authInterface;
    }

    public function login(AuthRequest $request)
    {
        return $this->authInterface->login($request);
    }

    public function logout(TokenRequest $request)
    {
        return $this->authInterface->logout($request);
    }
}
