<?php
date_default_timezone_set('America/Mexico_City');
$session = \Config\Services::session();
// Iniciar la sesión
$session->start();

// Verificar si existe un dato en la sesión
if (!$session->has('sesion')) {
    echo "<script>window.location.href ='" . base_url('Principal') . "'; </script>";
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="<?= base_url('css/styles.css') ?>" media="screen">
    <link href="<?= base_url('assets/css/fontawesome.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/brands.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/solid.css') ?>" rel="stylesheet">
</head>

<body>
    <section class="cont">
        <div class="sidebar">
            <!-- Contenido del sidebar aquí -->
            <img src="<?= base_url('img/logo.png') ?>" alt="Imagen de la barra lateral">
            <p>
                <a class="<?php echo $select[0] == 'Administrador' ? 'select' : ''; ?>" href="<?= base_url('Administradores') ?>">
                    <span class="icon-box">
                        <i class="fas fa-user"></i>
                    </span>
                    <strong>Administrador</strong>
                </a>
            </p>

            <p>
                <a class="<?php echo $select[0] == 'Monitoreo' ? 'select' : ''; ?>" href="<?= base_url("Monitoreo") ?>">
                    <span class="icon-box">
                        <i class="fas fa-chart-bar"></i>
                    </span>
                    <strong>Monitoreo sala de estudios</strong>
                </a>
            </p>
            <p>
                <a class="<?php echo $select[0] == 'MonitoreoComputo' ? 'select' : ''; ?>" href="<?= base_url("MonitoreoComputo") ?>">
                    <span class="icon-box">
                        <i class="fa-solid fa-computer"></i>
                    </span>
                    <strong>Monitoreo computadoras</strong>
                </a>
            </p>

            <p>
                <a class="<?php echo $select[0] == 'Bloqueos' ? 'select' : ''; ?>" href="Bloqueos">
                    <span class="icon-box">
                        <i class="fas fa-lock"></i>
                    </span>
                    <strong>Suspensión</strong>
                </a>
            </p>
            <h2>Usuarios</h2>

            <p>
                <a class="<?php echo $select[0] == 'Alumnos' ? 'select' : ''; ?>" href="<?= base_url('Alumnos') ?>">
                    <span class="icon-box">
                        <i class="fas fa-user-graduate"></i>
                    </span>
                    <strong>Alumnos</strong>
                </a>
            </p>

            <p>
                <a class="<?php echo $select[0] == 'ProfesorInvestigador' ? 'select' : ''; ?>" href="<?= base_url('Profesores') ?>" href="#">
                    <span class="icon-box">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </span>
                    <strong>Profesor Investigador</strong>
                </a>
            </p>

            <p>
                <a class="<?php echo $select[0] == 'Administrativos' ? 'select' : ''; ?>" href="<?= base_url('Administrativos') ?>">
                    <span class="icon-box">
                        <i class="fas fa-users-cog"></i>
                    </span>
                    <strong>Administrativos</strong>
                </a>
            </p>

            <p>
                <a class="<?php echo $select[0] == 'Invitados' ? 'select' : ''; ?>" href="<?= base_url('Invitados') ?>">
                    <span class="icon-box">
                        <i class="fas fa-user-friends"></i>
                    </span>
                    <strong>Invitados</strong>
                </a>
            </p>
            <div class="bottom-option" onclick="cerrarSesion()">
                <p><a style="cursor:pointer;"><span class="icon-box"><i class="fas fa-sign-out-alt"></i></span><strong>Salir</strong></a></p>
            </div>
        </div>