<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Report extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'reference_number',
        'name',
        'nik',
        'birthplace',
        'birthdate',
        'gender',
        'address',
        'phone',
        'citizen',
        'profession',
        'police_station',
        'reference_police_number',
        'report_date_time',
        'content',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getDay(): string
    {
        $day = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        $report_day = date('w', strtotime($this->report_date_time));

        return $day[$report_day];
    }

    public function getMonth($month): string
    {
        $months = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        $report_month = $month;

        return $months[$report_month];
    }

    public function getDate(): string
    {
        $date = date('d', strtotime($this->created_at));
        $month = $this->getMonth(date('n', strtotime($this->created_at)));
        $year = date('Y', strtotime($this->created_at));

        return "Probolinggo, {$date} {$month} {$year}";
    }

    public function getReportDate(): string
    {
        $date = date('d', strtotime($this->report_date_time));
        $month = $this->getMonth(date('n', strtotime($this->report_date_time)));
        $year = date('Y', strtotime($this->report_date_time));
        $time = date('H.i', strtotime($this->report_date_time));
        $report_date = "{$this->getDay()} Tanggal {$date} {$month} {$year} pukul {$time} WIB";

        return $report_date;
    }
}
