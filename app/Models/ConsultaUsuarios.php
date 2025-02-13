<?php 
namespace App\Models;

use CodeIgniter\Model;

class ConsultaUsuarios extends Model{
    protected $table      = 'record';
    protected $primaryKey = 'NoCuenta';
    protected $allowedFields = ['Nombre'];

    public function obtenerNoCuenta($NoCuenta)
    {
        return $this->db->query("SELECT u.NoCuenta AS Cuenta, u.Nombre AS Nombre , u.area as Área, IFNULL(p.cargo, IFNULL(ad.cargo, '')) AS Cargo, a.semestre as Semestre, a.grupo as Grupo, r.asiento AS Asiento, DATE_FORMAT(FROM_UNIXTIME(r.entrada), '%d-%m-%Y') AS Fecha ,TIME(FROM_UNIXTIME(r.entrada, '%H:%i:%s' )) AS Entrada, IF(r.salida = '', '', TIME(FROM_UNIXTIME(r.salida, '%H:%i:%s'))) AS Salida FROM record r LEFT JOIN alumno a ON a.NoCuenta = r.NoCuenta LEFT JOIN invitado i ON i.NoCuenta = r.NoCuenta LEFT JOIN profesor p ON p.NoCuenta = r.NoCuenta LEFT JOIN administrativo ad ON ad.NoCuenta = r.NoCuenta LEFT JOIN user u ON u.NoCuenta = r.NoCuenta where $NoCuenta  r.salida != '';");
    }
    public function obtenerNombre($NoCuenta)
    {
        return $this->db->query("SELECT u.Nombre AS Nombre ,u.NoCuenta AS Cuenta, u.area as Área, IFNULL(p.cargo, IFNULL(ad.cargo, '')) AS Cargo, a.semestre as Semestre, a.grupo as Grupo, r.asiento AS Asiento,  DATE_FORMAT(FROM_UNIXTIME(r.entrada), '%d-%m-%Y') AS Fecha ,TIME(FROM_UNIXTIME(r.entrada, '%H:%i:%s' )) AS Entrada, IF(r.salida = '', '', TIME(FROM_UNIXTIME(r.salida, '%H:%i:%s'))) AS Salida FROM record r LEFT JOIN alumno a ON a.NoCuenta = r.NoCuenta LEFT JOIN invitado i ON i.NoCuenta = r.NoCuenta LEFT JOIN profesor p ON p.NoCuenta = r.NoCuenta LEFT JOIN administrativo ad ON ad.NoCuenta = r.NoCuenta LEFT JOIN user u ON u.NoCuenta = r.NoCuenta where  $NoCuenta   r.salida != '';");
    }
    public function obtenerArea($NoCuenta)
    {
        return $this->db->query("SELECT  u.area as Área, u.NoCuenta AS Cuenta, u.Nombre AS Nombre ,IFNULL(p.cargo, IFNULL(ad.cargo, '')) AS Cargo, a.semestre as Semestre, a.grupo as Grupo, r.asiento AS Asiento, DATE_FORMAT(FROM_UNIXTIME(r.entrada), '%d-%m-%Y') AS Fecha , TIME(FROM_UNIXTIME(r.entrada, '%H:%i:%s' )) AS Entrada, IF(r.salida = '', '', TIME(FROM_UNIXTIME(r.salida, '%H:%i:%s'))) AS Salida FROM record r LEFT JOIN alumno a ON a.NoCuenta = r.NoCuenta LEFT JOIN invitado i ON i.NoCuenta = r.NoCuenta LEFT JOIN profesor p ON p.NoCuenta = r.NoCuenta LEFT JOIN administrativo ad ON ad.NoCuenta = r.NoCuenta LEFT JOIN user u ON u.NoCuenta = r.NoCuenta where  $NoCuenta r.salida != '';", '%'.$NoCuenta.'%');
    }

    public function obtenerCargo($NoCuenta)
    {
        return $this->db->query("SELECT IFNULL(p.cargo, IFNULL(ad.cargo, '')) AS Cargo, u.NoCuenta AS Cuenta,u.Nombre AS Nombre , u.area as Área,  a.semestre as Semestre, a.grupo as Grupo, r.asiento AS Asiento,  DATE_FORMAT(FROM_UNIXTIME(r.entrada), '%d-%m-%Y') AS Fecha ,TIME(FROM_UNIXTIME(r.entrada, '%H:%i:%s' )) AS Entrada, IF(r.salida = '', '', TIME(FROM_UNIXTIME(r.salida, '%H:%i:%s'))) AS Salida FROM record r LEFT JOIN alumno a ON a.NoCuenta = r.NoCuenta LEFT JOIN invitado i ON i.NoCuenta = r.NoCuenta LEFT JOIN profesor p ON p.NoCuenta = r.NoCuenta LEFT JOIN administrativo ad ON ad.NoCuenta = r.NoCuenta LEFT JOIN user u ON u.NoCuenta = r.NoCuenta where  $NoCuenta  r.salida != '';", $NoCuenta.'%');
    }

