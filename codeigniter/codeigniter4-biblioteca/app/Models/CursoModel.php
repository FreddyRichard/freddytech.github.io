<?php

namespace App\Models;

use CodeIgniter\Model;

class CursoModel extends Model {
    protected $table = 'curso';
    protected $primarykey = 'id';
    protected $allowedFields = ['nombre', 'description', 'categoria', 'imagen'];
}