<?php


namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Admin;
use Exception;

class ControllerAdmin extends Controller
{

    public function index(): string
    {
        $admin = new Admin();
        $resultado = $admin->ListarAdmin();
        $datos['admin'] = $resultado->getResultArray();
        $prueba["select"] = ["Administrador"];

        $datos['layout'] = view("layouts/layout", $prueba);
        $datos['layout_js'] = view("layouts/layout-js");

        return view('administrador', $datos);
    }

    public function add()
    {
        $admin = new Admin();

        $NoCuenta = $this->request->getVar('NoCuenta');
        $Nombre = $this->request->getVar('name');
        $contraseña = $this->request->getVar('new-account-password');

        $data = [
            $NoCuenta,
            $Nombre,
            $contraseña
        ];
        $resultado = $admin->insertarAdmin($data);

        if ($resultado) {
            $res = $admin->ListarAdmin();
            echo json_encode($res->getResultArray());
        } else {
            echo json_encode(array("status" => "Error control add"));
        }
    }

    
    public function obtener_admin($id)
    {
        $admin = new Admin();
        $resultado = $admin->obtenerDatosAdmin($id);
        echo json_encode($resultado);
    }

    public function eliminar_admin($id) {
        $admin = new Admin();
        $resultado = $admin->eliminarAdmin($id);
        if ($resultado) {
            $res = $admin->ListarAdmin();
            echo json_encode($res->getResultArray());
        } else {
            echo json_encode(array("status" => "Error controler elim"));
        }
        
    }

    public function actualizar_admin(){
        $admin = new Admin();

        $NoCuenta = $this->request->getVar('NoCuenta');
        $Nombre = $this->request->getVar('name');
        $contraseña = $this->request->getVar('new-account-password');

        $data = [
            $Nombre,
            $contraseña,
            $NoCuenta
        ];

        $resultado = $admin->actualizarAdmin($data);

        if ($resultado) {
            $res = $admin->ListarAdmin();
            echo json_encode($res->getResultArray());
        } else {
            echo json_encode(array("status" => "Error controler update"));
        }
    }

    public function search_all() {
        $Valor1 = $this->request->getVar('Valor1');
        $Valor2 = $this->request->getVar('Valor2');
        
        $data = [
            $Valor1,
            $Valor2
        ];

        $admin = new Admin();
        $resultado = $admin->searchAll($data);
        echo json_encode($resultado->getResultArray());
    }
}
