<?php

namespace App\Controllers;

use App\Models\AlumnoModel;
use App\Models\AulaModel;
use App\Models\AsistenciaModel;
use App\Models\DocenteModel;
use App\Models\UserModel;

class AsistenciaController extends BaseController
{
/**************************************************************/
  public function index()
  {

  }
/**************************************************************/
  public function listarAsistencias()
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

    $data = [
      'loggedIn' => $loggedIn,
      'isRolDirector' => $isRolDirector,
      'isRolOficina' => $isRolOficina,
      'isRolDocente' => $isRolDocente,
      'isRolAlumno' => $isRolAlumno
    ];

    $asistencia = new AsistenciaModel();
    $asistenciasData['asistencias'] = $asistencia->findAll();

    $usuarioModel = new UserModel();
$usuarios = $usuarioModel->findAll();
$asistenciasData['usuarios'] = $usuarios;

    echo view('template/header', $data);
    echo view('mantenimiento/asistencias/listar', $asistenciasData);
    echo view('template/footer');
  }
/**************************************************************/
public function listarAsistenciasPorFecha()
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

    $data = [
      'loggedIn' => $loggedIn,
      'isRolDirector' => $isRolDirector,
      'isRolOficina' => $isRolOficina,
      'isRolDocente' => $isRolDocente,
      'isRolAlumno' => $isRolAlumno
    ];

    $fecha = $this->request->getGet('fecha');
    
    // Obtener las asistencias que coinciden con la fecha
    $asistenciaModel = new AsistenciaModel();
    $asistencias = $asistenciaModel->where('fecha', $fecha)->findAll();

    // Cargar la vista con las asistencias filtradas
    $asistenciaData['asistencias'] = $asistencias;

    echo view('template/header', $data);
    echo view('mantenimiento/asistencias/listar', $asistenciaData);
    echo view('template/footer');
}
/**************************************************************/
public function crearAsistencias($docenteId)
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

    $data = [
        'loggedIn' => $loggedIn,
        'isRolDirector' => $isRolDirector,
        'isRolOficina' => $isRolOficina,
        'isRolDocente' => $isRolDocente,
        'isRolAlumno' => $isRolAlumno
    ];

    // Obtener los datos del docente usando el ID
    $docenteModel = new DocenteModel();
    $docenteData = $docenteModel->find($docenteId);
    $usuariosData['docenteData'] = $docenteData;

    // Obtener los datos del aula del docente
    $aulaModel = new AulaModel();
    $aulaData = $aulaModel->find($docenteData['aula_id']);
    $usuariosData['aulaData'] = $aulaData;

    // Obtener los alumnos relacionados con el docente
    $alumnoModel = new AlumnoModel();
    $alumnos = $alumnoModel->where('aula_id', $docenteData['aula_id'])->findAll();
    $usuariosData['alumnos'] = $alumnos;

    // Obtener los datos de usuarios relacionados con los alumnos (supongamos que existe una relación en tu modelo de AlumnoModel)
    $usuarioIds = array_column($alumnos, 'usuario_id');
    $usuarioModel = new UserModel();
    $usuarios = $usuarioModel->whereIn('id', $usuarioIds)->findAll();
    $usuariosData['usuarios'] = $usuarios;

    echo view('template/header', $data);
    echo view('mantenimiento/asistencias/crear', $usuariosData);
    echo view('template/footer');
}

/**************************************************************/
  public function crearCurso()
  {

  }
/**************************************************************/
public function guardarAsistencia($docenteId)
{
    $asistencia = new AsistenciaModel();
    $alumnoModel = new AlumnoModel();

    // Obtener los datos enviados mediante POST
    $fechaAsistencia = $this->request->getPost('fecha_asistencia');
    $estadoAsistencias = $this->request->getPost('asistencias'); // Array con los estados de asistencia por alumno

    // Obtener el curso_id y aula_id del docente usando el docenteId
    $docenteModel = new DocenteModel();
    $docenteData = $docenteModel->find($docenteId);
    
    $cursoId = $docenteData['curso_id'];
    $aulaId = $docenteData['aula_id'];

    // Iterar a través de los estados de asistencia y guardar en la base de datos
    foreach ($estadoAsistencias as $alumnoId => $estado) {
        // Obtener el usuario_id a partir del id del alumno
        $alumnoData = $alumnoModel->find($alumnoId);
        $usuarioId = $alumnoData['usuario_id'];

        $data = [
            'usuario_id' => $usuarioId, // Usar el usuario_id del alumno
            'curso_id' => $cursoId,
            'aula_id' => $aulaId,
            'fecha' => $fechaAsistencia,
            'estado' => $estado
        ];

        // Aquí guarda los datos en la tabla de asistencia, puedes usar el modelo de Asistencia
        $asistencia->insert($data); 
    }
    
    return redirect()->to('/docente/cursos');
}

/**************************************************************/
  public function editarCurso($id = null)
  {
    
  }
/**************************************************************/
public function actualizarCurso()
{
  
}
/**************************************************************/
  public function borrarCurso($id = null)
  {
    
  }
/**************************************************************/
public function asignarCurso()
{
  
}
/**************************************************************/
public function crearAsignacionCurso($id = null)
{
  
}

/**************************************************************/
public function guardarAsignacionCurso()
{
   
}

/**************************************************************/
}
