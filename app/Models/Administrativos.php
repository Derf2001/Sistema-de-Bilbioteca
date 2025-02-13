<?php 

namespace App\Models;

use CodeIgniter\Model;
 
class Administrativos extends Model
{
    protected $table      = 'administrativo';
    protected $primaryKey = 'NoCuenta';
    protected $allowedFields = ['cargo'];
 
    public function insertarAdministrativo($data)
    {
        return $this->db->query("CALL InsertarAdministrativo(?, ?, ?, ?)", $data);
    }

    public function actualizarAdministrativo($data)
    {
        return $this->db->query("CALL ActualizarAdministrativo(?, ?, ?, ?)", $data);
    }

    public function ListarAdministrativos() 
    {
        return $this->db->query("SELECT a.NoCuenta, u.Nombre, u.area, a.cargo FROM administrativo a JOIN user u ON a.NoCuenta = u.NoCuenta order by CAST(u.NoCuenta as UNSIGNED) ASC");
    }

    public function eliminarAdministrativo($NoCuenta)
    {
        return $this->db->query("CALL EliminarAdministrativo(?)", [$NoCuenta]);
    }

    public function obtenerDatosAdministrativo($NoCuenta)
    {
        return $this->db->query("SELECT a.NoCuenta, u.Nombre, u.area, a.cargo FROM administrativo a JOIN user u ON a.NoCuenta = u.NoCuenta WHERE a.NoCuenta = ?", [$NoCuenta])->getRowArray();
    }
    public function busquedaSuperAd($busqueda)
    {
        return $this->db->query("SELECT u.NoCuenta, u.Nombre, u.area, a.cargo,
            CASE
                WHEN u.NoCuenta LIKE '$busqueda%'  THEN 'NoCuenta'
                WHEN u.Nombre LIKE '%$busqueda%'  THEN 'Nombre'
                WHEN u.area LIKE '$busqueda%'  THEN 'Área'
                WHEN a.cargo LIKE '$busqueda%'  THEN 'Cargo'
            ELSE 'Otro'
            END AS CampoConsulta
             FROM user u INNER JOIN administrativo a ON u.NoCuenta = a.NoCuenta 
             WHERE u.NoCuenta LIKE '$busqueda%' OR u.Nombre LIKE '%$busqueda%' OR u.area LIKE '$busqueda%' OR a.cargo LIKE '$busqueda%'");
    }
    public function verificar($noCuenta)
    {
        // Realiza la consulta para verificar si el número de cuenta ya está bloqueado
        return $this->db->query("SELECT *
        FROM user u
        LEFT JOIN administrativo a ON u.NoCuenta = a.NoCuenta
        LEFT JOIN alumno al ON u.NoCuenta = al.NoCuenta
        LEFT JOIN profesor p ON u.NoCuenta = p.NoCuenta
        WHERE u.NoCuenta = ?", $noCuenta);
    }
}
