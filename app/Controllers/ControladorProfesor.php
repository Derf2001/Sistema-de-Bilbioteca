<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Profesores;

class ControladorProfesor extends Controller
{
    public function index(): string
    {
        $profesor = new Profesores();
        $resultado = $profesor->ListarProfesores();

        // Convertir los resultados a un array para pasarlo a la vista
        $datos['profesores'] = $resultado->getResultArray();
        // Cargar la vista y pasar los datos
        $prueba["select"] = ["ProfesorInvestigador"];

        $datos['layout'] = view("layouts/layout", $prueba);
        $datos['layout_js'] = view("layouts/layout-js");

        return view('Profesores', $datos);
    }
    public function obtener_Profesor($id)
    {
        $profesor = new Profesores();
        $resultado = $profesor->obtenerDatosProfesor($id);
        echo json_encode($resultado->getResultArray());
    }

    public function actualizar()
    {

        $profesor = new  Profesores();

        $NoCuenta = $this->request->getVar('NoCuenta');
        $Nombre = $this->request->getVar('Nombre');
        $Area = $this->request->getVar('Area');
        $Contrasena = $this->request->getVar('Contrasena');
        $Cargo = $this->request->getVar('Cargo');

        $data = [
            $NoCuenta,
            $Nombre,
            $Area,
            $Contrasena,
            $Cargo,
        ];

        $resultado = $profesor->actualizarProfesor($data);

        if ($resultado) {
            $res = $profesor->ListarProfesores();
            echo json_encode($res->getResultArray());
        } else {
            echo json_encode(array("status" => "Error"));
        }
    }
    public function eliminar_profesor($id)
    {
        $profesor = new  Profesores();
        $resultado = $profesor->eliminarProfesor($id);
        
        if ($resultado) {
            $res = $profesor->ListarProfesores();
            echo json_encode($res->getResultArray());
        } else {
            echo json_encode(array("status" => "Error"));
        }
    }
    public function addProfesor()
    {
        $profesorModel = new Profesores();
        $NoCuenta = $this->request->getVar('NoCuenta');
        $Nombre = $this->request->getVar('Nombre');
        $Area = $this->request->getVar('Area');
        $Contrasena = $this->request->getVar('Contrasena');
        $Cargo = $this->request->getVar('Cargo');

        $data = [
            $NoCuenta,
            $Nombre,
            $Area,
            $Contrasena,
            $Cargo,
        ];

        try {
            $resultado = $profesorModel->insertarProfesor($data);
    
            if ($resultado) {
                $res = $profesorModel->ListarProfesores();
                echo json_encode($res->getResultArray());
            } else {
                echo json_encode(array("status" => "Error"));
            }
        } catch (\Exception $e) {
            // Verificar si la excepción es sobre violación de clave primaria
            if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
                echo json_encode(array("status" => "Error", "message" => "La clave primaria ya existe en la base de datos"));
            } else {
                echo json_encode(array("status" => "Error", "message" => $e->getMessage()));
            }
        }
    }
    public function BuscarProfesorNombres()
    {
 
        $Nombre = $this->request->getVar('Nombre');
       

        $profesorModel = new Profesores();
        $resultado = $profesorModel->BuscarIndividualProfesor($Nombre);

        if ($resultado) {
            // $res = $profesorModel->ListarProfesores();
            echo json_encode($resultado->getResultArray());
            // echo json_encode(array("status" => "OK"));
        } else {
            echo json_encode(array("status" => "Error"));
        }
    }
}
