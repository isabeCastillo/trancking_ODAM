<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Envio;

class HistorialEnvioComponent extends Component
{
    public $envio;
    public $historial = [];

    public function mount(Envio $envio)
    {
        $this->envio = $envio;
        $this->cargarHistorial();
    }

    public function cargarHistorial()
    {
        $this->historial = $this->envio->historial()
            ->with('usuario')
            ->orderBy('fecha_hora', 'desc')
            ->get();
    }

    public function render()
    {
        return view('livewire.historial-envio');
    }
}
