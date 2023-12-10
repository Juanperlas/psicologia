<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CitaRechazada extends Model
{
    use HasFactory;

    protected $table = 'citas_rechazadas';

    protected $fillable = [
        'usuario_id',
        'fecha',
        'hora',
        'hora_fin'
    ];

    protected $casts = [
        'fecha' => 'datetime',
        'hora' => 'datetime',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
