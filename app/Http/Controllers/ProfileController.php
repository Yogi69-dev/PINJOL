<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // Tampilkan form edit profil
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    // Proses update profil
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'id_card_number' => 'required|string|max:50',
        ]);

        $user = Auth::user();
        $user->update($request->only('name', 'phone', 'address', 'id_card_number'));

        // Jika semua data penting sudah ada, tandai sebagai verified
        if ($user->name && $user->phone && $user->address && $user->id_card_number) {
            $user->is_verified = true;
            $user->save();
        }

        return redirect()->route('profile.edit')->with('status', 'Profil berhasil diperbarui.');
    }
}
