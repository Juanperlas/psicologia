<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boleta extends Model
{
    use HasFactory;

    protected $fillable = [
        'cita_aceptada_id'
    ];

    public function citaAceptada()
    {
        return $this->belongsTo(CitaAceptada::class);
    }
}
