<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TestVersion;
use App\Models\TestAttempt;
use App\Models\Candidate;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_candidates' => Candidate::count(),
            'total_tests' => TestVersion::count(),
            'active_tests' => TestVersion::where('status', 'active')->count(),
            'total_attempts' => TestAttempt::count(),
            'completed_attempts' => TestAttempt::where('status', 'completed')->count(),
            'passed_attempts' => TestAttempt::where('passed', true)->count(),
        ];

        $recentAttempts = TestAttempt::with('candidate', 'testVersion')
            ->latest()
            ->limit(10)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentAttempts'));
    }
}