<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        // Coba login dengan email atau nomor telepon
        $fieldType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
        
        $credentials = [
            $fieldType => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            
            return redirect()->intended('/dashboard')
                   ->with('success', 'Login berhasil!');
        }

        return back()->withErrors([
            'email' => 'Email/nomor telepon atau password salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}