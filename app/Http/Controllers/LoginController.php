<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'identifier' => ['required'],
            'password' => ['required'],
        ]);

        // Tentukan apakah identifier adalah email atau NIM
        $identifier = $request->input('identifier');
        $password = $request->input('password');

        if (filter_var($identifier, FILTER_VALIDATE_EMAIL)) {
            // Jika identifier adalah email
            $credentials = ['email' => $identifier, 'password' => $password];
        } else {
            // Jika identifier adalah NIM
            $credentials = ['nim' => $identifier, 'password' => $password];
        }

        // Coba login dengan kredensial yang sesuai
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        // Jika login gagal
        return back()->withErrors([
            'identifier' => 'Data tidak sama.',
        ])->onlyInput('identifier');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
