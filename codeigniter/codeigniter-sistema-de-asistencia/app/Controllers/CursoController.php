<?php

namespace App\Controllers;

use App\Models\AulaModel;
use App\Models\CursoModel;
use App\Models\DocenteModel;
use App\Models\UserModel;

class CursoController extends BaseController
{
/**************************************************************/
  public function index()
  {

  }
/**************************************************************/
  public function listarCursos()
  {
    $loggedIn = false; // Variable para determinar si el usuario está logueado
    $isRolDirector = false; // Variable para determinar si el usuario es director
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

    $curso = new CursoModel();
    $cursosData['cursos'] = $curso->orderBy('id', 'ASC')->findAll();

    echo view('template/header', $data);
    echo view('mantenimiento/cursos/listar', $cursosData);
    echo view('template/footer');
  }
/**************************************************************/
  public function crearCurso()
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
    echo view('mantenimiento/cursos/crear');
    echo view('template/footer');
  }
/**************************************************************/
  public function guardarCurso()
  {
    $curso = new CursoModel();

    // Obtener la cantidad actual de registros de aulas en la base de datos
    $cantidadCursos = $curso->countAllResults();

    // Verificar si la cantidad actual es igual o mayor a 16
    if ($cantidadCursos >= 18) {
        $session = session();
        $session->setFlashdata('mensaje', 'No se pueden registrar más de 18 cursos.');
        return redirect()->back()->withInput();
    }

    $datos = [
      'nombre' => $this->request->getVar('nombre'),
      'descripcion' => $this->request->getVar('descripcion'),
      'categoria' => $this->request->getVar('categoria'),
      'imagen' => $this->request->getVar('imagen')
    ];

    $curso->insert($datos);
    return $this->response->redirect(site_url('/listarCursos'));
  }
/**************************************************************/
  public function editarCurso($id = null)
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

    // Recuperar los datos del curso con el $id
    $curso = new CursoModel();
    $cursoData['curso'] = $curso->where('id', $id)->first();

    echo view('template/header', $data);
    echo view('mantenimiento/cursos/editar', $cursoData);
    echo view('template/footer');
  }
/**************************************************************/
public function actualizarCurso()
{
  $curso = new CursoModel();
  $id = $this->request->getVar('id');

  $datos = [
    'nombre' => $this->request->getVar('nombre'),
    'descripcion' => $this->request->getVar('descripcion'),
    'categoria' => $this->request->getVar('categoria'),
    'imagen' => $this->request->getVar('imagen')
  ];

  $curso->update($id, $datos);

  return $this->response->redirect(site_url('/listarCursos'));
}
/**************************************************************/
  public function borrarCurso($id = null)
  {
    $curso = new CursoModel();

    $curso->where('id', $id)->delete($id);

    return $this->response->redirect(site_url('/listarCursos'));
  }
/**************************************************************/
public function asignarCurso()
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

  $usuarioModel = new UserModel();

  $docentes = $usuarioModel->select('usuario.id, usuario.dni, usuario.nombres, usuario.apellidopaterno, usuario.apellidomaterno')
                          ->where('usuario.rol', 'Docente')
                          ->findAll();

  $docenteData['docentes'] = $docentes;


  echo view('template/header', $data);
  echo view('mantenimiento/cursos/asignar', $docenteData);
  echo view('template/footer');
}
/**************************************************************/
public function crearAsignacionCurso($id = null)
{
  $loggedIn = false;
  $isRolDirector = false;
  $isRolOficina = false;
  $isRolDocente = false;
  $isRolAlumno = false;

  if (!session()->has('user')) {
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

  // Recuperar los datos del docente con el $id
  $usuarioModel = new UserModel();
  $docente = $usuarioModel->find($id);

  if (!$docente || $docente->rol !== 'Docente') {
      // Manejar el caso en que el docente no existe o no es docente
      return redirect()->to('/error');
  }

  $data = [
      'loggedIn' => $loggedIn,
      'isRolDirector' => $isRolDirector,
      'isRolOficina' => $isRolOficina,
      'isRolDocente' => $isRolDocente,
      'isRolAlumno' => $isRolAlumno,
      'docente' => $docente  // Pasar los datos del docente a la vista
  ];

  $cursoModel = new CursoModel();
  $cursos = $cursoModel->findAll();

  $aulaModel = new AulaModel();
  $aulas = $aulaModel->findAll();

  $docenteData = [
        'cursos' => $cursos,
        'aulas' => $aulas
  ];

    echo view('template/header', $data);
    echo view('mantenimiento/cursos/crearAsignacion', $docenteData);
    echo view('template/footer');
}

/**************************************************************/
public function guardarAsignacionCurso()
{
    // Capturar el ID del usuario/docente
    $usuarioId = $this->request->getVar('id');

    // Datos para insertar en la tabla docente
    $docenteData = [
        'curso_id' => $this->request->getVar('curso_id'),
        'aula_id' => $this->request->getVar('aula_id'),
        'usuario_id' => $usuarioId
    ];

    // Instancia del modelo DocenteModel
    $docente = new DocenteModel();

    // Insertar datos en la tabla docente
    $docente->insert($docenteData);

    // Redireccionar a la página de listado de docentes
    return redirect()->to(site_url('/listarDocentes'));
}

/**************************************************************/
}
