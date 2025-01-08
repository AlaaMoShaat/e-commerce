<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotPasswordRequest;
use App\Services\Auth\PasswordService;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    protected $passwordService;
    public function __construct(PasswordService $passwordService)
    {
        $this->passwordService = $passwordService;
    }
    public function showResetForm($email)
    {
        if (!session()->has('password_reset_email') || !session()->has('password_reset_verified')) {
            return redirect()->route('dashboard.password.email')->with('error', 'Please complete the above steps.');
        }

        if (session('password_reset_email') !== $email) {
            return redirect()->route('dashboard.password.email')->with('error', 'Email does not match.');
        }

        return view('dashboard.auth.password.reset', compact('email'));
    }
    public function resetPassword(ForgotPasswordRequest $request)
    {
        $data = $request->only('email', 'password');

        $admin = $this->passwordService->resetPassword($data);

        if (!$admin) {
            return redirect()->back()->with(['emailError' => __('auth.try_again')]);
        }

        session()->forget(['password_reset_email', 'password_reset_verified']);

        return redirect()->route('dashboard.login')->with('success', __('passwords.reset'));
    }
}