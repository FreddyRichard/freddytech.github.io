<?php

namespace App\Controllers;

use App\Models\CursoModel;



class CursoController extends BaseController
{

  public function index()
  {
    $curso = new CursoModel();
    $datos['cursos'] = $curso->orderBy('id', 'ASC')->FindAll();

    $datos['header'] = view('template/header');
    $datos['footer'] = view('template/footer');

    return view('cursos/listar', $datos);
  }



  /**************************************************************/
  /**************************************************************/
  public function crear()
  {
    $datos['header'] = view('template/header');
    $datos['footer'] = view('template/footer');

    return view('cursos/crear', $datos);
  }



  /**************************************************************/
  /**************************************************************/
  public function guardar()
  {
    $curso = new CursoModel();
    $aliasImagen = null;
    $imagen = $this->request->getFile('imagen');

    // Verificar el límite de registros
    $totalRegistros = $curso->countAllResults();
    $limiteRegistros = 6;

    if ($totalRegistros >= $limiteRegistros) {
      $session = session();
      $session->setFlashdata('mensaje', 'Se ha alcanzado el límite de registros permitidos (6).');
      return redirect()->back()->withInput();
    }

    $validacion = $this->validate([
      'nombre' => 'required|min_length[3]',
      'categoria' => 'required|min_length[5]',
    ]);

    if (!$validacion) {
      $session = session();
      $session->setFlashdata('mensaje', 'Ingrese información correcta en los campos obligatorios.');
      return redirect()->back()->withInput();
    }

    if ($imagen && $imagen->isValid()) {
      $aliasImagen = $imagen->getRandomName();
      $imagen->move('../public/uploads/', $aliasImagen);
    }

    $datos = [
      'nombre' => $this->request->getVar('nombre'),
      'descripcion' => $this->request->getVar('descripcion'),
      'categoria' => $this->request->getVar('categoria'),
      'imagen' => $aliasImagen
    ];

    $curso->insert($datos);
    return $this->response->redirect(site_url('/listar'));
  }


  /**************************************************************/
  /**************************************************************/
  public function borrar($id = null)
  {
    $curso = new CursoModel();
    $datosCurso = $curso->where('id', $id)->first();

    // Verificar si el registro tiene una imagen antes de intentar eliminarla
    if ($datosCurso['imagen']) {
      $ruta = ('../public/uploads/' . $datosCurso['imagen']);
      unlink($ruta);
    }

    $curso->where('id', $id)->delete($id);

    return $this->response->redirect(site_url('/listar'));
  }



  /**************************************************************/
  public function editar($id = null)
  {
    $curso = new CursoModel();
    $datos['curso'] = $curso->where('id', $id)->first();

    $datos['header'] = view('template/header');
    $datos['footer'] = view('template/footer');

    return view('cursos/editar', $datos);
  }



  /**************************************************************/
  public function actualizar()
  {
    $curso = new CursoModel();
    $id = $this->request->getVar('id');
    $datos = [
      'nombre' => $this->request->getVar('nombre'),
      'descripcion' => $this->request->getVar('descripcion'),
      'categoria' => $this->request->getVar('categoria'),
    ];

    $validacion = $this->validate([
      'nombre' => 'required|min_length[3]',
      'categoria' => 'required|min_length[5]'
    ]);
    if (!$validacion) {
      $session = session();
      $session->setFlashdata('mensaje', 'Ingrese información correcta en los campos obligatorios.');
      return redirect()->back()->withInput();
    }

    // Verificar si se ha subido una imagen
    if (!empty($_FILES['imagen']['name'])) {
      $validacionImagen = $this->validate([
        'imagen' => [
          'uploaded[imagen]',
          'mime_in[imagen,image/jpg,image/jpeg,image/png]',
          'max_size[imagen,1024]',
        ]
      ]);

      if ($validacionImagen) {
        // Eliminar imagen existente si se ha subido una nueva imagen
        $datosCurso = $curso->where('id', $id)->first();
        if (!empty($datosCurso['imagen'])) {
          $ruta = '../public/uploads/' . $datosCurso['imagen'];
          if (is_file($ruta)) {
            unlink($ruta);
          }
        }

        // Mover y actualizar la nueva imagen
        $imagen = $this->request->getFile('imagen');
        $aliasImagen = $imagen->getRandomName();
        $imagen->move('../public/uploads/', $aliasImagen);

        $datos['imagen'] = $aliasImagen;
      }
    }

    $curso->update($id, $datos);

    return $this->response->redirect(site_url('/listar'));
  }
}
