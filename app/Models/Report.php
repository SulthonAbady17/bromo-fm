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

    public function policeStation(): BelongsTo
    {
        return $this->belongsTo(PoliceStation::class);
    }
}
