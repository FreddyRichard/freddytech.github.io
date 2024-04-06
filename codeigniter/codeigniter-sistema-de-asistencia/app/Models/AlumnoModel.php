<?php

namespace App\Models;

use CodeIgniter\Model;

class AlumnoModel extends Model {
    protected $table = 'alumno';

    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    
    protected $allowedFields = ['usuario_id', 'aula_id'];
}