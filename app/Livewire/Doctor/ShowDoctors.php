<?php

namespace App\Livewire\Doctor;

use Livewire\Component;
use App\Models\Doctor;

class ShowDoctors extends Component
{

    public $search = '';
    

    public function mount()
    {
        
    }

    public function render()
    {
        $doctors = Doctor::where('speciality', 'like', '%' . $this->search . '%')
        ->orWhere('name', 'like', '%' . $this->search . '%')->get();
        
        return view('livewire.doctor.show-doctors ', compact('doctors'));
    }
}
