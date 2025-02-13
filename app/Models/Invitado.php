<?php

namespace App\Models;

use CodeIgniter\Model;

class Invitado extends Model
{
    protected $table      = 'invitado';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'NoCuenta';

    public function insertarInvitado($data)
    {
        return $this->db->query("CALL InsertarInvitado(?, ?, ?, ?, ?)", $data);
    }
    public function actualizarInvitado($data)
    {
        return $this->db->query("CALL ActualizarInvitado(?, ?, ?, ?, ?)", $data);
    }
    public function ListarInvitados()
    {
        return $this->db->query("SELECT * FROM user u INNER JOIN Invitado a ON u.NoCuenta = a.NoCuenta");
    }
    public function eliminarInvitado($NoCuenta)
    {
        return $this->db->query("CALL EliminarInvitado(?)", $NoCuenta);
    }
    public function obtenerDatosInvitado($NoCuenta)
    {
        return $this->db->query("SELECT * FROM Invitado a JOIN user u ON a.NoCuenta = u.NoCuenta WHERE a.NoCuenta = ?", [$NoCuenta])->getRowArray();
    }

    public function searchAll($data) {
        return $this->db->query("SELECT u.NoCuenta, u.Nombre, u.area, a.dependencia FROM Invitado a JOIN user u ON a.NoCuenta = u.NoCuenta WHERE a.NoCuenta LIKE ? OR u.Nombre LIKE ? OR u.area LIKE ? OR a.dependencia LIKE ?", $data);
    }
}
