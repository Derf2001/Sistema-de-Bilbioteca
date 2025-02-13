<?php


namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Administrativos;
use Exception;

class ControllerAdministrativo extends Controller
{

    public function index(): string
    {
        $admin = new Administrativos();
        $resultado = $admin->ListarAdministrativos();
        $datos['administ'] = $resultado->getResultArray();
        $prueba["select"] = ["Administrativos"];

        $datos['layout'] = view("layouts/layout", $prueba);
        $datos['layout_js'] = view("layouts/layout-js");

        return view('administrativo', $datos);
    }
    public function Consulta(): string
    {
        $admin = new Administrativos();
        $resultado = $admin->ListarAdministrativos();
        $datos['administ'] = $resultado->getResultArray();
        $prueba["select"] = ["Administrativos"];

        $datos['layout'] = view("layouts/layout", $prueba);
        $datos['layout_js'] = view("layouts/layout-js");

        return view('pruebamiranda', $datos);
    }
    public function add()
    {
        try {
            $administrativo = new Administrativos();

            $NoCuenta = $this->request->getVar('NoCuenta');
            $Nombre = $this->request->getVar('Name');
            $area = $this->request->getVar('Area');
            $cargo = $this->request->getVar('Cargo');

            $data = [
                $NoCuenta,
                $Nombre,
                $area,
                $cargo,

            ];
 
            $resultado = $administrativo->insertarAdministrativo($data);

            if ($resultado) {
                $res = $administrativo->ListarAdministrativos();
                echo json_encode($res->getResultArray());
            } else {
                echo json_encode(array("status" => "Error"));
            }
        } catch (Exception $e) {
            echo json_encode(array("status" => "Error"));
        }
    }

    public function obtener_administrativo($id)
    {
        $administrativo = new Administrativos();
        $resultado = $administrativo->obtenerDatosAdministrativo($id);
        echo json_encode($resultado);
    }

    public function eliminar_administrativo($id)
    {
        $administrativo = new Administrativos();
        $resultado = $administrativo->eliminarAdministrativo($id);
        if ($resultado) {
            $res = $administrativo->ListarAdministrativos();
            echo json_encode($res->getResultArray());
        } else {
            echo json_encode(array("status" => "Error"));
        }
    }

    public function actualizar_administrativo()
    {
        $administrativo = new Administrativos();

        $NoCuenta = $this->request->getVar('NoCuenta');
        $Nombre = $this->request->getVar('Name');
        $area = $this->request->getVar('Area');
        $cargo = $this->request->getVar('Cargo');

        $data = [
            $NoCuenta,
            $Nombre,
            $area,
            $cargo,
        ];
        $resultado = $administrativo->actualizarAdministrativo($data);

        if ($resultado) {
            $res = $administrativo->ListarAdministrativos();
            echo json_encode($res->getResultArray());
        } else {
            echo json_encode(array("status" => "Error"));
        }
    }
    public function busquedaSuperAd()
    {
        $administrativo = new Administrativos();
        $busqueda = $this->request->getVar('busqueda');
        $resultado = $administrativo->busquedaSuperAd($busqueda);
        if ($resultado) {
            echo json_encode($resultado->getResultArray());
        } else {
            $res = $administrativo->ListarAdministrativos();
            echo json_encode($res->getResultArray());
        }
    }
    public function VerificarAdministrativo()
    {
        $Cuenta = $this->request->getVar('NoCuenta');

        try {

            $ConsultasUsuariosModel = new Administrativos();
            $resultadoConsulta = $ConsultasUsuariosModel->verificar($Cuenta);

            if ($resultadoConsulta) {
                echo json_encode($resultadoConsulta->getResultArray());
            } else {
                echo json_encode(array("status" => "Error", "message" => "No se encontraron registros"));
            }
        } catch (Exception $e) {
            echo json_encode(array("status" => "Error", "message" => $e->getMessage()));
        }
    }
}
