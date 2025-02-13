<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\PrincipalComputo;
use Exception;

class ControllerPrincipalComputo extends Controller
{
    public function index(): string
    {
        $principal = new PrincipalComputo();
        $resultado = $principal->ListarRecord();
        // Convertir los resultados a un array para pasarlo a la vista
        $datos['Computo'] = $resultado->getResultArray();
        // Cargar la vista y pasar los datos
        $prueba["select"] = ["Computo"];

        $datos['layout'] = view("layouts/layout", $prueba);
        $datos['layout_js'] = view("layouts/layout-js");

        return view('Computo', $datos);
    }
    public function add()
    {
        $principal = new PrincipalComputo();

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
        $principal = new PrincipalComputo();

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
            $principal = new PrincipalComputo();
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
            $principal = new PrincipalComputo();
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
            echo json_encode(array("status" => "Error control add"));
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
        $principal = new PrincipalComputo();
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
        $principal = new PrincipalComputo();
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


    public function obtener_asiento($Asiento, $NoCuenta)
    {
        $data = [
            $Asiento,
            $NoCuenta
        ];
        $principal = new PrincipalComputo();
        $resultado = $principal->ListarAsiento($data);
        if ($resultado) {
            echo json_encode($resultado);
        } else {
            echo json_encode(array("status" => "Error"));
        }
    }

    public function obtener_users($id)
    {
        $principal = new PrincipalComputo();
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
    function VelidarAll_Computos($NoCuenta, $Asiento){
        $principal = new PrincipalComputo();
        $data = [
            $NoCuenta,
            $Asiento
        ];

        $resultado = $principal->VelidarAll_Computos($data);
       
        echo json_encode(array("mensaje" => $resultado));
    }

    function Validar2_Computo($NoCuenta, $Asiento){
        $principal = new PrincipalComputo();
        $data = [
            $NoCuenta,
            $Asiento
        ];

        $resultado = $principal->Validar2_Computo($data);
       
        echo json_encode( $resultado);
    }
}