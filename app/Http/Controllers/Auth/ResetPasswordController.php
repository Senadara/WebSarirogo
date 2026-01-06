<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Log;

class ResetPasswordController extends Controller
{
    /**
     * Tampilkan form input email
     */
    public function showEmailForm()
    {
        return view('pages.auth.forgot-password');
    }

    /**
     * Verifikasi email dan redirect ke form reset password
     */
    public function verifyEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
        ]);

        // Cek apakah email terdaftar
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Email tidak terdaftar dalam sistem.',
            ])->onlyInput('email');
        }

        // Simpan email di session untuk reset password
        session(['reset_email' => $request->email]);

        return redirect()->route('password.reset');
    }

    /**
     * Tampilkan form reset password
     */
    public function showResetForm()
    {
        // Cek apakah ada email di session
        if (!session('reset_email')) {
            return redirect()->route('password.request')
                ->withErrors(['email' => 'Silakan masukkan email terlebih dahulu.']);
        }

        return view('pages.auth.reset-password', [
            'email' => session('reset_email'),
        ]);
    }

    /**
     * Reset password
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ], [
            'password.required' => 'Password baru wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $email = session('reset_email');

        if (!$email) {
            return redirect()->route('password.request')
                ->withErrors(['email' => 'Session expired. Silakan ulangi proses.']);
        }

        // Update password
        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->route('password.request')
                ->withErrors(['email' => 'User tidak ditemukan.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        // Log activity
        Log::create([
            'user_id' => $user->id,
            'activity' => 'Reset password berhasil',
        ]);

        // Clear session
        session()->forget('reset_email');

        return redirect()->route('login')
            ->with('success', 'Password berhasil direset. \nSilakan login dengan password baru.');
    }
}
