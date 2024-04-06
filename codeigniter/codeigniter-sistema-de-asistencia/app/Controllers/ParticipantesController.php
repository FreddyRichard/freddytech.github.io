<?php

namespace App\Controllers;

use App\Models\UserModel;

class ParticipantesController extends BaseController
{
    public function index()
    {
        $participanteModel = new UserModel();
        $clientes = $participanteModel->findAll();

        // Cargar la vista index.php y pasar la variable $clientes
        $data = ['clientes' => $clientes];

        //return view('index', ['clientes' => $clientes]);
        echo view('index', $data);
        echo view('template/footer');
    }

    public function verificarCedula()
    {
        $id = $this->request->getVar('dni');

        // Verificar si existe algún cliente en la base de datos con el DNI proporcionado
        $participanteModel = new UserModel();
        $totalCliente = $participanteModel->where('dni', $id)->countAllResults();

        $jsonData = [
            'success' => 0,
            'message' => '',
        ];

        if ($totalCliente > 0) {
            $jsonData['success'] = 1;
            $jsonData['message'] = '<p style="color:red;">Ya existe la Cédula <strong>(' . $id . ')</strong></p>';
        }

        // Mostrar la respuesta en formato JSON
        return $this->response->setJSON($jsonData);
    }

    

    public function listaClientes()
    {
        $participanteModel = new UserModel();
        $clientes = $participanteModel->findAll();

        return view('listClientes', ['clientes' => $clientes]);
    }
}
