<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Http\Requests\StoreCurso;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CursoController extends Controller
{
//*************************************************************************/ 
    public function index(){
        $cursos = Curso::orderBy('id', 'desc')->paginate();
        // Obtener las categorías relacionadas para cada curso
    foreach ($cursos as $curso) {
        $curso->categoria = Categoria::find($curso->categoria); // Obtén la categoría relacionada para este curso
    }
        $data = [
            'cursos' => $cursos,
        ];
        return view('cursos.index', compact('cursos', 'data'));
    }
//*************************************************************************/
    public function show(Curso $curso){
        $categoria = Categoria::find($curso->categoria); // Obtén la categoría relacionada
        $data = [
            'curso' => $curso,
            'categoria' => $categoria,
        ];
        return view('cursos.show', compact('curso', 'data'));
    }
//*************************************************************************/
    public function listarCursos(){
        $cursos = Curso::orderBy('id', 'desc')->paginate();
        // Obtener las categorías relacionadas para cada curso
    foreach ($cursos as $curso) {
        $curso->categoria = Categoria::find($curso->categoria); // Obtén la categoría relacionada para este curso
    }
        $data = [
            'cursos' => $cursos,
        ];
        return view('mantenimiento.cursos.listar', compact('cursos', 'data'));
    }
//*************************************************************************/
    public function crearCurso(){
        return view('mantenimiento.cursos.crear');
    }
//******************************************* */
    public function store(StoreCurso $request){
        // Validar y almacenar la imagen
        if ($request->hasFile('imagen')) {
            $imagenNombre = uniqid() . '.' . $request->file('imagen')->getClientOriginalExtension();
            $imagenPath = $request->file('imagen')->storeAs('public/cursos_images', $imagenNombre);
        } else {
            $imagenPath = null; // Si no se selecciona una imagen, asigna null
        }
    
        // Crear el curso con los datos del formulario
        $curso = new Curso([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'categoria' => $request->categoria,
            'slug' => Str::slug($request->nombre),
            'imagen' => $imagenNombre, // Asignar solo el nombre de la imagen
        ]);
    
        $curso->save();
    
        return redirect()->route('cursos.show', $curso);
    }    
//******************************************* */
    
//******************************************* */
    public function editarCurso(Curso $curso){
        return view('mantenimiento.cursos.editar', compact('curso'));
    }
    //******************************************* */
    public function actualizarCurso(Request $request, Curso $curso){
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'categoria' => 'required'
        ]);
    
        $request->merge([
            'slug' => Str::slug($request->nombre),
        ]);
    
        // Validar y actualizar la imagen si se selecciona una nueva
        if ($request->hasFile('imagen')) {
            // Eliminar la imagen antigua si existe
            if ($curso->imagen) {
                Storage::delete('public/cursos_images/' . $curso->imagen);
            }
    
            // Almacenar la nueva imagen
            $imagenNombre = uniqid() . '.' . $request->file('imagen')->getClientOriginalExtension();
            $imagenPath = $request->file('imagen')->storeAs('public/cursos_images', $imagenNombre);
    
            // Actualizar el nombre de la imagen en la base de datos
            $curso->update([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'categoria' => $request->categoria,
                'slug' => Str::slug($request->nombre),
                'imagen' => $imagenNombre,
            ]);
        } else {
            // Si no se selecciona una nueva imagen, actualizar los demás campos
            $curso->update([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'categoria' => $request->categoria,
                'slug' => Str::slug($request->nombre),
            ]);
        }
    
        return redirect()->route('cursos.listarCursos');
    }    
    //******************************************* */
    public function destroy(Curso $curso){
        $curso->delete(); 
        return redirect()->route('cursos.index');
    }
}
