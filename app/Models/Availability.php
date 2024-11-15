<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id', 'start_time', 'end_time'
    ];

    /**
     * Relación con el doctor (Doctor).
     */
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
