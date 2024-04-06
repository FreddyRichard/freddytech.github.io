<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    // protected $fillable = ['name', 'descripcion', 'categoria'];


    //Laravel utiliza convenciones de nomenclatura en inglés para interactuar con la base de datos. Si nuestra tabla esta en singular, la debemos especificar
    protected $table = 'categoria';

    //protected $fillable = ['nombre'];

    protected $guarded = [];


    public function getRouteKeyName()
    {
    }
    
}
