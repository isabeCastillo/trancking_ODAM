<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Envio;

class Tracking extends Component
{
    public $codigo = '';
    public $envio = null;
    public $mensaje = null;
    public $fotoActual = null;

    public function buscar()
    {
        $this->reset(['envio', 'mensaje', 'fotoActual']);

        if (!trim($this->codigo)) {
            $this->mensaje = 'Ingresa un código de tracking.';
            return;
        }

        $this->envio = Envio::with('historial')
            ->where('codigo_tracking', $this->codigo)
            ->first();

        if (!$this->envio) {
            $this->mensaje = 'No se encontró un envío con ese código.';
            return;
        }

        $ultimoHistorialConFoto = $this->envio->historial
            ->whereNotNull('evidencia_foto')
            ->last();

        if ($ultimoHistorialConFoto) {
            $this->fotoActual = $ultimoHistorialConFoto->evidencia_foto;
        } else {
            $this->fotoActual = $this->envio->foto;
        }
    }

    public function render()
    {
        $view = view('livewire.tracking');

        if (auth()->check() && auth()->user()->rol === 'admin') {
            return $view->layout('components.layouts.admin');
        }
        return $view->layout('components.layouts.motorista');
    }
}
