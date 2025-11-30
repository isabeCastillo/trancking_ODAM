<?php

namespace App\Livewire;
use App\Models\Vehiculo;

use Livewire\Component;

class VehiculosIndex extends Component
{
    public $buscar = ' ';
    public function render()
    {
       $vehiculos = Vehiculo::where('placa', 'like', '%'.$this->buscar.'%')
            ->orWhere('marca', 'like', '%'.$this->buscar.'%')
            ->get();

        return view('livewire.vehiculos-index', compact('vehiculos'));
    }

    public function eliminar($id)
    {
        Vehiculo::findOrFail($id)->delete();
    }
    
}
