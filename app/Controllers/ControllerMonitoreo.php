<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Monitoreo;
use Exception;

class ControllerMonitoreo extends Controller
{
    public function index(): string
    {
        $monitoreo = new Monitoreo();
        $resultado = $monitoreo->Listar();
        // Convertir los resultados a un array para pasarlo a la vista
        $datos['monitoreo'] = $resultado->getResultArray();
        // Cargar la vista y pasar los datos
        $prueba["select"] = ["Monitoreo"];

        $datos['layout'] = view("layouts/layout", $prueba);
        $datos['layout_js'] = view("layouts/layout-js");

        return view('Monitoreo', $datos);
    }

    function dropSala(){
        $monitoreo = new Monitoreo();
        $NoCuenta = $this->request->getPost('id');
        try {
            $resultado = $monitoreo->dropSala($NoCuenta);
            if ($resultado){
                $conten = $monitoreo->Listar();
                return json_encode($conten->getResultArray());
            }else{
                return json_encode("Error al eliminar");
            }
        } catch (Exception $e) {
            return json_encode($e->getMessage());
        }
    }
    function busquedaSuper_record(){
        $monitoreo = new Monitoreo();
        $NoCuenta = $this->request->getPost('busqueda');
        try {
            $resultado = $monitoreo->buscadorPro($NoCuenta);
            if ($resultado){
                return json_encode($resultado->getResultArray());
            }else{
                return json_encode("Error al buscar");
            }
        } catch (Exception $e) {
            return json_encode($e->getMessage());
        }
    }

    function ObtenerAsientos_hilo(){
        $monitoreo = new Monitoreo();
        $size = $monitoreo->ObtenerAsientos_hilo();
        $list = $monitoreo->Listar();
        try {
            if ($size && $list){
                $data = array(
                    "size" => $size->getResultArray(),
                    "list" => $list->getResultArray()
                );
                return json_encode($data);
            }else{
                return json_encode("Error al buscar");
            }
            
        } catch (Exception $e) {
            return json_encode($e->getMessage());
        }
    }
}  