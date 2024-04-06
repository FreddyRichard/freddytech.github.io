<?php

namespace App\Models;

use CodeIgniter\Model;

class AulaModel extends Model
{
    protected $table      = 'aula';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $allowedFields = ['nombre', 'seccion', 'nivel', 'vacanteTotal', 'vacanteRegistrada'];
}