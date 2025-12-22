<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Menampilkan halaman login
     */
    public function showLoginForm()
    {
        return view('pages.auth.login');
    }

    /**
     * Proses login (placeholder)
     */
    public function login(Request $request)
    {
        // TODO: Implement login logic
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Logic login akan ditambahkan nanti
        return back()->withErrors(['email' => 'Fitur login belum diimplementasi.']);
    }

    /**
     * Proses logout (placeholder)
     */
    public function logout(Request $request)
    {
        // TODO: Implement logout logic
        return redirect()->route('landing.index');
    }
}
