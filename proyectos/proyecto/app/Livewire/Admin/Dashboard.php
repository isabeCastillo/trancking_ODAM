<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Envio;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Dashboard extends Component
{
    public int $totalEnvios = 0;
    public int $pendientes  = 0;
    public int $enRuta      = 0;
    public int $entregados  = 0;
    public int $porAsignar  = 0;

    public $enviosRecientes    = [];
    public $enviosPorMotorista = [];
    public $enviosPorTipo      = [];
    public $enviosPorDia       = [];
    public $enviosPorCiudad    = [];

    public function mount()
    {
        $this->cargarDatos();
    }

    public function actualizarDatos()
    {
        $this->cargarDatos();
    }

    protected function cargarDatos(): void
    {
        $this->totalEnvios = Envio::count();
        $this->pendientes  = Envio::where('estado', 'pendiente')->count();

        $this->enRuta      = Envio::whereIn('estado', ['en ruta', 'en_ruta', 'en_transito'])->count();

        $this->entregados  = Envio::where('estado', 'entregado')->count();

        $this->porAsignar  = Envio::whereNull('id_motorista')->count();

        $this->enviosRecientes = Envio::with('motorista')
            ->latest()
            ->take(8)
            ->get();

        $this->enviosPorTipo = Envio::select('tipo_envio', DB::raw('COUNT(*) as total'))
            ->groupBy('tipo_envio')
            ->orderByDesc('total')
            ->get();

        $this->enviosPorDia = Envio::selectRaw('DATE(created_at) as fecha, COUNT(*) as total')
            ->where('created_at', '>=', now()->subDays(6)->startOfDay())
            ->groupBy('fecha')
            ->orderBy('fecha')
            ->get();
        $this->enviosPorMotorista = Envio::join('users', 'envios.id_motorista', '=', 'users.id')
            ->select('users.name as motorista', DB::raw('COUNT(envios.id) as total'))
            ->whereNotNull('envios.id_motorista')
            ->groupBy('envios.id_motorista', 'users.name')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        if (Schema::hasColumn('envios', 'destinatario_direccion')) {
            $this->enviosPorCiudad = Envio::select(
                    'destinatario_direccion',
                    DB::raw('COUNT(*) as total')
                )
                ->groupBy('destinatario_direccion')
                ->orderByDesc('total')
                ->limit(20)
                ->get();
        } else {
            $this->enviosPorCiudad = collect();
        }
    }

    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}
