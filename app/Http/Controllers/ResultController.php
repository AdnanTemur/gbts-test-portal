<?php

namespace App\Http\Controllers;

use App\Models\TestAttempt;
use App\Services\PDFService;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    protected $pdfService;

    public function __construct(PDFService $pdfService)
    {
        $this->pdfService = $pdfService;
    }

    /**
     * Show test results
     */
    public function show($token)
    {
        $testAttempt = TestAttempt::where('attempt_token', $token)->firstOrFail();

        if ($testAttempt->status !== 'completed' && $testAttempt->status !== 'timeout') {
            return redirect()->route('test.section', $token)
                ->with('error', 'Please complete the test first.');
        }

        // Load all necessary relationships
        $testAttempt->load([
            'candidate',
            'testVersion',
            'sectionAttempts.testSection',
            'candidateAnswers.question.testSection',
            'candidateAnswers.question.options',
            'candidateAnswers.question.matchingPairs',
            'candidateAnswers.selectedOption',
        ]);

        // Calculate section-wise statistics
        $sectionStats = [];
        foreach ($testAttempt->sectionAttempts as $sectionAttempt) {
            $sectionStats[] = [
                'name' => $sectionAttempt->testSection->name,
                'total_questions' => $sectionAttempt->total_questions,
                'correct' => $sectionAttempt->correct_answers,
                'incorrect' => $sectionAttempt->incorrect_answers,
                'unanswered' => $sectionAttempt->unanswered,
                'score' => $sectionAttempt->score,
                'percentage' => $sectionAttempt->total_questions > 0 
                    ? round(($sectionAttempt->correct_answers / $sectionAttempt->total_questions) * 100, 2)
                    : 0,
            ];
        }

        return view('results.show', compact('testAttempt', 'sectionStats'));
    }

    /**
     * Download PDF certificate
     */
    public function pdf($token)
    {
        $testAttempt = TestAttempt::where('attempt_token', $token)->firstOrFail();

        if ($testAttempt->status !== 'completed' && $testAttempt->status !== 'timeout') {
            abort(403, 'Test not completed');
        }

        return $this->pdfService->generateCertificate($testAttempt);
    }

    /**
     * Download Answer Sheet
     */
    public function answerSheetPdf($token)
    {
        $testAttempt = TestAttempt::where('attempt_token', $token)->firstOrFail();

        if ($testAttempt->status !== 'completed' && $testAttempt->status !== 'timeout') {
            abort(403, 'Test not completed');
        }

        return $this->pdfService->generateAnswerSheet($testAttempt);
    }
}
