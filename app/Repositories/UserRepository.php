<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Repositories\UserInterface;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserInterface
{
    private $user;

    public function __construct(User $user)
    {
        return $this->user = $user;
    }

    public function register($request)
    {
        $user = new $this->user;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->profile = $request->profile;
        if ($request->has('skill_id')) {
            $user->skill_id = $request->skill_id;
        }
        
        if ($user->save()) {
            $role = DB::table('roles')->where('name', $user->profile)->first();
            $user->assignRole($role->id);
            return $user;
        }
    }
}
