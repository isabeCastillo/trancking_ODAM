<?php

namespace App\Livewire;

use App\Models\Envio;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class EnviosIndex extends Component
{
    use WithPagination;

    
    protected string $paginationTheme = 'tailwind';

    // Filtros
    public string $search      = '';
    public string $estado      = '';
    public string $motoristaId = '';

   
    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingEstado(): void
    {
        $this->resetPage();
    }

    public function updatingMotoristaId(): void
    {
        $this->resetPage();
    }

    public function eliminar(int $id): void
    {
        $envio = Envio::findOrFail($id);
        $envio->delete();

        session()->flash('message', 'Envío eliminado correctamente.');
    }

    public function render()
    {
        $query = Envio::with(['motorista', 'vehiculo'])
            ->orderByDesc('created_at');

       
        if ($this->search !== '') {
            $texto = '%' . $this->search . '%';

            $query->where(function ($q) use ($texto) {
                $q->where('codigo_tracking', 'like', $texto)
                  ->orWhere('remitente_nombre', 'like', $texto)
                  ->orWhere('destinatario_nombre', 'like', $texto);
            });
        }

      
        if ($this->estado !== '') {
            $query->where('estado', $this->estado);
        }

       
        if ($this->motoristaId !== '') {
            $query->where('id_motorista', $this->motoristaId);
        }

        return view('livewire.envios-index', [
            'envios'     => $query->paginate(10),
            'motoristas' => User::where('rol', 'motorista')->get(),
        ]);
    }
}
