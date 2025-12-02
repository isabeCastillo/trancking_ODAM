<?php

namespace App\Livewire\Motorista;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Envio;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    use WithFileUploads;

    public $envios = [];
    public $envioSeleccionado = null;

    public $estado = '';
    public $comentario = '';
    public $foto; // evidencia

    protected $rules = [
        'estado'     => 'required|in:pendiente,en ruta,entregado',
        'comentario' => 'nullable|string|max:500',
        'foto'       => 'nullable|image|max:2048', // 2MB
    ];

    public function mount()
    {
        $this->cargarEnvios();
    }

    protected function motoristaId()
    {
        // Ajusta esto según cómo relaciones usuario ↔ motorista
        return Auth::user()->id_motorista ?? Auth::id();
    }

    public function cargarEnvios()
    {
        $this->envios = Envio::where('id_motorista', $this->motoristaId())
            ->orderByRaw("FIELD(estado, 'pendiente','en ruta','entregado')")
            ->orderByDesc('created_at')
            ->get();

        if ($this->envios->count() && !$this->envioSeleccionado) {
            $this->seleccionarEnvio($this->envios->first()->id);
        }
    }

    public function seleccionarEnvio($envioId)
    {
        $envio = Envio::where('id', $envioId)
            ->where('id_motorista', $this->motoristaId())
            ->firstOrFail();

        $this->envioSeleccionado = $envio;
        $this->estado = $envio->estado;
        $this->comentario = '';
        $this->foto = null;
    }

    public function actualizarEnvio()
    {
        if (!$this->envioSeleccionado) {
            return;
        }

        $this->validate();

        $envio = Envio::where('id', $this->envioSeleccionado->id)
            ->where('id_motorista', $this->motoristaId())
            ->firstOrFail();

        $envio->estado = $this->estado;
        $envio->save();

        $rutaFoto = null;
        if ($this->foto) {
            $rutaFoto = $this->foto->store('evidencias', 'public');
        }

        BitacoraEnvio::create([
            'envio_id'    => $envio->id,
            'motorista_id'=> $this->motoristaId(),
            'estado'      => $this->estado,
            'comentario'  => $this->comentario,
            'foto_path'   => $rutaFoto,
         ]);

        $this->cargarEnvios();
        $this->seleccionarEnvio($envio->id);

        session()->flash('mensaje', 'Envío actualizado correctamente.');
    }

    public function render()
    {
        return view('livewire.motorista.dashboard');
    }
}
