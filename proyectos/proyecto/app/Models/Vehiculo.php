<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vehiculo extends Model
{
    use HasFactory;

    protected $fillable = [
        'placa',
        'marca',
        'modelo',
        'color',
        'capacidad',
        'tipo',
        'estado'
    ];

    public function envios()
    {
        return $this->hasMany(Envio::class, 'id_vehiculo');
    }
}
