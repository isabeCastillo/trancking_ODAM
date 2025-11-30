<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class MotoristasIndex extends Component
{
    public $buscar;

    public function render()
    {
        
        $motoristas = User::where('rol', 'motorista')->where(function($q) {
            $q->where('name', 'like', '%'.$this->bus)
        })
    }
}
