<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISTEMA AUTOMATIZADO PARA EL REGISTRO A LA SALA DE ESTUDIOS</title>
    <link rel="stylesheet" href="<?= base_url('css/styles2.css') ?>">
</head>

<body>

    <div class="modal" id="myModal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Cuenta</h2>
            <p id="seatNumber2"></p>
            <p id="colorSeat"></p>
            <p id="cuentaAux"></p>
            <input type="text" id="inputSeat" placeholder="Ingrese cuenta" oninput="validateNoCuenta(this)"
                oncontextmenu="return false;"><br>
            <button onclick="accept()">Aceptar</button>
            <button onclick="closeModal()">Cancelar</button>
        </div>
    </div>

    <div class="modal3" id="myModal3">
        <div class="modal-content3">
            <p id="seatNumber3"></p>
            <span class="close3" onclick="closeModal3()">&times;</span>
            <h2>¿Salir?</h2>
            <button onclick="accept3()">Aceptar</button>
            <button onclick="closeModal3()">Cancelar</button>
        </div>
    </div>

    <div class="modal2" id="myModal2">
        <div class="modal-content2">
            <span class="close2" onclick="closeModal2()">&times;</span>
            <h2>Datos generales</h2>
            <div class="rectangle" id="rectangle">
                <p>Nombre:</p>
                <p id="Nombre" style="text-decoration: underline;"></p><br>
                <p>Cuenta:</p>
                <p id="NCuenta" style="text-decoration: underline;"></p><br>
                <p>Área:</p>
                <p id="Area" style="text-decoration: underline;"></p><br>
                <p>Semestre:</p>
                <p id="Semestre" style="text-decoration: underline;"></p><br>
                <p>Computadora:</p>
                <p id="seatNumber" style="text-decoration: underline;"></p><br>
            </div>
            <button onclick="accept2()">Aceptar</button>
            <button onclick="closeModal2()">Cancelar</button>
        </div>
    </div>

    <section class="cont">
        <div class="puerta">
            <img src="<?= base_url('img/Puerta Doble.png') ?>" alt="Imagen del centro">
        </div>
        <div class="SimbolosC">
            <div class="SimbolosC2"><img src="<?= base_url('img/DisponibleC.png') ?>" alt="Monitor">
                <p>Disponible</p>
            </div>
            <div class="SimbolosC2"><img src="<?= base_url('img/OcupadoC.png') ?>" alt="Admin">
                <p>Ocupado</p>
            </div>

        </div>
        <div class="admin-table">
            <div class="Compus2" id="Compus2">

                <?php
                for ($i = 1; $i < 7; $i++) {
                    /* if ($i > 2) {
                        echo '<div class="Compus">';
                        echo '<span class="compu-label">C-' . $i . '</span>';
                        echo '<img src="' . base_url('img/OcupadoC.png') . '" alt="1" id="C-' . $i . '" class="rotar disable-animation" onclick="opciones(\'C-' . 0 . '\')" disabled style="opacity: 0.5; cursor: not-allowed; ">';
                        echo '</div>';
                    } else {*/
                    echo '<div class="Compus">';
                    echo '<span class="compu-label">C-' . $i . '</span>';
                    echo '<img src="' . base_url('img/DisponibleC.png') . '" alt="0" id="C-' . $i . '" class="rotar" onclick="opciones(\'C-' . $i . '\')">';
                    echo '</div>';
                    //}
                }
                ?>
            </div>
        </div>
        <div class="sidebarLeft">
            <div class="sidebar2">
                <!-- Contenido del sidebar aquí -->
                <img src="<?= base_url('img/logo.png') ?>" alt="Imagen de la barra lateral izquierda">
            </div>
            <div class="sidebar">
                <!-- Contenido del sidebar aquí -->
                <img src="<?= base_url('img/ventana.png') ?>" alt="Imagen de la barra lateral izquierda">
                <img src="<?= base_url('img/ventana.png') ?>" alt="Imagen de la barra lateral izquierda">
                <img src="<?= base_url('img/ventana.png') ?>" alt="Imagen de la barra lateral izquierda">
                <img src="<?= base_url('img/ventana.png') ?>" alt="Imagen de la barra lateral izquierda">
            </div>
            <div class="small-images2">
                <a href="<?= base_url('Principal') ?>"><button><strong>Sala de Estudios</strong></button></a>
            </div>
        </div>
        <section class="cont2">
            <div class="tabla-header">
                <p><strong>UNIVERSIDAD DEL ISTMO</strong></p>
                <p><strong>CAMPUS JUCHITÁN</strong></p>
                <p><strong>DEPARTAMENTO DE BIBLIOTECA</strong></p>
                <p><strong><br>SISTEMA AUTOMATIZADO PARA EL REGISTRO A LA SALA DE ESTUDIOS</strong></p>
            </div>
        </section>
        <div class="sidebarRight">
            <div class="sidebar3">
                <img src="<?= base_url('img/logo2.png') ?>" alt="Imagen de la barra lateral derecha">
            </div>
            <div class="sidebar4">
                <img src="<?= base_url('img/ventana.png') ?>" alt="Imagen de la barra lateral derecha">
                <img src="<?= base_url('img/ventana.png') ?>" alt="Imagen de la barra lateral derecha">
                <img src="<?= base_url('img/ventana.png') ?>" alt="Imagen de la barra lateral derecha">
                <img src="<?= base_url('img/ventana.png') ?>" alt="Imagen de la barra lateral derecha">
            </div>
            <div class="small-images">
                <a href="<?= base_url('Login?parametro=1') ?>"><img src="<?= base_url('img/monitor.png') ?>"
                        alt="Monitor" class="ani"></a>
                <a href="<?= base_url('Login?parametro=0') ?>"><img src="<?= base_url('img/Admin.png') ?>" alt="Admin"
                        class="ani"></a>
                <a href="<?= base_url('Creditos') ?>"><img src="<?= base_url('img/Info.png') ?>" alt="Info"
                        class="ani"></a>
            </div>
        </div>
    </section>

