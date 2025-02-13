<?php 
namespace App\Models;

use CodeIgniter\Model;

class Profesores extends Model{
    protected $table      = 'profesor';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'NoCuenta';
    protected $allowedFields = ['cargo'];


    public function insertarProfesor($data)
    {
        return $this->db->query("CALL InsertarProfesor(?, ?, ?, ?, ?)", $data);
    }
    public function actualizarProfesor($data)
    {
        return $this->db->query("CALL ActualizarProfesor(?, ?, ?, ?, ?)", $data);
    }
    public function ListarProfesores()
    {
        return $this->db->query("SELECT u.NoCuenta, u.Nombre, u.area, p.cargo FROM User u JOIN Profesor p ON u.NoCuenta = p.NoCuenta order by CAST(u.NoCuenta as UNSIGNED) ASC;");
    }
    public function BuscarIndividualProfesor($nombre)
    {
        return $this->db->query("SELECT u.NoCuenta, u.Nombre, u.area, p.cargo 
        FROM User u 
        JOIN Profesor p ON u.NoCuenta = p.NoCuenta 
        WHERE u.Nombre LIKE '%$nombre%' 
           OR u.NoCuenta LIKE '%$nombre%' 
           OR u.area LIKE '%$nombre%' 
           OR p.cargo LIKE '%$nombre%';"
        );
    }
    public function eliminarProfesor($NoCuenta)
    {
        return $this->db->query("CALL EliminarProfesor(?)", [$NoCuenta]);
    }
    public function obtenerDatosProfesor($NoCuenta)
    {
        return $this->db->query("SELECT p.NoCuenta, u.Nombre,u.area, p.cargo, u.Contrasena, u.Is_Admin FROM profesor p JOIN user u ON p.NoCuenta = u.NoCuenta WHERE p.NoCuenta like ?", '%'.$NoCuenta);
    }
    
}