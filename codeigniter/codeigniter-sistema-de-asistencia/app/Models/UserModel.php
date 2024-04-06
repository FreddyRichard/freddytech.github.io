<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'usuario';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';

    protected $allowedFields = ['nombres', 'apellidopaterno', 'apellidomaterno', 'telefono', 'sexo', 'correo', 'username', 'password', 'dni', 'rol'];
}