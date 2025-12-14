<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\TestSectionController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\TestVersionController;
use App\Http\Controllers\Admin\CandidateManagementController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Auth\LoginController;

// Public routes
Route::get('/', [CandidateController::class, 'index'])->name('home');
Route::post('/candidate/lookup', [CandidateController::class, 'lookup'])->name('candidate.lookup');
Route::get('/candidate/lookup', function () {
    return redirect()->route('home')->with('error', 'Validation failed during registration. Please try again.');
})->name('candidate.lookup.redirect');
Route::post('/candidate/register', [CandidateController::class, 'register'])->name('candidate.register');
Route::get('/candidate/register', function() {
    return redirect()->route('home')->with('info', 'Please start from the home page.');
});

// Test taking routes
Route::get('/test/start/{token}', [TestController::class, 'start'])->name('test.start');
Route::get('/test/instructions/{token}', [TestController::class, 'instructions'])->name('test.instructions');
Route::post('/test/begin/{token}', [TestController::class, 'begin'])->name('test.begin');
Route::get('/test/section/{token}', [TestController::class, 'section'])->name('test.section');
Route::post('/test/answer/{token}', [TestController::class, 'saveAnswer'])->name('test.answer');
Route::post('/test/next-section/{token}', [TestController::class, 'nextSection'])->name('test.nextSection');
Route::post('/test/submit/{token}', [TestController::class, 'submit'])->name('test.submit');

// Result routes
Route::get('/results/{token}', [ResultController::class, 'show'])->name('results.show');
Route::get('/results/{token}/pdf', [ResultController::class, 'pdf'])->name('results.pdf');

// Auth routes
Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/admin/login', [LoginController::class, 'login']);
Route::post('/admin/logout', [LoginController::class, 'logout'])->name('logout');

// Admin routes
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

    // Test Sections
    Route::resource('sections', TestSectionController::class);

    // Questions
    Route::resource('questions', QuestionController::class);

    // Test Versions
    Route::resource('test-versions', TestVersionController::class);
    Route::get('test-versions/{testVersion}/preview', [TestVersionController::class, 'preview'])->name('test-versions.preview');

    // Candidates
    Route::get('candidates', [CandidateManagementController::class, 'index'])->name('candidates.index');
    Route::get('candidates/{candidate}', [CandidateManagementController::class, 'show'])->name('candidates.show');

    // Reports
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('reports/candidate-wise', [ReportController::class, 'candidateWise'])->name('reports.candidate-wise');
    Route::get('reports/category-wise', [ReportController::class, 'categoryWise'])->name('reports.category-wise');
    Route::get('reports/overall', [ReportController::class, 'overall'])->name('reports.overall');
});