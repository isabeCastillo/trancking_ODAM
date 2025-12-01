<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Vehiculo;

class Envio extends Model {
    protected $table = 'envios';
    protected $fillable = [
        'remitente_nombre',
        'remitente_telefono',
        'remitente_direccion',
        'destinatario_nombre',
        'destinatario_telefono',
        'destinatario_direccion',
        'descripcion',
        'peso',
        'tipo_envio',
        'fecha_estimada',
        'estado',
        'id_motorista',
        'id_vehiculo',
        'codigo_tracking',
    ];

    public function motorista()
    {
        return $this->belongsTo(Motorista::class, 'id_motorista');
    }

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class, 'id_vehiculo');
    }
}
