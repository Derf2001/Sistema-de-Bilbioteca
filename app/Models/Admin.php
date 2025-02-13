<?php

namespace App\Models;

use CodeIgniter\Model;

class Admin extends Model
{
    protected $table      = 'admin';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'NoCuenta';

    public function insertarAdmin($data)
    {
        return $this->db->query("INSERT INTO user(NoCuenta, Nombre, Contrasena, is_admin) VALUES (?,?,?,1)", $data);
    }
    public function actualizarAdmin($data)
    {
        return $this->db->query("UPDATE USER SET Nombre = ?, Contrasena = ? WHERE NoCuenta = ?", $data);
    }
    public function ListarAdmin()
    {
        return $this->db->query("SELECT NoCuenta, Nombre, Contrasena FROM user WHERE is_admin=1");
    }
    public function eliminarAdmin($NoCuenta)
    {
        return $this->db->query("DELETE FROM user WHERE NoCuenta = ?", [$NoCuenta]);
    }
    public function obtenerDatosAdmin($NoCuenta)
    {
        return $this->db->query("SELECT NoCuenta, Nombre, Contrasena FROM user WHERE NoCuenta = ?", [$NoCuenta])->getRowArray();
    }
    public function searchAll($data) {
        return $this->db->query("SELECT NoCuenta, Nombre, Contrasena FROM user WHERE (NoCuenta LIKE ? OR Nombre LIKE ?) AND is_admin=1", $data);
    }
}
