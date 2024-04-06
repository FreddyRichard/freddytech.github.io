<?php

use App\Http\Controllers\ContactanosController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocenteController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|   Route::get('cursos/nuevo', [CursoController::class, 'nuevo'])->name('cursos.nuevo');
    Laravel nos permite 
*/

// Muestra la pagina principal de la web
Route::get('/', HomeController::class)->name('home');

Route::view('nosotros', 'nosotros')->name('nosotros');

//******************************************************* */
//**** DASHBOARD -- CRUD  ********************************** */
//******************************************************* */
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index'); 


//******************************************************* */
//**** CURSOS -- CRUD  ********************************** */
//******************************************************* */
Route::get('listarCursos', [CursoController::class, 'listarCursos'])->name('cursos.listarCursos'); 
Route::get('crearCurso', [CursoController::class, 'crearCurso'])->name('crearCurso');
Route::post('cursos', [CursoController::class, 'store'])->name('cursos.store');  

Route::get('cursos/{curso}/edit', [CursoController::class, 'editarCurso'])->name('editarCurso');
Route::put('cursos/{curso}', [CursoController::class, 'actualizarCurso'])->name('cursos.actualizarCurso'); 

Route::delete('cursos/{curso}', [CursoController::class, 'eliminarCurso'])->name('eliminarCurso');

Route::get('cursos', [CursoController::class, 'index'])->name('cursos.index'); 
Route::get('cursos/{curso}', [CursoController::class, 'show'])->name('cursos.show');
//******************************************************* */
//******************************************************* */





//******************************************************* */
//**** CATEGORIAS -- CRUD  ********************************** */
//******************************************************* */
Route::get('listarCategorias', [DashboardController::class, 'listarCategorias'])->name('categorias.listarCategorias'); 

//******************************************************* */

//******************************************************* */
//**** DOCENTES -- CRUD  ********************************** */
//******************************************************* */
// INICIO
Route::get('docentes', [DocenteController::class, 'listarDocentes'])->name('listarDocentes'); 
// CREAR
Route::get('docentes/crear', [DocenteController::class, 'crearDocente'])->name('docentes.crear');
Route::post('docentes', [DocenteController::class, 'storeDocente'])->name('docentes.store');  
// LEER
Route::get('docentes/{docente}', [DocenteController::class, 'leer'])->name('docentes.leer');
// ACTUALIZAR
Route::get('docentes/{docente}/editar', [DocenteController::class, 'editarDocente'])->name('editarDocente');
Route::put('docentes/{docente}', [DocenteController::class, 'actualizarDocente'])->name('actualizarDocente'); 
// ELIMINAR
Route::delete('docentes/{docente}', [DocenteController::class, 'eliminar'])->name('eliminarDocente'); 
//******************************************************* */



//******************************************************* */
//**** Para los EMAIL  ********************************** */
//******************************************************* */
Route::get('contactanos', [ContactanosController::class, 'index'])->name('contactanos.index');
Route::post('contactanos', [ContactanosController::class, 'store'])->name('contactanos.store');



