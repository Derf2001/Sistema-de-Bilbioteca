<?php
/**/

namespace App\Models;

use CodeIgniter\Model;

class Monitoreo extends Model
{
    protected $table      = 'monitoreo';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'NoCuenta';

    public function Listar()
    {
        return $this->db->query("SELECT
        u.NoCuenta,
        IFNULL(u.Nombre,'') AS nombre_completo,
        IFNULL(u.area, '') AS area,
        IFNULL(p.cargo, IFNULL(ad.cargo, '')) AS cargo,
        IFNULL(a.semestre,'') AS semestre,
        IFNULL(a.grupo,'') AS grupo,
        IFNULL(r.asiento,'') AS asiento,
        DATE_FORMAT(FROM_UNIXTIME(r.entrada), '%d-%m-%Y') AS fecha,
        TIME(FROM_UNIXTIME(r.entrada, '%H:%i:%s' )) AS hora_entrada,
        IF(r.salida = '', '',  TIME(FROM_UNIXTIME(r.salida, '%H:%i:%s'))) AS hora_salida
    FROM record r
    LEFT JOIN alumno a ON a.NoCuenta = r.NoCuenta  
    LEFT JOIN invitado i ON i.NoCuenta = r.NoCuenta
    LEFT JOIN profesor p ON p.NoCuenta = r.NoCuenta
    LEFT JOIN administrativo ad ON ad.NoCuenta = r.NoCuenta
    LEFT JOIN user u ON u.NoCuenta = r.NoCuenta
    WHERE r.Salida = '' 
    ");
    }

    public function dropSala($NoCuenta)
    {
        return $this->db->query("CALL dropSala(?)", $NoCuenta);
    }

    public function buscadorPro($busqueda)
    {
        return $this->db->query("SELECT  u.NoCuenta,
        IFNULL(u.Nombre,'') AS nombre_completo,
        IFNULL(u.area, '') AS area,
        IFNULL(p.cargo, IFNULL(ad.cargo, '')) AS cargo,
        IFNULL(a.semestre,'') AS semestre,
        IFNULL(a.grupo,'') AS grupo,
        IFNULL(r.asiento,'') AS asiento,
        DATE_FORMAT(FROM_UNIXTIME(r.entrada), '%d-%m-%Y') AS fecha,
        TIME(FROM_UNIXTIME(r.entrada, '%H:%i:%s' )) AS hora_entrada,
        IF(r.salida = '', '',  TIME(FROM_UNIXTIME(r.salida, '%H:%i:%s'))) AS hora_salida
        FROM record r
        LEFT JOIN alumno a ON a.NoCuenta = r.NoCuenta  
        LEFT JOIN invitado i ON i.NoCuenta = r.NoCuenta
        LEFT JOIN profesor p ON p.NoCuenta = r.NoCuenta
        LEFT JOIN administrativo ad ON ad.NoCuenta = r.NoCuenta
        LEFT JOIN user u ON u.NoCuenta = r.NoCuenta
        WHERE (r.NoCuenta LIKE '$busqueda%' OR u.Nombre LIKE '%$busqueda%' OR u.area LIKE '%$busqueda%' 
        OR a.semestre LIKE '$busqueda%' OR a.grupo LIKE '$busqueda%' OR  r.asiento LIKE '$busqueda%'
        OR p.cargo LIKE '$busqueda%' OR  ad.cargo LIKE '$busqueda%')
        AND r.Salida = ''");
    }

    public function ObtenerAsientos_hilo()
    {
        return $this->db->query("SELECT COUNT(*) as size FROM asientos");
    }
}
