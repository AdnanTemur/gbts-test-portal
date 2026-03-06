<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TestVersion;
use App\Services\PDFService;
use App\Services\ReportService;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    protected $reportService;
    protected $pdfService;

    public function __construct(ReportService $reportService, PDFService $pdfService)
    {
        $this->reportService = $reportService;
        $this->pdfService = $pdfService;
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

    public function meritList(Request $request)
    {
        $testVersions = TestVersion::orderByDesc('created_at')->get();
        $data = null;

        if ($request->filled('test_version_id')) {
            $filters = $request->only(['date_from', 'date_to', 'result']);
            $filters['result'] = $filters['result'] ?? 'all';
            $data = $this->reportService->getMeritList($request->test_version_id, $filters);
        }

        return view('admin.reports.merit-list', compact('testVersions', 'data'));
    }

    public function meritListPdf(Request $request)
    {
        $request->validate(['test_version_id' => 'required|exists:test_versions,id']);
        $filters = $request->only(['date_from', 'date_to', 'result']);
        $filters['result'] = $filters['result'] ?? 'all';
        $data = $this->reportService->getMeritList($request->test_version_id, $filters);
        return $this->pdfService->generateMeritList($data);
    }

    public function viewMeritList(Request $request)
    {
        $request->validate(['test_version_id' => 'required|exists:test_versions,id']);
        $filters = $request->only(['date_from', 'date_to', 'result']);
        $filters['result'] = $filters['result'] ?? 'all';
        $data = $this->reportService->getMeritList($request->test_version_id, $filters);
        return view('pdf.merit-list', $data);
    }
}