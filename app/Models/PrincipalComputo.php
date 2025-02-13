<?php

namespace App\Models;

use CodeIgniter\Model;

class PrincipalComputo extends Model
{
    protected $table      = 'Princiapl';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'NoCuenta';

    public function insertarRecord($data)
    {
        //return $this->db->query("CALL InsertarRecord(?, ?)", $data);
        return $this->db->query("INSERT INTO record_computo (NoCuenta, Asiento, Entrada, Salida)VALUES (?, ?, UNIX_TIMESTAMP(NOW()), '')", $data);
    }

    public function insertarAsiento($data)
    {
        return $this->db->query("INSERT INTO asientos_computo VALUES (?, ?)", $data);
    }
    public function actualizarRecord($data)
    {
        //return $this->db->query("call ActualizarRecord(?)", $data);
        return $this->db->query("UPDATE record_computo SET Salida = UNIX_TIMESTAMP(NOW()) WHERE Salida = '' AND NoCuenta = ?", $data);
    }
    public function ListarUsers($data)
    {
        return $this->db->query("SELECT
        u.NoCuenta,
        u.Nombre,
        u.area,
        IFNULL(p.cargo, IFNULL(ad.cargo, '')) AS Cargo,
        a.semestre,
        a.grupo,
        inv.dependencia,
        u.is_admin
    FROM
        user u
    LEFT JOIN
        alumno a ON a.NoCuenta = u.NoCuenta
    LEFT JOIN
        profesor p ON p.NoCuenta = u.NoCuenta
    LEFT JOIN
        administrativo ad ON ad.NoCuenta = u.NoCuenta
    LEFT JOIN
        invitado inv ON inv.NoCuenta = u.NoCuenta
    WHERE
        u.NoCuenta = ? AND u.is_admin=0", [$data])->getRowArray();
    }

    public function ListarAsiento($data)
    {
        return $this->db->query("SELECT * FROM asientos_computo WHERE Asiento=? AND NoCuenta=?", $data)->getRowArray();
    }

    public function ListarRecord()
    {
        return $this->db->query("SELECT Asiento FROM record_computo");
    }

    public function ListarAsientos()
    {
        return $this->db->query("SELECT * FROM asientos_computo");
    } 

    public function VerificarAsiento($cuenta)
    {
        return $this->db->query("SELECT a.NoCuenta,
                                    a.Asiento AS AsientoTablaAsientos,
                                    ac.Asiento AS AsientoTablaAsientosComputo
                                FROM asientos a
                                    LEFT JOIN asientos_computo ac ON a.NoCuenta = ac.NoCuenta
                                WHERE a.NoCuenta = ?
                                UNION
                                SELECT ac.NoCuenta,
                                    a.Asiento AS AsientoTablaAsientos,
                                    ac.Asiento AS AsientoTablaAsientosComputo
                                FROM asientos a
                                    RIGHT JOIN asientos_computo ac ON a.NoCuenta = ac.NoCuenta
                                WHERE ac.NoCuenta = ?", [$cuenta,$cuenta])->getRowArray();
    }

    public function VerificarBloqueos($cuenta)
    {
        return $this->db->query("SELECT * FROM blocked_user WHERE NoCuenta=?", [$cuenta])->getRowArray();
    }

    public function eliminarAsiento($data)
    {
        return $this->db->query("DELETE FROM asientos_computo WHERE Asiento=? AND NoCuenta=?", $data);
    }

    public function eliminarRecord($id)
    {
        return $this->db->query("DELETE FROM record_computo WHERE Asiento=?", [$id]);
    }

    public function obtenerDatosAlumno($NoCuenta)
    {
        return $this->db->query("SELECT u.NoCuenta, u.Nombre, u.area, a.semestre, a.grupo  FROM alumno a JOIN user u ON a.NoCuenta = u.NoCuenta WHERE a.NoCuenta = ? AND u.is_admin=0", [$NoCuenta])->getRowArray();
    }

    public function bloquearprincipal($data) {
        return $this->db->query("INSERT INTO blocked_user (NoCuenta, Motivo, FechaBloqueo, FechaDesbloqueo) VALUES (?, ?, UNIX_TIMESTAMP(NOW()), UNIX_TIMESTAMP(DATE_ADD(NOW(), INTERVAL 1 DAY)));", $data);
    }
    public function VelidarAll_Computos($data) {
        try {
            // Tu código que puede generar la excepción
            $this->db->query("INSERT INTO asientos_computo (NoCuenta, Asiento) VALUES (?, ?)", $data);
            return "agregado,";
        } catch (\mysqli_sql_exception $e) {
            // Captura la excepción y recupera solo el mensaje de error
            $error_message = $e->getMessage();
            return $error_message;
        }     
    }

    public function Validar2_Computo($data) {
        try {
            $this->db->query("CALL eliminar_asiento_repetido_computo(?,?,@s_mensaje)", $data);
            return $this->db->query("SELECT @s_mensaje AS mensaje")->getRowArray();
        } catch (\mysqli_sql_exception $e) {
            // Captura la excepción y recupera solo el mensaje de error
            $error_message = $e->getMessage();
            return $error_message;
        }
    }
}
