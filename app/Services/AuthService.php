<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function login(array $credentials): ?User
    {
        $remember = $credentials['remember'] ?? false;

        if (!Auth::attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password'],
        ], $remember)) {
            return null;
        }

        /** @var User $user */
        $user = Auth::user();

        $user->update([
            'last_login_at' => now(),
        ]);

        return $user;
    }

    public function logout(): void
    {
        Auth::logout();
    }
}
