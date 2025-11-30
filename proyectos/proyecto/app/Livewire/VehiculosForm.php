<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Vehiculo;

class VehiculosForm extends Component
{
    public $vehiculo;
    public $placa, $marca, $modelo, $color, $capacidad, $tipo, $estado = 'Disponible';

    public function mount(?Vehiculo $vehiculo = null)
    {
        $this->vehiculo = $vehiculo;

        if ($vehiculo) {
            $this->placa = $vehiculo->placa;
            $this->marca = $vehiculo->marca;
            $this->modelo = $vehiculo->modelo;
            $this->color = $vehiculo->color;
            $this->capacidad = $vehiculo->capacidad;
            $this->tipo = $vehiculo->tipo;
            $this->estado = $vehiculo->estado;
        }
    }

    public function save()
    {
        $this->validate([
            'placa' => 'required|string',
            'marca' => 'required|string',
            'modelo' => 'required|string',
            'capacidad' => 'required|integer',
            'tipo' => 'required|string',
        ]);

        $data = [
            'placa' => $this->placa,
            'marca' => $this->marca,
            'modelo' => $this->modelo,
            'color' => $this->color,
            'capacidad' => $this->capacidad,
            'tipo' => $this->tipo,
            'estado' => $this->estado,
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
        return view('vehiculos.form');
    }
}