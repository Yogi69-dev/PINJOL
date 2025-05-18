<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Loan;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    // Cache duration in minutes
    protected const CACHE_DURATION = 30;

    public function index()
    {
        $stats = Cache::remember('admin_dashboard_stats', self::CACHE_DURATION, function () {
            return [
                'totalUsers' => $this->getTotalUsers(),
                'totalLoans' => $this->getTotalLoans(),
                'unpaidLoans' => $this->getUnpaidLoans(),
                'recentUsers' => $this->getRecentUsers(),
                'recentActivities' => $this->getRecentActivities()
            ];
        });

        return view('admin.dashboard', $stats);
    }

    protected function getTotalUsers(): int
    {
        return User::where('role', 'user')->count();
    }

    protected function getTotalLoans(): float
    {
        return Loan::sum('amount');
    }

    protected function getUnpaidLoans(): int
    {
        return Loan::where('status', '!=', 'lunas')->count();
    }

    protected function getRecentUsers()
    {
        return User::latest()
            ->take(5)
            ->get(['id', 'name', 'email', 'created_at']);
    }

    protected function getRecentActivities()
    {
        return ActivityLog::with(['user:id,name'])
            ->latest()
            ->take(5)
            ->get(['id', 'user_id', 'description', 'created_at']);
    }
}