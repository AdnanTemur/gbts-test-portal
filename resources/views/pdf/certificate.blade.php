<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Test Certificate</title>
    <style>
        @page {
            margin: 15mm;
            size: A4 portrait;
        }

        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            font-size: 11px;
            line-height: 1.4;
        }

        .certificate-container {
            border: 3px solid #2a7453;
            padding: 20px;
            position: relative;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #2a7453;
        }

        .logo {
            font-size: 18px;
            font-weight: bold;
            color: #2a7453;
            letter-spacing: 1px;
        }

        .subtitle {
            font-size: 10px;
            color: #666;
            margin-top: 3px;
        }

        .title {
            font-size: 24px;
            font-weight: bold;
            margin: 12px 0 8px 0;
            color: #1d4a37;
            letter-spacing: 2px;
        }

        .test-info {
            font-size: 10px;
            color: #666;
        }

        .content-row {
            display: table;
            width: 100%;
            margin-bottom: 15px;
        }

        .photo-section {
            display: table-cell;
            width: 120px;
            vertical-align: top;
            padding-right: 20px;
        }

        .candidate-photo {
            width: 110px;
            height: 110px;
            border-radius: 8px;
            object-fit: cover;
            border: 3px solid #2a7453;
            display: block;
        }

        .info-section {
            display: table-cell;
            vertical-align: top;
        }

        .candidate-name {
            font-size: 18px;
            font-weight: bold;
            color: #1d4a37;
            margin-bottom: 8px;
        }

        .info-grid {
            display: table;
            width: 100%;
        }

        .info-item {
            display: table-row;
        }

        .info-label {
            display: table-cell;
            font-weight: bold;
            color: #555;
            padding: 3px 10px 3px 0;
            width: 80px;
        }

        .info-value {
            display: table-cell;
            color: #333;
            padding: 3px 0;
        }

        .pass-status {
            text-align: center;
            margin: 0 auto;
            width: 200px; 
            padding: 12px;
            border: 2px solid;
            border-radius: 8px;
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

        .status-text {
            font-size: 20px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .status-icon {
            width: 24px;
            height: 24px;
            display: inline-block;
            vertical-align: middle;
        }

        .score-grid {
            display: table;
            width: 100%;
            margin: 12px 0;
            background-color: #f9fafb;
            border-radius: 6px;
            padding: 10px;
        }

        .score-item {
            display: table-cell;
            text-align: center;
            padding: 8px;
            border-right: 1px solid #ddd;
        }

        .score-item:last-child {
            border-right: none;
        }

        .score-value {
            font-size: 20px;
            font-weight: bold;
            color: #2a7453;
        }

        .score-label {
            font-size: 9px;
            color: #666;
            margin-top: 3px;
            text-transform: uppercase;
        }

        .section-title {
            font-size: 12px;
            font-weight: bold;
            color: #1d4a37;
            margin: 12px 0 8px 0;
            padding-bottom: 5px;
            border-bottom: 1px solid #e5e7eb;
        }

        .section-row {
            display: table;
            width: 100%;
            padding: 6px 0;
            border-bottom: 1px solid #f3f4f6;
        }

        .section-name {
            display: table-cell;
            font-weight: 600;
            width: 50%;
            color: #333;
        }

        .section-score {
            display: table-cell;
            text-align: right;
            width: 50%;
            color: #555;
        }

        .meta-info {
            margin: 12px 0;
            padding: 10px;
            background-color: #f9fafb;
            border-left: 3px solid #2a7453;
            border-radius: 4px;
        }

        .meta-row {
            display: table;
            width: 100%;
            margin: 2px 0;
        }

        .meta-label {
            display: table-cell;
            font-weight: bold;
            color: #555;
            width: 35%;
            font-size: 10px;
        }

        .meta-value {
            display: table-cell;
            color: #333;
            font-size: 10px;
        }

        .signature-section {
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid #e5e7eb;
        }

        .signature-row {
            display: table;
            width: 100%;
        }

        .signature-box {
            display: table-cell;
            width: 50%;
            text-align: center;
            padding: 0 20px;
        }

        .signature-line {
            border-top: 1px solid #333;
            margin-top: 30px;
            padding-top: 5px;
            font-size: 10px;
            color: #666;
        }

        .footer {
            text-align: center;
            margin-top: 15px;
            padding-top: 10px;
            border-top: 2px solid #2a7453;
            font-size: 8px;
            color: #666;
        }

        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 80px;
            font-weight: bold;
            opacity: 0.05;
            color: #2a7453;
            z-index: -1;
        }
    </style>
</head>

<body>
    <div class="certificate-container">
        <div class="watermark">GBTS</div>

        <!-- Header -->
        <div class="header">
            <div class="logo">GILGIT BALTISTAN TESTING SERVICE (CBT)</div>
            <div class="subtitle">GBTS, Gilgit</div>
            <div class="title">TEST CERTIFICATE</div>
            <div class="test-info">
                <strong>{{ $testAttempt->testVersion->title }}</strong>
                <span style="margin: 0 8px;">|</span>
                Version: {{ $testAttempt->testVersion->version_code }}
            </div>
        </div>

        <!-- Candidate Info with Photo -->
        <div class="content-row">
            @if($testAttempt->candidate->photo)
                <div class="photo-section">
                    <img src="{{ public_path('storage/' . $testAttempt->candidate->photo) }}" alt="Photo"
                        class="candidate-photo">
                </div>
            @endif

            <div class="info-section">
                <div class="candidate-name">{{ $testAttempt->candidate->name }}</div>
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">Father's Name:</div>
                        <div class="info-value">{{ $testAttempt->candidate->father_name }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">CNIC:</div>
                        <div class="info-value">{{ $testAttempt->candidate->cnic }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Phone:</div>
                        <div class="info-value">{{ $testAttempt->candidate->phone }}</div>
                    </div>
                    @if($testAttempt->candidate->email)
                        <div class="info-item">
                            <div class="info-label">Email:</div>
                            <div class="info-value">{{ $testAttempt->candidate->email }}</div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Pass/Fail Status with SVG Icons -->
        <div class="pass-status {{ $testAttempt->passed ? 'passed' : 'failed' }}">
            @if($testAttempt->passed)
                <div style="font-size: 24px; font-weight: bold;">
                    <span
                        style="display: inline-block; width: 20px; height: 20px; line-height: 20px; text-align: center; background-color: #10b981; border-radius: 50%; color: white; margin-right: 10px; vertical-align: middle; font-size: 16px; font-weight: bold;">&check;</span>
                    <span style="vertical-align: middle;">PASSED</span>
                </div>
            @else
                <div style="font-size: 24px; font-weight: bold;">
                    <span
                        style="display: inline-block; width: 20px; height: 20px; line-height: 20px; text-align: center; background-color: #ef4444; border-radius: 50%; color: white; margin-right: 10px; vertical-align: middle; font-size: 16px; font-weight: bold;">&times;</span>
                    <span style="vertical-align: middle;">NOT PASSED</span>
                </div>
            @endif
        </div>

        <!-- Overall Performance -->
        <div class="section-title">Overall Performance</div>
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

        <!-- Section-wise Performance -->
        <div class="section-title">Section-wise Performance</div>
        @foreach($sectionStats as $section)
            <div class="section-row">
                <span class="section-name">{{ $section['name'] }}</span>
                <span class="section-score">
                    <strong>{{ $section['percentage'] }}%</strong>
                    ({{ $section['correct'] }}/{{ $section['total'] }})
                </span>
            </div>
        @endforeach

        <!-- Test Details -->
        <div class="section-title">Test Details</div>
        <div class="meta-info">
            <div class="meta-row">
                <div class="meta-label">Test Completed:</div>
                <div class="meta-value">{{ $testAttempt->completed_at->format('F d, Y \a\t h:i A') }}</div>
            </div>
            <div class="meta-row">
                <div class="meta-label">Time Taken:</div>
                <div class="meta-value">{{ gmdate('H:i:s', $testAttempt->time_taken) }}</div>
            </div>
            <div class="meta-row">
                <div class="meta-label">Total Questions:</div>
                <div class="meta-value">{{ $testAttempt->total_questions }}</div>
            </div>
            <div class="meta-row">
                <div class="meta-label">Pass Threshold:</div>
                <div class="meta-value">{{ $testAttempt->testVersion->pass_threshold }}%</div>
            </div>
        </div>

        <!-- Signatures -->
        <div class="signature-section">
            <div class="signature-row">
                <div class="signature-box">
                    <div class="signature-line">Candidate's Signature</div>
                </div>
                <div class="signature-box">
                    <div class="signature-line">Authorized Signature</div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div><strong>Computer-generated certificate from GBTS Computer Based Test Management System</strong></div>
            <div>GBTS, Gilgit | Gilgit-Baltistan</div>
            <div style="margin-top: 3px;">Certificate ID: {{ strtoupper(substr($testAttempt->attempt_token, 0, 12)) }} |
                Generated: {{ now()->format('d-M-Y h:i A') }}</div>
        </div>
    </div>
</body>

</html>