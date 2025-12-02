<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HistorialEnvio extends Model
{
    use HasFactory;

    protected $table = 'historial_envios';

    protected $fillable = [
        'envio_id',
        'id_usuario',
        'estado_anterior',
        'estado_nuevo',
        'comentario',
        'evidencia_foto',
        'fecha_hora',
    ];

    protected $casts = [
        'fecha_hora' => 'datetime',
    ];

    //El envio al que pertenece este registro
    public function envio()
    {
        return $this->belongsTo(Envio::class, 'envio_id');
    }

    //Usuario (motorista) que hizo el cambio
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
}