<?php

namespace App\Controllers;

class DashboardController extends BaseController
{
    public function index()
    {
        $loggedIn = false; // Variable para determinar si el usuario está logueado
        $isRolDirector = false; // Variable para determinar si el usuario es director
        $isRolOficina = false; // Variable para determinar si el usuario es de oficina
        $isRolDocente  = false; // Variable para determinar si el usuario es de oficina
        $isRolAlumno  = false; // Variable para determinar si el usuario es un alumno

        if (!session()->has('user')) {
            // El usuario no ha iniciado sesión, redirigir a la página de inicio de sesión
            return redirect()->to('/login');
        }

        if (session()->has('user')) {
            $loggedIn = true;
            $user = session('user');
            if ($user->rol === 'Director') {
                $isRolDirector = true;
            } elseif ($user->rol === 'Oficina') {
                $isRolOficina = true;
            } elseif ($user->rol === 'Docente') {
                $isRolDocente = true;
            } elseif ($user->rol === 'Alumno') {
                $isRolAlumno = true;
            }
        }

        $data = [
            'loggedIn' => $loggedIn,
            'isRolDirector' => $isRolDirector,
            'isRolOficina' => $isRolOficina,
            'isRolDocente' => $isRolDocente,
            'isRolAlumno' => $isRolAlumno
        ];

        echo view('template/header', $data);
        echo view('dashboard');
        echo view('template/footer');
    }
}
