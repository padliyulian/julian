<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\AuthInterface;

class AuthRepository implements AuthInterface
{
    private $user;

    public function __construct(User $user)
    {
        return $this->user = $user;
    }

    public function login($request)
    {
        $login_with = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $valid = [
            $login_with => $request->username,
            'password' => $request->password
        ];

        if(!auth()->attempt($valid)) {
            return response()->json(['message' => 'Invalid  login'], 401);
        }

        $token = auth()->user()->createToken('authToken')->accessToken;

        $user = $this->user->findOrFail(auth()->user()->id);
        $user->api_token = $token;
        $user->update();

        return response()->json([
            'token' => $token,
            'profile' => auth()->user()->profile
        ], 200);
    }

    public function logout($request) {
        $user = $this->user->where('api_token', $request->token)->first();

        if ($user) {
            $user->api_token = null;
            $user->update();
            $user->authAcessToken()->delete();
            return response()->json(['message' => 'Logout success'], 200);
        } else {
            return response()->json(['message' => 'Unauthorized user'], 401);
        }
    }
}
