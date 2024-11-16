<?php

namespace App\Livewire\Doctor;

use Livewire\Component;
use App\Models\Doctor;
use App\Models\Availability;

class ShowDoctors extends Component
{

    public $search = '', $doctor, $doctorId, $start_time, $end_time, $message = '', $showScheduleModal;

    public function mount()
    {
        $this->doctor = Doctor::all();
    }

    public function updatedSearch()
    {
        $this->doctor = Doctor::where('name', 'like', '%' . $this->search . '%')->get();
    }

    //
    public function scheduleDoctorAvailability()
    {
        
        $validatedData = $this->validate([
            'start_time' => 'required|date|after:now',
            'end_time' => 'required|date|after:start_time',
        ]);

        // Delete the doctor's existing availabilities
        Availability::where('doctor_id', $this->doctorId)->delete();

        // Create the new availability
        Availability::create([
            'doctor_id' => $this->doctorId,
            'start_time' => $validatedData['start_time'],
            'end_time' => $validatedData['end_time'],
        ]);

    
        $this->message = 'Horario actualizado con éxito.';
        $this->reset(['start_time', 'end_time']); 
    }



    public function scheduleDoctor($doctorId)
    {
        $this->doctorId = $doctorId;
        $this->showScheduleModal = true;
    }

    // Method to obtain the availability of the selected doctor
    public function getDoctorAvailability()
    {
        return Availability::where('doctor_id', $this->doctorId)->get();
    }


    public function render()
    {
        $doctors = Doctor::where('speciality', 'like', '%' . $this->search . '%')
            ->orWhere('name', 'like', '%' . $this->search . '%')->get();

        $selectedDoctor = Doctor::find($this->doctorId);
        // Get the availability of the selected doctor
        $availabilities = $this->getDoctorAvailability();

        return view('livewire.doctor.show-doctors', compact('doctors', 'selectedDoctor'));
    }
}
