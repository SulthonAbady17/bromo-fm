<?php

use App\Http\Controllers\PdfController;
use App\Models\Report;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('pdf/{report}', PdfController::class)->name('pdf');
Route::get('/pdf/{report}', function (Report $report) {
    return view('pdf.report', compact('report'));
})->name('pdf');
