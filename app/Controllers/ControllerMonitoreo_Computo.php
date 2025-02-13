<?php

namespace App\Controllers;

use App\Models\Monitoreo;
use CodeIgniter\Controller;
use App\Models\Monitoreo_Computo;
use Exception;

class ControllerMonitoreo_Computo extends Controller
{
    public function index(): string
    {
        $monitoreo = new Monitoreo_Computo();
        $resultado = $monitoreo->Listar();
        // Convertir los resultados a un array para pasarlo a la vista
        $datos['monitoreo'] = $resultado->getResultArray();
        // Cargar la vista y pasar los datos
        $prueba["select"] = ["MonitoreoComputo"];

        $datos['layout'] = view("layouts/layout", $prueba);
        $datos['layout_js'] = view("layouts/layout-js");

        return view('Monitoreo2', $datos);
    }

    public function buscarRegistrosComputo()
    {

        $Columna =  $this->request->getVar('NombreColumna');
        $Valor =  $this->request->getVar('ValorColumna');

        $ConsultasUsuariosModel = new Monitoreo_Computo();
        $resultadoConsulta;

        switch ($Columna) {
            case "NoCuenta":
                $resultadoConsulta = $ConsultasUsuariosModel->obtenerNoCuenta($Valor);
                // $resultadoConsulta = $ConsultasUsuariosModel->Listar();
                break;

            case "Nombre":
                $resultadoConsulta = $ConsultasUsuariosModel->obtenerNombre($Valor);
                break;

            case "Area":
                $resultadoConsulta = $ConsultasUsuariosModel->obtenerArea($Valor);
                break;

            case "Cargo":
                $resultadoConsulta = $ConsultasUsuariosModel->obtenerCargo($Valor);
                break;

            case "Semestre":
                $resultadoConsulta = $ConsultasUsuariosModel->obtenerSemestre($Valor);
                break;
            case "Grupo":
                $resultadoConsulta = $ConsultasUsuariosModel->obtenerGrupo($Valor);
                break;
            case "Asiento":
                $resultadoConsulta = $ConsultasUsuariosModel->obtenerAsiento($Valor);
                break;
            case "Fecha":
                $comprobarBetween =  $this->request->getVar('Consulta2Fechas');
                $Valor2 = $this->request->getVar('SegundaFecha');
                if ($Valor2 != 0) {
                    $resultadoConsulta = $ConsultasUsuariosModel->obtenerFecha2($Valor, $Valor2);
                    // $resultadoConsulta = $ConsultasUsuariosModel->obtenerFecha($Valor);

                } else {
                    $fechaFormateada = date('Y-m-d', $Valor);
                    $resultadoConsulta = $ConsultasUsuariosModel->obtenerFecha($fechaFormateada);
                }
                break;
            case "Hora":
                date_default_timezone_set('America/Mexico_City');
                $horas = date("H", $Valor);
                $minutos = date("i", $Valor);

                // var_dump($horas, $minutos);

                $resultadoConsulta = $ConsultasUsuariosModel->obtenerHora($horas, $minutos);
                break;

            default:
                echo "Opción no válida";
                break;
        }
        if ($resultadoConsulta) {
            echo json_encode($resultadoConsulta->getResultArray());
        } else {
            echo json_encode(array("status" => "Error"));
        }
    }

    public function RGA2FechasComputo()
    {
        $Fecha1 =  $this->request->getVar('PrimeraFecha');
        $Fecha2 =  $this->request->getVar('SegundaFecha');

        $ConsultasUsuariosModel = new Monitoreo_Computo();
        $resultadoConsulta = $ConsultasUsuariosModel->RGA2F($Fecha1, $Fecha2);

        if ($resultadoConsulta) {
            echo json_encode($resultadoConsulta->getResultArray());
        } else {
            echo json_encode(array("status" => "Error"));
        }
    }
    public function RGAFechaComputo()
    {
        $Fecha1 =  $this->request->getVar('PrimeraFecha');
        $fechaFormateada = date('Y-m-d', $Fecha1);

        $ConsultasUsuariosModel = new Monitoreo_Computo();
        $resultadoConsulta = $ConsultasUsuariosModel->RGAF($fechaFormateada);

        if ($resultadoConsulta) {
            echo json_encode($resultadoConsulta->getResultArray());
        } else {
            echo json_encode(array("status" => "Error"));
        }
    }
    public function Borrar2FechasComputo()
    {
        $Fecha1 =  $this->request->getVar('PrimeraFecha');
        $Fecha2 =  $this->request->getVar('SegundaFecha');

        $ConsultasUsuariosModel = new Monitoreo_Computo();
        $resultadoConsulta = $ConsultasUsuariosModel->Borrar2F($Fecha1, $Fecha2);

        if ($resultadoConsulta) {
            $consultaDatosRegreso = new Monitoreo_Computo();
            $lista = $consultaDatosRegreso->Listar();

            echo json_encode($lista->getResultArray());
        } else {
            echo json_encode(array("status" => "Error"));
        }
    }

    public function Borrar1FechaComputo()
    {
        $Fecha1 =  $this->request->getVar('PrimeraFecha');
        $fechaFormateada = date('Y-m-d', $Fecha1);

        $ConsultasUsuariosModel = new Monitoreo_Computo();
        $resultadoConsulta = $ConsultasUsuariosModel->Borrar1F($fechaFormateada);

        if ($resultadoConsulta) {
            $consultaDatosRegreso = new Monitoreo_Computo();
            $lista = $consultaDatosRegreso->Listar();

            echo json_encode($lista->getResultArray());
        } else {
            echo json_encode(array("status" => "Error"));
        }
    }
    public function MostrarTodosComputo()
    {

        $consultaDatosRegreso = new Monitoreo_Computo();
        $lista = $consultaDatosRegreso->Listar();
        if ($lista) {
            echo json_encode($lista->getResultArray());
        } else {
            echo json_encode(array("status" => "Error"));
        }
    }

    function dropSala()
    {
        $monitoreo = new Monitoreo_Computo();
        $NoCuenta = $this->request->getPost('id');
        try {
            $resultado = $monitoreo->dropSala($NoCuenta);
            if ($resultado) {
                $conten = $monitoreo->Listar();
                return json_encode($conten->getResultArray());
            } else {
                return json_encode("Error al eliminar");
            }
        } catch (Exception $e) {
            return json_encode($e->getMessage());
        }
    }

    function busquedaSuper_recordComputo()
    {
        $monitoreo = new Monitoreo_Computo();
        $NoCuenta = $this->request->getPost('busqueda');
        try {
            $resultado = $monitoreo->buscadorPro($NoCuenta);
            if ($resultado) {
                return json_encode($resultado->getResultArray());
            } else {
                return json_encode("Error al buscar");
            }
        } catch (Exception $e) {
            return json_encode($e->getMessage());
        }
    }

    function ObtenerAsientos_hilo2()
    {
        $monitoreo = new Monitoreo_Computo();
        $size = $monitoreo->ObtenerAsientos_hilo();
        $list = $monitoreo->Listar();
        try {
            if ($size && $list) {
                $data = array(
                    "size" => $size->getResultArray(),
                    "list" => $list->getResultArray()
                );
                return json_encode($data);
            } else {
                return json_encode("Error al buscar");
            }
        } catch (Exception $e) {
            return json_encode($e->getMessage());
        }
    }
}