</body>
<script src="<?= base_url('js/sweetalert2@11.js') ?>"></script>
<script src="<?= base_url('js/jquery.min.js') ?>"></script>
<script>
var intentosConsecutivos = {};

function validateNoCuenta(input) {
    // Filtrar caracteres no permitidos (dejar solo letras, números y símbolos)
    input.value = input.value.replace(/[^a-zA-Z0-9!@#$%^&*()_+{}\[\]:;<>,.?~\\/-]/g, '');

    // Limitar la longitud a 15 caracteres
    if (input.value.length > 15) {
        input.value = input.value.slice(0, 15);
    }
}

function opciones(asiento) {
    var opcion = document.getElementById(asiento).getAttribute('alt');
    console.log(opcion);
    // 0=Libre, 1=Ocupado
    if (opcion == 0) {
        openModal(asiento, opcion);
        //verificarAsiento(asiento, document.getElementById("NCuenta").innerText);
    } else {
        openModalNoCuenta(asiento, opcion)
        //openModal3(asiento);
    }
}

// Function to check if the seat is already occupied
function verificarAsiento(asiento, cuenta) {
    // Make an AJAX request to your server to check the seat status
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '/Bib/public/VerificarAsiento2/' + cuenta, true);
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var ocupado = JSON.parse(this.responseText);
            console.log(ocupado + " ocupado");
            if (ocupado == "bloquedo") {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "¡Cuenta bloqueada!",
                    //text: "Tu cuenta esta bloqueada",
                    showConfirmButton: false,
                    timer: 1500
                });
            } else {
                if (ocupado != null) {
                    if (ocupado.NoCuenta.toLowerCase() != cuenta.toLowerCase()) {
                        buscarAlumno(cuenta);
                        //openModal2(cuenta);
                        document.getElementById('inputSeat').value = '';
                    } else {
                        Swal.fire({
                            position: "center",
                            icon: "error",
                            title: "¡Cuenta ocupada!",
                            //text: "Tu cuenta ya esta siendo usada",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                } else {
                    /*Swal.fire({
                            position: "center",
                            icon: "error",
                            title: "¡Cuenta No Encontrada!",
                            text: "Tu cuenta no Existe",
                            showConfirmButton: false,
                            timer: 1500
                        });*/
                    buscarAlumno(cuenta);
                    document.getElementById('inputSeat').value = '';
                    //openModal2(cuenta);
                }
            }

        }
    };
    xhr.send();
}

