<?php

namespace App\Repositories;

interface AuthInterface
{
    // public function register($request);
    public function login($request);
    public function logout($request);
}