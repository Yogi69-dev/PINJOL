<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validate both email and phone number
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Determine if input is email or phone
        $fieldType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        $userData = [
            'name' => $request->name,
            'password' => Hash::make($request->password),
            $fieldType => $request->email
        ];

        // Create user
        $user = User::create($userData);

        // Login user automatically
        Auth::login($user);

        return redirect()->route('dashboard')
               ->with('success', 'Registrasi berhasil! Selamat datang ' . $user->name);
    }
}