// Función para abrir el modal con el número de asiento
function openModal(seatNumber, OcuLib) {
    document.getElementById("seatNumber2").innerText = seatNumber;
    document.getElementById("colorSeat").innerHTML = OcuLib;
    var modal = document.getElementById("myModal");

    modal.style.display = "block";
    // Agrega la clase 'show' para aplicar la transición
    modal.classList.add("show");
    document.getElementById("inputSeat").focus();

}

//Funcion para abrir el modal NoCuenta,
function openModalNoCuenta(seatNumber, OcuLib) {
    document.getElementById("seatNumber2").innerHTML = seatNumber;
    document.getElementById("colorSeat").innerHTML = OcuLib;
    var modal = document.getElementById("myModal");
    modal.style.display = "block";
    // Agrega la clase 'show' para aplicar la transición
    modal.classList.add("show");
    // Agrega la clase 'show' para aplicar la transición
    modal.classList.add("show");
    document.getElementById("inputSeat").focus();
}

// Función para cerrar el modal
function closeModal() {
    var modal = document.getElementById("myModal");
    // Elimina la clase 'show' para aplicar la transición al cerrar
    modal.classList.remove("show");
    // Espera a que termine la transición y luego oculta el modal
    setTimeout(function() {
        modal.style.display = "none";
    }, 300); // 300 milisegundos, debe coincidir con la duración de la transición en CSS
}

