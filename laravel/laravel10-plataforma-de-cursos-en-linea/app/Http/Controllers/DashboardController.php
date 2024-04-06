<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use App\Models\DocenteModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
//******************************************* */
    public function index(){
        return view('dashboard.index');
    }
//******************************************* */
    public function listarCategorias(){
        return view('mantenimiento.categorias.index');
    }
//******************************************* */

//******************************************* */
    
}
