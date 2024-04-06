<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocenteModel extends Model
{
    use HasFactory;

    protected $table = 'docente';
    protected $guarded = [];
    public $timestamps = false;
    
}
