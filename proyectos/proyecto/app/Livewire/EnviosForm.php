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
    public $id_motorista;
    public $id_vehiculo;
    public $codigo_tracking;

    public function mount(Envio $envio = null): void
    {
        if ($envio && $envio->exists) {
            
            $this->envio = $envio;
            $this->fill($envio->toArray());
        } else {
            
            $this->codigo_tracking = $this->generateTrackingCode();
        }
    }

    
    public function generateTrackingCode(): string
    {
        $ultimoId = Envio::max('id') ?? 0;
        $numero = $ultimoId + 1;

        return 'ENV-' . str_pad($numero, 4, '0', STR_PAD_LEFT);
    }

    public function rules(): array
    {
        return [
            'remitente_nombre'       => ['required', 'string', 'max:255'],
            'remitente_telefono'     => ['nullable', 'string', 'max:50'],
            'remitente_direccion'    => ['nullable', 'string', 'max:255'],

            'destinatario_nombre'    => ['required', 'string', 'max:255'],
            'destinatario_telefono'  => ['nullable', 'string', 'max:50'],
            'destinatario_direccion' => ['nullable', 'string', 'max:255'],

            'descripcion'            => ['nullable', 'string'],
            'peso'                   => ['nullable', 'numeric', 'min:0'],
            'tipo_envio'             => ['nullable', 'string', 'max:100'],
            'fecha_estimada'         => ['nullable', 'date'],

            'estado'                 => ['required', Rule::in(['pendiente', 'en_transito', 'entregado', 'cancelado'])],

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
        // 1) Validar
        
        $data = $this->validate();

        // 2) Crear o actualizar
        if ($this->envio && $this->envio->exists) {
            $this->envio->update($data);
            session()->flash('message', 'Envío actualizado correctamente.');
        } else {
            $this->envio = Envio::create($data);
            session()->flash('message', 'Envío creado correctamente.');
        }

        // 3) Redirigir al listado
        return redirect()->route('envios.index');
    }

    public function render()
    {
        $motoristas = User::where('rol', 'motorista')->get();
        $vehiculos  = Vehiculo::all();

        return view('livewire.envios-form', [
            'motoristas' => $motoristas,
            'vehiculos'  => $vehiculos,
        ]);
    }
}
