<?php

namespace App\Models;

use CodeIgniter\Model;

class DocenteModel extends Model
{
    protected $table      = 'docente';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $allowedFields = ['usuario_id', 'curso_id', 'aula_id'];


}