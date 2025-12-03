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
        // Limpiamos estado
        $this->reset(['envio', 'mensaje', 'fotoActual']);

        if (!trim($this->codigo)) {
            $this->mensaje = 'Ingresa un código de tracking.';
            return;
        }

        // Traemos el envío con su historial
        $this->envio = Envio::with('historial')
            ->where('codigo_tracking', $this->codigo)
            ->first();

        if (!$this->envio) {
            $this->mensaje = 'No se encontró un envío con ese código.';
            return;
        }

        // 🔹 OJO: aquí usamos $this->envio, no $envio
        // En historial_envios la columna es evidencia_foto
        $ultimoHistorialConFoto = $this->envio->historial
            ->whereNotNull('evidencia_foto')
            ->last();   // el más reciente (ya vienen ordenados por fecha_hora asc)

        if ($ultimoHistorialConFoto) {
            // Foto más reciente subida por el motorista
            $this->fotoActual = $ultimoHistorialConFoto->evidencia_foto;
        } else {
            // Si nunca ha subido foto en el historial, usamos la de envios (si la hubiera)
            $this->fotoActual = $this->envio->foto;
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
