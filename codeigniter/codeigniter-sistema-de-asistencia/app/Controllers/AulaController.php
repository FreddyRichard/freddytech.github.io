<?php

namespace App\Controllers;

use App\Models\AlumnoModel;
use App\Models\AulaModel;

class AulaController extends BaseController
{
/**************************************************************/
  public function index()
  {

  }
/**************************************************************/
  public function listarAulas()
  {
    $loggedIn = false;
    $isRolDirector = false; 
    $isRolOficina = false;
    $isRolDocente = false;
    $isRolAlumno = false; 

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

    $alumnoModel = new AlumnoModel();
    $aulaModel = new AulaModel();
    //$aulasData['aulas'] = $aula->orderBy('id', 'ASC')->findAll();
    $aulas = $aulaModel->orderBy('id', 'ASC')->findAll();

    // Obtener el contador de alumnos registrados por aula y actualizar el campo vacanteRegistrada
    foreach ($aulas as &$aula) {
        $contador = $alumnoModel->where('aula_id', $aula['id'])->countAllResults();
        $aula['vacanteRegistrada'] = $contador;
        // Actualizar el valor de vacanteRegistrada en la base de datos
        $aulaModel->update($aula['id'], ['vacanteRegistrada' => $contador]);
    }

    $aulasData['aulas'] = $aulas;

    echo view('template/header', $data);
    echo view('mantenimiento/aulas/listar', $aulasData);
    echo view('template/footer');
  }
/**************************************************************/
  public function crearAula()
  {
    $loggedIn = false;
    $isRolDirector = false; 
    $isRolOficina = false;
    $isRolDocente = false;
    $isRolAlumno = false; 

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
    echo view('mantenimiento/aulas/crear');
    echo view('template/footer');
  }
/**************************************************************/
  public function guardarAula()
  {
    $aula = new AulaModel();

    // Obtener la cantidad actual de registros de aulas en la base de datos
    $cantidadAulas = $aula->countAllResults();

    // Verificar si la cantidad actual es igual o mayor a 16
    if ($cantidadAulas >= 16) {
        $session = session();
        $session->setFlashdata('mensaje', 'No se pueden registrar más de 16 aulas.');
        return redirect()->back()->withInput();
    }

    $validacion = $this->validate([
      'nombre' => 'required|min_length[3]',
      'seccion' => 'required|max_length[3]',
      'nivel' => 'required|max_length[11]'
    ]);

    if (!$validacion) {
      $session = session();
      $session->setFlashdata('mensaje', 'Ingrese información correcta en los campos obligatorios.');
      return redirect()->back()->withInput();
    }

    $datos = [
      'nombre' => $this->request->getVar('nombre'),
      'seccion' => $this->request->getVar('seccion'),
      'nivel' => $this->request->getVar('nivel'),
      'vacanteTotal' => $this->request->getVar('vacanteTotal')
    ];

    $aula->insert($datos);
    return $this->response->redirect(site_url('/listarAulas'));
  }
/**************************************************************/
  public function editarAula($id = null)
  {
    $loggedIn = false;
    $isRolDirector = false; 
    $isRolOficina = false;
    $isRolDocente = false;
    $isRolAlumno = false; 

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

    // Recuperar los datos del aula con el $id
    $aula = new AulaModel();
    $aulaData['aula'] = $aula->where('id', $id)->first();

    echo view('template/header', $data);
    echo view('mantenimiento/aulas/editar', $aulaData);
    echo view('template/footer');
  }
/**************************************************************/
  public function actualizarAula()
  {
    $aula = new AulaModel();
    $id = $this->request->getVar('id');
    $datos = [
      'nombre' => $this->request->getVar('nombre'),
      'seccion' => $this->request->getVar('seccion'),
      'nivel' => $this->request->getVar('nivel'),
      'vacanteTotal' => $this->request->getVar('vacanteTotal')
    ];

    $validacion = $this->validate([
      'nombre' => 'required|min_length[4]',
      'seccion' => 'required|max_length[5]'
    ]);
    if (!$validacion) {
      $session = session();
      $session->setFlashdata('mensaje', 'Ingrese información correcta en los campos obligatorios.');
      return redirect()->back()->withInput();
    }

    $aula->update($id, $datos);

    return $this->response->redirect(site_url('/listarAulas'));
  }
/**************************************************************/
  public function borrarAula($id = null)
  {
    $aula = new AulaModel();

    $aula->where('id', $id)->delete($id);

    return $this->response->redirect(site_url('/listarAulas'));
  }
/**************************************************************/
}
