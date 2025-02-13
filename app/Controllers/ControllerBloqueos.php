<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Bloqueos;
use Exception;

class ControllerBloqueos extends Controller
{
    public function index(): string
    {
        $bloqueo = new Bloqueos();
        $resultado = $bloqueo->ListarBloqueos();
        $datos['bloqueos'] = $resultado->getResultArray();
        // Cargar la vista y pasar los datos
        $prueba["select"] = ["Bloqueos"];

        $datos['layout'] = view("layouts/layout", $prueba);
        $datos['layout_js'] = view("layouts/layout-js");

        return view('bloqueos', $datos);
    }
    public function desbloquearxDia()
    {
        $bloqueo = new Bloqueos();
        $resultado = $bloqueo->desbloquearxDia();
    
        if ($resultado) {
            $res = $bloqueo->ListarBloqueos();
            return json_encode($res->getResultArray());
        } else {
            return json_encode(array("status" => "Error"));
        }
    }

    
    function Bloquear()
    {
        $bloqueo = new Bloqueos();
        $NoCuenta = $this->request->getVar('NoCuenta');
        $motivo = $this->request->getVar('Motivo');
        $fechaDesbloqueo = $this->request->getVar('FechaDesbloqueo');
        $data = [
            $NoCuenta,
            $motivo,
            $fechaDesbloqueo
        ];
        $resultado = $bloqueo->Bloquear($data);
        if ($resultado) {
            $res = $bloqueo->ListarBloqueos();
            echo json_encode($res->getResultArray());
        } else {
            echo json_encode(array("status" => "Error"));
        }
    }

    public function desbloquear($id)
    {
        $bloqueo = new Bloqueos();
        $resultado = $bloqueo->Desbloquear($id);
        if ($resultado) {
            $res = $bloqueo->ListarBloqueos();
            echo json_encode($res->getResultArray());
        } else {
            echo json_encode(array("status" => "Error"));
        }
    }
    public function buscarRegistros()
    {
        $Cuenta = $this->request->getVar('NoCuenta');

        try {
            //echo ("Numero de cuenta" +  $Cuenta);

            $ConsultasUsuariosModel = new Bloqueos();
            $resultadoConsulta = $ConsultasUsuariosModel->obtenerNoCuenta($Cuenta);

            if ($resultadoConsulta) {
                echo json_encode($resultadoConsulta->getResultArray());
            } else {
                echo json_encode(array("status" => "Error", "message" => "No se encontraron registros"));
            }
        } catch (Exception $e) {
            echo json_encode(array("status" => "Error", "message" => $e->getMessage()));
        } 
    }
    // Controlador
    public function VerificarBloqueo()
    {
        $Cuenta = $this->request->getVar('NoCuenta');

        try {
            //echo ("Numero de cuenta" +  $Cuenta);

            $ConsultasUsuariosModel = new Bloqueos();
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
    public function busquedaSuperBlo()
    {
        $bloqueoModel = new Bloqueos(); // Asegúrate de cargar el modelo adecuado aquí
        $busqueda = $this->request->getVar('busqueda');
        $resultado = $bloqueoModel->busquedaSuperBlo($busqueda);
        if ($resultado) {
            echo json_encode($resultado->getResultArray());
        } else {
            $res = $bloqueoModel->ListarBloqueos(); // Cambia esto a tu método para listar los bloqueos
            echo json_encode($res->getResultArray());
        }
    }
    
}
