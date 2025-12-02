<?php

namespace App\Livewire;

use App\Models\Envio;
use App\Models\User;
use App\Models\Vehiculo;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Closure;
use Illuminate\Support\Facades\Log;

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
        'id_vehiculo' => [
                'nullable',
                'exists:vehiculos,id',
                function (string $attribute, mixed $value, Closure $fail) {
                    if (!$value) return;

                    Log::info('--- INICIO VALIDACION PERSONALIZADA ---');
                    Log::info('ID Vehículo seleccionado: ' . $value);

                    // 1. Obtener capacidad
                    // ¡ATENCIÓN! ¿Es 'capacidad' el nombre exacto de tu columna en la tabla 'vehiculos'?
                    $capacidadMaxima = Vehiculo::where('id', $value)->value('capacidad');

                    // Usamos json_encode para ver exactamente qué trajo (si es null, texto, numero)
                    Log::info('Valor crudo de capacidad obtenido de BD: ' . json_encode($capacidadMaxima));

                    if (!is_numeric($capacidadMaxima)) {
                         Log::info('VALIDACION TERMINADA ANTES DE TIEMPO: La capacidad es NULL o no es un número. Se permite guardar.');
                         Log::info('--- FIN VALIDACION ---');
                         // Si no hay capacidad definida, asumimos que no hay límite y dejamos pasar.
                         return;
                    }

                    $capacidadMaximaInt = (int) $capacidadMaxima;
                    Log::info('Capacidad interpretada como entero: ' . $capacidadMaximaInt);

                    // 2. Query builder
                    $query = Envio::query()
                        ->where('id_vehiculo', $value)
                        ->whereIn('estado', ['pendiente', 'en_transito']);

                    // 3. Excluir si editamos
                    if ($this->envio && $this->envio->exists) {
                         $query->where('id', '!=', $this->envio->id);
                         Log::info('Modo edición: Excluyendo el envío actual ID ' . $this->envio->id . ' del conteo.');
                    }

                    // 4. Contar
                    $conteoEnviosActivos = $query->count();
                    Log::info('Conteo total de envíos activos encontrados: ' . $conteoEnviosActivos);

                    // 5. Comparar
                    if ($conteoEnviosActivos >= $capacidadMaximaInt) {
                        Log::info('RESULTADO: FALLO. El vehículo está lleno (' . $conteoEnviosActivos . ' >= ' . $capacidadMaximaInt . ')');
                        $fail("El vehículo seleccionado ya está lleno. Tiene {$conteoEnviosActivos} de {$capacidadMaximaInt} envíos asignados.");
                    } else {
                        Log::info('RESULTADO: OK. Hay espacio.');
                    }
                    Log::info('--- FIN VALIDACION ---');
                },
            ],

        'codigo_tracking'        => [
            'required',
            'string',
            'max:50',
            Rule::unique('envios', 'codigo_tracking')->ignore($this->envio?->id),
        ],
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

    \Log::info('Vehículo cambiado: ' . $value . ' | Motorista asignado: ' . $this->id_motorista);
}




    public function guardar()
    {
        
        
        $data = $this->validate();

      
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