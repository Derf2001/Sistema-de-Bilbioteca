<?= $layout ?>

<div class="modal2" id="myModal2">
    <div class="modal-content2">
        <span class="close2" onclick="closeModal2()">&times;</span>
        <h2>Datos del Usuario</h2>
        <div class="rectangle" id='rectangle'>
            <p id="nombreLabel">Nombre:</p>
            <p id="Nombre" style="text-decoration: underline;"></p><br>
            <p id="nCuentaLabel">Cuenta:</p>
            <p id="NCuenta" style="text-decoration: underline;"></p><br>
            <p id="areaLabel">Área:</p>
            <p id="Area" style="text-decoration: underline;"></p><br>
            <p id="semestreLabel">Semestre:</p>
            <p id="Semestre" style="text-decoration: underline;"></p><br>
            <p id="cargoLabel">Cargo:</p>
            <p id="Cargo" style="text-decoration: underline;"></p><br>
            <p id="grupoLabel">Grupo:</p>
            <p id="Grupo" style="text-decoration: underline;"></p><br>
            <p>Motivo del bloqueo:*</p>
            <select id="motivoSelect" onchange="checkMotivo()" required>
                <option value="" disabled selected>Selecciona un motivo</option>
                <option value="Jugar videojuegos">Jugar videojuegos</option>
                <option value="Dormir">Dormir</option>
                <option value="Comer">Comer</option>
                <option value="Platicar">Platicar</option>
                <option value="opcion5">Otro</option>
            </select> 
            <br>
            <div id="otroMotivo" style="display: none;">
                <p>Ingrese el motivo:*</p>
                <input type="text" id="motivoInput" placeholder="Ingrese el motivo" />
                <br>
            </div>
            <br>
            <p>Fecha de desbloqueo:*</p>
            <input type="date" id="fechaInput" required onkeydown="return false" />
            <br>
        </div>
        <button onclick="accept2()">Aceptar</button>
        <button onclick="closeModal2()">Cancelar</button>
    </div>
</div>


<section class="cont2">
    <div class="tabla-header">
        <p>Suspensión/Tabla Suspensión</p>
        <p><strong>Tabla Suspensión</strong></p>
        <div class="searchbar">
            <form class="search-form">
                <i class="fas fa-search"></i>
                <input type="text" id="search" placeholder="Buscar..." oninput="buscadorPro()">
            </form>
        </div>
    </div>

    <div class="admin-table">
        <!-- Contenido de la tabla aquí -->
        <h3>Suspensión</h3>
        <table id="admin-table">
            <thead>
                <tr>
                    <th>Cuenta</th>
                    <th>Nombre</th>
                    <th>Área</th>
                    <th>Semestre</th>
                    <th>Grupo</th>
                    <th>Motivo</th>
                    <th>Fecha de Bloqueo</th>
                    <th>Fecha de Desbloqueo</th>
                    <th>Estado</th><!-- aqui van los iconos-->
                </tr>
            </thead>

            <tbody id="content-table">
                <?php foreach ($bloqueos as $bloqueos) :
                    extract($bloqueos);
                    echo "<tr>";
                    echo "<td>$NoCuenta</td>";
                    echo "<td>$Nombre</td>";
                    echo "<td>$area</td>";
                    echo "<td>$semestre</td>";
                    echo "<td>$grupo</td>";
                    echo "<td>$motivo</td>";
                    echo "<td>" . date('d-m-Y', strtotime($FechaBloqueo)) . "</td>";
                    echo "<td>" . date('d-m-Y', strtotime($FechaDesbloqueo)) . "</td>";
                    echo "<td>";
                    echo "<a class='delete-icon' ><i class='fa-solid fa-lock' onclick='desbloquear($idBlocked)'></i></a>";
                    echo "</a>";
                    echo "</td>";
                    echo "</tr>";
                endforeach; ?>
            </tbody>

        </table>
    </div>
    <div class="bottom-button">
        <button id="new-account-btn" onclick="add()"><strong>Bloquear</strong></button>
    </div>
