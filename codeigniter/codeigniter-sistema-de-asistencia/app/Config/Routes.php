<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('home', 'Home::index');

$routes->get('login', 'LoginController::index');
$routes->post('login', 'LoginController::login');
$routes->get('logout', 'LoginController::logout');

$routes->get('register', 'RegisterController::index');
$routes->post('register', 'RegisterController::register');

$routes->get('dashboard', 'DashboardController::index');
/**************************************************************** */
//$routes->get('listarUsuarios', 'LoginController::index');


/**************************************************************** */
//$routes->get('listarAlumnos', 'OficinaController::listarAlumnos');
//$routes->get('listarAlumnos/(:any)', 'OficinaController::listarAlumnos/$1');
//$routes->get('listarAlumnos/(:any)/(:any)/(:any)', 'OficinaController::listarAlumnos/$1/$2///$3');
//$routes->get('crearAlumno', 'OficinaController::crearAlumno');
//$routes->post('guardarAlumno', 'OficinaController::guardarAlumno');
//$routes->get('editarAlumno/(:num)', 'OficinaController::editarAlumno/$1');
//$routes->post('actualizarAlumno', 'OficinaController::actualizarAlumno');
//$routes->get('borrarAlumno/(:num)', 'CursoController::borrarAlumno/$1');
/**************************************************************** */


/** --------------------------------------------------------------------
 * MANTENIMIENTO
 * ------------------------------------------------------------------**/
$routes->get('listarAlumnos', 'AlumnoController::listarAlumnos');
$routes->get('listarAlumnos/(:any)', 'AlumnoController::listarAlumnos/$1');
$routes->get('crearAlumno', 'AlumnoController::crearAlumno');
$routes->post('guardarAlumno', 'AlumnoController::guardarAlumno');
$routes->get('editarAlumno/(:num)', 'AlumnoController::editarAlumno/$1');
$routes->post('actualizarAlumno', 'AlumnoController::actualizarAlumno');
$routes->get('borrarAlumno/(:num)', 'AlumnoController::borrarAlumno/$1');

$routes->get('listarAulas', 'AulaController::listarAulas');
$routes->get('crearAula', 'AulaController::crearAula');
$routes->post('verificarNombre', 'DocenteController::verificarNombre');
$routes->post('guardarAula', 'AulaController::guardarAula');
$routes->get('editarAula/(:num)', 'AulaController::editarAula/$1');
$routes->post('actualizarAula', 'AulaController::actualizarAula');
$routes->get('borrarAula/(:num)', 'AulaController::borrarAula/$1');

$routes->get('listarCursos', 'CursoController::listarCursos');
$routes->get('crearCurso', 'CursoController::crearCurso');
$routes->post('guardarCurso', 'CursoController::guardarCurso');
$routes->get('editarCurso/(:num)', 'CursoController::editarCurso/$1');
$routes->post('actualizarCurso', 'CursoController::actualizarCurso');
$routes->get('borrarCurso/(:num)', 'CursoController::borrarCurso/$1');
$routes->get('asignarCurso', 'CursoController::asignarCurso');
$routes->get('crearAsignacionCurso/(:num)', 'CursoController::crearAsignacionCurso/$1');
$routes->post('guardarAsignacionCurso', 'CursoController::guardarAsignacionCurso');

$routes->get('listarDocentes', 'DocenteController::listarDocentes');
$routes->get('listarDocentes/(:any)', 'DocenteController::listarDocentes/$1');
$routes->get('crearDocente', 'DocenteController::crearDocente');
$routes->post('guardarDocente', 'DocenteController::guardarDocente');
$routes->get('editarDocente/(:num)', 'DocenteController::editarDocente/$1');
$routes->post('actualizarDocente', 'DocenteController::actualizarDocente');
$routes->get('borrarDocente/(:num)', 'DocenteController::borrarDocente/$1');
//************************************************ */
$routes->get('participantes/verificarCedula', 'ParticipantesController::verificarCedula');
//****************************** */
$routes->get('listarUsuarios', 'UsuarioController::listarUsuarios');
$routes->get('listarUsuarios/(:any)', 'UsuarioController::listarUsuarios/$1');
$routes->get('crearUsuario', 'UsuarioController::crearUsuario');
$routes->post('guardarUsuario', 'UsuarioController::guardarUsuario');
$routes->get('editarUsuario/(:num)', 'UsuarioController::editarUsuario/$1');
$routes->post('actualizarUsuario', 'UsuarioController::actualizarUsuario');
$routes->get('borrarUsuario/(:num)', 'UsuarioController::borrarUsuario/$1');




/** --------------------------------------------------------------------
 * VISTAS DEL ALUMNO
 * ------------------------------------------------------------------**/
$routes->group('alumno', function ($routes) {
    $routes->get('cursosActuales', 'AlumnoController::cursosActuales');
    $routes->get('notas', 'AlumnoController::notas');
    $routes->get('horario', 'AlumnoController::horario');
});
/** --------------------------------------------------------------------
 * VISTAS DEL DOCENTE
 * ------------------------------------------------------------------**/
$routes->group('docente', function ($routes) {
    $routes->get('cursos', 'DocenteController::cursos');
    $routes->get('evaluaciones', 'DocenteController::evaluaciones');
});


/** --------------------------------------------------------------------
 * ASISTENCIAS
 * ------------------------------------------------------------------**/
$routes->get('listarAsistencias', 'AsistenciaController::listarAsistencias');
$routes->get('listarAsistenciasPorFecha', 'AsistenciaController::listarAsistenciasPorFecha');
$routes->get('crearAsistencias/(:num)', 'AsistenciaController::crearAsistencias/$1');
$routes->post('guardarAsistencia/(:segment)', 'AsistenciaController::guardarAsistencia/$1');


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
