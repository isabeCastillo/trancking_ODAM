<?php

namespace App\Livewire;

use Livewire\Component;

class MotoristaVehiculo extends Component
{
    public function render()
    {
        $user = auth()->user();
        $vehiculo = $user?->vehiculo; 

        return view('livewire.motorista-vehiculo', compact('user', 'vehiculo'))
            ->layout('components.layouts.motorista');
    }
}
