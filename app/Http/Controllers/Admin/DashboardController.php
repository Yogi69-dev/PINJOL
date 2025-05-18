<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Loan;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'totalUsers' => User::where('role', 'user')->count(),
            'totalLoans' => Loan::sum('amount'),
            'unpaidLoans' => Loan::where('status', '!=', 'lunas')->count(),
            'recentUsers' => User::latest()->take(5)->get(['id', 'name', 'email', 'created_at']),
            'recentActivities' => ActivityLog::with('user:id,name')
                                        ->latest()
                                        ->take(5)
                                        ->get(['id', 'description', 'created_at', 'user_id'])
        ];

        return view('admin.dashboard', $data);
    }
}