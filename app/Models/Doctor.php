<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model

{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'status', 
        'phone_number', 'address', 'speciality'
    ];


    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function availabilities()
    {
        return $this->hasMany(Availability::class);
    }

    public function scheduleChanges()
    {
        return $this->hasMany(ScheduleChange::class);
    }
}
