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

        $admin = \App\Models\Admin::where('email', $request->email)->first() ?? \App\Models\Admin::first();

        $targetEmail = 'booking.siangholidays@gmail.com';

        if ($admin) {
            if ($admin->email !== $targetEmail) {
                $admin->email = $targetEmail;
                $admin->save();
            }

            $token = \Illuminate\Support\Str::random(40);

            \Illuminate\Support\Facades\DB::table('password_reset_tokens')->updateOrInsert(
                ['email' => $targetEmail],
                [
                    'token' => \Illuminate\Support\Facades\Hash::make($token),
                    'created_at' => now(),
                ]
            );

            $domain = $request->getSchemeAndHttpHost();
            $resetUrl = $domain . '/admin/reset-password/' . $token . '?email=' . urlencode($targetEmail);

            try {
                $htmlContent = "
                <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 24px; border: 1px solid #e2e8f0; border-radius: 12px; background-color: #ffffff;'>
                    <div style='text-align: center; margin-bottom: 24px;'>
                        <h2 style='color: #0f172a; margin: 0;'>Siang<span style='color: #0d9488;'>Explorer</span> Admin</h2>
                        <p style='color: #64748b; font-size: 14px; margin-top: 4px;'>Password Reset Request</p>
                    </div>
                    <p style='color: #334155; font-size: 15px;'>Hello <strong>{$admin->name}</strong>,</p>
                    <p style='color: #334155; font-size: 14px; line-height: 1.6;'>You are receiving this email because a password reset request was received for your SiangExplorer Admin Account.</p>
                    <div style='text-align: center; margin: 30px 0;'>
                        <a href='{$resetUrl}' target='_blank' style='background: linear-gradient(to right, #0d9488, #14b8a6); color: #ffffff; padding: 14px 28px; text-decoration: none; border-radius: 10px; font-weight: bold; font-size: 14px; display: inline-block; box-shadow: 0 4px 12px rgba(13, 148, 136, 0.3);'>Reset Admin Password</a>
                    </div>
                    <p style='color: #64748b; font-size: 12px; line-height: 1.5;'>If the button above does not work, copy and paste this link into your browser:<br><a href='{$resetUrl}' style='color: #0d9488; word-break: break-all;'>{$resetUrl}</a></p>
                    <hr style='border: none; border-top: 1px solid #e2e8f0; margin: 24px 0;'>
                    <p style='color: #94a3b8; font-size: 12px; text-align: center; margin: 0;'>If you did not request a password reset, no further action is required.</p>
                </div>
                ";

                \Illuminate\Support\Facades\Mail::html(
                    $htmlContent,
                    function ($mail) use ($targetEmail) {
                        $mail->to($targetEmail)
                            ->subject('SiangExplorer Admin - Reset Password Notification');
                    }
                );
            } catch (\Throwable $e) {
                \Illuminate\Support\Facades\Log::error('Admin reset password email error: ' . $e->getMessage());
            }

            try {
                $headers  = "MIME-Version: 1.0\r\n";
                $headers .= "Content-type: text/html; charset=UTF-8\r\n";
                $headers .= "From: SiangExplorer <booking.siangholidays@gmail.com>\r\n";
                $headers .= "Reply-To: booking.siangholidays@gmail.com\r\n";
                $headers .= "X-Mailer: PHP/" . phpversion();

                @mail($targetEmail, 'SiangExplorer Admin - Reset Password Notification', $htmlContent, $headers);
            } catch (\Throwable $e) {
                \Illuminate\Support\Facades\Log::error('Native mail fallback error: ' . $e->getMessage());
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
