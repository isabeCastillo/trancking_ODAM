<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Envio;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class Dashboard extends Component{
    public int $totalEnvios = 0;
    public int $pendientes = 0;
    public int $enRuta = 0;
    public int $entregados = 0;
    public int $porAsignar = 0;

    public $enviosRecientes = [];
    public $enviosPorMotorista = [];
    public $enviosPorTipo = [];
    public $enviosPorDia = [];
    public $enviosPorCiudad = [];

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
        $this->enRuta      = Envio::where('estado', 'en ruta')->count();
        $this->entregados  = Envio::where('estado', 'entregado')->count();

        $this->porAsignar  = Envio::whereNull('id_motorista')->count();

        $this->enviosRecientes = Envio::latest()->take(8)->get();

        $this->enviosPorTipo = Envio::select('tipo_envio', DB::raw('COUNT(*) as total'))
            ->groupBy('tipo_envio')
            ->orderByDesc('total')
            ->get();
            
        $this->enviosPorDia = Envio::selectRaw('DATE(created_at) as fecha, COUNT(*) as total')
            ->where('created_at', '>=', now()->subDays(6)->startOfDay())
            ->groupBy('fecha')
            ->orderBy('fecha')
            ->get();

        // Ranking de motoristas (requiere tabla motoristas)
        // Ajusta nombres de tabla/columnas si es necesario
        try {
            $this->enviosPorMotorista = DB::table('envios')
                ->join('motoristas', 'envios.id_motorista', '=', 'motoristas.id')
                ->select('motoristas.nombre as motorista', DB::raw('COUNT(envios.id) as total'))
                ->whereNotNull('envios.id_motorista')
                ->groupBy('envios.id_motorista', 'motoristas.nombre')
                ->orderByDesc('total')
                ->limit(5)
                ->get();
        } catch (\Throwable $e) {
            // Si aún no existe la tabla motoristas, simplemente dejamos la colección vacía
            $this->enviosPorMotorista = collect();
        }

        // Envíos por ciudad/zona (solo si después agregan una columna tipo 'destinatario_ciudad')
        if (Schema::hasColumn('envios', 'destinatario_ciudad')) {
            $this->enviosPorCiudad = Envio::select('destinatario_ciudad', DB::raw('COUNT(*) as total'))
                ->groupBy('destinatario_ciudad')
                ->orderByDesc('total')
                ->limit(10)
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
