<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Envio;
use App\Models\User;
use App\Models\Vehiculo;

class EnviosForm extends Component
{
    public ?Envio $envio = null;

    public $remitente_nombre;
    public $remitente_telefono;
    public $remitente_direccion;

    public $destinatario_nombre;
    public $destinatario_telefono;
    public $destinatario_direccion;

    public $descripcion;
    public $peso;
    public $tipo_envio;
    public $fecha_estimada;
    public $estado = 'pendiente';
    public $id_motorista = null;
    public $id_vehiculo = null;
    public $codigo_tracking = null;

    public $modoEdicion = false;

    protected function rules()
    {
        return [
            'remitente_nombre'       => 'required|string|max:255',
            'remitente_telefono'     => 'required|string|max:30',
            'remitente_direccion'    => 'required|string|max:255',

            'destinatario_nombre'    => 'required|string|max:255',
            'destinatario_telefono'  => 'required|string|max:30',
            'destinatario_direccion' => 'required|string|max:255',

            'descripcion'            => 'nullable|string|max:500',
            'peso'                   => 'nullable|numeric|min:0',
            'tipo_envio'             => 'required|string|max:100',
            'fecha_estimada'         => 'nullable|date',

            'estado'                 => 'required|in:pendiente,en ruta,entregado',
            'id_motorista'           => 'nullable|exists:users,id',
            'id_vehiculo'            => 'nullable|exists:vehiculos,id',
            'codigo_tracking'        => 'nullable|string|max:100',
        ];
    }

    public function mount(?Envio $envio = null)
    {
        if ($envio && $envio->exists) {
            $this->envio = $envio;
            $this->modoEdicion = true;

            $this->remitente_nombre       = $envio->remitente_nombre;
            $this->remitente_telefono     = $envio->remitente_telefono;
            $this->remitente_direccion    = $envio->remitente_direccion;

            $this->destinatario_nombre    = $envio->destinatario_nombre;
            $this->destinatario_telefono  = $envio->destinatario_telefono;
            $this->destinatario_direccion = $envio->destinatario_direccion;

            $this->descripcion            = $envio->descripcion;
            $this->peso                   = $envio->peso;
            $this->tipo_envio             = $envio->tipo_envio;
            $this->fecha_estimada         = $envio->fecha_estimada;
            $this->estado                 = $envio->estado;
            $this->id_motorista           = $envio->id_motorista;
            $this->id_vehiculo            = $envio->id_vehiculo;
            $this->codigo_tracking        = $envio->codigo_tracking;
        } else {
            $this->modoEdicion = false;
            $this->estado = 'pendiente';
        }
    }

    public function guardar()
    {
        $datos = $this->validate();

        if ($this->modoEdicion && $this->envio) {
            $this->envio->update($datos);
            session()->flash('mensaje', 'Envío actualizado correctamente.');
        } else {
            $this->envio = Envio::create($datos);
            $this->modoEdicion = true;
            session()->flash('mensaje', 'Envío creado correctamente.');
        }

        return redirect()->route('envios.index');
    }

    public function render()
    {
        $motoristas = User::where('rol', 'motorista')
            ->orderBy('name')
            ->get();

        $vehiculos  = Vehiculo::orderBy('placa')->get();

        return view('livewire.envios-form', [
            'motoristas' => $motoristas,
            'vehiculos'  => $vehiculos,
        ]);
    }
}
