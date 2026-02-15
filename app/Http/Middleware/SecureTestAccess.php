<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\TestAttempt;
use Illuminate\Http\Request;

class SecureTestAccess
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->route('token');
        $attempt = TestAttempt::where('attempt_token', $token)->firstOrFail();

        // Test hasn't started yet
        if ($attempt->status === 'not_started') {
            return redirect()->route('test.start', $token)
                ->with('info', 'Please start the test first.');
        }

        // Completed test = read-only
        if ($attempt->status === 'completed' && !str_contains($request->route()->getName(), 'results')) {
            abort(403, 'Test already completed.');
        }

        // Allow first entry immediately after begin()
        if ($attempt->status === 'in_progress' && !session()->has('active_test_token')) {
            session([
                'active_test_token' => $attempt->attempt_token,
                'candidate_id' => $attempt->candidate_id,
            ]);
        }

        // Session lock
        if (session('active_test_token') && session('active_test_token') !== $attempt->attempt_token) {
            abort(403, 'This test is active in another session.');
        }

        // Device lock
        if ($attempt->device_fingerprint && $attempt->device_fingerprint !== device_fingerprint($request)) {
            abort(403, 'This test is locked to another device.');
        }

        // IP lock (test center mode)
        if ($attempt->ip_address && $attempt->ip_address !== $request->ip()) {
            abort(403, 'Network change detected.');
        }

        // Time expiry
        if ($attempt->expires_at && now()->greaterThan($attempt->expires_at)) {
            $attempt->update(['status' => 'timeout']);
            abort(403, 'Test time expired.');
        }

        return $next($request);
    }

}
