<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\TestAttempt;
use Symfony\Component\HttpFoundation\Response;

class TestResultAccess
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get the token from route parameter
        $token = $request->route('token');

        if (!$token) {
            abort(404);
        }

        // Find the test attempt
        $testAttempt = TestAttempt::where('attempt_token', $token)
            ->where('status', 'completed')
            ->first();

        if (!$testAttempt) {
            abort(404, 'Test result not found');
        }

        // Check authorization
        if (!$this->canViewResult($request, $testAttempt)) {
            abort(403, 'You are not authorized to view this test result.');
        }

        return $next($request);
    }

    /**
     * Check if the current request can view this test result
     */
    private function canViewResult(Request $request, TestAttempt $testAttempt): bool
    {
        // 1. Allow if user is authenticated admin
        if (auth()->check()) {
            return true;
        }

        // 2. Candidate can view if they own this attempt
        $candidateId = session('candidate_id');
        if ($candidateId && $candidateId === $testAttempt->candidate_id) {
            return true;
        }

        // 3. Optional: Allow if completed within last 24 hours
        // if ($testAttempt->completed_at && $testAttempt->completed_at->isAfter(now()->subHours(24))) {
        //     return true;
        // }

        return false;
    }
}