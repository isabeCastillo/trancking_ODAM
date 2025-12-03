<?php

namespace App\Livewire;

use App\Models\Envio;
use App\Models\User;
use App\Models\Vehiculo;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use Closure;
use Illuminate\Support\Facades\Log;

#[Layout('components.layouts.app')]
class EnviosForm extends Component
{
    use WithFileUploads;

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

    public $foto;

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

            'id_vehiculo' => [
                'nullable',
                'exists:vehiculos,id',
                function (string $attribute, mixed $value, Closure $fail) {

                    if (!$value) return;

                    Log::info('--- INICIO VALIDACION PERSONALIZADA ---');
                    Log::info('ID Vehículo seleccionado: ' . $value);

                    $capacidadMaxima = Vehiculo::where('id', $value)->value('capacidad');
                    Log::info('Valor crudo de capacidad obtenido de BD: ' . json_encode($capacidadMaxima));

                    if (!is_numeric($capacidadMaxima)) {
                        Log::info('VALIDACION TERMINADA: Capacidad NULL → se permite');
                        return;
                    }

                    $capacidadMaximaInt = (int) $capacidadMaxima;

                    $query = Envio::query()
                        ->where('id_vehiculo', $value)
                        ->whereIn('estado', ['pendiente', 'en_transito']);

                    if ($this->envio && $this->envio->exists) {
                        $query->where('id', '!=', $this->envio->id);
                    }

                    $conteoEnviosActivos = $query->count();

                    if ($conteoEnviosActivos >= $capacidadMaximaInt) {
                        $fail("El vehículo está lleno: {$conteoEnviosActivos}/{$capacidadMaximaInt}");
                    }
                },
            ],

            'codigo_tracking'        => [
                'required',
                'string',
                'max:50',
                Rule::unique('envios', 'codigo_tracking')->ignore($this->envio?->id),
            ],

            'foto' => ['nullable', 'image', 'max:2048'],
        ];
    }

    public function updatedIdVehiculo($value)
    {
        $this->id_motorista = null;

        if (!$value) return;

        $vehiculo = Vehiculo::with('motorista')->find($value);

        if ($vehiculo && $vehiculo->motorista) {
            $this->id_motorista = $vehiculo->user_id;
        }

        Log::info("Vehículo cambiado: $value | Motorista asignado: $this->id_motorista");
    }

    public function guardar()
    {
        $data = $this->validate();
        if ($this->foto) {
            $data['foto'] = $this->foto->store('envios', 'public');
        }

        if ($this->envio && $this->envio->exists) {
            $this->envio->update($data);
            session()->flash('message', 'Envío actualizado correctamente.');
        } else {
            $this->envio = Envio::create($data);
            session()->flash('message', 'Envío creado correctamente.');
        }

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