// Función para ejecutar acciones al aceptar en el modal (puedes personalizar según tus necesidades)
function accept() {
    const inputSeatValue = document.getElementById("inputSeat").value;
    var asiento = document.getElementById("seatNumber2").innerText;
    var ocu = document.getElementById("colorSeat").innerText;
    /*alert("Asiento aceptado con información: " + inputSeatValue);*/
    console.log(ocu + " opcion");
    if (ocu == 0) {
        closeModal();
        /*
                    buscarAlumno(inputSeatValue);
                    openModal2(inputSeatValue);*/
        verificarAsiento(asiento, inputSeatValue);
        document.getElementById('inputSeat').value = '';
    } else {
        closeModal();
        xml = new XMLHttpRequest();
        xml.open('GET', '/Bib/public/ObtenerAsiento2/' + asiento + "/" + inputSeatValue, true);
        xml.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xml.send();
        xml.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var datos = JSON.parse(this.responseText);
                if (this.responseText != '{"status":"Error"}') {
                    console.log(datos.NoCuenta != 0);
                    if (datos.NoCuenta.toLowerCase()) {
                        openModal3(asiento);
                    } else {
                        Swal.fire({
                            position: "center",
                            icon: "error",
                            title: "¡Error!",
                            text: "Cuenta errónea",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        document.getElementById('inputSeat').value = '';
                    }
                } else {
                    Swal.fire({
                        position: "center",
                        icon: "error",
                        title: "¡Error!",
                        text: "Cuenta errónea",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    document.getElementById('inputSeat').value = '';
                }
            }
        }


    }
}

// Función para abrir el modal con el número de asiento
function openModal2(seatNumber) {
    //document.getElementById("seatNumber").innerText = "Número de asiento: " + seatNumber;
    var modal = document.getElementById("myModal2");
    modal.style.display = "block";
    // Agrega la clase 'show' para aplicar la transición
    modal.classList.add("show");
    // Establecer el foco en el botón "Aceptar" cuando se abre el modal
    var acceptButton = document.querySelector("#myModal2 button[onclick='accept2()']");
    if (acceptButton) {
        acceptButton.focus();
    }
}

// Función para cerrar el modal
function closeModal2() {
    var modal = document.getElementById("myModal2");
    // Elimina la clase 'show' para aplicar la transición al cerrar
    modal.classList.remove("show");
    // Espera a que termine la transición y luego oculta el modal
    setTimeout(function() {
        modal.style.display = "none";
    }, 300); // 300 milisegundos, debe coincidir con la duración de la transición en CSS
}

// Función para ejecutar acciones al aceptar en el modal (puedes personalizar según tus necesidades)
function accept2() {
    const inputSeatValue = document.getElementById("inputSeat").value;
    /*alert("Asiento aceptado con información: " + inputSeatValue);*/
    agregarAsiento();
    closeModal2();

}

// Función para abrir el modal con el número de asiento
function openModal3(seatNumber) {
    document.getElementById("seatNumber3").innerText = seatNumber;
    var modal = document.getElementById("myModal3");
    modal.style.display = "block";
    // Agrega la clase 'show' para aplicar la transición
    modal.classList.add("show");
    // Establecer el foco con un pequeño retraso
    setTimeout(function() {
        var acceptButton = document.querySelector("#myModal3 button[onclick='accept3()']");
        if (acceptButton) {
            acceptButton.focus();
        }
    }, 300); // Ajusta el tiempo de retraso según tus preferencias
}

// Función para cerrar el modal
function closeModal3() {
    var modal = document.getElementById("myModal3");
    // Elimina la clase 'show' para aplicar la transición al cerrar
    modal.classList.remove("show");
    // Espera a que termine la transición y luego oculta el modal
    setTimeout(function() {
        modal.style.display = "none";
    }, 300); // 300 milisegundos, debe coincidir con la duración de la transición en CSS
}

// Función para ejecutar acciones al aceptar en el modal (puedes personalizar según tus necesidades)
function accept3() {
    const inputSeatValue = document.getElementById("seatNumber3").innerHTML;
    /*alert("Asiento aceptado con información: " + inputSeatValue);*/
    deleteAsiento(inputSeatValue)
    closeModal3();
}

function buscarAlumno(id) {
    document.getElementById('inputSeat').value = id;
    xml = new XMLHttpRequest();
    xml.open('GET', '/Bib/public/ObtenerUsers2/' + id, true);
    xml.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xml.send();
    xml.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

            var datos = JSON.parse(this.responseText);
            console.log(this.responseText + "es estoooo");
            if (this.responseText != '{"status":"Error"}') {
                var body = document.getElementById('rectangle');
                var text = "";
                if (datos.Nombre) text += "<p>Nombre:</p><p id='Nombre' style='text-decoration: underline;'>" +
                    datos.Nombre + "</p><br>";
                if (datos.NoCuenta) text += "<p>Cuenta:</p><p id='NCuenta' style='text-decoration: underline;'>" +
                    datos.NoCuenta + "</p><br>";
                if (datos.area) text += "<p>Área:</p><p id='Area' style='text-decoration: underline;'>" + datos
                    .area + "</p><br>";
                if (datos.semestre) text +=
                    "<p>Semestre:</p><p id='Semestre' style='text-decoration: underline;'>" + datos.semestre +
                    "</p><br>";
                if (datos.grupo) text += "<p>Grupo:</p><p id='Grupo' style='text-decoration: underline;'>" + datos
                    .grupo + "</p><br>";
                if (datos.Cargo) text += "<p>Cargo:</p><p id='Cargo' style='text-decoration: underline;'>" + datos
                    .Cargo + "</p><br>";
                if (datos.dependencia) text +=
                    "<p>Dependencia:</p><p id='Dependencia' style='text-decoration: underline;'>" + datos
                    .dependencia + "</p><br>";
                text += "<p>Computadora:</p><p id='seatNumber' style='text-decoration: underline;'>" + document
                    .getElementById("seatNumber2").innerText + "</p><br>";
                console.log(text);
                body.innerHTML = text;
                /*
                                    document.getElementById("Nombre").innerText = datos.Nombre;
                                    document.getElementById("NCuenta").innerText = datos.NoCuenta;
                                    document.getElementById("Area").innerText = datos.area;
                                    document.getElementById("Semestre").innerText = datos.semestre;
                                    document.getElementById("seatNumber").innerText = document.getElementById("seatNumber2").innerText;*/
                openModal2(id);
            } else {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "¡Cuenta no encontrada!",
                    text: "Tu cuenta no existe",
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        }
    }
}

function deleteAsiento(id) {
    var Event = []
    Event.push(id)
    Event.push(document.getElementById("inputSeat").value)
    $.ajax({
        url: '/Bib/public/BorrarRegistro2',
        type: 'POST',
        data: {
            "asiento": Event[0],
            "NoCuenta": Event[1],
        },
        success: function(result) {
            result = JSON.parse(result);
            console.log(result);
            try {
                if (result.NoCuenta.toLowerCase() === Event[1].toLowerCase()) {
                    actualizarRecord(result.NoCuenta);
                    console.log(result);
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "¡Hasta pronto!",
                        text: "Biblioteca UNISTMO Campus Juchitán",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    var imagenAsiento = document.getElementById(document.getElementById("seatNumber3")
                        .innerText);
                    imagenAsiento.alt = "0";
                    if (imagenAsiento) {
                        imagenAsiento.src = 'img/DisponibleC.png';
                    } else {
                        console.error('Asiento no encontrado: ' + asiento);
                    }
                }
            } catch (Exception) {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "¡Error!",
                    text: "Cuenta errónea",
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        },
        error: function(result) {
            console.log(result);
        }
    });
    document.getElementById('inputSeat').value = '';
    //console.log(cuentaAux + " buenasasasas");
    //actualizarRecord(cuentaAux);
}

function obtenerAsiento(id) {
    xml = new XMLHttpRequest();
    console.log(id);
    xml.open('GET', '/Bib/public/BorrarRegistro2/' + id, true);
    xml.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xml.send();
    xml.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var result = JSON.parse(this.responseText);
            /*console.log(this.responseText);*/
            var datos = JSON.parse(this.responseText);
            Swal.fire({
                position: "center",
                icon: "success",
                title: "¡Hasta pronto!",
                text: "Biblioteca UNISTMO Campus Juchitán",
                showConfirmButton: false,
                timer: 1500
            });
            console.log(id);
            var imagenAsiento = document.getElementById(document.getElementById("seatNumber3").innerText);
            imagenAsiento.alt = "0";
            if (imagenAsiento) {
                imagenAsiento.src = 'img/DisponibleC.png';
            } else {
                console.error('Asiento no encontrado: ' + asiento);
            }
        }
    }
}

