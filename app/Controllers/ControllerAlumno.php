<?php

namespace App\Controllers;
 
use CodeIgniter\Controller;
use App\Models\Alumno;
use Exception;

class ControllerAlumno extends Controller
{
    public function index(): string
    {
        $alumno = new Alumno();
        $resultado = $alumno->ListarAlumnos();
        $datos['alumnos'] = $resultado->getResultArray();
        // Cargar la vista y pasar los datos
        $prueba["select"] = ["Alumnos"];

        $datos['layout'] = view("layouts/layout", $prueba);
        $datos['layout_js'] = view("layouts/layout-js");

        return view('alumnos', $datos);
    }
    public function add()
    {
        $alumno = new Alumno();

        $NoCuenta = $this->request->getVar('NoCuenta');
        $Nombre = $this->request->getVar('Name');
        $area = $this->request->getVar('Area');
        $semestre = $this->request->getVar('Semestre');
        $group = $this->request->getVar('Grupo');
        $contraseña = $this->request->getVar('Pass');

        $data = [
            $NoCuenta,
            $Nombre,
            $area,
            $contraseña,
            $semestre,
            $group,
           
        ];

        
        $resultado = $alumno->insertarAlumno($data);

        if ($resultado) {
            $res = $alumno->ListarAlumnos();
            echo json_encode($res->getResultArray());
        } else {
            echo json_encode(array("status" => "Error"));
        }
    }

    public function obtener_alumno($id)
    {
        $alumno = new Alumno();
        $resultado = $alumno->obtenerDatosAlumno($id);
        echo json_encode($resultado);
    }

    public function eliminar_alumno($id) {
        $alumno = new Alumno();
        $resultado = $alumno->eliminarAlumno($id);
        if ($resultado) {
            $res = $alumno->ListarAlumnos();
            echo json_encode($res->getResultArray());
        } else {
            echo json_encode(array("status" => "Error"));
        }
        
    }

    public function actualizar_alumno(){
        $alumno = new Alumno();

        $NoCuenta = $this->request->getVar('NoCuenta');
        $Nombre = $this->request->getVar('Name');
        $area = $this->request->getVar('Area');
        $semestre = $this->request->getVar('Semestre');
        $group = $this->request->getVar('Grupo');
        $contraseña = $this->request->getVar('Pass');

        $data = [
            $NoCuenta,
            $Nombre,
            $area,
            $contraseña,
            $semestre,
            $group,
           
        ];


        $resultado = $alumno->actualizarAlumno($data);

        if ($resultado) {
            $res = $alumno->ListarAlumnos();
            echo json_encode($res->getResultArray());
        } else {
            echo json_encode(array("status" => "Error"));
        }
    }
    public function busquedaSuper(){
        $alumno = new Alumno();
        $busqueda = $this->request->getVar('busqueda');
        $resultado = $alumno->busquedaSuper($busqueda);
        if ($resultado) {
            echo json_encode($resultado->getResultArray());
        } else {
            $res = $alumno->ListarAlumnos();
            echo json_encode($res->getResultArray());
        }
    }

    public function validarUsuario(){
        $alumno = new Alumno();
        $NoCuenta = $this->request->getVar('NoCuenta');
        $resultado = $alumno->validarUsuario($NoCuenta);
        echo json_encode($resultado);
    }
}