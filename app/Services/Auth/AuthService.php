<?php

namespace App\Services\Auth;

use App\Contracts\Auth\AuthContract;
use App\Models\User;

class AuthService implements AuthContract
{
    public function register(object $request): array
    {
        $user = User::query()->create([
            'email' => $request->email,
            'name' => $request->login,
            'role'  => 1,
            'password'  => $request->password
        ]);

        return ["token" => $user->createToken('auth_token', ['user'])->plainTextToken];
    }

    public function login(object $request, object $user): array
    {

    }
}
