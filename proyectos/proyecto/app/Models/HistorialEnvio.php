<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistorialEnvio extends Model
{
    protected $table = 'historial_envios';

    protected $fillable = [
        'envio_id',
        'id_usuario',
        'estado_anterior',
        'estado_nuevo',
        'comentario',
        'user_id',
        'evidencia_foto',
        'fecha_hora',
    ];

    public function envio()
    {
        return $this->belongsTo(Envio::class, 'envio_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
}