</section>
<!--Aqui va un estilo que tiene administrador-->
<style>
    #dialog {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #1B254B;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        text-align: center;
        border-radius: 15px;
        width: 400px;
    }

    #dialog p {
        font-size: 20px;
        margin-bottom: 20px;
        color: white;
    }

    #dialog button {
        background-color: #3182CE;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        margin-right: 10px;
    }

    #dialog button:hover {
        background-color: #2d70af;
    }

    #dialog button:disabled {
        background-color: #cccccc;
        cursor: not-allowed;
    }

    #dialog .cancel-btn {
        background-color: #f44336;
    }
</style>
<div id="overlay"></div>
<div id="dialog" class="modal">
    <p>¿Desbloquear?</p>
    <button id="accept">Aceptar</button>
    <button id="cancel">Cancelar</button>
</div>
<div class="new-account-panel" id="panelBloquearUsuario">
    <div class="cont3">
        <h3>Bloquear Usuario</h3>
        <form class="newAccountForm" onsubmit="return false;" id="newAccountForm">
            <label for="new-account-name"><strong>Cuenta</strong></label>
            <input type="Text" id="new-account-name" name="NoCuenta" placeholder="Ingrese cuenta" required maxlength="15">
            <div class="btns">
                <div class="row">
                    <input type="hidden" id="aux" value="0">
                    <button type="submit" class="new-account-btn2" onclick="verificarSiYaEsta()"><strong>Buscar</strong></button>
                    <button id="cerrarPanel" type="button" class="cancel-btn"><strong>Cancelar</strong></button>
                </div>
                <button type="submit" class="limpiar-btn" onclick="limpiarform()"><strong>Limpiar</strong></button>
            </div>
        </form>

    </div>

</div>
</div>
<?= $layout_js ?>

