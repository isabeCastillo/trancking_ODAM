<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Envio;
use App\Models\HistorialEnvio;
use Illuminate\Support\Facades\Auth;

class MotoristaEnvios extends Component
{
    use WithFileUploads;

    public $envios;
    public $selectedEnvio;
    public $estado;
    public $comentario;
    public $foto;

    public function mount()
    {
        // Cargar solo los envíos del motorista autenticado
        $this->envios = Envio::where('id_motorista', Auth::id())->get();
    }

    public function seleccionarEnvio($id)
    {
        $this->selectedEnvio = Envio::find($id);
        $this->estado = $this->selectedEnvio->estado;
        $this->comentario = null;
    }

    public function actualizar()
    {
        $this->validate([
            'estado' => 'required',
            'foto' => 'nullable|image|max:2048'
        ]);

        // Guardar foto si existe
        $fotoPath = null;
        if ($this->foto) {
            $fotoPath = $this->foto->store('evidencias', 'public');
        }

        // Actualizar estado
        $this->selectedEnvio->update([
            'estado' => $this->estado
        ]);

        // Registrar historial
        HistorialEnvio::create([
            'envio_id' => $this->selectedEnvio->id,
            'estado' => $this->estado,
            'comentario' => $this->comentario,
            'user_id'    => auth()->id(),
            'imagen' => $fotoPath,
        ]);

        $this->envios = Envio::where('motorista_id', auth()->id())->get();

    // mensaje
    session()->flash('message', 'Envío actualizado correctamente');

    }

    public function render()
    {
        return view('livewire.motorista-envios');
    }
}
