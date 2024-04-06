<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke(){
        // El metodo view hace que laravel se dirija a la 
        // carpeta resources y a partir de ahi nos direccione 
        // la ruta de la vista
        return view("home");
    }
}
