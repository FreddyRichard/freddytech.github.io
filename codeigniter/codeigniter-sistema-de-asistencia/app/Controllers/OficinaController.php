<?php

namespace App\Controllers;

use App\Models\AlumnoModel;
use App\Models\AulaModel;

class OficinaController extends BaseController
{

  public function index()
  {

  }


/**************************************************************/
/**************************************************************/
/***** ALUMNOS  ***********************************************/
/**************************************************************/
/**************************************************************/


/**************************************************************/
  
/**************************************************************/
  public function guardarAlumno()
  {
    $alumno = new AlumnoModel();

    // $validacion = $this->validate([
    //   'nombre' => 'required|min_length[3]',
    //   'seccion' => 'required|max_length[3]',
    //   'nivel' => 'required|max_length[11]'
    // ]);

    // if (!$validacion) {
    //   $session = session();
    //   $session->setFlashdata('mensaje', 'Ingrese información correcta en los campos obligatorios.');
    //   return redirect()->back()->withInput();
    // }

    $datos = [
      'dni' => $this->request->getVar('dni'),
      'nombres' => $this->request->getVar('nombres'),
      'apellidopaterno' => $this->request->getVar('apellidopaterno'),
      'apellidomaterno' => $this->request->getVar('apellidomaterno'),
      'nacimiento' => $this->request->getVar('nacimiento'),
      'telefono' => $this->request->getVar('telefono'),
      'distrito' => $this->request->getVar('distrito'),
      'direccion' => $this->request->getVar('direccion'),
      'grado' => $this->request->getVar('grado'),
      'seccion' => $this->request->getVar('seccion'),
      'nivel' => $this->request->getVar('nivel'),
      'correo' => $this->request->getVar('correo'),
      'password' => $this->request->getVar('password'),
      'imagen' => $this->request->getVar('imagen')
    ];

    $alumno->insert($datos);
    // Actualizar la disponibilidad de vacantes en el aula correspondiente
    $this->actualizarVacantesAula($datos['grado'], $datos['seccion'], $datos['nivel']);

    return $this->response->redirect(site_url('/listarAlumnos'));
  }


