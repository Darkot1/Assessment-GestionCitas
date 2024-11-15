<?php

namespace App\Livewire\Doctor;

use Livewire\Component;
use App\Models\Doctor;

class CreateDoctors extends Component
{
    public $name, $email, $phone_number, $address, $speciality, $status = 'active', $password;
    public $isModalOpen = false; 
    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:doctors,email',
        'phone_number' => 'nullable|string|max:15',
        'address' => 'nullable|string|max:255',
        'speciality' => 'required|in:dentist,surgeon,physician,gynecologist,pediatrician,orthopedic',
        'password' => 'required|string|min:8',
    ];

    public function createDoctor()
    {
        $this->validate();

        Doctor::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'address' => $this->address,
            'speciality' => $this->speciality,
            'password' => bcrypt($this->password),
        ]);

        session()->flash('message', 'Doctor creado exitosamente.');
        $this->reset();
        $this->isModalOpen = false;
    }

    public function render()
    {
        return view('livewire.doctor.create-doctors');
    }
}
