<?php

namespace App\Http\Controllers\Admin;  // Harus seperti ini

use App\Http\Controllers\Controller;

class ActivityController extends Controller  // Nama class harus sama dengan nama file
{
    public function index()
    {
        return view('admin.activities.index');
    }
}