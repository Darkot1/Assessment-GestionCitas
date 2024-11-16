<?php

namespace App\Livewire\Appointment;

use Livewire\Component;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Availability;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CreateAppointments extends Component
{
    public $doctor_id;
    public $start_time;
    public $end_time;
    public $reason;
    public $status = 'pending'; 
    public $doctors;
    public $availabilities;  
    public $isModalOpen = false;

    // Register appointment
    public function createAppointment()
    {
        $this->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'start_time' => 'required|date|after_or_equal:today',
            'end_time' => 'required|date|after:start_time',
            'reason' => 'required|string|max:255',
            'status' => 'required|in:pending,confirmed,canceled,done',
        ]);

        $doctorAvailability = Availability::where('doctor_id', $this->doctor_id)->get();

        if ($doctorAvailability->isEmpty()) {
            session()->flash('warning', 'Este doctor no tiene un horario disponible configurado.');
            return;
        }

        $isWithinAvailability = $doctorAvailability->contains(function ($availability) {
            return Carbon::parse($this->start_time)->between($availability->start_time, $availability->end_time) &&
                   Carbon::parse($this->end_time)->between($availability->start_time, $availability->end_time);
        });

        if (!$isWithinAvailability) {
            session()->flash('message', 'El horario seleccionado no coincide con la disponibilidad del doctor.');
            return;
        }

        $existingAppointment = Appointment::where('doctor_id', $this->doctor_id)
            ->where(function ($query) {
                $query->whereBetween('start_time', [$this->start_time, $this->end_time])
                      ->orWhereBetween('end_time', [$this->start_time, $this->end_time]);
            })
            ->exists();

        if ($existingAppointment) {
            session()->flash('message', 'El horario seleccionado ya está ocupado, por favor elija otro.');
            return;
        }

        Appointment::create([
            'doctor_id' => $this->doctor_id,
            'patient_id' => Auth::user()->id,
            'start_time' => Carbon::parse($this->start_time),
            'end_time' => Carbon::parse($this->end_time),
            'reason' => $this->reason,
            'status' => $this->status,
        ]);

        $this->reset(['doctor_id', 'start_time', 'end_time', 'reason', 'status']);
        session()->flash('message', 'Cita agendada exitosamente.');
    }


    // Load available doctors when initializing the component
    public function mount()
    {
        $this->doctors = Doctor::whereHas('availabilities')->get();
    }

    // Get the availability of the selected doctor
    public function updatedDoctorId($doctorId)
    {
        if ($doctorId) {
            
            $this->availabilities = Availability::where('doctor_id', $doctorId)->get();
        } else {
           
            $this->availabilities = [];
        }
    }

    public function updatedStartTime($startTime)
{
    // If a date has been selected, an hour is added 30 minutes later
    if ($startTime) {
        $this->end_time = Carbon::parse($startTime)->addMinutes(30)->format('Y-m-d\TH:i');
    }
}

    public function render()
    {
        return view('livewire.appointment.create-appointments', [
            'availabilities' => $this->availabilities,
        ]);
    }
}
