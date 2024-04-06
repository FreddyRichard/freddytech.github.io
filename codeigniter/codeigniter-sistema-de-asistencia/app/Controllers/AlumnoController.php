<?php

namespace App\Controllers;

use App\Models\AlumnoModel;
use App\Models\AulaModel;
use App\Models\UserModel;

class AlumnoController extends BaseController
{
/**************************************************************/
  public function index()
  {

  }
/**************************************************************/
  public function listarAlumnos($orden = '', $filtro = '')
  {
      $loggedIn = false; // Variable para determinar si el usuario está logueado
      $isRolDirector = false; // Variable para determinar si el usuario es director
      $isRolOficina = false; // Variable para determinar si el usuario es de oficina
      $isRolDocente = false;
      $isRolAlumno = false;
      $filtroActivo = ($orden === 'id' || $orden === 'nombres' || $orden === 'apellidopaterno' || $orden === 'apellidomaterno');

      if (!session()->has('user')) {
        // El usuario no ha iniciado sesión, redirigir a la página de inicio de sesión
        return redirect()->to(base_url('login'));
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
          'isRolAlumno' => $isRolAlumno,
          'filtroActivo' => $filtroActivo,
          'orden' => $orden
      ];

      $usuarioModel = new UserModel();

      // Aplicar filtro si se proporciona
      if (!empty($filtro)) {
          $usuarioModel->like('dni', $filtro)
          ->orLike('alumno.id', $filtro)
                      ->orLike('nombres', $filtro)
                      ->orLike('apellidopaterno', $filtro)
                      ->orLike('apellidomaterno', $filtro);
      }

      // Aplicar ordenamiento
      switch ($orden) {
          case 'id':
            $usuarioModel->orderBy('alumno.id', 'ASC');
            break;
          case 'dni':
              $usuarioModel->orderBy('dni', 'asc');
              break;
          case 'nombres':
              $usuarioModel->orderBy('nombres', 'ASC');
              break;
          case 'apellidopaterno':
              $usuarioModel->orderBy('apellidopaterno', 'ASC');
              break;
          case 'apellidomaterno':
              $usuarioModel->orderBy('apellidomaterno', 'ASC');
              break;
          default:
              $usuarioModel->orderBy('alumno.id', 'DESC');
              break;
      }

      $alumnos = $usuarioModel->select('alumno.id, alumno.usuario_id, usuario.dni, usuario.nombres, usuario.apellidopaterno, usuario.apellidomaterno, alumno.aula_id')
                              ->join('alumno', 'alumno.usuario_id = usuario.id')
                              ->where('usuario.rol', 'Alumno')
                              ->findAll();

      $alumnosData['alumnos'] = $alumnos;

      $aulaModel = new AulaModel();
      $aulas = $aulaModel->findAll();
      $alumnosData['aulas'] = $aulas;

      $alumnosData['filtro'] = $filtro;
      $alumnosData['orden'] = $orden;

      echo view('template/header', $data);
      echo view('mantenimiento/alumnos/listar', $alumnosData);
      echo view('template/footer');
  }
/**************************************************************/
  public function crearAlumno()
  {
    $loggedIn = false; 
    $isRolDirector = false; 
    $isRolOficina = false;
    $isRolDocente = false;
    $isRolAlumno = false;

    if (!session()->has('user')) {
      // El usuario no ha iniciado sesión, redirigir a la página de inicio de sesión
      return redirect()->to(base_url('login'));
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
    $usuarios = $usuarioModel->where('rol', 'Alumno')->findAll();

    $aulaModel = new AulaModel();
    $aulas = $aulaModel->findAll();
  
    $alumnoData = [
      'usuarios' => $usuarios,
      'aulas' => $aulas
    ];

    echo view('template/header', $data);
    echo view('mantenimiento/alumnos/crear', $alumnoData);
    echo view('template/footer');
  }
/**************************************************************/
  public function guardarAlumno()
  {
    // Crear instancia del modelo UserModel
    $usuarioModel = new UserModel();

    // Obtener datos del formulario y guardarlos en un array
    $usuarioData = [
      'nombres' => $this->request->getVar('nombres'),
      'apellidopaterno' => $this->request->getVar('apellidopaterno'),
      'apellidomaterno' => $this->request->getVar('apellidomaterno'),
      'telefono' => $this->request->getVar('telefono'),
      'sexo' => $this->request->getVar('sexo'),
      'correo' => $this->request->getVar('correo'),
      'dni' => $this->request->getVar('dni'),
      'username' => $this->request->getVar('username'),
      'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
      'rol' => 'Alumno'
    ];

    // Insertar datos en la tabla "usuario"
    $usuarioModel->insert($usuarioData);

    // Obtener el ID del usuario recién creado
    $usuarioId = $usuarioModel->getInsertID();

    // Crear instancia del modelo DocenteModel
    $alumnoModel = new AlumnoModel();

    // Obtener datos adicionales del formulario y agregar el ID del usuario
    $alumnoData = [
      'usuario_id' => $usuarioId,
      'aula_id' => $this->request->getVar('aula_id')
    ];

    // Insertar datos en la tabla "usuario"
    $alumnoModel->insert($alumnoData);

    // Redireccionar a la página de listado de alumnos
    return redirect()->to(site_url('listarAlumnos'));
  }
/**************************************************************/
  public function editarAlumno($id = null)
  {
    $loggedIn = false; 
    $isRolDirector = false; 
    $isRolOficina = false;
    $isRolDocente = false;
    $isRolAlumno = false;

    if (!session()->has('user')) {
      // El usuario no ha iniciado sesión, redirigir a la página de inicio de sesión
      return redirect()->to(base_url('login'));
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
    $alumno = new AlumnoModel();
    $alumnoData['alumno'] = $alumno->where('id', $id)->first();

    // Recuperar los datos de los usuarios
    $userModel = new UserModel();
    $usuarios = $userModel->findAll();
    $alumnoData['usuarios'] = $usuarios;

    // Recuperar los datos de las aulas
    $aulaModel = new AulaModel();
    $aulas = $aulaModel->findAll();
    $alumnoData['aulas'] = $aulas;

    $usuarioId = $alumnoData['alumno']['usuario_id'];
    $usuarioEncontrado = null;
    foreach ($usuarios as $usuario) {
        if ($usuario->id == $usuarioId) {
            $usuarioEncontrado = $usuario;
            break;
        }
    }

    $dni = '';
    $nombres = '';
    $apellidoPaterno = '';
    $apellidoMaterno = '';
    $telefono = '';
    $sexo = '';
    $correo = '';
    $username = '';

    if ($usuarioEncontrado !== null) {
        $dni = $usuarioEncontrado->dni;
        $nombres = $usuarioEncontrado->nombres;
        $apellidoPaterno = $usuarioEncontrado->apellidopaterno;
        $apellidoMaterno = $usuarioEncontrado->apellidomaterno;
        $telefono = $usuarioEncontrado->telefono;
        $sexo = $usuarioEncontrado->sexo;
        $correo = $usuarioEncontrado->correo;
        $username = $usuarioEncontrado->username;
    }
    $alumnoData['dni'] = $dni;
    $alumnoData['nombres'] = $nombres;
    $alumnoData['apellidoPaterno'] = $apellidoPaterno;
    $alumnoData['apellidoMaterno'] = $apellidoMaterno;
    $alumnoData['telefono'] = $telefono;
    $alumnoData['sexo'] = $sexo;
    $alumnoData['correo'] = $correo;
    $alumnoData['username'] = $username;

    echo view('template/header', $data);
    echo view('mantenimiento/alumnos/editar', $alumnoData);
    echo view('template/footer');
  }
/**************************************************************/
public function actualizarAlumno()
{
    // Obtener el ID del alumno
    $alumnoId = $this->request->getVar('id');

    // Crear instancia del modelo AlumnoModel
    $alumnoModel = new AlumnoModel();

    // Obtener los datos del alumno desde la base de datos
    $alumno = $alumnoModel->find($alumnoId);

    // Verificar si se encontró el alumno
    if (!$alumno) {
        // Manejar el caso cuando el alumno no existe
        return redirect()->to(site_url('error'));
    }

    // Obtener el ID del usuario relacionado con el alumno
    $usuarioId = $alumno['usuario_id'];

    // Crear instancia del modelo UserModel
    $userModel = new UserModel();

    // Obtener los datos del usuario desde la base de datos
    $usuario = $userModel->find($usuarioId);

    // Verificar si se encontró el usuario
    if (!$usuario) {
        // Manejar el caso cuando el usuario no existe
        return redirect()->to(site_url('error'));
    }

    // Obtener datos del formulario y guardarlos en un array
    $userData = [
        'nombres' => $this->request->getVar('nombres'),
        'apellidopaterno' => $this->request->getVar('apellidopaterno'),
        'apellidomaterno' => $this->request->getVar('apellidomaterno'),
        'telefono' => $this->request->getVar('telefono'),
        'sexo' => $this->request->getVar('sexo'),
        'correo' => $this->request->getVar('correo'),
        'dni' => $this->request->getVar('dni'),
        'username' => $this->request->getVar('username'),
    ];

    // Verificar si se proporcionó una nueva contraseña en el formulario
    $password = $this->request->getVar('password');
    if (!empty($password)) {
        // Agregar la nueva contraseña al array de datos
        $userData['password'] = password_hash($password, PASSWORD_DEFAULT);
    }

    // Actualizar los datos del usuario en la tabla "usuario"
    $userModel->update($usuarioId, $userData);

    // Crear instancia del modelo AlumnoModel
    $alumnoModel = new AlumnoModel();

    // Obtener datos adicionales del formulario y agregar el ID del usuario
    $nuevaAula = $this->request->getVar('aula_id');
    $alumnoData = [
        'aula_id' => $nuevaAula
    ];

    // Insertar datos en la tabla "alumno"
    $alumnoModel->update($alumnoId, $alumnoData);

    // Redireccionar según si se actualizó el aula o no
    if ($nuevaAula !== $alumno['aula_id']) {
        return redirect()->to(site_url('listarAulas'));
    } else {
        return redirect()->to(site_url('listarAlumnos'));
    }
}

/**************************************************************/
  public function borrarAlumno($id = null)
  {
    $alumno = new AlumnoModel();

    $alumno->where('id', $id)->delete($id);

    return redirect()->to(site_url('listarAlumnos'));
  }
/**************************************************************/










/** --------------------------------------------------------------------
 * VISTAS DEL ALUMNO
 * ------------------------------------------------------------------**/
  public function cursosActuales()
  {
      $loggedIn = false;
      $isRolDirector = false; 
      $isRolOficina = false; 
      $isRolDocente = false;
      $isRolAlumno = false;
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
      echo view('alumnos/cursosactuales');
      echo view('template/footer');
  }
/**************************************************************/
  public function notas() {
    $loggedIn = false;
    $isRolDirector = false; 
    $isRolOficina = false; 
    $isRolDocente = false;
    $isRolAlumno = false;

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
    $alumnosData['alumnos'] = $alumnoModel->findAll();
    echo view('template/header', $data);
    echo view('alumnos/notas', $alumnosData);
    echo view('template/footer');
  }
/**************************************************************/
  public function horario() {
    $loggedIn = false;
    $isRolDirector = false; 
    $isRolOficina = false; 
    $isRolDocente = false;
    $isRolAlumno = false;

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
    $alumnosData['alumnos'] = $alumnoModel->findAll();
    echo view('template/header', $data);
    echo view('alumnos/horario', $alumnosData);
    echo view('template/footer');
  }
/**************************************************************/
}
