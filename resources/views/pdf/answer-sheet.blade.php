<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Detailed Answer Sheet</title>
    <style>
        body {
            font-family: 'DejaVu Sans', 'Arial', sans-serif;
            margin: 30px;
            font-size: 11px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #2a7453;
            padding-bottom: 15px;
        }

        .logo {
            font-size: 18px;
            font-weight: bold;
            color: #2a7453;
        }

        .title {
            font-size: 20px;
            font-weight: bold;
            margin: 10px 0;
            color: #1d4a37;
        }

        .candidate-section {
            margin-bottom: 15px;
            padding: 10px;
            background-color: #f9fafb;
            border-left: 3px solid #2a7453;
        }

        .info-grid {
            display: table;
            width: 100%;
        }

        .info-item {
            display: table-cell;
            padding: 3px 10px;
        }

        .question-block {
            margin-bottom: 15px;
            page-break-inside: avoid;
            border: 1px solid #e5e7eb;
            padding: 10px;
        }

        .question-header {
            display: table;
            width: 100%;
            margin-bottom: 8px;
        }

        .question-number {
            display: table-cell;
            width: 50px;
            font-weight: bold;
            padding: 5px;
            text-align: center;
            border-radius: 4px;
        }

        .question-number.correct {
            background-color: #d1fae5;
            color: #065f46;
        }

        .question-number.incorrect {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .question-text {
            display: table-cell;
            padding: 5px 10px;
            vertical-align: middle;
        }

        .question-meta {
            display: table-cell;
            text-align: right;
            width: 150px;
            font-size: 10px;
            color: #666;
        }

        .options-list {
            margin: 8px 0;
            padding-left: 60px;
        }

        .option-item {
            padding: 5px;
            margin: 3px 0;
            border-radius: 3px;
        }

        .option-item.correct {
            background-color: #d1fae5;
            border-left: 3px solid #10b981;
            font-weight: bold;
        }

        .option-item.selected-wrong {
            background-color: #fee2e2;
            border-left: 3px solid #ef4444;
            font-weight: bold;
        }

        .option-item.neutral {
            background-color: #f9fafb;
        }

        .matching-grid {
            display: table;
            width: 100%;
            margin: 8px 0;
            padding-left: 60px;
        }

        .matching-column {
            display: table-cell;
            width: 50%;
            padding: 0 10px;
        }

        .matching-item {
            padding: 5px;
            margin: 3px 0;
            border-radius: 3px;
        }

        .matching-item.correct {
            background-color: #d1fae5;
            border-left: 3px solid #10b981;
        }

        .matching-item.incorrect {
            background-color: #fee2e2;
            border-left: 3px solid #ef4444;
        }

        .summary-section {
            margin-top: 20px;
            padding: 15px;
            background-color: #f3f4f6;
            border: 2px solid #2a7453;
            page-break-inside: avoid;
        }

        .summary-grid {
            display: table;
            width: 100%;
            margin-top: 10px;
        }

        .summary-item {
            display: table-cell;
            text-align: center;
            padding: 10px;
            border-right: 1px solid #ddd;
        }

        .summary-item:last-child {
            border-right: none;
        }

        .summary-value {
            font-size: 20px;
            font-weight: bold;
            color: #2a7453;
        }

        .summary-label {
            font-size: 10px;
            color: #666;
            margin-top: 3px;
        }

        .section-divider {
            margin: 20px 0;
            padding: 8px;
            background-color: #2a7453;
            color: white;
            font-weight: bold;
            text-align: center;
            font-size: 12px;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 15px;
            border-top: 2px solid #2a7453;
            font-size: 9px;
            color: #666;
        }

        .badge {
            display: inline-block;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 9px;
            font-weight: bold;
        }

        .badge-success {
            background-color: #d1fae5;
            color: #065f46;
        }

        .badge-danger {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .badge-warning {
            background-color: #fef3c7;
            color: #92400e;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="logo">GILGIT BALTISTAN TESTING SERVICE (CBT)</div>
        <div style="font-size: 11px; color: #666;">GBTS, Gilgit</div>
        <div class="title">DETAILED ANSWER SHEET</div>
        <div style="font-size: 10px; color: #666;">{{ $testAttempt->testVersion->title }}</div>
    </div>

    <div class="candidate-section">
        <div class="info-grid">
            <div class="info-item">
                <strong>Name:</strong> {{ $testAttempt->candidate->name }}
            </div>
            <div class="info-item">
                <strong>Father Name:</strong> {{ $testAttempt->candidate->father_name }}
            </div>
        </div>
        <div class="info-grid">
            <div class="info-item">
                <strong>CNIC:</strong> {{ $testAttempt->candidate->cnic }}
            </div>
            <div class="info-item">
                <strong>Phone:</strong> {{ $testAttempt->candidate->phone }}
            </div>
            <div class="info-item">
                <strong>Completed:</strong> {{ $testAttempt->completed_at->format('M d, Y H:i A') }}
            </div>
        </div>
    </div>

    <div class="summary-section">
        <h3 style="margin: 0 0 10px 0; color: #1d4a37;">Performance Summary</h3>
        <div class="summary-grid">
            <div class="summary-item">
                <div class="summary-value">{{ $testAttempt->percentage }}%</div>
                <div class="summary-label">Overall Score</div>
            </div>
            <div class="summary-item">
                <div class="summary-value" style="color: #10b981;">{{ $testAttempt->correct_answers }}</div>
                <div class="summary-label">Correct</div>
            </div>
            <div class="summary-item">
                <div class="summary-value" style="color: #ef4444;">{{ $testAttempt->incorrect_answers }}</div>
                <div class="summary-label">Incorrect</div>
            </div>
            <div class="summary-item">
                <div class="summary-value" style="color: #6b7280;">{{ $testAttempt->unanswered }}</div>
                <div class="summary-label">Unanswered</div>
            </div>
            <div class="summary-item">
                <div class="summary-value">{{ $testAttempt->total_questions }}</div>
                <div class="summary-label">Total Questions</div>
            </div>
        </div>
    </div>

    @php
        $currentSection = null;
        $questionNumber = 0;
    @endphp

    @foreach($testAttempt->candidateAnswers as $answer)
        @php
            $question = $answer->question;
            $questionNumber++;

            // Section divider
            if ($currentSection != $question->testSection->name) {
                $currentSection = $question->testSection->name;
                echo '<div class="section-divider">' . $currentSection . '</div>';
            }
        @endphp

        <div class="question-block">
            <div class="question-header">
                <div class="question-number {{ $answer->is_correct ? 'correct' : 'incorrect' }}">
                    Q{{ $questionNumber }}
                    <div style="font-size: 9px;">{!! $answer->is_correct ? '&check;' : '&times;' !!}</div>
                </div>
                <div class="question-text">
                    {{ $question->question_text }}
                </div>
                <div class="question-meta">
                    <span class="badge badge-warning">{{ ucfirst($question->difficulty_level) }}</span>
                    <span class="badge {{ $answer->is_correct ? 'badge-success' : 'badge-danger' }}">
                        {{ $question->marks }} {{ $question->marks > 1 ? 'marks' : 'mark' }}
                    </span>
                </div>
            </div>

            @if($question->isMCQ() || $question->isTrueFalse())
                <div class="options-list">
                    @foreach($question->options as $optIndex => $option)
                        <div
                            class="option-item {{ $option->is_correct ? 'correct' : ($answer->selected_option_id == $option->id ? 'selected-wrong' : 'neutral') }}">
                            <strong>{{ chr(65 + $optIndex) }}.</strong> {{ $option->option_text }}
                            @if($option->is_correct)
                                <strong style="float: right; color: #065f46;">&check; CORRECT ANSWER</strong>
                            @elseif($answer->selected_option_id == $option->id)
                                <strong style="float: right; color: #991b1b;">&times; YOUR ANSWER</strong>
                            @endif
                        </div>
                    @endforeach

                    @if(!$answer->selected_option_id)
                        <div style="padding: 5px; margin-top: 5px; color: #6b7280; font-style: italic;">
                            ! No answer selected
                        </div>
                    @endif
                </div>
            @endif

            @if($question->isMatching())
                <div class="matching-grid">
                    <div class="matching-column">
                        <h4 style="margin: 0 0 5px 0; font-size: 11px;">Your Answers</h4>
                        @foreach($question->matchingPairs as $pair)
                            @php
                                $yourAnswer = $answer->matching_answers[$pair->pair_order] ?? null;
                                $isCorrect = $yourAnswer == $pair->column_b_key;
                            @endphp
                            <div class="matching-item {{ $isCorrect ? 'correct' : 'incorrect' }}">
                                <strong>{{ $pair->pair_order }}.</strong> {{ $pair->column_a_text }} &rarr;
                                <strong>{{ $yourAnswer ?? '?' }}</strong>
                                {{ $isCorrect ? '&check;' : '&times;' }}
                            </div>
                        @endforeach
                    </div>
                    <div class="matching-column">
                        <h4 style="margin: 0 0 5px 0; font-size: 11px;">Correct Answers</h4>
                        @foreach($question->matchingPairs as $pair)
                            <div class="matching-item correct">
                                <strong>{{ $pair->pair_order }}.</strong> {{ $pair->column_a_text }} →
                                <strong>{{ $pair->column_b_key }}. {{ $pair->column_b_text }}</strong>
                            </div>
                        @endforeach
                    </div>
                </div>

                @if($answer->is_correct)
                    <div
                        style="padding: 5px; margin-top: 5px; background-color: #d1fae5; color: #065f46; font-weight: bold; text-align: center;">
                        &check; All pairs matched correctly!
                    </div>
                @else
                    <div
                        style="padding: 5px; margin-top: 5px; background-color: #fee2e2; color: #991b1b; font-weight: bold; text-align: center;">
                        &times; Not all pairs were matched correctly (0 marks for matching questions)
                    </div>
                @endif
            @endif
        </div>

        @if($questionNumber % 10 == 0 && !$loop->last)
            <div style="page-break-after: always;"></div>
        @endif
    @endforeach

    <div class="footer">
        <div><strong>Test Version:</strong> {{ $testAttempt->testVersion->version_code }}</div>
        <div><strong>Pass Threshold:</strong> {{ $testAttempt->testVersion->pass_threshold }}%</div>
        <div><strong>Status:</strong> {{ $testAttempt->passed ? 'PASSED' : 'NOT PASSED' }}</div>
        <div style="margin-top: 10px;">This is a computer-generated answer sheet from the GBTS Computer Based Test Management System
        </div>
        <div>GBTS, Gilgit | Gilgit Baltistan</div>
        <div style="margin-top: 5px;">Generated on {{ now()->format('F d, Y \a\t h:i A') }}</div>
    </div>
</body>

</html>