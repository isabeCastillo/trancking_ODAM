<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\Vehiculo;

class VehiculosForm extends Component
{
    //Para relacionar motorista a un vehiuclo.
    public $user_id;
    public $motoristas;

    public $vehiculo;
    public $placa, $marca, $modelo, $color, $capacidad, $tipo, $estado = 'Disponible';

    public function mount(?Vehiculo $vehiculo = null)
    {
        $this->motoristas = User::where('rol', 'motorista')->get();
        $this->vehiculo = $vehiculo;

        if ($vehiculo) {
            $this->placa = $vehiculo->placa;
            $this->marca = $vehiculo->marca;
            $this->modelo = $vehiculo->modelo;
            $this->color = $vehiculo->color;
            $this->capacidad = $vehiculo->capacidad;
            $this->tipo = $vehiculo->tipo;
            $this->estado = $vehiculo->estado;
            $this->user_id = $vehiculo->user_id;
        }
    }

    public function save(){
        $this->validate([
            'placa' => 'required|string',
            'marca' => 'required|string',
            'modelo' => 'required|string',
            'color' => 'nullable|string',
            'capacidad' => 'required|integer',
            'tipo' => 'required|string',
            'estado' => 'required|string',
            'user_id' => 'nullable|exists:users,id'
        ]);

        $data = [
            'placa' => $this->placa,
            'marca' => $this->marca,
            'modelo' => $this->modelo,
            'color' => $this->color,
            'capacidad' => $this->capacidad,
            'tipo' => $this->tipo,
            'estado' => $this->estado,
            'user_id' => $this->user_id,
        ];

        if ($this->vehiculo) {
            $this->vehiculo->update($data);
        } else {
            Vehiculo::create($data);
        }

        return redirect()->route('vehiculos.index');
    }

    public function render()
    {
        return view('livewire.vehiculos-form');
    }
}