/*function agregarAsiento() {
    var Event = []
    Event.push(document.getElementById("NCuenta").innerText)
    Event.push(document.getElementById("seatNumber").innerText)

    // Incrementa el contador de intentos consecutivos
    if (intentosConsecutivos[Event[0]]) {
        intentosConsecutivos[Event[0]]++;
    } else {
        intentosConsecutivos = {};
        intentosConsecutivos[Event[0]] = 1;
    }

    // Bloquea la cuenta si los intentos consecutivos alcanzan 3
    if (intentosConsecutivos[Event[0]] >= 3) {
        // Llama a una función para bloquear la cuenta, por ejemplo, bloquearCuenta(cuenta);
        bloquearCuenta(Event[0]);
        //alert("Cuenta bloqueada por 3 intentos");
        //intentosConsecutivos[Event[0]] = 0;
        intentosConsecutivos = {};
    } else {

        $.ajax({
            url: '/Bib/public/AgregarAsiento2',
            type: 'POST',
            data: {
                "NoCuenta": Event[0],
                "asiento": Event[1],
            },
            success: function(result) {
                result = JSON.parse(result);
                agregarRecord();
                /* console.log(result);
                 Swal.fire({
                     position: "center",
                     icon: "success",
                     title: "¡Bienvenido a la sala de estudios!",
                     text: "Bibioteca Unistmo Campus Juchitan",
                     showConfirmButton: false,
                     timer: 2000
                 });
                var imagenAsiento = document.getElementById(document.getElementById("seatNumber").innerText);
                imagenAsiento.alt = "1";
                if (imagenAsiento) {
                    imagenAsiento.src = 'img/OcupadoC.png';
                    document.getElementById("inputSeat").innerHTML = "";
                } else {
                    console.error('Asiento no encontrado: ' + asiento);
                }

            }
        });
    }
}*/
function agregarAsiento() {
    var Event = []
    Event.push(document.getElementById("NCuenta").innerText)
    Event.push(document.getElementById("seatNumber").innerText)

    if (intentosConsecutivos[Event[0]] > 2) {
        closeModal2();
        // Llama a una función para bloquear la cuenta, por ejemplo, bloquearCuenta(cuenta);
        bloquearCuenta(Event[0]);
        //alert("Cuenta bloqueada por 3 intentos");
        //intentosConsecutivos[Event[0]] = 0;
        intentosConsecutivos = {};
    } else {
        // Make an AJAX request to your server to check the seat status
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '/Bib/public/VelidarAll_Computo/' + Event[0] + "/" + Event[1], true);
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var ocupado = JSON.parse(this.responseText);
                console.log(ocupado);
                $.ajax({
                    url: '/Bib/public/Validar2_computo/' + Event[0] + "/" + Event[1],
                    type: 'GET',
                    success: function(result) {

                        var res = JSON.parse(result);
                        if (res.mensaje == null) {
                            var msj = ocupado.mensaje.split(',');
                            switch (msj[0]) {
                                case "bloqueado":
                                    Swal.fire({
                                        position: "center",
                                        icon: "error",
                                        title: "¡Cuenta bloqueada!",
                                        // text: "Intentalo en 10 minutos",
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                    break;
                                case "ocupado":
                                    Swal.fire({
                                        position: "center",
                                        icon: "error",
                                        title: "¡Cuenta ocupada en asiento " + msj[1] + "!",
                                        // text: "Tu cuenta ya esta siendo usada",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    break;

                                case "sala":
                                    Swal.fire({
                                        position: "center",
                                        icon: "error",
                                        title: "¡Cuenta ocupada en la sala de estudios!",
                                        // text: "Tu cuenta ya esta siendo usada",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    break;
                                case "agregado":
                                    // Incrementa el contador de intentos consecutivos
                                    if (intentosConsecutivos[Event[0]]) {
                                        intentosConsecutivos[Event[0]]++;
                                    } else {
                                        intentosConsecutivos = {};
                                        intentosConsecutivos[Event[0]] = 1;
                                    }
                                    Swal.fire({
                                        position: "center",
                                        icon: "success",
                                        title: "¡Bienvenido a la sala de estudios!",
                                        text: "Biblioteca UNISTMO Campus Juchitán",
                                        showConfirmButton: false,
                                        timer: 2000
                                    });
                                    break;
                                default:
                                    Swal.fire({
                                        position: "center",
                                        icon: "error",
                                        title: "Error desconocido",
                                        text: "Hubo un error desconocido",
                                        showConfirmButton: true
                                    });
                                    break;
                            }
                        } else {
                            var arrayResultante = res.mensaje.split(',');
                            console.log((parseInt(arrayResultante[1]) === parseInt(Event[0])));
                            if (parseInt(arrayResultante[1]) === parseInt(Event[0])) {
                                Swal.fire({
                                    position: "center",
                                    icon: "error",
                                    title: "¡Cuenta ocupada!",
                                    // text: "Tu cuenta ya esta siendo usada",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            } else {
                                Swal.fire({
                                    position: "center",
                                    icon: "success",
                                    title: "¡Bienvenido a la sala de estudios!",
                                    text: "Biblioteca UNISTMO Campus Juchitán",
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                            }
                        }
                    }
                });

            }
        };
        xhr.send();
    }
}

function bloquearCuenta(cuenta) {
    var Event = []
    Event.push(cuenta)
    Event.push("3 ingresos seguidos")

    $.ajax({
        url: '/Bib/public/BloquearPrincipal',
        type: 'POST',
        data: {
            "NoCuenta": Event[0],
            "Motivo": Event[1]
        },
        success: function(result) {
            result = JSON.parse(result);
            console.log(result);
            Swal.fire({
                position: "center",
                icon: "error",
                title: "¡Cuenta bloqueada!",
                text: "Intentalo en 10 minutos",
                showConfirmButton: false,
                timer: 2000
            });
        }
    });
}

function agregarRecord() {
    var Event = []
    Event.push(document.getElementById("NCuenta").innerText)
    Event.push(document.getElementById("seatNumber").innerText)

    $.ajax({
        url: '/Bib/public/AgregarRecord2',
        type: 'POST',
        data: {
            "NoCuenta": Event[0],
            "asiento": Event[1],
        },
        success: function(result) {
            result = JSON.parse(result);
            console.log(result);
            Swal.fire({
                position: "center",
                icon: "success",
                title: "¡Bienvenido a la sala de estudios!",
                text: "Biblioteca UNISTMO Campus Juchitán",
                showConfirmButton: false,
                timer: 2000
            });
        }
    });
}

function actualizarRecord(NCuenta) {
    console.log("otroooo " + NCuenta);
    $.ajax({
        url: '/Bib/public/ActualizarRecord2',
        type: 'POST',
        data: {
            "NoCuenta": NCuenta
        },
        success: function(result) {
            result = JSON.parse(result);
            console.log(result[0] + " jaloooooooo");
        },
        error: function(result) {
            console.log(result);
        }

    });

}

document.addEventListener('DOMContentLoaded', function() {
    // Realizar una solicitud AJAX para obtener los asientos ocupados
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '/Bib/public/ObtenerAsientos2', true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            var ocupados = JSON.parse(xhr.responseText);
            console.log(ocupados)
            // Actualizar las imágenes de los asientos ocupados
            ocupados.forEach(function(asientos) {
                console.log(asientos.Asiento);
                var imagenAsiento = document.getElementById(asientos.Asiento);

                if (imagenAsiento) {
                    imagenAsiento.src = 'img/OcupadoC.png';
                    imagenAsiento.alt = '1';
                }
            });
        }
    };
    xhr.send();

    var inputElement = document.getElementById('inputSeat');

    inputElement.addEventListener('keydown', function(event) {
        // Bloquear Ctrl+C (código de tecla 67) y Ctrl+V (código de tecla 86)
        if ((event.ctrlKey && event.keyCode === 67) || (event.ctrlKey && event.keyCode === 86)) {
            event.preventDefault();
        }

        if (event.keyCode === 13) {
            // Llamar a la función deseada, por ejemplo, la función accept()
            accept();
        }
    });

    inputElement.addEventListener('contextmenu', function(event) {
        // Bloquear el clic derecho solo para el elemento inputSeat
        event.preventDefault();
    });

    var modal2 = document.getElementById('myModal2');

    modal2.addEventListener('keydown', function(event) {
        setTimeout(function() {
            // Verificar si la tecla presionada es "Enter"
            if (event.keyCode === 13) {
                // Llamar a la función deseada dentro del modal2, por ejemplo, la función accept2()
                //accept2();
            }
        }, 300)
    });
});
</script>

<script>
var tamano = 0; //tamaño bd asientos
window.onload = function() {
    $.ajax({
        url: '/Bib/public/ObtenerAsientos2',
        type: 'GET',
        success: function(response) {
            var asientos = JSON.parse(response);
            tamano = asientos.length;

            asientos.forEach(function(asientos) {
                console.log(asientos.Asiento)
                if (['C-1', 'C-2', 'C-3', 'C-4', 'C-5', 'C-6'].includes(asientos.Asiento) && [
                        '1', '2', '3', '4', '5', '6'
                    ].includes(asientos.NoCuenta)) {
                    console.log("Bloqueados");
                    var silla = document.getElementById(asientos.Asiento);
                    silla.src = 'img/OcupadoC.png';
                    silla.alt = '1';
                    silla.onclick = function() {};
                    silla.disabled = true;
                    silla.classList.add(
                    'disable-animation'); // Agregar la clase disable-animation
                    silla.style.opacity = '0.5';
                    silla.style.cursor = 'not-allowed';
                }
            });


        },
        error: function(xhr, status, error) {
            console.error("Error en la solicitud AJAX:", error);
        }
    });
    hilo();
}

function hilo() {

    setInterval(function() {
        $.ajax({
            url: '/Bib/public/ObtenerAsientos2',
            type: 'GET',
            success: function(response) {
                var ocupados = JSON.parse(response);

                if (ocupados.length > tamano) {

                    var sillas = document.getElementById('Compus2');

                    var allasientos = sillas.querySelectorAll('img');

                    allasientos.forEach(function(asientos) {
                        asientos.src = 'img/DisponibleC.png';
                        asientos.alt = '0';
                        asientos.disabled = false;
                        asientos.onclick = function() {
                            opciones(asientos.id)
                        };
                        asientos.style.cursor = 'pointer';
                        asientos.style.opacity = '1';
                        if (asientos.classList.contains('disable-animation')) {
                            asientos.classList.remove(
                            'disable-animation'); // Eliminar la clase disable-animation
                        }
                    });

                    ocupados.forEach(function(asientos) {

                        var imagenAsiento = document.getElementById(asientos.Asiento);

                        if (imagenAsiento) {
                            imagenAsiento.src = 'img/OcupadoC.png';
                            imagenAsiento.alt = '1';
                        }
                        if (['C-1', 'C-2', 'C-3', 'C-4', 'C-5', 'C-6'].includes(asientos
                                .Asiento) && ['1', '2', '3', '4', '5', '6'].includes(
                                asientos.NoCuenta)) {
                            var silla = document.getElementById(asientos.Asiento);
                            silla.src = 'img/OcupadoC.png';
                            silla.alt = '1';
                            silla.onclick = function() {};
                            silla.disabled = true;
                            silla.classList.add(
                            'disable-animation'); // Agregar la clase disable-animation
                            silla.style.opacity = '0.5';
                            silla.style.cursor = 'not-allowed';

                        }

                    });

                    tamano = ocupados.length;

                } else if (ocupados.length < tamano) {

                    console.log("else");

                    var sillas = document.getElementById('Compus2');

                    var allasientos = sillas.querySelectorAll('img');

                    allasientos.forEach(function(asientos) {
                        asientos.src = 'img/DisponibleC.png';
                        asientos.alt = '0';
                        asientos.disabled = false;
                        asientos.onclick = function() {
                            opciones(asientos.id)
                        };
                        asientos.style.cursor = 'pointer';
                        asientos.style.opacity = '1';
                        if (asientos.classList.contains('disable-animation')) {
                            asientos.classList.remove(
                            'disable-animation'); // Eliminar la clase disable-animation
                        }

                    });

                    ocupados.forEach(function(asientos) {

                        var imagenAsiento = document.getElementById(asientos.Asiento);

                        if (imagenAsiento) {
                            imagenAsiento.src = 'img/OcupadoC.png';
                            imagenAsiento.alt = '1';
                        }

                        if (['C-1', 'C-2', 'C-3', 'C-4', 'C-5', 'C-6'].includes(asientos
                                .Asiento) && ['1', '2', '3', '4', '5', '6'].includes(
                                asientos.NoCuenta)) {
                            var silla = document.getElementById(asientos.Asiento);
                            silla.src = 'img/OcupadoC.png';
                            silla.alt = '1';
                            silla.onclick = function() {};
                            silla.disabled = true;
                            silla.classList.add(
                            'disable-animation'); // Agregar la clase disable-animation
                            silla.style.opacity = '0.5';
                            silla.style.cursor = 'not-allowed';
                        }


                    });
                    tamano = ocupados.length;
                }
            },
            error: function(xhr, status, error) {
                console.error("Error en la solicitud AJAX:", error);
            }
        });
        // console.log("segundo paso" + tamano);
    }, 2000);
}
</script>

</html>