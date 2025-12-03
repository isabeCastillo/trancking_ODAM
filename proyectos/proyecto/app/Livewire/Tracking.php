<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Envio;

class Tracking extends Component
{
    public $codigo = '';
    public $envio = null;
    public $mensaje = null;
    public $ultimaFoto = null;

    public function buscar()
    {
        $this->reset(['envio', 'mensaje', 'ultimaFoto']);

        if (!$this->codigo) {
            $this->mensaje = 'Ingresa un código de tracking.';
            return;
        }

        $this->envio = Envio::where('codigo_tracking', $this->codigo)->first();

        if (! $this->envio) {
            $this->mensaje = 'No se encontró un envío con ese código.';
            return;
        }

        $ultimoHistorial = $this->envio
            ->historial()
            ->whereNotNull('evidencia_foto')
            ->latest('id')
            ->first();
        $this->ultimaFoto = $ultimoHistorial?->evidencia_foto;
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
