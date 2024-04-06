<?php

namespace App\Controllers;

use App\Models\AlumnoModel;
use App\Models\DocenteModel;
use App\Models\UserModel;

class UsuarioController extends BaseController
{
/**************************************************************/
  public function index()
  {

  }
/**************************************************************/
  public function verificarDNI()
  {
      $dni = $this->request->getVar('dni');

      $db = db_connect();
      $builder = $db->table('usuario');
      $builder->where('dni', $dni);
      $totalCliente = $builder->countAllResults();

      $jsonData = [
          'success' => 0,
          'message' => '',
      ];

      if ($totalCliente > 0) {
          $jsonData['success'] = 1;
          $jsonData['message'] = '<p style="color:red;">Ya existe el DNI <strong>(' . $dni . ')</strong></p>';
      }

      // Mostrar la respuesta en formato JSON
      return $this->response->setJSON($jsonData);
  }
/**************************************************************/
  public function listarUsuarios($orden = '', $filtro = '')
  {
    $loggedIn = false; 
    $isRolDirector = false; 
    $isRolOficina = false;
    $isRolDocente = false; 
    $isRolAlumno = false;
    $filtroActivo = ($orden === 'id' || $orden === 'nombres' || $orden === 'apellidopaterno' || $orden === 'apellidomaterno');
  
    // if (!session()->has('user')) {
    //   // El usuario no ha iniciado sesión, redirigir a la página de inicio de sesión
    //   return redirect()->to(base_url('login'));
    // }   
  
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
          $usuarioModel->orderBy('id', 'ASC');
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
          $usuarioModel->orderBy('id', 'DESC');
          break;
    }
    $usuariosData['usuarios'] = $usuarioModel->orderBy('id', 'ASC')->findAll();
    //$usuariosData['usuarios'] = $usuario->orderBy('rol', 'ASC')->findAll();
    $usuariosData['alumnos'] = $usuarioModel;

    $usuariosData['filtro'] = $filtro;
    $usuariosData['orden'] = $orden;

    echo view('template/header', $data);
    echo view('mantenimiento/usuarios/listar', $usuariosData);
    echo view('template/footer');
  }
/**************************************************************/
  public function crearUsuario()
  {
    $loggedIn = false; 
    $isRolDirector = false; 
    $isRolOficina = false;
    $isRolDocente = false; 
    $isRolAlumno = false;
  
    // if (!session()->has('user')) {
    //     // El usuario no ha iniciado sesión, redirigir a la página de inicio de sesión
    //     return redirect()->to('/login');
    // }
  
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
    echo view('mantenimiento/usuarios/crear');
    echo view('template/footer');
  }
/**************************************************************/
public function guardarUsuario()
{
    $usuario = new UserModel();

    $datos = [
        'nombres' => $this->request->getVar('nombres'),
        'apellidopaterno' => $this->request->getVar('apellidopaterno'),
        'apellidomaterno' => $this->request->getVar('apellidomaterno'),
        'telefono' => $this->request->getVar('telefono'),
        'sexo' => $this->request->getVar('sexo'),
        'correo' => $this->request->getVar('correo'),
        'username' => $this->request->getVar('username'),
        'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
        'dni' => $this->request->getVar('dni'),
        'rol' => $this->request->getVar('rol')
    ];

    $usuario->insert($datos);

    // Obtener el ID del usuario recién creado
    $usuarioId = $usuario->getInsertID();

    // Insertar en la tabla correspondiente según el rol
    if ($datos['rol'] === 'Alumno') {
        $alumnoModel = new AlumnoModel();
        $alumnoData = [
            'usuario_id' => $usuarioId,
            // Otros campos específicos de alumno
        ];
        $alumnoModel->insert($alumnoData);
    } elseif ($datos['rol'] === 'Docente') {
        $docenteModel = new DocenteModel();
        $docenteData = [
            'usuario_id' => $usuarioId,
            // Otros campos específicos de docente
        ];
        $docenteModel->insert($docenteData);
    }

    return $this->response->redirect(site_url('/listarUsuarios'));
}

/**************************************************************/
  public function editarUsuario($id = null)
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
  
    // Recuperar los datos del usuario con el $id
    $usuario = new UserModel();
    $usuarioData['usuario'] = $usuario->where('id', $id)->first();

    // Verificar si hay una contraseña encriptada y dejar el campo vacío si es así
    if (password_needs_rehash($usuarioData['usuario']->password, PASSWORD_DEFAULT)) {
      $usuarioData['usuario']->password = '';
    }


    echo view('template/header', $data);
    echo view('mantenimiento/usuarios/editar', $usuarioData);
    echo view('template/footer');
  }
/**************************************************************/
  public function actualizarUsuario()
  {
      $usuario = new UserModel();
      $id = $this->request->getVar('id');

      $datos = [
          'nombres' => $this->request->getVar('nombres'),
          'apellidopaterno' => $this->request->getVar('apellidopaterno'),
          'apellidomaterno' => $this->request->getVar('apellidomaterno'),
          'telefono' => $this->request->getVar('telefono'),
          'sexo' => $this->request->getVar('sexo'),
          'correo' => $this->request->getVar('correo'),
          'username' => $this->request->getVar('username'),
          'dni' => $this->request->getVar('dni'),
          'rol' => $this->request->getVar('rol')
      ];

      $password = $this->request->getVar('password');

      if (!empty($password)) {
          // El campo de contraseña no está vacío, encriptar la nueva contraseña
          $datos['password'] = password_hash($password, PASSWORD_DEFAULT);
      }

      $usuario->update($id, $datos);

      return $this->response->redirect(site_url('/listarUsuarios'));
  }
/**************************************************************/
  public function borrarUsuario($id = null)
  {
    $usuario = new UserModel();

    $usuario->where('id', $id)->delete($id);

    return $this->response->redirect(site_url('/listarUsuarios'));
  }
/**************************************************************/
}
