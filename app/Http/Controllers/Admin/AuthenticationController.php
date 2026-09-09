<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ForgotPasswordRequest;
use App\Http\Requests\Admin\LoginRequest;
use App\Http\Requests\Admin\PasswordResetRequest;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class AuthenticationController extends Controller
{
    public function showLogin()
    {
        return view('admin.auth.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'email' => 'Email hoặc mật khẩu không chính xác.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    public function showForgotPassword()
    {
        return view('admin.auth.forgot-password');
    }

    public function forgotPassword(ForgotPasswordRequest $request)
    {
        $email = $request->input('email');

        $status = Password::sendResetLink(['email' => $email]);

        return $status === Password::ResetLinkSent
            ? back()->withSuccess('Mã đặt lại mật khẩu đã được gửi đến email của bạn.')
            : back()->withErrors(['email' => 'Email không tồn tại.']);
    }

    public function showResetPassword(Request $request, string $token)
    {
        $token = $request->route('token');

        return view('admin.auth.reset-password', compact('token'));
    }

    public function resetPassword(PasswordResetRequest $request)
    {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $this->updatePassword($user, $password);
            }
        );

        return $status === Password::PasswordReset
            ? back()->withSuccess('Mật khẩu đã được đặt lại thành công.')
            : back()->withErrors(['email' => $status]);
    }

    public function updatePassword(User $user, string $password): void
    {
        $user->forceFill([
            'password' => Hash::make($password),
        ])->setRememberToken(Str::random(60));

        $user->save();

        event(new PasswordReset($user));
    }
}