  protected function actualizarVacantesAula($grado, $seccion, $nivel)
    {
        $aula = new AulaModel();

        // Obtener los datos del aula correspondiente al grado, sección y nivel del alumno
        $aulaData = $aula->where('nombre', $grado)->where('seccion', $seccion)->where('nivel', $nivel)->first();

        // Verificar que se haya encontrado el aula correspondiente
        if ($aulaData) {
            $vacantesActuales = $aulaData['vacantes'];
            $aulaId = $aulaData['id'];

            // Actualizar la disponibilidad de vacantes restando 1
            $vacantesActualizadas = $vacantesActuales - 1;

            // Actualizar el registro del aula en la base de datos
            $aula->update($aulaId, ['vacantes' => $vacantesActualizadas]);
        }
    }
/**************************************************************/
  public function editarAlumno($id = null)
  {
    $loggedIn = false; 
    $isRolDirector = false; 
    $isRolOficina = false;

    if (session()->has('user')) {
        $loggedIn = true;
        $user = session('user');
        if ($user->rol === 'Director') {
            $isRolDirector = true;
        } elseif ($user->rol === 'Oficina') {
            $isRolOficina = true;
        }
    }

    $data = [
        'loggedIn' => $loggedIn,
        'isRolDirector' => $isRolDirector,
        'isRolOficina' => $isRolOficina
    ];

    // Recuperar los datos del aula con el $id
    $alumno = new AlumnoModel();
    $alumnoData['alumno'] = $alumno->where('id', $id)->first();

    echo view('template/header', $data);
    echo view('oficina/alumnos/editar', $alumnoData);
    echo view('template/footer');
  }
/**************************************************************/
  public function actualizarAlumno()
  {
  $alumno = new AlumnoModel();
  $id = $this->request->getVar('id');

  $datos = [
    'dni' => $this->request->getVar('dni'),
    'nombres' => $this->request->getVar('nombres'),
    'apellidopaterno' => $this->request->getVar('apellidopaterno'),
    'apellidomaterno' => $this->request->getVar('apellidomaterno'),
    'nacimiento' => $this->request->getVar('nacimiento'),
    'telefono' => $this->request->getVar('telefono'),
    'distrito' => $this->request->getVar('distrito'),
    'direccion' => $this->request->getVar('direccion'),
    'grado' => $this->request->getVar('grado'),
    'seccion' => $this->request->getVar('seccion'),
    'nivel' => $this->request->getVar('nivel'),
    'correo' => $this->request->getVar('correo'),
    'password' => $this->request->getVar('password'),
    'imagen' => $this->request->getVar('imagen')
  ];

  // $validacion = $this->validate([
  //   'nombre' => 'required|min_length[4]',
  //   'seccion' => 'required|max_length[5]'
  // ]);
  // if (!$validacion) {
  //   $session = session();
  //   $session->setFlashdata('mensaje', 'Ingrese información correcta en los campos obligatorios.');
  //   return redirect()->back()->withInput();
  // }

  $alumno->update($id, $datos);

  return $this->response->redirect(site_url('/listarAlumnos'));
  }
/**************************************************************/



/**************************************************************/
/**************************************************************/
/*** AULAS  ***************************************************/
/**************************************************************/
/**************************************************************/
  public function listarAulas()
  {
    $loggedIn = false; // Variable para determinar si el usuario está logueado
    $isRolDirector = false; // Variable para determinar si el usuario es director
    $isRolOficina = false; // Variable para determinar si el usuario es de oficina
    $isRolAlumno = false; // Variable para determinar si el usuario es de oficina

    if (session()->has('user')) {
        $loggedIn = true;
        $user = session('user');
        if ($user->rol === 'Director') {
            $isRolDirector = true;
        } elseif ($user->rol === 'Oficina') {
            $isRolOficina = true;
        } elseif ($user->rol === 'Alumno') {
          $isRolAlumno = true;
        }
    }

    $data = [
        'loggedIn' => $loggedIn,
        'isRolDirector' => $isRolDirector,
        'isRolOficina' => $isRolOficina,
        'isRolAlumno' => $isRolAlumno
    ];

    $aula = new AulaModel();
    $aulasData['aulas'] = $aula->orderBy('id', 'ASC')->findAll();

    // Obtener el modelo de alumnos
    $alumnoModel = new AlumnoModel();

    // Actualizar el número de alumnos registrados en cada aula y guardar en la base de datos
    foreach ($aulasData['aulas'] as &$aulaData) {
        $vacanteRegistrada = $alumnoModel->where('grado', $aulaData['nombre'])
                                         ->where('seccion', $aulaData['seccion'])
                                         ->where('nivel', $aulaData['nivel'])
                                         ->countAllResults();

        $aula->update($aulaData['id'], ['vacanteRegistrada' => $vacanteRegistrada]);

        $aulaData['vacanteRegistrada'] = $vacanteRegistrada;
    }
    
    echo view('template/header', $data);
    echo view('oficina/aulas/listar', $aulasData);
    echo view('template/footer');
  }
/**************************************************************/
  public function crearAula()
  {
    $loggedIn = false; 
    $isRolDirector = false; 
    $isRolOficina = false;

    if (session()->has('user')) {
        $loggedIn = true;
        $user = session('user');
        if ($user->rol === 'Director') {
            $isRolDirector = true;
        } elseif ($user->rol === 'Oficina') {
            $isRolOficina = true;
        }
    }

    $data = [
        'loggedIn' => $loggedIn,
        'isRolDirector' => $isRolDirector,
        'isRolOficina' => $isRolOficina
    ];

    echo view('template/header', $data);
    echo view('oficina/aulas/crear');
    echo view('template/footer');
  }
/**************************************************************/
  public function guardarAula()
  {
    $aula = new AulaModel();

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

    if (session()->has('user')) {
        $loggedIn = true;
        $user = session('user');
        if ($user->rol === 'Director') {
            $isRolDirector = true;
        } elseif ($user->rol === 'Oficina') {
            $isRolOficina = true;
        }
    }

    $data = [
        'loggedIn' => $loggedIn,
        'isRolDirector' => $isRolDirector,
        'isRolOficina' => $isRolOficina
    ];

    // Recuperar los datos del aula con el $id
    $aula = new AulaModel();
    $aulaData['aula'] = $aula->where('id', $id)->first();

    echo view('template/header', $data);
    echo view('oficina/aulas/editar', $aulaData);
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
}
