<?php

namespace App\Livewire\Appointment;

use Livewire\Component;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class ShowAppointments extends Component
{
    protected $dates = ['start_time', 'end_time'];

    public function mount()
    {
        
        $this->appointments = Auth::user()->appointments; 
    }


    public function changeStatus($appointmentId, $status)
    {
       
        $validStatuses = ['pending', 'confirmed', 'cancelled'];
        
        if (!in_array($status, $validStatuses)) {
            session()->flash('error', 'Estado inválido');
            return;
        }

        
        $appointment = Appointment::find($appointmentId);

       
        if ($appointment && $appointment->patient_id === Auth::user()->id) {
           
            $appointment->update(['status' => $status]);
            session()->flash('message', 'Estado de la cita actualizado con éxito');
        } else {
            session()->flash('error', 'Cita no encontrada o no pertenece a este usuario');
        }

       
        $this->appointments = Auth::user()->appointments;
    }


    public $appointments;
    public function render()
    {
        return view('livewire.appointment.show-appointments');
    }
}
