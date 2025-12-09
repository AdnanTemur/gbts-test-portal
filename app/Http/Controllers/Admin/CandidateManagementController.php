<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use Illuminate\Http\Request;

class CandidateManagementController extends Controller
{
    public function index(Request $request)
    {
        $query = Candidate::withCount('testAttempts');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('cnic', 'like', "%{$search}%")
                  ->orWhere('name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $candidates = $query->latest()->paginate(20);

        return view('admin.candidates.index', compact('candidates'));
    }

    public function show(Candidate $candidate)
    {
        $candidate->load(['testAttempts.testVersion', 'testAttempts.sectionAttempts.testSection']);
        return view('admin.candidates.show', compact('candidate'));
    }
}