<script>
    function checkMotivo() {
        var motivoSelect = document.getElementById("motivoSelect");
        var otroMotivoDiv = document.getElementById("otroMotivo");
        var motivoInput = document.getElementById("motivoInput");

        if (motivoSelect.value == "opcion5") {
            otroMotivoDiv.style.display = "block";
            motivoInput.required = true;
        } else {
            otroMotivoDiv.style.display = "none";
            motivoInput.required = false;
        }
    }

    function accept2() {

        var motivoSelect = document.getElementById("motivoSelect");
        var fechaInput = document.getElementById("fechaInput");

        if (motivoSelect.checkValidity() && fechaInput.checkValidity()) {
            Bloquear();

        } else {
            Swal.fire({
                position: "center",
                icon: "error",
                title: "Fecha o motivo estan vacios",
                showConfirmButton: false,
                timer: 1500
            });
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
        document.getElementById("motivoSelect").selectedIndex = 0; // Establece el índice seleccionado de nuevo a la primera opción
        document.getElementById("motivoInput").value = ""; // Borra el contenido del input
        document.getElementById("fechaInput").value = ""; // Establece el valor del input de fecha como una cadena vacía
        closepanel();

    }

    /*  function openModal2(columnas) {
          var modal = document.getElementById("myModal2");
          modal.style.display = "block";
          modal.classList.add("show");
          /*
              <p id="nombreLabel">Nombre:</p>
              <p id="Nombre" style="text-decoration: underline;"></p><br>

              <p id="nCuentaLabel">Cuenta:</p>
              <p id="NCuenta" style="text-decoration: underline;"></p><br>
              
              <p id="areaLabel">Área:</p>
              <p id="Area" style="text-decoration: underline;"></p><br>
              
              <p id="semestreLabel">Semestre:</p>
              <p id="Semestre" style="text-decoration: underline;"></p><br>
              
              <p id="cargoLabel">Cargo:</p>
              <p id="Cargo" style="text-decoration: underline;"></p><br>
              
              <p id="grupoLabel">Grupo:</p>
              <p id="Grupo" style="text-decoration: underline;"></p><br>
              */

    /*
        var fieldMap = {
            "Nombre": ["Nombre", "nombreLabel"],
            "NCuenta": ["NCuenta", "nCuentaLabel"],
            "Area": ["Area", "areaLabel"],
            "Semestre": ["Semestre", "semestreLabel"],
            "Grupo": ["Grupo", "grupoLabel"],
            "Cargo": ["Cargo", "cargoLabel"]
        };

        // Iterar sobre las columnas y mostrar los datos si están presentes
        columnas.forEach(function(columna) {
            for (var field in fieldMap) {
                var labelId = fieldMap[field][0];
                var dataId = fieldMap[field][1];
                var value = columna[field] || "-"; // Usar "-" si el valor está ausente
                console.log(columna[field]);
                // Mostrar el valor y la etiqueta de nombre solo si el valor no es "-"
                if (value !== "-") {
                    document.getElementById(dataId).innerText = value;
                    document.getElementById(labelId).style.display = "block";
                } else {
                    document.getElementById(dataId).innerText = "";
                    document.getElementById(labelId).style.display = "none";
                }

            }
        });
    }*/

    function openModal2(columnas) {
        var modal = document.getElementById("myModal2");
        modal.style.display = "block";
        modal.classList.add("show");
        /*
                columnas.forEach(function(columna) {
                    // Nombre
                    var nombre = columna.Nombre || "-";
                    document.getElementById('Nombre').innerText = nombre;
                    document.getElementById('nombreLabel').style.display = (nombre !== "-") ? "block" : "none";

                    // Número de cuenta
                    var nCuenta = columna.NoCuenta || "-";
                    document.getElementById('NCuenta').innerText = nCuenta;
                    document.getElementById('nCuentaLabel').style.display = (nCuenta !== "-") ? "block" : "none";
                    // Área
                    var area = columna.area;
                    if (area) {
                        document.getElementById('Area').innerText = area;
                        document.getElementById('areaLabel').style.display = "block";
                    } else {
                        document.getElementById('Area').innerText = "";
                        document.getElementById('areaLabel').style.display = "none";
                    }
                    // Semestre
                    var semestre = columna.semestre;
                    if (semestre) {
                        document.getElementById('Semestre').innerText = semestre;
                        document.getElementById('semestreLabel').style.display = "block";
                    } else {
                        document.getElementById('Semestre').innerText = "";
                        document.getElementById('semestreLabel').style.display = "none";
                    }
                    // Grupo
                    var grupo = columna.grupo;
                    if (grupo) {
                        document.getElementById('Grupo').innerText = grupo;
                        document.getElementById('grupoLabel').style.display = "block";
                    } else {
                        document.getElementById('Grupo').innerText = "";
                        document.getElementById('grupoLabel').style.display = "none";
                    }
                    // Cargo
                    var cargo = columna.cargo;
                    if (cargo) {
                        document.getElementById('Cargo').innerText = cargo;
                        document.getElementById('cargoLabel').style.display = "block";
                    } else {
                        document.getElementById('Cargo').innerText = "";
                        document.getElementById('cargoLabel').style.display = "none";
                    }
                });*/
    }

    function add() {
        limpiarform();
        showpanel();
    }

    function limpiarform() {
        var form = document.getElementById("newAccountForm");
        form.reset();
    }

    function desbloquear(NoCuenta) {

        // console.log("El numero de cuenta de i creo" + NoCuenta);
        var modal = document.getElementById("dialog");
        var accept = document.getElementById("accept");
        var cancel = document.getElementById("cancel");
        modal.style.display = "block";
        accept.onclick = function() {
            desbloquear2(NoCuenta);
            //cosole.log("Que se esta imprimiendo aqui" + NoCuenta);

            modal.style.display = "none";
        }
        cancel.onclick = function() {
            modal.style.display = "none";
        }
    }

    function desbloquear2(NoCuenta) {
        //console.log("Que manda" + NoCuenta);

        $.ajax({
            url: '/Bib/public/Desbloquear/' + NoCuenta, // Cambia la URL a la que corresponda
            type: 'GET',
            success: function(result) {
                result = JSON.parse(result);
                var size = result.length;
                if (size != 0) {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Desbloqueado",
                        showConfirmButton: false,
                        timer: 1500
                    });

                    // console.log("Contenido de la tabla: " + result);

                    var body = document.getElementById('content-table');
                    body.innerHTML = '';

                    result.forEach(element => {
                        console.log("Esta fecha se recupera" + element.FechaDesbloqueo);

                        body.innerHTML +=
                            `<tr>
                            <td>${valorONulo(element.NoCuenta)}</td>
                            <td>${valorONulo(element.Nombre)}</td>
                            <td>${valorONulo(element.area)}</td>
                            <td>${valorONulo(element.semestre)}</td>
                            <td>${valorONulo(element.grupo)}</td>
                            <td>${valorONulo(element.motivo)}</td>
                            <td>${formatoFecha(valorONulo(element.FechaBloqueo))}</td>
                            <td>${formatoFecha(valorONulo(element.FechaDesbloqueo))}</td>
                            <td>
                                <a class='delete-icon'>
                                    <i class='fa-solid fa-lock' onclick='desbloquear(${element.idBlocked})'></i>
                                </a>
                            </td>
                        </tr>`;
                    });
                    document.getElementById('search').value = '';
                    body.innerHTML = text;
                    closepanel();

                } else if (size == 0) {
                    var body = document.getElementById('content-table');
                    body.innerHTML = '';
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Desbloqueado",
                        showConfirmButton: false,
                        timer: 1500

                    });
                }
            }
        });
    }

    /*function Buscar() {
        $.ajax({
            url: '/Bib/public/ObtenerUser',
            type: 'POST',
            data: {
                "NoCuenta": document.getElementById("new-account-name").value
            },
            success: function(result) {
                result = JSON.parse(result);
                //console.log(result + 'texto');
                if (result.length == 0) {
                    Swal.fire({
                        position: "center",
                        icon: "info",
                        title: "Usuario inexistente",
                        showConfirmButton: false,
                        timer: 1500
                    });
                } else if (result.length != 0) {
                    var columnas = Object.keys(result[0]);
                    openModal2(result);


                } else {
                    alert('Error');
                }
            }
        });
        var formulario = document.getElementById('newAccountForm');
        // Resetea el formulario
        formulario.reset();
    }*/
    function Buscar() {
        $.ajax({
            url: '/Bib/public/ObtenerUser',
            type: 'POST',
            data: {
                "NoCuenta": document.getElementById("new-account-name").value
            },
            success: function(result) {
                result = JSON.parse(result);
                //console.log(result + 'texto');
                if (result.length == 0) {
                    Swal.fire({
                        position: "center",
                        icon: "info",
                        title: "Usuario inexistente",
                        showConfirmButton: false,
                        timer: 1500
                    });
                } else if (result.length != 0) {
                    var columnas = Object.keys(result[0]);
                    var body = document.getElementById('rectangle');
                    var text = "";
                    if (result[0].Nombre) text += "<p id='nombreLabel'>Nombre:</p><p id='Nombre' style='text-decoration: underline;'>" + result[0].Nombre + "</p><br>";
                    if (result[0].NoCuenta) text += "<p id='nCuentaLabel'>Cuenta:</p><p id='NCuenta' style='text-decoration: underline;'>" + result[0].NoCuenta + "</p><br>";
                    if (result[0].area) text += "<p id='areaLabel'>Área:</p><p id='Area' style='text-decoration: underline;'>" + result[0].area + "</p><br>";
                    if (result[0].semestre) text += "<p id='semestreLabel'>Semestre:</p><p id='Semestre' style='text-decoration: underline;'>" + result[0].semestre + "</p><br>";
                    if (result[0].grupo) text += "<p id='grupoLabel'>Grupo:</p><p id='Grupo' style='text-decoration: underline;'>" + result[0].grupo + "</p><br>";
                    if (result[0].Cargo) text += "<p id='cargoLabel'>Cargo:</p><p id='Cargo' style='text-decoration: underline;'>" + result[0].Cargo + "</p><br>";
                    if (result[0].dependencia) text += "<p>Dependencia:</p><p id='Dependencia' style='text-decoration: underline;'>" + result[0].dependencia + "</p><br>";
                    text += "<p>Motivo del bloqueo:</p><select id='motivoSelect' onchange='checkMotivo()' required><option value='' disabled selected>Selecciona un motivo</option><option value='Jugar videojuegos'>Jugar videojuegos</option><option value='Dormir'>Dormir</option><option value='Comer'>Comer</option><option value='Platicar'>Platicar</option><option value='opcion5'>Otro</option></select><div id='otroMotivo' style='display: none;'><p>Ingrese el motivo:</p><input type='text' id='motivoInput' placeholder='Ingrese el motivo' /></div><br><p>Fecha de desbloqueo:*</p><input type='date' id='fechaInput' required onkeydown='return false' /><br>"
                    console.log(result);
                    body.innerHTML = text;
                    openModal2(result);


                } else {
                    alert('Error');
                }
            }
        });
        var formulario = document.getElementById('newAccountForm');
        // Resetea el formulario
        formulario.reset();
    }

    function Bloquear() {
        var motivoSelect = document.getElementById("motivoSelect");
        var selectedMotivo = motivoSelect.value;

        var fechaInput = document.getElementById('fechaInput').value;
        var fechaLocal = new Date(fechaInput);
        var zonaHorariaOffset = fechaLocal.getTimezoneOffset();
        var fechaUTC = new Date(fechaLocal.getTime() + (zonaHorariaOffset * 60 * 1000));
        var fechaUnixGMT = Math.floor(fechaUTC.getTime() / 1000);

        //console.log("fecha ingresada" + fechaUnixGMT);


        if (selectedMotivo == "opcion5") {
            selectedMotivo = document.getElementById('motivoInput').value;
        }
        var noCuenta = document.getElementById('NCuenta').innerText;
        $.ajax({
            url: '/Bib/public/VerificarBloqueo',
            type: 'POST',
            data: {
                "NoCuenta": noCuenta
            },
            success: function(result) {
                result = JSON.parse(result);
                var size = result.length;
                if (size === 0) {
                    // El número de cuenta no está bloqueado, procede a bloquear
                    var Event = [];
                    Event.push(noCuenta);
                    Event.push(selectedMotivo);
                    // Event.push(fechaInput);
                    Event.push(fechaUnixGMT);


                    $.ajax({
                        url: '/Bib/public/Bloquear',
                        type: 'POST',
                        data: {
                            "NoCuenta": Event[0],
                            "Motivo": Event[1],
                            "FechaDesbloqueo": Event[2],
                        },
                        success: function(result) {
                            result = JSON.parse(result);
                            //console.log(result);
                            if (result[0].NoCuenta != 0) {
                                Swal.fire({
                                    position: "center",
                                    icon: "success",
                                    title: "Bloqueado",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                var body = document.getElementById('content-table');
                                body.innerHTML = '';

                                result.forEach(element => {
                                    body.innerHTML +=
                                        `<tr>
                            <td>${valorONulo(element.NoCuenta)}</td>
                            <td>${valorONulo(element.Nombre)}</td>
                            <td>${valorONulo(element.area)}</td>
                            <td>${valorONulo(element.semestre)}</td>
                            <td>${valorONulo(element.grupo)}</td>
                            <td>${valorONulo(element.motivo)}</td>
                            <td>${formatoFecha(valorONulo(element.FechaBloqueo))}</td>
                            <td>${formatoFecha(valorONulo(element.FechaDesbloqueo))}</td>
                            <td>
                                <a class='delete-icon'>
                                    <i class='fa-solid fa-lock' onclick='desbloquear(${element.idBlocked})'></i>
                                </a>
                            </td>
                        </tr>`;
                                });

                                document.getElementById('search').value = '';
                                body.innerHTML = text;


                            } else {
                                alert('Error');
                            }
                        }
                    });
                    return;
                }
            },
            error: function(result) {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "Error al verificar el bloqueo",
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });

        document.getElementById('search').value = '';
        //closepanel();
        closeModal2();
    }


    function verificarSiYaEsta() {
        // var noCuenta = document.getElementById('NCuenta').innerText;
        var noCuenta = document.getElementById("new-account-name").value;

        $.ajax({
            url: '/Bib/public/VerificarBloqueo',
            type: 'POST',
            data: {
                "NoCuenta": noCuenta
            },
            success: function(result) {
                result = JSON.parse(result);
                var size = result.length;
                if (size === 0) {
                    Buscar();
                } else {
                    Swal.fire({
                        position: "center",
                        icon: "error",
                        title: "Cuenta bloqueada",
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            }
        });

    }


    function buscadorPro() {
        var busqueda = document.getElementById('search').value;
        // console.log(busqueda);
        $.ajax({
            url: "/Bib/public/busquedaSuperBlo",
            type: 'POST',
            data: {
                "busqueda": busqueda
            },

            success: function(response) {
                var res = JSON.parse(response);
                var content = document.getElementById('content-table');
                content.innerHTML = ''; // Limpiar el contenido existente

                var body = document.getElementById('content-table');
                body.innerHTML = '';

                res.forEach(element => {
                    body.innerHTML +=
                        `<tr>
                            <td>${valorONulo(element.NoCuenta)}</td>
                            <td>${valorONulo(element.Nombre)}</td>
                            <td>${valorONulo(element.area)}</td>
                            <td>${valorONulo(element.semestre)}</td>
                            <td>${valorONulo(element.grupo)}</td>
                            <td>${valorONulo(element.motivo)}</td>
                            <td>${formatoFecha(valorONulo(element.FechaBloqueo))}</td>
                            <td>${formatoFecha(valorONulo(element.FechaDesbloqueo))}</td>
                            <td>
                                <a class='delete-icon'>
                                    <i class='fa-solid fa-lock' onclick='desbloquear(${element.idBlocked})'></i>
                                </a>
                            </td>
                        </tr>`;

                });
            }
        });
    }

    function valorONulo(valor, predeterminado = '') {
        return valor === null ? predeterminado : valor;
    }


    function formatoFecha(fecha) {
        if (!fecha) return ""; // Si la fecha es nula o indefinida, retornamos una cadena vacía

        // Convertimos la fecha a un objeto Date
        let fechaObj = new Date(fecha);

        // Ajustamos la fecha restando un día
        fechaObj.setDate(fechaObj.getDate() + 1);

        // Obtenemos los componentes de la fecha (día, mes y año)
        let dia = fechaObj.getDate();
        let mes = fechaObj.getMonth() + 1; // Los meses son indexados desde 0
        let año = fechaObj.getFullYear();

        // Agregamos ceros a la izquierda si es necesario
        dia = dia < 10 ? '0' + dia : dia;
        mes = mes < 10 ? '0' + mes : mes;

        // Devolvemos la fecha en el formato deseado
        return dia + '-' + mes + '-' + año;
    }



    document.addEventListener("DOMContentLoaded", function() {
        eliminarRegistros();
    });
    setInterval(eliminarRegistros, 2 * 60 * 1000);

    function eliminarRegistros() {
        $.ajax({
            url: '/Bib/public/desbloquearxDia',
            type: 'POST',
            success: function(response) {
                console.log("Respuesta exitosa de la solicitud AJAX:", response);
                console.log('Entra a eliminar');
                actualizarTabla(response);

            },
            error: function(xhr, status, error) {
                console.error("Error en la solicitud AJAX:", error);
            }
        });
    }


function actualizarTabla(data) {
    var res = JSON.parse(data);
    var body = document.getElementById('content-table');

    // Limpiar el contenido existente antes de agregar nuevos datos
    body.innerHTML = '';

    res.forEach(element => {
        body.innerHTML += `
            <tr>
                <td>${valorONulo(element.NoCuenta)}</td>
                <td>${valorONulo(element.Nombre)}</td>
                <td>${valorONulo(element.area)}</td>
                <td>${valorONulo(element.semestre)}</td>
                <td>${valorONulo(element.grupo)}</td>
                <td>${valorONulo(element.motivo)}</td>
                <td>${formatoFecha(valorONulo(element.FechaBloqueo))}</td>
                <td>${formatoFecha(valorONulo(element.FechaDesbloqueo))}</td>
                <td>
                    <a class='delete-icon'>
                        <i class='fa-solid fa-lock' onclick='desbloquear(${element.idBlocked})'></i>
                    </a>
                </td>
            </tr>`;
    });
}
</script>