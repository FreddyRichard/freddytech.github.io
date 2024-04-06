<?php

namespace App\Controllers;

use App\Models\AulaModel;
use App\Models\CursoModel;
use App\Models\DocenteModel;
use App\Models\ParticipanteModel;
use App\Models\UserModel;

class DocenteController extends BaseController
{
/**************************************************************/
  public function index()
  {

  }
/**************************************************************/
  public function listarDocentes($orden = '', $filtro = '')
  {
      $loggedIn = false;
      $isRolDirector = false;
      $isRolOficina = false;
      $isRolDocente = false;
      $isRolAlumno = false;
      $filtroActivo = ($orden === 'id' || $orden === 'nombres' || $orden === 'curso');

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
      // Si el filtro es 'curso', hacemos un join con la tabla "docente" y la tabla "curso" para obtener el nombre del curso
      if ($filtro === 'curso') {
        $usuarioModel->join('docente', 'docente.usuario_id = usuario.id')
                     ->join('curso', 'docente.curso_id = curso.id');
    }

        $usuarioModel->like('dni', $filtro)
        ->orLike('docente.id', $filtro)
                    ->orLike('nombres', $filtro);

                    // Si el filtro es 'curso', también agregamos la búsqueda por el nombre del curso
        if ($filtro === 'curso') {
          $usuarioModel->orLike('curso.nombre', $filtro);
      }
    }

    // Aplicar ordenamiento
    switch ($orden) {
        case 'id':
            $usuarioModel->orderBy('docente.id', 'ASC');
            break;
        case 'dni':
            $usuarioModel->orderBy('dni', 'ASC');
            break;
        case 'nombres':
            $usuarioModel->orderBy('nombres', 'ASC');
            break;
        case 'curso':
            $usuarioModel->orderBy('(SELECT id FROM curso WHERE docente.curso_id = curso.nombre)', 'ASC');
            break;
        default:
            $usuarioModel->orderBy('docente.id', 'DESC');
            break;
    }

      $docentes = $usuarioModel->select('docente.id, docente.usuario_id, usuario.dni, usuario.nombres, usuario.apellidopaterno, usuario.apellidomaterno, docente.curso_id, docente.aula_id')
                              ->join('docente', 'docente.usuario_id = usuario.id')
                              ->where('usuario.rol', 'Docente')
                              ->findAll();



      $docenteData['docentes'] = $docentes;

      $cursoModel = new CursoModel();
      $cursos = $cursoModel->findAll();
      $docenteData['cursos'] = $cursos;

      $aulaModel = new AulaModel();
      $aulas = $aulaModel->findAll();
      $docenteData['aulas'] = $aulas;

      echo view('template/header', $data);
      echo view('mantenimiento/docentes/listar', $docenteData);
      echo view('template/footer');
  }
/**************************************************************/
public function crearDocente()
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
  $usuarios = $usuarioModel->where('rol', 'Docente')->findAll();

  $cursoModel = new CursoModel();
  $cursos = $cursoModel->findAll();

  $aulaModel = new AulaModel();
  $aulas = $aulaModel->findAll();

  $docenteData = [
    'usuarios' => $usuarios,
        'cursos' => $cursos,
        'aulas' => $aulas
        
  ];

  echo view('template/header', $data);
  echo view('mantenimiento/docentes/crear', $docenteData);
  echo view('template/footer');
}
/**************************************************************/
  public function guardarDocente()
  {
    // Crear instancia del modelo UserModel
    $userModel = new UserModel();

    $cantidadDocentes = $userModel->countAllResults();

    if ($cantidadDocentes >= 18) {
        $session = session();
        $session->setFlashdata('mensaje', 'No se pueden registrar más de 18 docentes.');
        return redirect()->back()->withInput();
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
      'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
      'rol' => 'Docente'
    ];

    // Insertar datos en la tabla "usuario"
    $userModel->insert($userData);

    // Obtener el ID del usuario recién creado
    $usuarioId = $userModel->getInsertID();

    // Crear instancia del modelo DocenteModel
    $docenteModel = new DocenteModel();

    // Obtener datos adicionales del formulario y agregar el ID del usuario
    $docenteData = [
      'curso_id' => $this->request->getVar('curso_id'),
      'aula_id' => $this->request->getVar('aula_id'),
      'usuario_id' => $usuarioId
    ];

    // Insertar datos en la tabla "docente"
    $docenteModel->insert($docenteData);

    // Redireccionar a la página de listado de docentes
    return redirect()->to(site_url('listarDocentes'));
  }
