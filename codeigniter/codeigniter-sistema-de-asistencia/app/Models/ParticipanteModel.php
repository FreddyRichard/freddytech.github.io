<?php

namespace App\Models;

use CodeIgniter\Model;

class ParticipanteModel extends Model {
    protected $table = 'participantes';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nombre', 'correo', 'celular'];
}