<?php

namespace App\Filament\Exports;

use App\Models\Report;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class ReportExporter extends Exporter
{
    protected static ?string $model = Report::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('reference_number'),
            ExportColumn::make('name'),
            // ExportColumn::make('birthplace'),
            // ExportColumn::make('birthdate'),
            // ExportColumn::make('gender'),
            ExportColumn::make('address'),
            ExportColumn::make('phone'),
            // ExportColumn::make('citizen'),
            // ExportColumn::make('profession'),
            ExportColumn::make('policeStation.name'),
            ExportColumn::make('reference_police_number'),
            ExportColumn::make('report_date_time'),
            ExportColumn::make('content'),
            ExportColumn::make('user.name'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your report export has completed and '.number_format($export->successful_rows).' '.str('row')->plural($export->successful_rows).' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' '.number_format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to export.';
        }

        return $body;
    }
}
