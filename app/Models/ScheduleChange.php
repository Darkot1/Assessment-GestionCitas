<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ScheduleChange extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id', 'changed_Date', 'reason'
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
