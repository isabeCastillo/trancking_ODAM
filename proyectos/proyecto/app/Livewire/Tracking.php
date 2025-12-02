<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Envio;

class Tracking extends Component
{
    public $codigo = '';
    public $envio = null;
    public $mensaje = null;

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
        $view = view('livewire.tracking');

        // Si es admin usar layout admin
        if (auth()->check() && auth()->user()->rol === 'admin') {
            return $view->layout('components.layouts.admin');
        }

        // Si es motorista usar layout motorista
        return $view->layout('components.layouts.motorista');
    }
}
