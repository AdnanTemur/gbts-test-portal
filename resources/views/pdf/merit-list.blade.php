<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
    <title>Merit List — {{ $testVersion->title }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #1a1a2e;
            background: #fff;
        }

        /* ── Header ── */
        .header {
            display: table;
            width: 100%;
            border-bottom: 3px solid #1e3a5f;
            padding-bottom: 10px;
            margin-bottom: 12px;
        }

        .header-logo {
            display: table-cell;
            width: 70px;
            vertical-align: middle;
        }

        .header-logo img {
            width: 60px;
            height: 60px;
            object-fit: contain;
        }

        .header-text {
            display: table-cell;
            vertical-align: middle;
            text-align: center;
        }

        .header-text .gov {
            font-size: 11px;
            color: #4a5568;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .header-text .org {
            font-size: 18px;
            font-weight: bold;
            color: #1e3a5f;
            letter-spacing: 0.5px;
        }

        .header-text .dept {
            font-size: 10px;
            color: #718096;
            margin-top: 2px;
        }

        .header-meta {
            display: table-cell;
            width: 160px;
            vertical-align: middle;
            text-align: right;
        }

        .header-meta table {
            width: 100%;
        }

        .header-meta td {
            font-size: 9px;
            padding: 1px 0;
            color: #4a5568;
        }

        .header-meta td:first-child {
            font-weight: bold;
            color: #1e3a5f;
        }

        /* ── Title Banner ── */
        .title-banner {
            border-top: 2px solid #1e3a5f;
            border-bottom: 2px solid #1e3a5f;
            text-align: center;
            padding: 6px 12px;
            margin-bottom: 10px;
        }

        .title-banner .title {
            font-size: 15px;
            font-weight: bold;
            letter-spacing: 2px;
            color: #1e3a5f;
        }

        .title-banner .subtitle {
            font-size: 10px;
            color: #4a5568;
            margin-top: 2px;
        }

        /* ── Summary Row ── */
        .summary {
            display: table;
            width: 100%;
            margin-bottom: 10px;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            overflow: hidden;
        }

        .summary-cell {
            display: table-cell;
            text-align: center;
            padding: 6px 4px;
            border-right: 1px solid #e2e8f0;
        }

        .summary-cell:last-child {
            border-right: none;
        }

        .summary-cell .val {
            font-size: 14px;
            font-weight: bold;
            color: #1e3a5f;
        }

        .summary-cell .lbl {
            font-size: 8px;
            color: #718096;
            text-transform: uppercase;
            margin-top: 1px;
        }

        .summary-cell.pass .val {
            color: #1a1a2e;
        }

        .summary-cell.fail .val {
            color: #1a1a2e;
        }

        /* ── Table ── */
        table.merit {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 12px;
        }

        table.merit thead tr {
            background: #fff;
            border-bottom: 2px solid #1e3a5f;
        }

        table.merit thead th {
            padding: 5px 4px;
            text-align: center;
            font-size: 10px;
            font-weight: bold;
            letter-spacing: 0.3px;
            color: #1e3a5f;
            border: 1px solid #c0c8d8;
            white-space: nowrap;
        }

        table.merit thead th.left {
            text-align: left;
        }

        table.merit tbody tr {
            border-bottom: 1px solid #e8ecf0;
        }

        table.merit tbody tr:nth-child(even) {
            background: #f9f9f9;
        }

        table.merit tbody tr.top3 {
            font-weight: bold;
        }

        table.merit tbody td {
            padding: 5px 4px;
            font-size: 10px;
            border: 1px solid #e8ecf0;
            text-align: center;
            vertical-align: middle;
        }

        table.merit tbody td.left {
            text-align: left;
        }

        .rank-badge {
            display: inline-block;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            border: 1.5px solid #1e3a5f;
            text-align: center;
            line-height: 16px;
            font-weight: bold;
            font-size: 9px;
            color: #1e3a5f;
        }

        .rank-1 {
            border-width: 2px;
        }

        .rank-2 {}

        .rank-3 {}

        .rank-other {
            color: #4a5568;
            font-weight: bold;
        }

        .name {
            font-weight: bold;
            font-size: 10px;
        }

        .father {
            font-size: 9px;
            color: #718096;
        }

        .cnic {
            font-size: 9.5px;
            color: #1a1a2e;
            font-weight: bold;
        }

        .section-score {
            font-weight: bold;
        }

        .section-score.good {
            color: #1a1a2e;
        }

        .section-score.poor {
            color: #1a1a2e;
        }

        .section-pct {
            font-size: 8.5px;
            color: #4a5568;
        }

        .pct-good {
            font-weight: bold;
            color: #1a1a2e;
        }

        .pct-fail {
            font-weight: bold;
            color: #1a1a2e;
        }

        .badge-pass {
            color: #1a1a2e;
            font-weight: bold;
        }

        .badge-fail {
            color: #1a1a2e;
            font-weight: bold;
        }

        /* ── Footer ── */
        .footer {
            border-top: 2px solid #1e3a5f;
            padding-top: 6px;
            display: table;
            width: 100%;
        }

        .footer td {
            font-size: 9px;
            color: #718096;
            vertical-align: bottom;
        }

        .footer .note {
            font-size: 8px;
            color: #a0aec0;
        }

        .page-break {
            page-break-after: always;
        }

        @if(!isset($isPdf) || !$isPdf)
            @media screen {
                body {
                    padding: 12px;
                    background: #f0f4f8;
                }

                .print-wrapper {
                    background: white;
                    max-width: 98vw;
                    margin: 0 auto;
                    padding: 16px 20px;
                    box-shadow: 0 4px 24px rgba(0, 0, 0, 0.1);
                    border-radius: 8px;
                }

                .print-toolbar {
                    max-width: 98vw;
                    margin: 0 auto 12px;
                    display: flex;
                    justify-content: flex-end;
                    gap: 10px;
                }

                .btn-print {
                    background: #1e3a5f;
                    color: white;
                    border: none;
                    padding: 8px 20px;
                    border-radius: 6px;
                    font-size: 13px;
                    cursor: pointer;
                    font-weight: bold;
                }

                .btn-close {
                    background: #718096;
                    color: white;
                    border: none;
                    padding: 8px 20px;
                    border-radius: 6px;
                    font-size: 13px;
                    cursor: pointer;
                }
            }

            @media print {
                .print-toolbar {
                    display: none !important;
                }

                .print-wrapper {
                    padding: 0;
                    box-shadow: none;
                }

                body {
                    padding: 0;
                    background: white;
                }
            }

        @endif
    </style>
