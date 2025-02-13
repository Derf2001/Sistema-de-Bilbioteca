<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créditos</title>
    <link rel="stylesheet" href="<?= base_url('css/styles4.css') ?>">
    <link href="<?= base_url('assets/css/fontawesome.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/brands.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/solid.css') ?>" rel="stylesheet">
</head>

<body>
    <a href="<?= base_url('Principal') ?>" class='back2'><i class="fa-solid fa-circle-left back"></i></a>
    <div class="modal show" id="myModal">
        <div class="modal-content">
            <div class="message">
                <a>"Detrás de cada función, hay horas de esfuerzo, lineas de código y un equipo comprometido. Agradecemos tu participación en esta aventura digital. ¡Que disfrutes de cada clic!"</a>
            </div>
            <div class="columns">
                <div class="column">
                    <p>PROGRAMADORES</p>
                    <a href="#" class="uss" onclick="mostrarInfo('Juan Diego Ramos Gómez', 'juandig52@gmail.com', '@itsjuandig')">Juan Diego Ramos Gómez</a><br>
                    <a href="#" class="uss" onclick="mostrarInfo('Josué Velázquez López', 'josuevl100@gmail.com', '@josue_bbx')">Josué Velázquez López</a><br>
                    <a href="#" class="uss" onclick="mostrarInfo('Daniel Efrén Rojas Flores', 'efren.20011002@gmail.com', '@derf_2001')">Daniel Efrén Rojas Flores</a><br>
                    <a href="#" class="uss" onclick="mostrarInfo('Miranda Cruz Madariaga', 'mirandamraz03@gmail.com', '@miranda_mraz')">Miranda Cruz Madariaga</a>

                    <br><br>
                    <a>Universidad del Istmo, Campus Ixtepec<br>Noveno Semestre de la Licenciatura en Informática</a>
                </div>
                <div class="column">
                    <p>COORDINADORES</p>
                    <a>L.B. Edi Ruth López Sánchez<br>Jefa del Departamento de Biblioteca<br>Universidad del Istmo, Campus Juchitán</a><br><br>
                    <a>M.C.C. Luis David Huerta Hernández<!--<br>Jefe de Carrera, Licenciatura en Informática--><br>Universidad del Istmo, Campus Ixtepec</a>
                </div>
            </div>
        </div>
    </div>

    <section class="cont">
        <div class="admin-table">

            <img src="<?= base_url('img/Fondo.jpg') ?>" alt="">
        </div>
        <div class="sidebarLeft">
            <div class="sidebar2">
                <!-- Contenido del sidebar aquí -->
                <img src="<?= base_url('img/logo.png') ?>" alt="Imagen de la barra lateral izquierda">
            </div>
        </div>
        <section class="cont2">
            <div class="tabla-header">
                <h2>¡Créditos!</h2>

            </div>
        </section>
        <div class="sidebarRight">
            <div class="sidebar3">
                <img src="<?= base_url('img/logo2.png') ?>" alt="Imagen de la barra lateral derecha">
            </div>

        </div>
        <div class="tenue">
        </div>
    </section>

</body>
<script src="<?= base_url('js/sweetalert2@11.js') ?>"></script>

</html>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    function mostrarInfo(nombre, correo, instagram) {
        const iconoInstagram = '<img src="img/instagram-icon.png" alt="Instagram" style="width: 20px; height: 20px; margin-right: 5px;">';
        
        Swal.fire({
            title: nombre,
            html: `
                <p>Correo electrónico: ${correo}</p>
                <p>${iconoInstagram} Instagram: ${instagram}</p>
            `,
            confirmButtonText: 'OK'
        });
    }
</script>