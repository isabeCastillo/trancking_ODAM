<?php

namespace App\Livewire\Motorista;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Envio;
use App\Models\HistorialEnvio;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    use WithFileUploads;

    public $envios;
    public $envioSeleccionado = null;
    public $estado;
    public $comentario;
    public $foto;

    protected $rules = [
        'estado' => 'required|in:pendiente,en ruta,entregado',
        'comentario' => 'nullable|string|max:500',
        'foto' => 'nullable|image|max:2048',
    ];

    public function mount()
    {
        $this->envios = Envio::where('id_motorista', Auth::id())->get();
    }

    public function seleccionarEnvio($idEnvio)
    {
        $this->envioSeleccionado = Envio::where('id_motorista', Auth::id())
            ->findOrFail($idEnvio);

        $this->estado = $this->envioSeleccionado->estado;
        $this->comentario = '';
        $this->foto = null;
    }

    public function actualizarEnvio()
    {
        $this->validate();

        if (!$this->envioSeleccionado) {
            return;
        }

        $envio = $this->envioSeleccionado;
        $estadoAnterior = $envio->estado;
        $envio->estado = $this->estado;
        $envio->save();

        $rutaFoto = null;
        if ($this->foto) {
            $rutaFoto = $this->foto->store('evidencias', 'public');
        }

        HistorialEnvio::create([
            'envio_id' => $envio->id,
            'id_usuario' => Auth::id(),
            'estado_anterior' => $estadoAnterior,
            'estado_nuevo' => $this->estado,
            'comentario' => $this->comentario,
            'evidencia_foto' => $rutaFoto,
            'fecha_hora' => now(),
        ]);

        session()->flash('mensaje', 'Envío actualizado y registrado en la bitácora.');

        $this->envios = Envio::where('id_motorista', Auth::id())->get();
        $this->envioSeleccionado = Envio::find($envio->id);
        $this->comentario = '';
        $this->foto = null;
    }

    public function render()
    {
        return view('livewire.motorista.dashboard');
    }
}

