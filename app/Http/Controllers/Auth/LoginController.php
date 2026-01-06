<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Log;

class LoginController extends Controller
{
    /**
     * Menampilkan halaman login
     */
    public function showLoginForm()
    {
        // Jika sudah login, redirect ke admin
        if (Auth::check()) {
            return redirect()->route('admin.ayam.index');
        }
        
        return view('pages.auth.login');
    }

    /**
     * Proses login dengan detailed error messages
     */
    public function login(Request $request)
    {
        // Validasi format input dengan custom messages
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
        ]);

        // Cek apakah email terdaftar
        $user = User::where('email', $credentials['email'])->first();
        
        if (!$user) {
            return back()->withErrors([
                'email' => 'Email tidak terdaftar dalam sistem.',
            ])->onlyInput('email');
        }

        // Cek password
        if (!Hash::check($credentials['password'], $user->password)) {
            return back()->withErrors([
                'password' => 'Password yang Anda masukkan salah.',
            ])->onlyInput('email');
        }

        // Login user
        $remember = $request->boolean('remember');
        Auth::login($user, $remember);
        $request->session()->regenerate();
        
        // Log activity
        Log::create([
            'user_id' => Auth::id(),
            'activity' => 'Login berhasil',
        ]);

        return redirect()->intended(route('admin.ayam.index'));
    }

    /**
     * Proses logout
     */
    public function logout(Request $request)
    {
        // Log activity before logout
        if (Auth::check()) {
            Log::create([
                'user_id' => Auth::id(),
                'activity' => 'Logout',
            ]);
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}