/**************************************************************/
  public function editarDocente($id = null)
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

    // Recuperar los datos del docente con el $id
    $docente = new DocenteModel();
    $docenteData['docente'] = $docente->where('id', $id)->first();

    // Recuperar los datos de los usuarios
    $userModel = new UserModel();
    $usuarios = $userModel->findAll();
    $docenteData['usuarios'] = $usuarios;

    // Recuperar los datos de los cursos
    $cursoModel = new CursoModel();
    $cursos = $cursoModel->findAll();
    $docenteData['cursos'] = $cursos;

    // Recuperar los datos de las aulas
    $aulaModel = new AulaModel();
    $aulas = $aulaModel->findAll();
    $docenteData['aulas'] = $aulas;

    $usuarioId = $docenteData['docente']['usuario_id'];
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
    $docenteData['dni'] = $dni;
    $docenteData['nombres'] = $nombres;
    $docenteData['apellidoPaterno'] = $apellidoPaterno;
    $docenteData['apellidoMaterno'] = $apellidoMaterno;
    $docenteData['telefono'] = $telefono;
    $docenteData['sexo'] = $sexo;
    $docenteData['correo'] = $correo;
    $docenteData['username'] = $username;

    echo view('template/header', $data);
    echo view('mantenimiento/docentes/editar', $docenteData);
    echo view('template/footer');
  }
/**************************************************************/
  public function actualizarDocente()
  {
      // Obtener el ID del docente
      $docenteId = $this->request->getVar('id');

      // Crear instancia del modelo DocenteModel
      $docenteModel = new DocenteModel();

      // Obtener los datos del docente desde la base de datos
      $docente = $docenteModel->find($docenteId);

      // Verificar si se encontró el docente
      if (!$docente) {
          // Manejar el caso cuando el docente no existe
          // Puedes mostrar un mensaje de error o redirigir a una página de error
          return redirect()->to(site_url('error'));
      }

      // Obtener el ID del usuario relacionado con el docente
      $usuarioId = $docente['usuario_id'];

      // Crear instancia del modelo UserModel
      $userModel = new UserModel();

      // Obtener los datos del usuario desde la base de datos
      $usuario = $userModel->find($usuarioId);

      // Verificar si se encontró el usuario
      if (!$usuario) {
          // Manejar el caso cuando el usuario no existe
          // Puedes mostrar un mensaje de error o redirigir a una página de error
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

      // Crear instancia del modelo DocenteModel
      $docenteModel = new DocenteModel();

      // Obtener datos adicionales del formulario y agregar el ID del usuario
      $docenteData = [
          'curso_id' => $this->request->getVar('curso_id'),
          'aula_id' => $this->request->getVar('aula_id'),
      ];

      // Insertar datos en la tabla "docente"
      $docenteModel->update($docenteId, $docenteData);

      // Redireccionar a la página de listado de docentes
      return redirect()->to(site_url('listarDocentes'));
  }
/**************************************************************/
public function borrarDocente($id = null)
{
  $docente = new DocenteModel();

  $docente->where('id', $id)->delete($id);

  return redirect()->to(site_url('listarDocentes'));
}
/**************************************************************/





/** --------------------------------------------------------------------
 * VISTAS DEL DOCENTE
 * ------------------------------------------------------------------**/
  public function cursos()
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

    if (session()->has('user') && session('user')->rol === 'Docente') {
      $loggedUserId = session('user')->id;
    }
  

    $docenteModel = new DocenteModel();

    if (isset($loggedUserId)) {
        $docentes = $docenteModel->where('usuario_id', $loggedUserId)->findAll();
    } else {
        $docentes = $docenteModel->findAll();
    }
    
    $docenteData['docentes'] = $docentes;
  

    $cursoModel = new CursoModel();
    $cursos = $cursoModel->findAll();
    $docenteData['cursos'] = $cursos;

    $aulaModel = new AulaModel();
    $aulas = $aulaModel->findAll();
    $docenteData['aulas'] = $aulas;

    echo view('template/header', $data);
    echo view('docentes/cursos', $docenteData);
    echo view('template/footer');
  }
/**************************************************************/
  public function evaluaciones()
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
    echo view('docentes/evaluaciones');
    echo view('template/footer');
  }
/**************************************************************/
}
