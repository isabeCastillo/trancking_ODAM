<?php

namespace App\Livewire;

use App\Models\Envio;
use App\Models\User;
use App\Models\Vehiculo;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class EnviosForm extends Component
{
    public ?Envio $envio = null;

    // REMITENTE
    public $remitente_nombre;
    public $remitente_telefono;
    public $remitente_direccion;

    // DESTINATARIO
    public $destinatario_nombre;
    public $destinatario_telefono;
    public $destinatario_direccion;

    // DETALLE ENVÍO
    public $descripcion;
    public $peso;
    public $tipo_envio;
    public $fecha_estimada;
    public $estado = 'pendiente';

    // ASIGNACIÓN
    public $id_motorista = null;
    public $id_vehiculo = null;

    // TRACKING
    public $codigo_tracking = null;

    // MODO
    public $modoEdicion = false;

    public function mount(?Envio $envio = null): void
    {
        if ($envio && $envio->exists) {
            // Modo edición
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
            // Modo creación
            $this->modoEdicion    = false;
            $this->estado         = 'pendiente';
            $this->codigo_tracking = $this->generateTrackingCode();
        }
    }

    /**
     * Genera un código tipo ENV-0001, ENV-0002, etc.
     */
    public function generateTrackingCode(): string
    {
        $ultimoId = Envio::max('id') ?? 0;
        $numero   = $ultimoId + 1;

        return 'ENV-' . str_pad($numero, 4, '0', STR_PAD_LEFT);
    }

    protected function rules(): array
    {
        return [
            'remitente_nombre'       => ['required', 'string', 'max:255'],
            'remitente_telefono'     => ['required', 'string', 'max:50'],
            'remitente_direccion'    => ['required', 'string', 'max:255'],

            'destinatario_nombre'    => ['required', 'string', 'max:255'],
            'destinatario_telefono'  => ['required', 'string', 'max:50'],
            'destinatario_direccion' => ['required', 'string', 'max:255'],

            'descripcion'            => ['nullable', 'string'],
            'peso'                   => ['nullable', 'numeric', 'min:0'],
            'tipo_envio'             => ['required', 'string', 'max:100'],
            'fecha_estimada'         => ['nullable', 'date'],

            'estado'                 => ['required', Rule::in(['pendiente', 'en ruta', 'entregado'])],

            'id_motorista'           => ['nullable', 'exists:users,id'],
            'id_vehiculo'            => ['nullable', 'exists:vehiculos,id'],

            'codigo_tracking'        => [
                'required',
                'string',
                'max:50',
                Rule::unique('envios', 'codigo_tracking')->ignore($this->envio?->id),
            ],
        ];
    }

    public function guardar()
    {
        $data = $this->validate();

        if ($this->modoEdicion && $this->envio) {
            // Actualizar
            $this->envio->update($data);
            session()->flash('mensaje', 'Envío actualizado correctamente.');
        } else {
            // Crear
            $this->envio = Envio::create($data);
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

        $vehiculos = Vehiculo::orderBy('placa')->get();

        return view('livewire.envios-form', [
            'motoristas' => $motoristas,
            'vehiculos'  => $vehiculos,
        ]);
    }
}
