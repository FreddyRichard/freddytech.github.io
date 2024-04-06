<?php

namespace App\Controllers;


class Home extends BaseController
{
    public function index()
    {
        $loggedIn = $this->mostrarNavbar();
        $isRolDirector = false; // Variable para determinar si el usuario es administrador
        $isRolOficina = false; // Variable para determinar si el usuario es administrador
        $isRolDocente  = false; // Variable para determinar si el usuario es administrador
        $isRolAlumno  = false;

        if (session()->has('user')) {
            $user = session('user');
            if ($user->rol === 'Director') {
                $isRolDirector = true;
            } elseif ($user->rol === 'Oficina') {
                $isRolOficina = true;
            } elseif ($user->rol === 'Docente') {
                $isRolDocente = true;
            } elseif ($user->rol === 'Alumno') {
                $isRolAlumno  = true;
            }
        }

        echo view('template/header', [
            'loggedIn' => $loggedIn,
            'isRolDirector' => $isRolDirector,
            'isRolOficina' => $isRolOficina,
            'isRolDocente' => $isRolDocente,
            'isRolAlumno' => $isRolAlumno
        ]);

        echo view('home');
        echo view('template/footer');
    }
/******************************************************************************** */
    public function mostrarNavbar()
    {
        $loggedIn = false; // Variable para determinar si el usuario está logueado

        if (session()->has('user')) {
            $loggedIn = true;
        }

        return $loggedIn;
    }
}
