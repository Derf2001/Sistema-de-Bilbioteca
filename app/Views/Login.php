<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="<?= base_url('css/styles3.css') ?>">
    <link href="<?= base_url('assets/css/fontawesome.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/brands.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/solid.css') ?>" rel="stylesheet">
</head>

<body>
    <a href="<?= base_url('Principal') ?>" class='back2'><i class="fa-solid fa-circle-left back"></i></a>
    <div class="modal show" id="myModal">
        <div class="modal-content">
            <h2>Iniciar sesión</h2>
            <p id="tagUsername">Usuario</p>
            <input type="text" id="username" placeholder="Ingrese su usuario"><br>
            <p id="tagPass">Contraseña</p>
            <div class="password-container">
                <input type="password" id="password" placeholder="Ingrese su contraseña">
                <button id="togglePassword" onclick="togglePasswordVisibility()">
                    <i class="fas fa-eye" id="eye-icon"></i>
                </button>
            </div>
            <button onclick="iniciar()">Iniciar</button>
        </div>
    </div>

    <section class="cont">
        <div class="admin-table">
            <div class="tenue">
            </div>
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
                <h2>¡Bienvenido!</h2>
            </div>
        </section>
        <div class="sidebarRight">
            <div class="sidebar3">
                <img src="<?= base_url('img/logo2.png') ?>" alt="Imagen de la barra lateral derecha">
            </div>

        </div>
    </section>

</body>
<script src="<?= base_url('js/sweetalert2@11.js') ?>"></script>
<script src="<?= base_url('js/jquery.min.js') ?>"></script>
<script>
    document.getElementById("password").addEventListener("keypress", function(event) {
        if (event.key === "Enter") {
            event.preventDefault(); // Evita el envío del formulario por defecto
            iniciar(); // Llama a la función de inicio de sesión
            // Borra el contenido del campo de contraseña
            document.getElementById("password").value = "";
        }
    });


    // Función para ejecutar acciones al aceptar en el modal (puedes personalizar según tus necesidades)
    function iniciar() {
        const name = document.getElementById("username").value;
        const pass = document.getElementById("password").value;

        if (name.trim() === '' || pass.trim() === '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Por favor, ingrese el nombre de usuario y la contraseña.',
            });
            return;
        }

        buscarAdmin(name, pass);
    }

    function togglePasswordVisibility() {
        const passwordInput = document.getElementById("password");
        const eyeIcon = document.getElementById("eye-icon");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            eyeIcon.classList.remove("fa-eye");
            eyeIcon.classList.add("fa-eye-slash");
        } else {
            passwordInput.type = "password";
            eyeIcon.classList.remove("fa-eye-slash");
            eyeIcon.classList.add("fa-eye");
        }
    }
</script>
<script>
    function redirigirAlDashboard() {
        // Obtener la cadena de consulta de la URL
        var queryString = window.location.search;

        // Obtener un objeto con los parámetros de la cadena de consulta
        var urlParams = new URLSearchParams(queryString);

        // Obtener el valor del parámetro llamado "parametro"
        var parametro = urlParams.get('parametro');

        // Verificar el valor del parámetro y redirigir en consecuencia
        if (parametro == 0) {
            window.location.href = "<?= base_url('Administradores') ?>";
        } else {
            window.location.href = "<?= base_url('Monitoreo') ?>";
        }
    }

    function buscarAdmin(name, pass) {
        xml = new XMLHttpRequest();
        xml.open('POST', '/Bib/public/ObtenerAdminLogin', true);
        xml.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        const params = 'name=' + encodeURIComponent(name) + '&pass=' + encodeURIComponent(pass);
        xml.send(params);
        xml.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var datos = JSON.parse(this.responseText);
                console.log(datos);
                if (datos != null) {
                    console.log(datos.NoCuenta);
                    Swal.fire({
                        icon: 'success',
                        title: '¡Bienvenido!',
                        text: 'Iniciando sesión...',
                        timer: 2000,
                        showConfirmButton: false,
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading()
                            setTimeout(() => {
                                redirigirAlDashboard();
                            }, 2000)
                        }
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Usuario o contraseña incorrectos',
                    })
                }

            }
        }
        // Borra el contenido del campo de contraseña
        document.getElementById("password").value = "";
        document.getElementById("username").value = "";
    }
</script>

</html>

<!--
    ******** Agregar esto a la BD ***********

    CREATE DEFINER=`root`@`localhost` PROCEDURE `ConsultarUsuario` (IN `p_IdAdmin` INT, IN `p_Nombre` VARCHAR(255), IN `p_Contrasena` VARCHAR(255))
BEGIN
    SELECT *
    FROM USER
    WHERE is_admin = p_IdAdmin
      AND Nombre = p_Nombre
      AND Contrasena = p_Contrasena;
END$$
-->