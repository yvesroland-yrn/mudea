<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login()
    {
        return view('admin.auth.login');
    }

    public function login_store(AuthRequest $request)
    {
        $user = $this->authService->login(
            $request->validated()
        );

        if (!$user) {
            return back()->withErrors([
                'login' => 'Email ou mot de passe incorrect.'
            ])->onlyInput('email', 'remember');
        }

        $request->session()->regenerate();

        return redirect()->intended(route('admin.dashboard'));
    }

    public function logout(Request $request)
    {
        $this->authService->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
