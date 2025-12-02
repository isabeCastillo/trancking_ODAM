<?php

namespace App\Models;
use App\Models\Envio;
use App\Models\User;

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
        'estado',
        'user_id',
    ];

    public function envios()
    {
        return $this->hasMany(Envio::class, 'id_vehiculo');
    }

     public function motorista() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
