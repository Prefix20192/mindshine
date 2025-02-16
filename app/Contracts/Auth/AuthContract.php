<?php

namespace App\Contracts\Auth;

interface AuthContract
{
    public function login(object $request, object $user): array;
    public function register(object $request): array;
}
