<?php

namespace App\Models;

use CodeIgniter\Model;

class Bloqueos extends Model
{
    protected $table      = 'blocked_user';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'idBlocked';
    protected $allowedFields = ['NoCuenta'];

    public function Bloquear($data)
    {
        return $this->db->query("CALL Bloquear(?, ?, ?)", $data);
    }

    public function ListarBloqueos()
    {
        return $this->db->query("SELECT
        bu.idBlocked,
        bu.NoCuenta,
        u.Nombre,
        u.area,
        IFNULL(p.cargo, IFNULL(ad.cargo, '')) AS Cargo,
        a.semestre,
        a.grupo,
        bu.motivo,
        DATE(FROM_UNIXTIME(bu.FechaBloqueo)) as FechaBloqueo,
        DATE(FROM_UNIXTIME(bu.FechaDesbloqueo)) as FechaDesbloqueo
    FROM
        blocked_user bu
    LEFT JOIN
        user u ON bu.NoCuenta = u.NoCuenta
    LEFT JOIN
        alumno a ON a.NoCuenta = u.NoCuenta
    LEFT JOIN
        profesor p ON p.NoCuenta = u.NoCuenta
    LEFT JOIN
        administrativo ad ON ad.NoCuenta = u.NoCuenta");
    }



    public function desbloquear($NoCuenta)
    {
        return $this->db->query("CALL Desbloquear(?)", [$NoCuenta]);
    }
    public function obtenerDatosBloqueo($NoCuenta)
    {
        return $this->db->query("SELECT a.NoCuenta, 
        u.Nombre, 
        u.area, 
        u.semestre, 
        u.grupo, 
        DATE(FROM_UNIXTIME(a.FechaBloqueo)) as FechaBloqueo,
        DATE(FROM_UNIXTIME(a.FechaDesbloqueo)) as FechaDesbloqueo
        FROM blocked_user a 
        JOIN Alumno u ON a.NoCuenta = u.NoCuenta 
        WHERE a.NoCuenta = ?", [$NoCuenta])->getRowArray();
    }


    public function obtenerNoCuenta($NoCuenta)
    {
        return $this->db->query("SELECT
        u.NoCuenta,
        u.Nombre,
        u.area,
        IFNULL(p.cargo, IFNULL(ad.cargo, '')) AS Cargo,
        a.semestre,
        a.grupo
    FROM
        user u
    LEFT JOIN
        alumno a ON a.NoCuenta = u.NoCuenta
    LEFT JOIN
        profesor p ON p.NoCuenta = u.NoCuenta
    LEFT JOIN
        administrativo ad ON ad.NoCuenta = u.NoCuenta
    WHERE
        u.NoCuenta = ?", $NoCuenta);
    }


    // Modelo (Bloqueos)
    public function verificar($noCuenta)
    {
        // Realiza la consulta para verificar si el número de cuenta ya está bloqueado
        return $this->db->query("SELECT * FROM blocked_user WHERE NoCuenta = ?", $noCuenta);
    }
    public function busquedaSuperBlo($busqueda)
{
    return $this->db->query("SELECT
            b.idBlocked,
            u.NoCuenta,
            u.Nombre,
            u.area,
            IFNULL(p.cargo, IFNULL(ad.cargo, '')) AS Cargo,
            a.semestre,
            a.grupo,
            b.motivo,
            DATE(FROM_UNIXTIME(b.FechaBloqueo)) as FechaBloqueo,
            DATE(FROM_UNIXTIME(b.FechaDesbloqueo)) as FechaDesbloqueo
        FROM
            blocked_user b
        LEFT JOIN
            user u ON u.NoCuenta = b.NoCuenta
        LEFT JOIN
            alumno a ON a.NoCuenta = u.NoCuenta
        LEFT JOIN
            profesor p ON p.NoCuenta = u.NoCuenta
        LEFT JOIN
            administrativo ad ON ad.NoCuenta = u.NoCuenta
        WHERE
            b.idBlocked LIKE '$busqueda%' OR
            u.NoCuenta LIKE '$busqueda%' OR 
            u.Nombre LIKE '%$busqueda%' OR 
            u.area LIKE '%$busqueda%' OR 
            a.semestre LIKE '$busqueda%' OR 
            a.grupo LIKE '$busqueda%' OR 
            IFNULL(p.cargo, IFNULL(ad.cargo, '')) LIKE '$busqueda%' OR 
            b.motivo LIKE '$busqueda%' OR 
            b.FechaBloqueo LIKE '$busqueda%' OR 
            b.FechaDesbloqueo LIKE '$busqueda%'");
}
 
   /* public function desbloquearxDia()
    {
        $this->db->query("DELETE FROM blocked_user WHERE idBlocked > 0 AND ((Motivo = '3 ingresos seguidos' AND FROM_UNIXTIME(FechaDesbloqueo) <= NOW())OR (DATE(FROM_UNIXTIME(fechaBloqueo)) != CURDATE() AND DATE(FROM_UNIXTIME(FechaDesbloqueo)) <= CURDATE()))");
    }*/
public function desbloquearxDia()
{
    $this->db->query("DELETE FROM blocked_user WHERE idBlocked > 0 AND ((Motivo = '3 ingresos seguidos' AND FROM_UNIXTIME(FechaDesbloqueo) <= NOW()) OR (DATE(FROM_UNIXTIME(fechaBloqueo)) != CURDATE() AND DATE(FROM_UNIXTIME(FechaDesbloqueo)) <= CURDATE()))");

    // Obtener la lista actualizada de usuarios bloqueados después de desbloquear
    $res = $this->ListarBloqueos();
    echo json_encode($res->getResultArray());
}
}
