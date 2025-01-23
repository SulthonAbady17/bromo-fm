<?php

namespace App\Filament\Resources\ReportResource\Pages;

use App\Filament\Resources\ReportResource;
use App\Models\Report;
use Filament\Resources\Pages\CreateRecord;
use Romans\Filter\IntToRoman;

class CreateReport extends CreateRecord
{
    protected static string $resource = ReportResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $roman = new IntToRoman;
        $order = Report::count() + 1;
        $number = sprintf('%03d', $order);
        $date = date('d');
        $month = $roman->filter(date('n'));
        $year = date('Y');

        $data['user_id'] = auth()->id();
        $data['reference_number'] = "{$number}/{$date}/{$month}/BROMO FM/{$year}";

        return $data;
    }
}
