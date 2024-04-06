<?php

namespace App\Controllers;

use App\Models\UserModel;

class RegisterController extends BaseController
{
    public function index()
    {
        echo view('template/header');
        echo view('register');
        echo view('template/footer');        
    }

    public function register() {
        $request = service('request');
        $usuario = new UserModel();

        $username = $this->request->getPost('username');
        $password = $request->getPost('password');
        $password = password_hash($password, PASSWORD_BCRYPT);
        $dni = $this->request->getPost('dni');
        $rol = $this->request->getPost('rol');

        $data = [
            'username'=>$username, 
            'password'=>$password,
            'dni'=>$dni,
            'rol'=>$rol
        ];

        $r = $usuario->insert($data);

        if ($r) {
            //echo "Registro correcto";
            return redirect()->to('/dashboard');
        } else {
            echo "ERROR";
        }
        //$jsonData = json_encode($data);
        //echo $jsonData;
    }

}
