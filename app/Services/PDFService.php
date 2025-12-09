<?php

namespace App\Services;

use App\Models\TestAttempt;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFService
{
    /**
     * Generate PDF certificate for test attempt
     */
    public function generateCertificate(TestAttempt $testAttempt)
    {
        $testAttempt->load([
            'candidate',
            'testVersion',
            'sectionAttempts.testSection',
        ]);

        // Calculate section stats
        $sectionStats = [];
        foreach ($testAttempt->sectionAttempts as $sectionAttempt) {
            $sectionStats[] = [
                'name' => $sectionAttempt->testSection->name,
                'correct' => $sectionAttempt->correct_answers,
                'total' => $sectionAttempt->total_questions,
                'percentage' => $sectionAttempt->total_questions > 0 
                    ? round(($sectionAttempt->correct_answers / $sectionAttempt->total_questions) * 100, 2)
                    : 0,
            ];
        }

        $pdf = Pdf::loadView('pdf.certificate', [
            'testAttempt' => $testAttempt,
            'sectionStats' => $sectionStats,
        ]);

        $filename = 'certificate_' . $testAttempt->candidate->cnic . '_' . now()->format('Ymd') . '.pdf';

        return $pdf->download($filename);
    }

    /**
     * Generate detailed answer sheet PDF
     */
    public function generateAnswerSheet(TestAttempt $testAttempt)
    {
        $testAttempt->load([
            'candidate',
            'testVersion',
            'candidateAnswers.question.options',
            'candidateAnswers.question.matchingPairs',
            'candidateAnswers.question.testSection',
            'candidateAnswers.selectedOption',
        ]);

        $pdf = Pdf::loadView('pdf.answer-sheet', [
            'testAttempt' => $testAttempt,
        ]);

        $filename = 'answers_' . $testAttempt->candidate->cnic . '_' . now()->format('Ymd') . '.pdf';

        return $pdf->download($filename);
    }
}
