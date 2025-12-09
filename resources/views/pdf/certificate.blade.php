<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Test Certificate</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #2a7453;
            padding-bottom: 20px;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #2a7453;
        }
        .title {
            font-size: 32px;
            font-weight: bold;
            margin: 20px 0;
            color: #1d4a37;
        }
        .candidate-photo {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #2a7453;
            display: block;
            margin: 0 auto 20px;
        }
        .candidate-info {
            text-align: center;
            margin-bottom: 30px;
        }
        .candidate-name {
            font-size: 24px;
            font-weight: bold;
            color: #1d4a37;
        }
        .info-row {
            margin: 5px 0;
            color: #555;
        }
        .pass-status {
            text-align: center;
            margin: 30px 0;
            padding: 20px;
            border: 3px solid;
        }
        .pass-status.passed {
            background-color: #d1fae5;
            border-color: #10b981;
            color: #065f46;
        }
        .pass-status.failed {
            background-color: #fee2e2;
            border-color: #ef4444;
            color: #991b1b;
        }
        .score-section {
            margin: 30px 0;
            padding: 20px;
            background-color: #f9fafb;
            border-radius: 8px;
        }
        .score-grid {
            display: table;
            width: 100%;
            margin-top: 15px;
        }
        .score-item {
            display: table-cell;
            text-align: center;
            padding: 15px;
            border-right: 1px solid #ddd;
        }
        .score-item:last-child {
            border-right: none;
        }
        .score-value {
            font-size: 28px;
            font-weight: bold;
            color: #2a7453;
        }
        .score-label {
            font-size: 12px;
            color: #666;
            margin-top: 5px;
        }
        .section-scores {
            margin: 20px 0;
        }
        .section-row {
            padding: 10px;
            border-bottom: 1px solid #e5e7eb;
            display: table;
            width: 100%;
        }
        .section-name {
            display: table-cell;
            font-weight: bold;
            width: 40%;
        }
        .section-score {
            display: table-cell;
            text-align: right;
            width: 60%;
        }
        .signature-section {
            margin-top: 60px;
            padding-top: 20px;
            border-top: 2px solid #e5e7eb;
        }
        .signature-line {
            display: inline-block;
            width: 40%;
            text-align: center;
            margin: 0 5%;
        }
        .signature-line-border {
            border-top: 1px solid #000;
            margin-top: 40px;
            padding-top: 5px;
        }
        .footer {
            text-align: center;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 2px solid #2a7453;
            font-size: 11px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">PAKISTAN MILITARY ACADEMY</div>
        <div style="font-size: 14px; color: #666;">AS & RC, Gilgit</div>
        <div class="title">TEST CERTIFICATE</div>
        <div style="font-size: 12px; color: #666;">{{ $testAttempt->testVersion->title }}</div>
        <div style="font-size: 11px; color: #999;">Version: {{ $testAttempt->testVersion->version_code }}</div>
    </div>

    <div class="candidate-info">
        @if($testAttempt->candidate->photo)
            <img src="{{ public_path('storage/' . $testAttempt->candidate->photo) }}" 
                 alt="Candidate Photo" 
                 class="candidate-photo">
        @endif
        
        <div class="candidate-name">{{ $testAttempt->candidate->name }}</div>
        <div class="info-row">S/O {{ $testAttempt->candidate->father_name }}</div>
        <div class="info-row">CNIC: {{ $testAttempt->candidate->cnic }}</div>
        <div class="info-row">Phone: {{ $testAttempt->candidate->phone }}</div>
    </div>

    <div class="pass-status {{ $testAttempt->passed ? 'passed' : 'failed' }}">
        <div style="font-size: 28px; font-weight: bold;">
            {{ $testAttempt->passed ? '✓ PASSED' : '✗ NOT PASSED' }}
        </div>
    </div>

    <div class="score-section">
        <h3 style="margin-top: 0; color: #1d4a37;">Overall Performance</h3>
        
        <div class="score-grid">
            <div class="score-item">
                <div class="score-value">{{ $testAttempt->percentage }}%</div>
                <div class="score-label">Overall Score</div>
            </div>
            <div class="score-item">
                <div class="score-value" style="color: #10b981;">{{ $testAttempt->correct_answers }}</div>
                <div class="score-label">Correct</div>
            </div>
            <div class="score-item">
                <div class="score-value" style="color: #ef4444;">{{ $testAttempt->incorrect_answers }}</div>
                <div class="score-label">Incorrect</div>
            </div>
            <div class="score-item">
                <div class="score-value" style="color: #6b7280;">{{ $testAttempt->unanswered }}</div>
                <div class="score-label">Unanswered</div>
            </div>
        </div>
    </div>

    <div class="section-scores">
        <h3 style="color: #1d4a37;">Section-wise Performance</h3>
        @foreach($sectionStats as $section)
            <div class="section-row">
                <span class="section-name">{{ $section['name'] }}</span>
                <span class="section-score">
                    <strong>{{ $section['percentage'] }}%</strong> 
                    ({{ $section['correct'] }}/{{ $section['total'] }} correct)
                </span>
            </div>
        @endforeach
    </div>

    <div style="margin: 30px 0; padding: 15px; background-color: #f3f4f6; border-left: 4px solid #2a7453;">
        <div style="font-size: 11px; color: #666;">
            <div><strong>Test Completed:</strong> {{ $testAttempt->completed_at->format('F d, Y \a\t h:i A') }}</div>
            <div><strong>Time Taken:</strong> {{ gmdate('H:i:s', $testAttempt->time_taken) }}</div>
            <div><strong>Total Questions:</strong> {{ $testAttempt->total_questions }}</div>
            <div><strong>Pass Threshold:</strong> {{ $testAttempt->testVersion->pass_threshold }}%</div>
        </div>
    </div>

    <div class="signature-section">
        <div class="signature-line">
            <div class="signature-line-border">
                Candidate's Signature
            </div>
        </div>
        <div class="signature-line">
            <div class="signature-line-border">
                Authorized Signature
            </div>
        </div>
    </div>

    <div class="footer">
        <div>This is a computer-generated certificate from the PMA Test Management System</div>
        <div>AS & RC, Gilgit | Pakistan Military Academy</div>
        <div style="margin-top: 5px;">Generated on {{ now()->format('F d, Y \a\t h:i A') }}</div>
    </div>
</body>
</html>