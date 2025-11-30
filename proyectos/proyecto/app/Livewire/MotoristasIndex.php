<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class MotoristasIndex extends Component
{
    public $busqueda = ' ';

    public function render()
    {
        $motoristas = User::where('rol', 'motorista')
            ->where(function ($query) {
                $query->where('name', 'like', '%'.$this->busqueda.'%')
                  ->orWhere('email', 'like', '%'.$this->busqueda.'%')
                  ->orWhere('username', 'like', '%'.$this->busqueda.'%');
            })
            ->get();

        return view('motoristas.index', compact('motoristas'));
    }

    public function eliminar($id)
    {
        User::find($id)?->delete();
        session()->flash('message', 'Motorista eliminado correctamente.');
    }
    public function toggleEstado($id)
    {
        $motorista = User::findOrFail($id);
        $motorista->estado = !$motorista->estado;
        $motorista->save();
    }
}
