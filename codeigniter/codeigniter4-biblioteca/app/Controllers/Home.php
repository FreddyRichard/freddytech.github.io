<?php

namespace App\Controllers;


class Home extends BaseController
{
    public function index()
    {
        $datos['header'] = view('template/header');
        $datos['footer'] = view('template/footer');

        return view('index', $datos);
    }
}
