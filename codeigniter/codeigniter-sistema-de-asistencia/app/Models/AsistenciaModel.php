<?php

namespace App\Models;

use CodeIgniter\Model;

class AsistenciaModel extends Model
{
    protected $table      = 'asistencia';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $allowedFields = ['usuario_id', 'curso_id', 'aula_id', 'fecha', 'estado'];
}