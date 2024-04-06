<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Controllers\BaseController;


class LoginController extends BaseController
{
    public function index()
    {
        $loggedIn = false; // Variable para determinar si el usuario está logueado

        if (session()->has('user')) {
            $loggedIn = true;
        }

        $data = [
            'loggedIn' => $loggedIn
        ];

        echo view('template/header', $data);
        echo view('login');
        echo view('template/footer');     
    }

//********************************************* */
public function login() {
    $request = service('request');
    $usuario = new UserModel();

    $username = $request->getPost('username');
    $password = $request->getPost('password');

    $result = $usuario->where('username', $username)->first();

    if ($result->id > 0) {
        if (password_verify($password, $result->password)) {
            $this->session->set("user", $result);
            return redirect()->to('/dashboard');
        } else {
            $this->session->setFlashdata('error', 'Credenciales incorrectas');
            return redirect()->to('/login');
        }
    } else {
        $this->session->setFlashdata('error', 'Credenciales incorrectas');
        return redirect()->to('/login');
    }
}

//********************************************* */
    public function logout() {
        session_destroy();
        return redirect()->to('/login');
    }



}
