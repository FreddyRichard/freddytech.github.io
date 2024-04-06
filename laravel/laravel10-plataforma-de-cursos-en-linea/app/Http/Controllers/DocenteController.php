<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDocente;
use App\Models\DocenteModel;
use Illuminate\Http\Request;


class DocenteController extends Controller
{
    public function listarDocentes(){
        $docentes = DocenteModel::orderBy('id', 'desc')->paginate();
        return view('mantenimiento.docentes.listar', compact('docentes'));
    }
    //******************************************* */
    public function crearDocente(){
        return view('mantenimiento.docentes.crear');
    }

    //******************************************* */
    public function storeDocente(StoreDocente $request){
        $docente = DocenteModel::create($request->all());  
        return redirect()->route('mantenimiento.docentes.leer', $docente);
    }
    //******************************************* */
    public function leer(DocenteModel $docente){
        return view('mantenimiento.docentes.leer', compact('docente'));
    }

    //******************************************* */
    public function editarDocente(DocenteModel $docente){
        return view('mantenimiento.docentes.editar', compact('docente'));
    }
    //******************************************* */
    public function actualizarDocente(Request $request, DocenteModel $docente){
        $request->validate([
            'nombres' => 'required',
            'apellidopaterno' => 'required',
        ]);
        $docente->dni = $request->dni;
        $docente->nombres = $request->nombres;
        $docente->apellidopaterno = $request->apellidopaterno;
        $docente->apellidomaterno = $request->apellidomaterno;
        $docente->telefono = $request->telefono;
        $docente->genero = $request->genero;
        $docente->save();
        return redirect()->route('listarDocentes', $docente);
    }
    //******************************************* */
    public function eliminar(DocenteModel $docente){
        $docente->delete(); 
        return redirect()->route('docentes.index');
    }
}
