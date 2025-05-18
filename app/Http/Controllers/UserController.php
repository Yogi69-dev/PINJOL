<?php
namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('is_admin', false)->get(); // Hanya user biasa
        return view('admin.users.index', compact('users'));
    }
}
