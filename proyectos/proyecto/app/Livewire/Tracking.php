<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Envio;

class Tracking extends Component
{
    public $codigo;  // Lo que ingresa la persona
    public $envio;   // Resultado de la búsqueda
    public $mensaje; // Mensaje si no encuentra

    public function buscar()
    {
        $this->envio = Envio::where('codigo_tracking', $this->codigo)->first();

        if (!$this->envio) {
            $this->mensaje = "No se encontró ningún envío con ese código.";
        } else {
            $this->mensaje = null;
        }
    }

    public function render()
    {
        return view('livewire.tracking');
    }
}