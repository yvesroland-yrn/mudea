<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

        /** @var User|null $user */
        $user = User::query()
            ->where('email', $credentials['email'])
            ->first();

        if (!$user || !is_string($user->password) || !password_verify($credentials['password'], $user->password)) {
            return null;
        }

        if (password_needs_rehash($user->password, PASSWORD_BCRYPT)) {
            $user->forceFill([
                'password' => Hash::make($credentials['password']),
            ])->save();
        }

        Auth::login($user, $remember);

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
