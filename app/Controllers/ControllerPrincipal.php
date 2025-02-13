<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Principal;
use Exception;

class ControllerPrincipal extends Controller
{
    public function index(): string
    {
        $principal = new Principal();
        $resultado = $principal->ListarRecord();
        // Convertir los resultados a un array para pasarlo a la vista
        $datos['Principal'] = $resultado->getResultArray();
        // Cargar la vista y pasar los datos
        $prueba["select"] = ["Principal"];

        $datos['layout'] = view("layouts/layout", $prueba);
        $datos['layout_js'] = view("layouts/layout-js");

        return view('Principal', $datos);
    }
    public function add()
    {
        $principal = new Principal();

        $NoCuenta = $this->request->getVar('NoCuenta');
        $Asiento = $this->request->getVar('asiento');

        $data = [
            $NoCuenta,
            $Asiento
        ];
        $resultado = $principal->insertarAsiento($data);

        if ($resultado) {
            echo json_encode(array("status" => "Ok"));
        } else {
            echo json_encode(array("status" => "Error"));
        }
    }

    public function add2()
    {
        $principal = new Principal();

        $NoCuenta = $this->request->getVar('NoCuenta');
        $Asiento = $this->request->getVar('asiento');

        $data = [
            $NoCuenta,
            $Asiento
        ];
        $resultado = $principal->insertarRecord($data);

        if ($resultado) {
            echo json_encode(array("status" => "Ok"));
        } else {
            echo json_encode(array("status" => "Error"));
        }
    }

    public function listar_asientos()
    {
        try {
            $principal = new Principal();
            $resultado = $principal->ListarAsientos();
            $ocupados = [];
            // while ($row = $resultado->fetch_assoc()) {
            //     $ocupados[] = $row['Asiento'];
            // }

            echo json_encode($resultado->getResultArray());
        } catch (Exception $e) {
            // Manejar la excepción (por ejemplo, loggearla, mostrar un mensaje de error, etc.)
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function verificar_asiento($cuenta)
    {
        try {
            $principal = new Principal();
            $resultado = $principal->VerificarAsiento($cuenta);
            $result = $principal->VerificarBloqueos($cuenta);
            if($result)
                echo json_encode("bloquedo");
            else
            if (!$resultado){
                echo json_encode($resultado);
            }else {
                echo json_encode($resultado);
            }
        } catch (Exception $e) {
            // Manejar la excepción (por ejemplo, loggearla, mostrar un mensaje de error, etc.)
            echo json_encode(array("status" => "error"));
        }
    }

    public function obtener_alumno($id)
    {
        $principal = new Invitado();
        $resultado = $principal->obtenerDatosAlumno($id);
        echo json_encode($resultado);
    }

    public function elimregistro()
    {
        $NoCuenta = $this->request->getVar('NoCuenta');
        $Asiento = $this->request->getVar('asiento');

        $data = [
            $Asiento,
            $NoCuenta
        ];
        //echo $data;
        $principal = new Principal();
        $resultado = $principal->ListarAsiento($data);
        if ($resultado) {
            $principal->eliminarAsiento($data);
            echo json_encode($resultado);
        } else {
            echo json_encode(array("status" => "Error"));
        }
    }

    public function actualizar_record()
    {
        $principal = new Principal();
        $NoCuenta = $this->request->getVar('NoCuenta');
        $data = [
            $NoCuenta,
        ];
        $resultado = $principal->actualizarRecord($data);
        if ($resultado) {
            echo json_encode(array("status" => $NoCuenta));
        } else {
            echo json_encode(array("status" => "Error"));
        }
    }



    public function obtener_users($id)
    {
        $principal = new Principal();
        $resultado = $principal->ListarUsers($id);
        if ($resultado) {
            echo json_encode($resultado);
        } else {
            echo json_encode(array("status" => "Error"));
        }
    }

    public function bloquearPrincipal() {
        $principal = new Principal();
        $NoCuenta = $this->request->getVar('NoCuenta');
        $motivo = $this->request->getVar('Motivo');
        $data = [
            $NoCuenta,
            $motivo
        ];
        $resultado = $principal->bloquearprincipal($data);
        if ($resultado) {
            echo json_encode(array("status" => "Ok"));
        } else {
            echo json_encode(array("status" => "Error"));
        }
    }

        public function ValidarAll($NoCuenta, $Asiento) {
        $principal = new Principal();
        $data = [
            $NoCuenta,
            $Asiento
        ];

        $resultado = $principal->ValidarAll($data);
       
        echo json_encode(array("mensaje" => $resultado));
    }

    public function Validar2($NoCuenta, $Asiento) {
        $principal = new Principal();
        $data = [
            $NoCuenta,
            $Asiento
        ];

        $resultado = $principal->Validar2($data);
        echo json_encode($resultado);
    }
    public function obtener_asiento($Asiento, $NoCuenta)
    {
        $data = [
            $Asiento,
            $NoCuenta
        ];
        $principal = new Principal();
        $resultado = $principal->ListarAsiento($data);
        if ($resultado) {
            echo json_encode($resultado);
        } else {
            echo json_encode(array("status" => "Error"));
        }
    }
}