</head>

<body>
    @if(!isset($isPdf) || !$isPdf)
        <div class="print-toolbar">
            <button class="btn-close" onclick="window.close()">✕ Close</button>
            <button class="btn-print" onclick="window.print()">🖨 Print</button>
        </div>
        <div class="print-wrapper">
    @endif

        <!-- Header -->
        <div class="header">
            <div class="header-logo">
                @php
                    $logoFile = file_exists(public_path('logo.png')) ? 'logo.png' : 'favicon.png';
                    $logoSrc = request()->routeIs('admin.reports.merit-list.pdf')
                        ? public_path($logoFile)
                        : asset($logoFile);
                @endphp
                @if(file_exists(public_path($logoFile)))
                    <img src="{{ $logoSrc }}" alt="GBTS Logo">
                @endif
            </div>
            <div class="header-text">
                <div class="gov">Government of Gilgit-Baltistan</div>
                <div class="org">Gilgit-Baltistan Testing Service</div>
                <div class="dept">Competitive Examination &amp; Merit-Based Selection</div>
            </div>
            <div class="header-meta">
                <table>
                    <tr>
                        <td>Document:</td>
                        <td>Merit List</td>
                    </tr>
                    <tr>
                        <td>Version:</td>
                        <td>{{ $testVersion->version_code }}</td>
                    </tr>
                    <tr>
                        <td>Generated:</td>
                        <td>{{ now()->format('d M Y, g:i A') }}</td>
                    </tr>
                    <tr>
                        <td>Pass Threshold:</td>
                        <td>{{ $testVersion->pass_threshold }}%</td>
                    </tr>
                    @if(!empty($filters['date_from']) || !empty($filters['date_to']))
                        <tr>
                            <td>Period:</td>
                            <td>
                                {{ !empty($filters['date_from']) ? $filters['date_from'] : '—' }}
                                to
                                {{ !empty($filters['date_to']) ? $filters['date_to'] : 'Present' }}
                            </td>
                        </tr>
                    @endif
                </table>
            </div>
        </div>

        <!-- Title Banner -->
        <div class="title-banner">
            <div class="title">MERIT LIST</div>
            <div class="subtitle">{{ strtoupper($testVersion->title) }}</div>
        </div>

        <!-- Summary -->
        <div class="summary">
            <div class="summary-cell">
                <div class="val">{{ $summary['total'] }}</div>
                <div class="lbl">Total Candidates</div>
            </div>
            <div class="summary-cell pass">
                <div class="val">{{ $summary['passed'] }}</div>
                <div class="lbl">Passed</div>
            </div>
            <div class="summary-cell fail">
                <div class="val">{{ $summary['failed'] }}</div>
                <div class="lbl">Failed</div>
            </div>
            <div class="summary-cell">
                <div class="val">
                    {{ $summary['total'] > 0 ? round($summary['passed'] / $summary['total'] * 100, 1) : 0 }}%
                </div>
                <div class="lbl">Pass Rate</div>
            </div>
            <div class="summary-cell">
                <div class="val">{{ $summary['highest'] }}%</div>
                <div class="lbl">Highest Score</div>
            </div>
            <div class="summary-cell">
                <div class="val">{{ $summary['lowest'] }}%</div>
                <div class="lbl">Lowest Score</div>
            </div>
            <div class="summary-cell">
                <div class="val">{{ $summary['average'] }}%</div>
                <div class="lbl">Average Score</div>
            </div>
        </div>

        <!-- Merit Table -->
        <table class="merit">
            <thead>
                <tr>
                    <th style="width:28px">Rank</th>
                    <th class="left" style="width:130px">Candidate</th>
                    <th style="width:80px">CNIC</th>
                    @foreach($sections as $section)
                        <th style="width:{{ max(55, 60) }}px">{{ Str::limit($section->name, 14) }}</th>
                    @endforeach
                    <th style="width:48px">Score</th>
                    <th style="width:38px">%</th>
                    <th style="width:38px">Time</th>
                    <th style="width:40px">Result</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ranked as $row)
                    <tr class="{{ $row['rank'] <= 3 ? 'top3' : '' }}">
                        <td>
                            @if($row['rank'] <= 3)
                                <span class="rank-badge rank-{{ $row['rank'] }}">{{ $row['rank'] }}</span>
                            @else
                                <span class="rank-other">{{ $row['rank'] }}</span>
                            @endif
                        </td>
                        <td class="left">
                            <span class="name">{{ $row['candidate']->name }}</span><br>
                            <span class="father">S/O {{ $row['candidate']->father_name }}</span>
                        </td>
                        <td><span class="cnic">{{ $row['candidate']->cnic }}</span></td>
                        @foreach($sections as $section)
                            @php $ss = $row['section_scores'][$section->id] ?? null; @endphp
                            <td>
                                @if($ss)
                                    <span class="section-score {{ $ss['percentage'] >= 60 ? 'good' : 'poor' }}">
                                        {{ $ss['correct'] }}/{{ $ss['total'] }}
                                    </span><br>
                                    <span class="section-pct">{{ $ss['percentage'] }}%</span>
                                @else
                                    —
                                @endif
                            </td>
                        @endforeach
                        <td>{{ $row['attempt']->correct_answers }}/{{ $row['attempt']->total_questions }}</td>
                        <td>
                            <span class="{{ $row['passed'] ? 'pct-good' : 'pct-fail' }}">
                                {{ $row['percentage'] }}%
                            </span>
                        </td>
                        <td>{{ gmdate('i:s', $row['time_taken']) }}</td>
                        <td>
                            @if($row['passed'])
                                <span class="badge-pass">✓ PASS</span>
                            @else
                                <span class="badge-fail">✗ FAIL</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ 7 + count($sections) }}" style="text-align:center; padding:20px; color:#a0aec0;">
                            No records found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Footer -->
        <div class="footer">
            <table width="100%">
                <tr>
                    <td style="width:40%">
                        <strong>Note:</strong> Ranked by Total Score → Time Taken → Name (Alphabetical)<br>
                        <span class="note">This document is computer-generated. Verify with official records.</span>
                    </td>
                    <td style="text-align:center; width:20%">
                        <strong>GBTS Portal</strong><br>
                        <span class="note">Gilgit-Baltistan Testing Service</span>
                    </td>
                    <td style="text-align:right; width:40%">
                        <strong>Authorised Signatory</strong><br><br>
                        <span style="border-top:1px solid #1e3a5f; padding-top:2px;">Controller of Examinations</span>
                    </td>
                </tr>
            </table>
        </div>

        @if(!isset($isPdf) || !$isPdf)
            </div><!-- end print-wrapper -->
        @endif
</body>

</html>