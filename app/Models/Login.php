<?php

namespace App\Models;

use CodeIgniter\Model;

class Login extends Model
{
    protected $table      = 'Login';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'NoCuenta';

    public function insertarRecord($data)
    {
        return $this->db->query("CALL InsertarRecord(?, ?, ?)", $data);
    }
    public function actualizarInvitado($data)
    {
        return $this->db->query("CALL ActualizarInvitado(?, ?, ?, ?, ?, ?, ?)", $data);
    }
    public function ListarInvitados()
    {
        return $this->db->query("SELECT u.NoCuenta, u.Nombre, u.area, a.dependencia FROM user u INNER JOIN Invitado a ON u.NoCuenta = a.NoCuenta");
    }

    public function ListarRecord() {
        return $this->db->query("SELECT Asiento FROM record");
    }
    public function eliminarRecord($id)
    {
        return $this->db->query("DELETE FROM record WHERE Asiento=?", [$id]);
    }

    public function obtenerDatosAlumno($NoCuenta)
    {
        return $this->db->query("SELECT u.NoCuenta, u.Nombre, u.area, a.semestre, a.grupo  FROM alumno a JOIN user u ON a.NoCuenta = u.NoCuenta WHERE a.NoCuenta = ?", [$NoCuenta])->getRowArray();
    }

    public function obtenerAdminLogin($name, $pass) {
        return $this->db->query("CALL ConsultarUsuario(1, ?, ?)", array($name, $pass))->getRowArray();
    }
     
}
