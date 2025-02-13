<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Invitado;
use Exception;

class ControllerInvitados extends Controller
{
    public function index(): string
    {
        $invitado = new Invitado();
        $resultado = $invitado->ListarInvitados();
        // Convertir los resultados a un array para pasarlo a la vista
        $datos['invitado'] = $resultado->getResultArray();
        // Cargar la vista y pasar los datos
        $prueba["select"] = ["Invitados"];

        $datos['layout'] = view("layouts/layout", $prueba);
        $datos['layout_js'] = view("layouts/layout-js");

        return view('invitados', $datos);
    }
    public function add()
    {
        try {
            $invitado = new Invitado();

            $NoCuenta = $this->request->getVar('NoCuenta');
            $Nombre = $this->request->getVar('name');
            $area = $this->request->getVar('area');
            $dependencia = $this->request->getVar('depend');
            $contraseña = $this->request->getVar('new-account-password');

            $data = [
                $NoCuenta,
                $Nombre,
                $area,
                $contraseña,
                $dependencia,
            ];

            $resultado = $invitado->insertarInvitado($data);

            if ($resultado) {
                $res = $invitado->ListarInvitados();
                echo json_encode($res->getResultArray());
            } else {
                echo json_encode(array("status" => "Error"));
            }
        } catch (\Exception $e) {
            echo json_encode(array("status" => "Error"));
        }
    }

    public function obtener_invitado($id)
    {
        $invitado = new Invitado();
        $resultado = $invitado->obtenerDatosInvitado($id);
        echo json_encode($resultado);
    }

    public function eliminar_invitado()
    {
        $invitado = new Invitado();
        $id = $this->request->getVar('NoCuenta');
        $resultado = $invitado->eliminarInvitado($id);
        if ($resultado) {
            $res = $invitado->ListarInvitados();
            echo json_encode($res->getResultArray());
        } else {
            echo json_encode(array("status" => "Error"));
        }
    }

    public function actualizar_invitado()
    {
        $invitado = new Invitado();

        $NoCuenta = $this->request->getVar('NoCuenta');
        $Nombre = $this->request->getVar('name');
        $area = $this->request->getVar('area');
        $dependencia = $this->request->getVar('depend');
        $contraseña = $this->request->getVar('new-account-password');

        $data = [
            $NoCuenta,
            $Nombre,
            $area,
            $contraseña,
            $dependencia,
        ];

        $resultado = $invitado->actualizarInvitado($data);

        if ($resultado) {
            $res = $invitado->ListarInvitados();
            echo json_encode($res->getResultArray());
        } else {
            echo json_encode(array("status" => "Error"));
        }
    }

    public function search_all()
    {
        $Valor1 = $this->request->getVar('Valor1');
        $Valor2 = $this->request->getVar('Valor2');
        $Valor3 = $this->request->getVar('Valor3');
        $Valor4 = $this->request->getVar('Valor4');

        $data = [
            $Valor1,
            $Valor2,
            $Valor3,
            $Valor4
        ];

        $invitado = new Invitado();
        $resultado = $invitado->searchAll($data);
        echo json_encode($resultado->getResultArray());
    }
}
