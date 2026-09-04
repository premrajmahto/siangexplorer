<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->boolean('remember');

        if (Auth::guard('admin')->attempt($credentials, $remember)) {
            $admin = Auth::guard('admin')->user();
            if (!$admin->is_active) {
                Auth::guard('admin')->logout();
                return back()->withErrors(['email' => 'Your account has been disabled. Please contact the super admin.']);
            }

            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'))
                ->with('success', 'Welcome back, ' . $admin->name . '!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our administrative records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('info', 'You have been logged out successfully.');
    }

    public function showForgotPasswordForm()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $admin = \App\Models\Admin::where('email', $request->email)->first();

        // Fallback to primary admin account if email entered matches legacy admin or non-exact match
        if (!$admin) {
            $admin = \App\Models\Admin::first();
        }

        if ($admin) {
            $token = \Illuminate\Support\Str::random(64);

            \Illuminate\Support\Facades\DB::table('password_reset_tokens')->updateOrInsert(
                ['email' => $admin->email],
                [
                    'token' => \Illuminate\Support\Facades\Hash::make($token),
                    'created_at' => now(),
                ]
            );

            $resetUrl = route('admin.password.reset', ['token' => $token, 'email' => $admin->email]);

            try {
                \Illuminate\Support\Facades\Mail::raw(
                    "Hello {$admin->name},\n\n" .
                    "You are receiving this email because a password reset was requested for your SiangExplorer Admin Account.\n\n" .
                    "Reset Password Link: {$resetUrl}\n\n" .
                    "If you did not request a password reset, no further action is required.\n\n" .
                    "Regards,\nSiangExplorer Security Team",
                    function ($mail) use ($admin) {
                        $mail->to($admin->email)
                            ->subject('SiangExplorer Admin - Reset Password Notification');
                    }
                );
            } catch (\Throwable $e) {
                \Illuminate\Support\Facades\Log::error('Admin reset password email error: ' . $e->getMessage());
            }
        }

        return back()->with('status', 'A password reset link has been dispatched to your administrator inbox (booking.siangholidays@gmail.com). Please check your email.');
    }

    public function showResetPasswordForm($token, Request $request)
    {
        return view('admin.auth.reset-password', [
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $tokenRecord = \Illuminate\Support\Facades\DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        if (!$tokenRecord || !\Illuminate\Support\Facades\Hash::check($request->token, $tokenRecord->token)) {
            return back()->withErrors(['email' => 'This password reset token is invalid or has expired.']);
        }

        $admin = \App\Models\Admin::where('email', $request->email)->first() ?? \App\Models\Admin::first();
        if (!$admin) {
            return back()->withErrors(['email' => 'Unable to locate administrator account with that email address.']);
        }

        $admin->password = $request->password;
        $admin->save();

        \Illuminate\Support\Facades\DB::table('password_reset_tokens')->where('email', $request->email)->delete();
        \Illuminate\Support\Facades\DB::table('password_reset_tokens')->where('email', $admin->email)->delete();

        return redirect()->route('admin.login')->with('info', 'Password reset successfully! You can now log in with your new password.');
    }
}
