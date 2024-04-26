<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'id'; // Cambia 'id' por el nombre real de la clave primaria de tu tabla de rutas
}

