<?php

namespace App\Http\Controllers\Dashboard\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Dashboard\Admin\CreateAdminRequest;
use App\Services\Auth\AuthService;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class AuthController extends Controller implements HasMiddleware
{
    protected $authService;
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public static function middleware()
    {
        return [
            new Middleware(middleware: 'guest:admin', except: ['logout']),
        ];
    }

    public function showLoginForm()
    {
        return view('dashboard.auth.login');
    }

    public function login(CreateAdminRequest $request)
    {

        $credenstials = $request->only(['email', 'password']);

        $remember_me = $request->remember_me;

        if ($this->authService->login($credenstials, 'admin', $remember_me)) {
            return redirect()->intended(route('dashboard.home'));
        } else {
            return redirect()->back()->withErrors(['email' => __('auth.failed')]);
        }
    }

    public function logout()
    {
        $this->authService->logout('admin');
        return redirect()->route('dashboard.login');
    }
}
