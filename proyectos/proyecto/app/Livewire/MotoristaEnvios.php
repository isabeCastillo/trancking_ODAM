<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Envio;
use App\Models\HistorialEnvio;

class MotoristaEnvios extends Component
{
    use WithFileUploads;

    public $envios = [];
    public $selectedEnvio = null;
    public $estado;
    public $comentario;
    public $foto;

    protected $rules = [
        'estado'     => 'required|in:pendiente,en ruta,entregado',
        'comentario' => 'nullable|string|max:500',
        'foto'       => 'nullable|image|max:2048',
    ];

    public function mount()
    {
        $this->cargarEnvios();
    }

    public function cargarEnvios()
    {
        // Envíos asignados al motorista logueado
        $this->envios = Envio::where('id_motorista', auth()->id())->get();
    }

    public function seleccionarEnvio($id)
    {
        // Solo puede seleccionar envíos que realmente son suyos
        $this->selectedEnvio = Envio::where('id_motorista', auth()->id())
            ->findOrFail($id);

        $this->estado = $this->selectedEnvio->estado;
        $this->comentario = '';
        $this->foto = null;
    }

    public function actualizar()
    {
        $this->validate();

        if (!$this->selectedEnvio) {
            return;
        }

        $envio = $this->selectedEnvio;
        $estadoAnterior = $envio->estado;

        // 1) Actualizar envío
        $envio->estado = $this->estado;
        $envio->save();

        // 2) Subir evidencia si hay
        $rutaFoto = null;
        if ($this->foto) {
            // guarda en storage/app/public/evidencias
            $rutaFoto = $this->foto->store('evidencias', 'public');
        }

        // 3) Registrar en historial_envios 
        HistorialEnvio::create([
            'envio_id'        => $envio->id,
            'id_usuario'      => auth()->id(),  
            'estado_anterior' => $estadoAnterior,
            'estado_nuevo'    => $this->estado,
            'comentario'      => $this->comentario,
            'evidencia_foto'  => $rutaFoto,
            'fecha_hora'      => now(),
        ]);

        session()->flash('mensaje', 'Estado actualizado y registrado en historial.');

        // 4) Limpiar formulario y recargar lista
        $this->reset(['selectedEnvio', 'estado', 'comentario', 'foto']);
        $this->cargarEnvios();
    }

    public function render()
    {
        return view('livewire.motorista-envios');
    }
}