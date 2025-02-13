<?php

namespace App\Models;

use CodeIgniter\Model;

class Alumno extends Model
{
    protected $table = 'alumno';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'NoCuenta';
    protected $allowedFields = ['cargo'];

    public function insertarAlumno($data)
    {
        return $this->db->query("CALL InsertarAlumno(?, ?, ?, ?, ?, ?)", $data);
    }
    public function actualizarAlumno($data)
    {
        return $this->db->query("CALL ActualizarAlumno(?, ?, ?, ?, ?, ?)", $data);
    }
    public function ListarAlumnos()
    {
        return $this->db->query("SELECT u.NoCuenta, u.Nombre, u.area, a.semestre, a.grupo FROM user u INNER JOIN Alumno a ON u.NoCuenta = a.NoCuenta");
    }
    public function eliminarAlumno($NoCuenta)
    {
        return $this->db->query("CALL EliminarAlumno(?)", [$NoCuenta]);
    }
    public function obtenerDatosAlumno($NoCuenta)
    {
        return $this->db->query("SELECT u.NoCuenta, u.Nombre, u.area, a.semestre, a.grupo FROM alumno a JOIN user u ON a.NoCuenta = u.NoCuenta WHERE a.NoCuenta = ?", [$NoCuenta])->getRowArray();
    }
    public function busquedaSuper($busqueda)
    {
        return $this->db->query("SELECT u.NoCuenta, u.Nombre, u.area, a.semestre, a.grupo,
            CASE
                WHEN u.NoCuenta LIKE '$busqueda%'  THEN 'NoCuenta'
                WHEN u.Nombre LIKE '%$busqueda%'  THEN 'Nombre'
                WHEN u.area LIKE '$busqueda%'  THEN 'Área'
                WHEN a.semestre LIKE '$busqueda%'  THEN 'Semestre'
                WHEN a.grupo LIKE '$busqueda%'  THEN 'Grupo'
            ELSE 'Otro'
            END AS CampoConsulta
             FROM user u INNER JOIN Alumno a ON u.NoCuenta = a.NoCuenta 
             WHERE u.NoCuenta LIKE '%$busqueda%' OR u.Nombre LIKE '%$busqueda%' OR u.area LIKE '%$busqueda%' OR a.semestre LIKE '$busqueda%' OR a.grupo LIKE '$busqueda%'");
    }

    public function validarUsuario($NoCuenta)
    {
        return $this->db->query("SELECT * FROM user WHERE NoCuenta = ?", [$NoCuenta])->getResultArray();
    }
}
