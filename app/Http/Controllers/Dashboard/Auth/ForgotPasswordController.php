<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Models\Admin;
use Ichtrojan\Otp\Otp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotPasswordRequest;
use App\Notifications\SendCodeNotify;
use App\Services\Auth\PasswordService;

class ForgotPasswordController extends Controller
{

    protected $passwordService;
    public function __construct(PasswordService $passwordService)
    {
        $this->passwordService = $passwordService;
    }
    public function showEmailForm()
    {
        return view('dashboard.auth.password.email');
    }

    public function sendCode(ForgotPasswordRequest $request)
    {
        $email = $request->email;

        $admin = $this->passwordService->sendCode($email);

        if (!$admin) {
            return redirect()->back()->withErrors(['error' => __('passwords.user')]);
        }

        session(['password_reset_email' => $admin->email]);

        return redirect()->route('dashboard.password.showCodeForm', ['email' => $admin->email])
            ->with('success', __('passwords.sent'));
    }

    public function showCodeForm($email)
    {
        return view('dashboard.auth.password.confirm', compact('email'));
    }

    public function verifyCode(ForgotPasswordRequest $request)
    {
        $data = $request->only('email', 'code');

        if (!$this->passwordService->verifyCode($data)) {
            return redirect()->back()->withErrors(['error' => __('passwords.token')]);
        }
        session(['password_reset_verified' => true]);

        return redirect()->route('dashboard.password.showResetForm', ['email' => $request->email]);
    }
}