    public function obtenerSemestre($NoCuenta)
    {
        return $this->db->query("SELECT a.semestre as Semestre,u.NoCuenta AS Cuenta, u.Nombre AS Nombre ,u.area as Área, IFNULL(p.cargo, IFNULL(ad.cargo, '')) AS Cargo,  a.grupo as Grupo, r.asiento AS Asiento,  DATE_FORMAT(FROM_UNIXTIME(r.entrada), '%d-%m-%Y') AS Fecha ,TIME(FROM_UNIXTIME(r.entrada, '%H:%i:%s' )) AS Entrada, IF(r.salida = '', '', TIME(FROM_UNIXTIME(r.salida, '%H:%i:%s'))) AS Salida FROM record r LEFT JOIN alumno a ON a.NoCuenta = r.NoCuenta LEFT JOIN invitado i ON i.NoCuenta = r.NoCuenta LEFT JOIN profesor p ON p.NoCuenta = r.NoCuenta LEFT JOIN administrativo ad ON ad.NoCuenta = r.NoCuenta LEFT JOIN user u ON u.NoCuenta = r.NoCuenta where  $NoCuenta  r.salida != '';", $NoCuenta.'%');
    }
    public function obtenerGrupo($NoCuenta)
    {
        return $this->db->query("SELECT  a.grupo as Grupo,u.NoCuenta AS Cuenta,u.Nombre AS Nombre , u.area as Área, IFNULL(p.cargo, IFNULL(ad.cargo, '')) AS Cargo, a.semestre as Semestre, r.asiento AS Asiento,  DATE_FORMAT(FROM_UNIXTIME(r.entrada), '%d-%m-%Y') AS Fecha ,TIME(FROM_UNIXTIME(r.entrada, '%H:%i:%s' )) AS Entrada, IF(r.salida = '', '', TIME(FROM_UNIXTIME(r.salida, '%H:%i:%s'))) AS Salida FROM record r LEFT JOIN alumno a ON a.NoCuenta = r.NoCuenta LEFT JOIN invitado i ON i.NoCuenta = r.NoCuenta LEFT JOIN profesor p ON p.NoCuenta = r.NoCuenta LEFT JOIN administrativo ad ON ad.NoCuenta = r.NoCuenta LEFT JOIN user u ON u.NoCuenta = r.NoCuenta where  $NoCuenta  r.salida != '';", $NoCuenta.'%');
    }
    public function obtenerAsiento($NoCuenta)
    {
        return $this->db->query("SELECT r.asiento AS Asiento, u.NoCuenta AS Cuenta,u.Nombre AS Nombre , u.area as Área, IFNULL(p.cargo, IFNULL(ad.cargo, '')) AS Cargo, a.semestre as Semestre, a.grupo as Grupo,  DATE_FORMAT(FROM_UNIXTIME(r.entrada), '%d-%m-%Y') AS Fecha ,TIME(FROM_UNIXTIME(r.entrada, '%H:%i:%s' )) AS Entrada, IF(r.salida = '', '', TIME(FROM_UNIXTIME(r.salida, '%H:%i:%s'))) AS Salida FROM record r LEFT JOIN alumno a ON a.NoCuenta = r.NoCuenta LEFT JOIN invitado i ON i.NoCuenta = r.NoCuenta LEFT JOIN profesor p ON p.NoCuenta = r.NoCuenta LEFT JOIN administrativo ad ON ad.NoCuenta = r.NoCuenta LEFT JOIN user u ON u.NoCuenta = r.NoCuenta where  $NoCuenta  r.salida != '';", $NoCuenta.'%');
    }

