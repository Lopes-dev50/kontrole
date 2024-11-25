<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Moviment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'data',
        'etiqueta',
        'motivo',
        'dia',
        'valor',
        'tipo',
        'pago'
    ];
}
