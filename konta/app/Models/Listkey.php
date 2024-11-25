<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listey extends Model
{
    use HasFactory;

    protected $fillable = [
        'chave',
       
        'site'
    ];
}