    public function obtenerFecha2($fecha1,$fecha2)
    {
        return $this->db->query("SELECT  DATE_FORMAT(FROM_UNIXTIME(r.entrada), '%d-%m-%Y') AS Fecha ,u.NoCuenta AS Cuenta, u.Nombre AS Nombre , u.area as Área, IFNULL(p.cargo, IFNULL(ad.cargo, '')) AS Cargo, a.semestre as Semestre, a.grupo as Grupo, r.asiento AS Asiento, TIME(FROM_UNIXTIME(r.entrada, '%H:%i:%s' )) AS Entrada,IF(r.salida = '', '', TIME(FROM_UNIXTIME(r.salida, '%H:%i:%s'))) AS Salida FROM record r LEFT JOIN alumno a ON a.NoCuenta = r.NoCuenta LEFT JOIN invitado i ON i.NoCuenta = r.NoCuenta LEFT JOIN profesor p ON p.NoCuenta = r.NoCuenta LEFT JOIN administrativo ad ON ad.NoCuenta = r.NoCuenta LEFT JOIN user u ON u.NoCuenta = r.NoCuenta where r.entrada between  ? and ? AND r.salida != '';",  array($fecha1, $fecha2));
    }
    public function obtenerFecha($NoCuenta)
    {
        return $this->db->query("SELECT  DATE_FORMAT(FROM_UNIXTIME(r.entrada), '%d-%m-%Y') AS Fecha , u.NoCuenta AS Cuenta, u.Nombre AS Nombre, u.area AS Área, IFNULL(p.cargo, IFNULL(ad.cargo, '')) AS Cargo, a.semestre AS Semestre, a.grupo AS Grupo, r.asiento AS Asiento, TIME(FROM_UNIXTIME(r.entrada, '%H:%i:%s' )) AS Entrada,IF(r.salida = '', '', TIME(FROM_UNIXTIME(r.salida, '%H:%i:%s'))) AS Salida FROM record r LEFT JOIN alumno a ON a.NoCuenta = r.NoCuenta LEFT JOIN invitado i ON i.NoCuenta = r.NoCuenta LEFT JOIN profesor p ON p.NoCuenta = r.NoCuenta LEFT JOIN administrativo ad ON ad.NoCuenta = r.NoCuenta LEFT JOIN user u ON u.NoCuenta = r.NoCuenta where DATE(FROM_UNIXTIME(r.entrada)) = ? AND r.salida != '';", $NoCuenta);
    }
    public function obtenerHora($horas,$minutos)
    {
        return $this->db->query("SELECT TIME(FROM_UNIXTIME(r.entrada, '%H:%i:%s' )) AS Entrada, u.area as Área, u.Nombre AS Nombre ,u.NoCuenta AS Cuenta, IFNULL(p.cargo, IFNULL(ad.cargo, '')) AS Cargo, a.semestre as Semestre, a.grupo as Grupo, r.asiento AS Asiento, DATE_FORMAT(FROM_UNIXTIME(r.entrada), '%d-%m-%Y') AS Fecha , IF(r.salida = '', '', TIME(FROM_UNIXTIME(r.salida, '%H:%i:%s'))) AS Salida FROM record r LEFT JOIN alumno a ON a.NoCuenta = r.NoCuenta LEFT JOIN invitado i ON i.NoCuenta = r.NoCuenta LEFT JOIN profesor p ON p.NoCuenta = r.NoCuenta LEFT JOIN administrativo ad ON ad.NoCuenta = r.NoCuenta LEFT JOIN user u ON u.NoCuenta = r.NoCuenta
           WHERE HOUR(FROM_UNIXTIME(r.entrada)) = ?  AND r.salida != '';", array($horas));
    }
    public function RGA2F($fecha1,$fecha2)
    {
        return $this->db->query("SELECT u.NoCuenta AS Cuenta, u.Nombre AS Nombre, u.area as Área,IFNULL(p.cargo, IFNULL(ad.cargo, '')) AS Cargo, a.semestre as Semestre, a.grupo as Grupo, r.asiento AS Asiento, DATE_FORMAT(FROM_UNIXTIME(r.entrada), '%d-%m-%Y') AS Fecha , TIME(FROM_UNIXTIME(r.entrada, '%H:%i:%s' )) AS Entrada, IF(r.salida = '', '', TIME(FROM_UNIXTIME(r.salida, '%H:%i:%s'))) AS Salida FROM record r LEFT JOIN alumno a ON a.NoCuenta = r.NoCuenta LEFT JOIN invitado i ON i.NoCuenta = r.NoCuenta LEFT JOIN profesor p ON p.NoCuenta = r.NoCuenta LEFT JOIN administrativo ad ON ad.NoCuenta = r.NoCuenta LEFT JOIN user u ON u.NoCuenta = r.NoCuenta where r.entrada between  ? and ?  AND r.salida != '';",  array($fecha1, $fecha2));
    }
    public function RGAF($fecha1)
    {
        return $this->db->query("SELECT u.NoCuenta AS Cuenta, u.Nombre AS Nombre , u.area as Área, IFNULL(p.cargo, IFNULL(ad.cargo, '')) AS Cargo, a.semestre as Semestre, a.grupo as Grupo, r.asiento AS Asiento, DATE_FORMAT(FROM_UNIXTIME(r.entrada), '%d-%m-%Y') AS Fecha , TIME(FROM_UNIXTIME(r.entrada, '%H:%i:%s' )) AS Entrada, IF(r.salida = '', '', TIME(FROM_UNIXTIME(r.salida, '%H:%i:%s'))) AS Salida FROM record r LEFT JOIN alumno a ON a.NoCuenta = r.NoCuenta LEFT JOIN invitado i ON i.NoCuenta = r.NoCuenta LEFT JOIN profesor p ON p.NoCuenta = r.NoCuenta LEFT JOIN administrativo ad ON ad.NoCuenta = r.NoCuenta LEFT JOIN user u ON u.NoCuenta = r.NoCuenta WHERE DATE(FROM_UNIXTIME(Entrada)) =  ? AND r.salida != '';", $fecha1);
    }
    public function Borrar2F($fecha1,$fecha2)
    {
      return $this->db->query("DELETE FROM record WHERE Entrada BETWEEN ? AND ? AND salida != '';", array($fecha1, $fecha2));
    }
    public function Borrar1F($fecha1)
    {
      return $this->db->query("DELETE FROM record WHERE DATE(FROM_UNIXTIME(Entrada))  = ? AND salida != '';", $fecha1);
    }

}