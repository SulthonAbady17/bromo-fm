<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Spatie\Browsershot\Browsershot;
use Spatie\LaravelPdf\Facades\Pdf;

use function Spatie\LaravelPdf\Support\pdf;

class PdfController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Report $report)
    {
        $reference_number = str_replace(['/', ' '], '', $report->reference_number);

        return pdf()
            ->view('pdf.report', compact('report'))
            ->name("{$reference_number}_{$report->name}.pdf");
        // return view('pdf.report', compact('report'));

        // return Pdf::view('pdf.report', ['report' => $report])->name("{$reference_number}_{$report->name}.pdf");
        // $template = view('pdf.report', ['report' => $report])->render();
        // return Pdf::html($template);

        // Browsershot::html($template)->showBackground()->pdf("{$reference_number}_{$report->name}.pdf");
    }
}
