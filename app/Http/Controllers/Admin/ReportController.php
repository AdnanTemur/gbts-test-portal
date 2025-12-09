<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TestVersion;
use App\Services\ReportService;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    protected $reportService;

    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    public function index()
    {
        $testVersions = TestVersion::all();
        return view('admin.reports.index', compact('testVersions'));
    }

    public function candidateWise(Request $request)
    {
        $testVersionId = $request->input('test_version_id');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Report logic here
        return view('admin.reports.candidate-wise');
    }

    public function categoryWise(Request $request)
    {
        $testVersionId = $request->input('test_version_id');
        $report = $this->reportService->getCategoryReport($testVersionId);

        return view('admin.reports.category-wise', compact('report'));
    }

    public function overall(Request $request)
    {
        $testVersionId = $request->input('test_version_id');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $report = $this->reportService->getOverallReport($testVersionId, $startDate, $endDate);

        return view('admin.reports.overall', compact('report'));
    }
}