<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ConsultaUsuarios;
use App\Models\Monitoreo;

class Busquedas extends Controller{

    public function buscarRegistros(){

        $Columna =  $this->request->getVar('NombreColumna');
        $Valor =  $this->request->getVar('ValorColumna');
        $condiciones = $this->request->getVar('Condiciones');

        
        $ConsultasUsuariosModel = new ConsultaUsuarios();
        $resultadoConsulta="";

        switch ($Columna) {
            case "NoCuenta":
                // echo("entra NoCuenta");
                $resultadoConsulta = $ConsultasUsuariosModel->obtenerNoCuenta($condiciones);
                break;
            
            case "Nombre":
                $resultadoConsulta = $ConsultasUsuariosModel->obtenerNombre($condiciones);
                break;
            
            case "Area":
                $resultadoConsulta = $ConsultasUsuariosModel->obtenerArea($condiciones);
                break;

            case "Cargo":
                $resultadoConsulta = $ConsultasUsuariosModel->obtenerCargo($condiciones);
                break;
            
            case "Semestre":
                $resultadoConsulta = $ConsultasUsuariosModel->obtenerSemestre($condiciones);
                break;
            case "Grupo":
                $resultadoConsulta = $ConsultasUsuariosModel->obtenerGrupo($condiciones);
                break;
            case "Asiento":
                $resultadoConsulta = $ConsultasUsuariosModel->obtenerAsiento($condiciones);
                break;
            case "Fecha":
                $comprobarBetween =  $this->request->getVar('Consulta2Fechas');
                $Valor2 = $this->request->getVar('SegundaFecha');
                if($Valor2 != 0){
                    $resultadoConsulta = $ConsultasUsuariosModel->obtenerFecha2($Valor, $Valor2);
                    // $resultadoConsulta = $ConsultasUsuariosModel->obtenerFecha($Valor);

                }else{
                    $fechaFormateada = date('Y-m-d', $Valor);
                    $resultadoConsulta = $ConsultasUsuariosModel->obtenerFecha($fechaFormateada);
                }
                break;
            case "Hora":
                date_default_timezone_set('America/Mexico_City');
                $horas = date("H", $Valor);
                $minutos = date("i", $Valor);

                // var_dump($horas, $minutos);

                $resultadoConsulta = $ConsultasUsuariosModel->obtenerHora($horas,$minutos);
                break;
        
            default:
                echo "Opción no válida";
                break;
        }
        if($resultadoConsulta){
            echo json_encode($resultadoConsulta->getResultArray());
        }else{
            echo json_encode(array("status" => "Error"));
        }
        // echo ($Columna." valor: ". $Valor);
    }

    public function RGA2Fechas(){
        $Fecha1 =  $this->request->getVar('PrimeraFecha');
        $Fecha2 =  $this->request->getVar('SegundaFecha');

        $ConsultasUsuariosModel = new ConsultaUsuarios();
        $resultadoConsulta = $ConsultasUsuariosModel->RGA2F($Fecha1,$Fecha2);

        if($resultadoConsulta){
            echo json_encode($resultadoConsulta->getResultArray());
        }else{
            echo json_encode(array("status" => "Error"));
        }
    }
    public function RGAFecha(){
        $Fecha1 =  $this->request->getVar('PrimeraFecha');
        $fechaFormateada = date('Y-m-d', $Fecha1);

        $ConsultasUsuariosModel = new ConsultaUsuarios();
        $resultadoConsulta = $ConsultasUsuariosModel->RGAF($fechaFormateada);

        if($resultadoConsulta){
            echo json_encode($resultadoConsulta->getResultArray());
        }else{
            echo json_encode(array("status" => "Error"));
        }
    }
    public function Borrar2Fechas(){
        $Fecha1 =  $this->request->getVar('PrimeraFecha');
        $Fecha2 =  $this->request->getVar('SegundaFecha');

        $ConsultasUsuariosModel = new ConsultaUsuarios();
        $resultadoConsulta = $ConsultasUsuariosModel->Borrar2F($Fecha1,$Fecha2);

        if($resultadoConsulta){
            $consultaDatosRegreso = new Monitoreo();
            $lista = $consultaDatosRegreso->Listar();

            echo json_encode($lista->getResultArray());
        }else{
            echo json_encode(array("status" => "Error"));
        }
    }

    public function Borrar1Fecha(){
        $Fecha1 =  $this->request->getVar('PrimeraFecha');
        $fechaFormateada = date('Y-m-d', $Fecha1);

        $ConsultasUsuariosModel = new ConsultaUsuarios();
        $resultadoConsulta = $ConsultasUsuariosModel->Borrar1F($fechaFormateada);

        if($resultadoConsulta){
            $consultaDatosRegreso = new Monitoreo();
            $lista = $consultaDatosRegreso->Listar();

            echo json_encode($lista->getResultArray());
        }else{
            echo json_encode(array("status" => "Error"));
        }
    }
    public function MostrarTodos(){
       
        $consultaDatosRegreso = new Monitoreo();
        $lista = $consultaDatosRegreso->Listar();
        if($lista){
            echo json_encode($lista->getResultArray());
        }else{
            echo json_encode(array("status" => "Error"));
        }
    }
}