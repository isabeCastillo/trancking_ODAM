<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\HistorialEnvio;

class BitacoraEnvios extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public function render()
    {
        $registros = HistorialEnvio::with(['envio', 'usuario'])
            ->orderByDesc('fecha_hora')
            ->paginate(10);

        return view('livewire.admin.bitacora-envios', [
            'registros' => $registros,
        ]);
    }
}
