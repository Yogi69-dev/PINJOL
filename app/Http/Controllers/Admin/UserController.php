<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Menampilkan daftar pengguna
    public function index()
    {
        $users = User::where('role', 'user')->latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    // Menampilkan detail pengguna
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    // Menampilkan formulir untuk mengedit pengguna
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // Memperbarui data pengguna
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update($request->only('name', 'email'));

        return redirect()->route('admin.users.index')->with('success', 'Data pengguna berhasil diperbarui.');
    }

    // Menghapus pengguna
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil dihapus.');
    }
}
