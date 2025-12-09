<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\TestVersion;
use App\Models\TestAttempt;
use App\Services\DistributionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CandidateController extends Controller
{
    protected $distributionService;

    public function __construct(DistributionService $distributionService)
    {
        $this->distributionService = $distributionService;
    }

    /**
     * Show home page with active test versions
     */
    public function index()
    {
        $testVersions = TestVersion::where('status', 'active')->get();
        
        return view('candidate.index', compact('testVersions'));
    }

    /**
     * Lookup existing candidate by CNIC
     */
    public function lookup(Request $request)
    {
        $request->validate([
            'cnic' => 'required|string',
            'test_version_id' => 'required|exists:test_versions,id',
        ]);

        $candidate = Candidate::where('cnic', $request->cnic)->first();
        $testVersion = TestVersion::findOrFail($request->test_version_id);

        if ($candidate) {
            // Check if candidate already has an attempt for this version
            $existingAttempt = TestAttempt::where('candidate_id', $candidate->id)
                ->where('test_version_id', $testVersion->id)
                ->where('status', '!=', 'completed')
                ->first();

            if ($existingAttempt) {
                // Continue existing attempt
                return redirect()->route('test.start', $existingAttempt->attempt_token);
            }

            // Show candidate details for confirmation
            return view('candidate.confirm', compact('candidate', 'testVersion'));
        }

        // New candidate - show registration form
        return view('candidate.register', [
            'cnic' => $request->cnic,
            'testVersion' => $testVersion
        ]);
    }

    /**
     * Register new candidate or create new attempt
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'cnic' => 'required|string|max:20',
            'name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'test_version_id' => 'required|exists:test_versions,id',
        ]);

        // Handle photo upload
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            
            // Validate aspect ratio (1:1 square)
            list($width, $height) = getimagesize($photo->path());
            if ($width != $height) {
                return back()->withErrors(['photo' => 'Photo must be square (1:1 aspect ratio)']);
            }
            
            $photoPath = $photo->store('candidates', 'public');
        }

        // Find or create candidate
        $candidate = Candidate::updateOrCreate(
            ['cnic' => $validated['cnic']],
            [
                'name' => $validated['name'],
                'father_name' => $validated['father_name'],
                'phone' => $validated['phone'],
                'email' => $validated['email'],
                'photo' => $photoPath ?? Candidate::where('cnic', $validated['cnic'])->value('photo'),
            ]
        );

        // Create new test attempt
        $testVersion = TestVersion::findOrFail($validated['test_version_id']);
        
        $testAttempt = TestAttempt::create([
            'candidate_id' => $candidate->id,
            'test_version_id' => $testVersion->id,
            'status' => 'not_started',
            'current_section_index' => 0,
        ]);

        // Generate question assignments
        $this->distributionService->generateAssignments($testAttempt);

        // Redirect to test start page
        return redirect()->route('test.start', $testAttempt->attempt_token);
    }
}
