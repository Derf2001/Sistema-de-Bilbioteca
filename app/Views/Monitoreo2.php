<?= $layout ?>

<div class="modal3" id="myModal3">
    <div class="modal-content3">
        <span class="close3" onclick="closeModal3()">&times;</span>
        <h2>Seleccione las computadoras</h2>
        <div class="checkbox-grid">
            <label><strong>C-1<br></strong><input type="checkbox" id="C-1" class="checkbox-computadora" alt='1' checked /></label>
            <label><strong>C-2<br></strong><input type="checkbox" id="C-2" class="checkbox-computadora" alt='2' checked /></label>
            <label><strong>C-3<br></strong><input type="checkbox" id="C-3" class="checkbox-computadora" alt='3' checked /></label>
            <label><strong>C-4<br></strong><input type="checkbox" id="C-4" class="checkbox-computadora" alt='4' checked /></label>
            <label><strong>C-5<br></strong><input type="checkbox" id="C-5" class="checkbox-computadora" alt='5' checked /></label>
            <label><strong>C-6<br></strong><input type="checkbox" id="C-6" class="checkbox-computadora" alt='6' checked /></label>
        </div>
        <button onclick="accept3()">Aceptar</button>
        <button onclick="closeModal3()">Cancelar</button>
    </div>
</div>

<section class="cont2">
    <div class="tabla-header">
        <p>Administrador/Monitoreo sala de computo </p>
        <p><strong>Monitoreo sala de computo</strong></p>
        <div class="searchbar">
            <form class="search-form">
                <i class="fas fa-search"></i>
                <input type="text" id="search" placeholder="Buscar..." oninput="buscadorPro()">
            </form>
        </div>
    </div>
    <div class="admin-table">
        <h3>Monitoreo</h3>
        <div class="table-container">
            <table id="admin-table">
                <thead>
                    <tr>
                        <th>Cuenta</th>
                        <th>Nombre</th>
                        <th>Área</th>
                        <th>Cargo</th>
                        <th>Semestre</th>
                        <th>Grupo</th>
                        <th>Asiento</th>
                        <th>Fecha</th>
                        <th>Entrada</th>
                        <th>Salida</th>
                    </tr>
                </thead>
                <tbody id="content-table">
                    <?php foreach ($monitoreo as $monitoreos) :
                        extract($monitoreos);
                        echo "<tr>";
                        echo "<td>$NoCuenta</td>";
                        echo "<td>$nombre_completo</td>";
                        echo "<td>$area</td>";
                        echo "<td>$cargo</td>";
                        echo "<td>$semestre</td>";
                        echo "<td>$grupo</td>";
                        echo "<td>$asiento</td>";
                        echo "<td>$fecha</td>";
                        echo "<td>$hora_entrada</td>";
                        echo "<td>";
                        echo "<a class='edit-icon' onclick=\"elimiAlumno('$NoCuenta')\"><i class='fa-solid fa-right-from-bracket'></i></a>";
                        echo "</td>";
                        echo "</tr>";
                    endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="bottom-button">
        <button id="RGA" onclick="abrirModalRGA()" style="display:block"><strong>Reporte general de
                asistencias</strong></button>
        <a id="Compartir" style="display:none">
            <button onclick="imprimir()" id="new-account-btn"><strong id="pdff">PDF</strong></button>
        </a>
        <button id="EliminarRegistrosBTN" onclick="EliminarRegistros()" style="display:block"><strong>Eliminar
                registros</strong></button>
        <button id="btn-asientos-sala" onclick="openModal3()"><strong>Habilitar/Deshabilitar</strong></button>

        <button id="Eliminar" onclick="Eliminar()" style="display:none"><strong>Eliminar</strong></button>
        <button id="verBotones" onclick="VisualizarBotones()" style="display:none"><strong>Cancelar</strong></button>
        <input type="hidden" name="OcutalBonotes" value="NO" id="OcutalBonotes">
        <input type="hidden" name="ValorF1" value="" id="ValorF1">
        <input type="hidden" name="ValorF2" value="" id="ValorF2">
    </div>
</section>

<!-- <div class="new-modal" id="Modal">

    <h3 style="text-align: center">Buscador avanzado</h3>
    <form class="new-form" onsubmit="return false;" id="newAccountForm">

        <div class="form-group">
            <label for="noCuenta">Número de Cuenta:</label>
            <input type="text" id="NoCuenta" name="NoCuenta"><br>
        </div>

        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" id="Nombre" name="Nombre"><br>
        </div>
        <div class="form-group">
            <label for="area">Área:</label>
            <select id="Area" name="Area">
                <option value=""></option>
                <option value="Licenciatura en Enfermería">Licenciatura en Enfermería</option>
                <option value="Licenciatura en Nutrición">Licenciatura en Nutrición</option>
                <option value="Servicio Social">Servicio Social</option>
                <option value="Curso Propedéutico">Curso Propedéutico</option>
                <option value="Administrativos">Administrativos</option>
                <option value="Intendencia">Intendencia</option>
                <option value="Operativos">Operativos</option>

            </select>
        </div>
        <div class="form-group">
            <label for="Cargo">Cargo:</label>
            <input type="text" id="Cargo" name="Cargo"><br>
        </div>
        <div class="form-group">
            <label for="Semestre">Semestre:</label>
            <select id="Semestre" name="Semestre">
                <option value=""></option>
                <option value="114">114</option>
                <option value="214">214</option>
                <option value="314">314</option>
                <option value="414">414</option>
                <option value="514">514</option>
                <option value="614">614</option>
                <option value="714">714</option>
                <option value="814">814</option>
                <option value="914">914</option>
                <option value="1014">1014</option>
                <option value="115">115</option>
                <option value="215">215</option>
                <option value="315">315</option>
                <option value="415">415</option>
                <option value="515">515</option>
                <option value="615">615</option>
                <option value="715">715</option>
                <option value="815">815</option>
                <option value="915">915</option>
                <option value="1015">1015</option>
            </select>
        </div>
        <div class="form-group">

            <label for="Grupo">Grupo:</label>
            <input type="text" id="Grupo" name="Grupo"><br>
        </div>
        <div class="form-group">
            <label for="Asiento">Asiento:</label>
            <select id="Asiento" name="Asiento">
                <option value=""></option>
                <option value="A1">A1</option>
                <option value="A2">A2</option>
                <option value="A3">A3</option>
                <option value="A4">A4</option>
                <option value="A5">A5</option>
                <option value="A6">A6</option>
                <option value="A7">A7</option>
                <option value="A8">A8</option>
                <option value="A9">A9</option>
                
            </select>
        </div>
        <div class="form-group">
            <label for="Fecha">Fecha:</label>
            <input type="date" id="Fecha" name="Fecha"><br>
        </div>
        <div class="form-group">
            <label for="Fecha">Fecha 2:</label>
            <input type="date" id="Fecha2" name="Fecha2"><br>
        </div>
        <div class="form-group">
            <label for="Hora">Hora:</label>
            <input type="time" id="Hora" name="Hora"><br>
        </div>
        <div class="btns">
            <div class="row">
                <button class="search-btn" type="button" onclick="Buscar()">Buscar</button>
                <button class="cancel-btn" type="button" onclick="CerrarModal()"><strong>Cancelar</strong></button>
            </div>
        </div>
    </form>

</div> -->
<div class="new-modal" id="ModalRGA">

    <h3 style="text-align: center" id="Titulo">Registro General de Asistencias</h3>
    <form class="new-form" onsubmit="return false;" id="newAccountFormRGA">

        <div class="form-group">
            <label for="Fecha">Fecha:</label>
            <input type="date" id="FechaRGA" name="Fecha"><br>
        </div>
        <div class="form-group">
            <label for="Fecha">Fecha 2:</label>
            <input type="date" id="Fecha2RGA" name="Fecha2"><br>
        </div>
        <div class="btns">
            <div class="row">
                <button class="search-btn" type="button" onclick="BuscarRGA()">Buscar</button>
                <button class="cancel-btn" type="button" onclick="CerrarModalRGA()"><strong>Cancelar</strong></button>
            </div>
        </div>
    </form>

</div>
<div id="ConfirmarBorrar" class="modal">
    <P>Eliminar registros</P>
    <br><br>
    <button id="acceptBorrar" onclick="BorrarRegistros()">Aceptar</button>
    <button id="cancelBorrar" onclick="CancelarBorrar()">Cancelar</button>
</div>
<p style="display=none;" id="idpdf" value="0"></p>
<style>
    #ConfirmarBorrar p {
        font-size: 20px;
        margin-bottom: 20px;
        color: white;
    }

    #ConfirmarBorrar button {
        background-color: #3182CE;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        margin-right: 10px;
    }

    #ConfirmarBorrar button:hover {
        background-color: #2d70af;
    }

    #ConfirmarBorrar button:disabled {
        background-color: #cccccc;
        cursor: not-allowed;
    }

    #ConfirmarBorrar .cancel-btn {
        background-color: #f44336;
    }

    /* Dialog */
    #dialog,
    #ConfirmarBorrar {
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
        padding-top: 60px;
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

    #dialog a {
        display: block;
        margin-bottom: 10px;
        padding: 10px;
        text-decoration: none;
        color: #fff;
        background-color: #333;
        border-radius: 6px;
        transition: background-color 0.3s ease;
    }

    #dialog a:hover {
        background-color: #555;
    }


    #dialog a.logo-link {
        background-color: #ffcc00;
        color: #333;
        font-weight: bold;
    }
</style>

<script>
    // Función para abrir el modal con el número de asiento
    function openModal3(seatNumber) {

        var modal = document.getElementById("myModal3");
        modal.style.display = "block";
        // Agrega la clase 'show' para aplicar la transición
        modal.classList.add("show");
        Computadoras();
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
        //const inputSeatValue = document.getElementById("seatNumber3").innerHTML;
        /*alert("Asiento aceptado con información: " + inputSeatValue);*/
        HDComputadoras();
        closeModal3();
    }

    function CancelarBorrar() {
        var modal = document.getElementById('ConfirmarBorrar');
        modal.style.display = 'none';
    }



    var dialog = document.getElementById('dialog');
    var cancel = document.getElementById('cancel');

    cancel.addEventListener('click', function() {
        dialog.style.display = 'none';
    });

    window.addEventListener('click', function(event) {
        if (event.target == document.getElementById('pdff') || event.target == document.getElementById(
                'new-account-btn')) {
            dialog.style.display = 'block';
        } else if (event.target != dialog) {
            dialog.style.display = 'none';
        }
    });

      function imprimir() {
        console.log(document.getElementById("idpdf").value);
        var table = document.getElementById('admin-table');
        var thead = table.getElementsByTagName('thead')[0];
        var tbody = table.getElementsByTagName('tbody')[0];
        console.log(thead);

        var rows = [];
        var columns = "";
        for (var i = 0, row; row = thead.rows[0].cells[i]; i++) {
           // columns.push(row.innerHTML);
           if (i == thead.rows[0].cells.length - 1) {
                columns += row.innerHTML;
            } else {
                columns += row.innerHTML + ",";
            }
          //  columns += row.innerHTML+",";
        }

        for (var i = 0, row; row = tbody.rows[i]; i++) {
            var rowData = [];
            for (var j = 0, col; col = row.cells[j]; j++) {
                rowData.push(col.innerHTML);
            }
            rows.push(rowData);
        }
        var dataString = JSON.stringify(rows);
      
        
        var mapForm = document.createElement("form");
        mapForm.target = "newFormWindow";
        mapForm.method = "POST";
        mapForm.action ='/Bib/public/PDF?idpdf=' + document.getElementById("idpdf").value;// PHP con código para mostrar el PDF
        // Crea los inputs
        var mapInput1 = document.createElement("input");
        var mapInput2 = document.createElement("input");
        mapInput1.type = "text";
        mapInput1.name = "rows";
        mapInput1.value = dataString;
        mapInput2.type = "text";
        mapInput2.name = "columns";
        mapInput2.value = columns;
        mapForm.appendChild(mapInput1);
        mapForm.appendChild(mapInput2);
        // Adiciona form a dom
        document.body.appendChild(mapForm);
        // Abre nueva ventana popup (fullscreen) donde se mostrará la información
        window.open("", "newFormWindow", "height=" + screen.height + ",width=" + screen.width + ",resizable=yes");
        // submit form
        mapForm.submit();
        document.body.removeChild(mapForm);
    }
</script>
<script>
    var cancel = document.getElementById('cancel');
    var confirmModal = document.getElementById('confirmModal');
    var openMainModalBtn = document.getElementById('openMainModalBtn');

    cancel.addEventListener('click', function() {
        dialog.style.display = 'none';
    });


    openMainModalBtn.addEventListener('click', function() {
        dialog.style.display = 'block';
    });
    closeMainModalBtn.addEventListener('click', function() {
        dialog.style.display = 'none';
    });

    window.addEventListener('click', function(event) {
        if (event.target == dialog) {
            dialog.style.display = 'none';
        } else if (event.target == confirmModal) {
            confirmModal.style.display = 'none';
        }
    });
    var datosIniciales = <?php echo json_encode($monitoreo); ?>;

    function Eliminar() {
        ModalConfirmar = document.getElementById('ConfirmarBorrar');
        ModalConfirmar.style.display = 'block';
    }

    function BorrarRegistros() {
        var F1 = document.getElementById("ValorF1");
        var F2 = document.getElementById("ValorF2");
        if (F2.value !== "") {
            $.ajax({

                url: '/Bib/public/Borrar2CamposComputo',
                type: 'POST',
                data: {
                    "PrimeraFecha": F1.value,
                    "SegundaFecha": F2.value
                },
                success: function(result) {
                    result = JSON.parse(result);
                    console.log(result);
                    Swal.fire({
                        position: "center",
                        icon: "info",
                        title: "Registros eliminados",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    var tablaHTML =
                        "<thead><tr><th>Cuenta</th><th>Nombre</th><th>Área</th><th>Cargo</th><th>Semestre</th><th>Grupo</th><th>Asiento</th><th>Fecha</th><th>Entrada</th><th>Salida</th></tr></thead>";
                    tablaHTML += "<tbody  id='content-table'>";
                    for (var i = 0; i < result.length; i++) {
                        tablaHTML += "<tr>";
                        for (var j = 0; j < columnas.length; j++) {

                            var valor = result[i][columnas[j]];
                            if (columnas[j] === "entrada" && valor === null) {
                                valor = "12:00:00"; // Reemplaza "hora_predefinida" con tu valor deseado
                            } else if (j == columnas.length - 1) {
                                tablaHTML += "<td>";
                                tablaHTML += "<a class='edit-icon' onclick=elimiAlumno('" + result[i][columnas[
                                    0]] + "' )><i class='fa-solid fa-right-from-bracket'></i></a>";
                                tablaHTML += "</td>";
                            } else {
                                tablaHTML += "<td>" + (valor !== null ? valor : "") + "</td>";
                            }
                        }
                        tablaHTML += "</tr>";
                    }
                    tablaHTML += "</tbody>";

                    // Inserta la tabla en el elemento con el ID 'tablaBusqueda'
                    var body = document.getElementById('admin-table');
                    body.innerHTML = tablaHTML;
                }
            });
        } else {
            $.ajax({

                url: '/Bib/public/Borrar1CampoComputo',
                type: 'POST',
                data: {
                    "PrimeraFecha": F1.value
                },
                success: function(result) {
                    result = JSON.parse(result);
                    console.log(result);
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Registros eliminados exitosamente",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    var tablaHTML =
                        "<thead><tr><th>Cuenta</th><th>Nombre</th><th>Área</th><th>Cargo</th><th>Semestre</th><th>Grupo</th><th>Asiento</th><th>Fecha</th><th>Entrada</th><th>Salida</th></tr></thead>";
                    tablaHTML += "<tbody  id='content-table'>";
                    for (var i = 0; i < result.length; i++) {
                        tablaHTML += "<tr>";
                        for (var j = 0; j < columnas.length; j++) {

                            var valor = result[i][columnas[j]];
                            if (columnas[j] === "entrada" && valor === null) {
                                valor = "12:00:00"; // Reemplaza "hora_predefinida" con tu valor deseado
                            } else if (j == columnas.length - 1) {
                                tablaHTML += "<td>";
                                tablaHTML += "<a class='edit-icon' onclick=elimiAlumno('" + result[i][columnas[
                                    0]] + "' )><i class='fa-solid fa-right-from-bracket'></i></a>";
                                tablaHTML += "</td>";
                            } else {
                                tablaHTML += "<td>" + (valor !== null ? valor : "") + "</td>";
                            }
                        }
                        tablaHTML += "</tr>";
                    }
                    tablaHTML += "</tbody>";

                    // Inserta la tabla en el elemento con el ID 'tablaBusqueda'
                    var body = document.getElementById('admin-table');
                    body.innerHTML = tablaHTML;
                }
            });
        }
        VisualizarBotones();
        ModalConfirmar = document.getElementById('ConfirmarBorrar');
        ModalConfirmar.style.display = 'none';
    }

    function OcultarBotones() {
	var HD = document.getElementById('btn-asientos-sala');
        HD.style.display = "none";

        var RGA = document.getElementById("RGA");
        var Compartir = document.getElementById("Compartir");
        var EliminarRegistrosBTN = document.getElementById("EliminarRegistrosBTN");
        var Eliminar = document.getElementById("Eliminar");
        var VerBotones = document.getElementById("verBotones");

        RGA.style.display = "none";
        Compartir.style.display = "none";
        EliminarRegistrosBTN.style.display = "none";
        Eliminar.style.display = "block";
        VerBotones.style.display = "block";
    }

    function OcultarBotonesRGA() {
	var HD = document.getElementById('btn-asientos-sala');
        HD.style.display = "none";

        var RGA = document.getElementById("RGA");
        var Compartir = document.getElementById("Compartir");
        var EliminarRegistrosBTN = document.getElementById("EliminarRegistrosBTN");
        var Eliminar = document.getElementById("Eliminar");
        var VerBotones = document.getElementById("verBotones");

        RGA.style.display = "none";
        Compartir.style.display = "block";
        EliminarRegistrosBTN.style.display = "none";
        Eliminar.style.display = "none";
        VerBotones.style.display = "block";
    }

    function VisualizarBotones() {
	hilo();
	var HD = document.getElementById('btn-asientos-sala');
        HD.style.display = "block";

        var RGA = document.getElementById("RGA");
        var Compartir = document.getElementById("Compartir");
        var EliminarRegistrosBTN = document.getElementById("EliminarRegistrosBTN");
        var Eliminar = document.getElementById("Eliminar");
        var VerBotones = document.getElementById("verBotones");

        RGA.style.display = "block";
        Compartir.style.display = "none";
        EliminarRegistrosBTN.style.display = "block";
        Eliminar.style.display = "none";
        VerBotones.style.display = "none";
        $.ajax({

            url: '/Bib/public/MostrarMonitoreoComputo',
            type: 'POST',
            data: {},
            success: function(result) {
                result = JSON.parse(result);
                console.log(result);
                if (result.length == 0) {
                    var tablaHTML =
                        "<thead><tr><th>Cuenta</th><th>Nombre</th><th>Área</th><th>Cargo</th><th>Semestre</th><th>Grupo</th><th>Asiento</th><th>Fecha</th><th>Entrada</th><th>Salida</th></tr></thead>";
                    tablaHTML += "<tbody  id='content-table'>";
                    tablaHTML += "</tbody>";
                    var body = document.getElementById('admin-table');
                    body.innerHTML = tablaHTML;
                } else if (result.lenght != 0) {
                    var columnas = Object.keys(result[0]);
                    var tablaHTML =
                        "<thead><tr><th>Cuenta</th><th>Nombre</th><th>Área</th><th>Cargo</th><th>Semestre</th><th>Grupo</th><th>Asiento</th><th>Fecha</th><th>Entrada</th><th>Salida</th></tr></thead>";
                    tablaHTML += "<tbody  id='content-table'>";
                    for (var i = 0; i < result.length; i++) {
                        tablaHTML += "<tr>";
                        for (var j = 0; j < columnas.length; j++) {

                            var valor = result[i][columnas[j]];
                            if (j == columnas.length - 1) {
                                tablaHTML += "<td>";
                                tablaHTML += "<a class='edit-icon' onclick=elimiAlumno('" + result[i][columnas[
                                    0]] + "')><i class='fa-solid fa-right-from-bracket'></i></a>";
                                tablaHTML += "</td>";
                            } else {
                                tablaHTML += "<td>" + (valor !== null ? valor : "") + "</td>";
                            }
                        }
                        tablaHTML += "</tr>";
                    }
                    tablaHTML += "</tbody>";
                    var body = document.getElementById('admin-table');
                    body.innerHTML = tablaHTML;
                } else {
                    alert('Error');
                }
            }
        });

    }
</script>
<script>
    function EliminarRegistros() {
        abrirModalRGA();
        var body = document.getElementById('Titulo');
        body.innerHTML = "Borrar registros";

        var Aux = document.getElementById("OcutalBonotes");
        Aux.value = "SI";
    }

    function BuscarRGA() {
	detenerHilo();
        var Aux = document.getElementById("OcutalBonotes").value;
        console.log(Aux);
        var fechaInicial = document.getElementById('FechaRGA').value;
        var fechaPosterior = document.getElementById('Fecha2RGA').value;
        if (fechaInicial === "" && fechaPosterior === "") {
            Swal.fire({
                position: "center",
                icon: "info",
                title: "Agregar datos para poder buscar",
                showConfirmButton: false,
                timer: 1500
            });
        }
        var fechaObj = new Date(fechaInicial);
        var fechaUnix = Math.floor(fechaObj.getTime() / 1000);
        fechaInicial = fechaUnix;


        var F1 = document.getElementById('ValorF1');
        var F2 = document.getElementById('ValorF2');


        if (fechaPosterior !== "") {
            fechaObj = new Date(fechaPosterior);
            fechaUnix = Math.floor(fechaObj.getTime() / 1000);
            fechaUnix += (24 * 3600)
            fechaPosterior = fechaUnix;

            F1.value = fechaInicial;
            F2.value = fechaPosterior;

            $.ajax({

                url: '/Bib/public/BusquedaRGA2CamposComputo',
                type: 'POST',
                data: {
                    "PrimeraFecha": fechaInicial,
                    "SegundaFecha": fechaPosterior
                },
                success: function(result) {
                    result = JSON.parse(result);
                    console.log(result);
                    if (result.length == 0) {
                        Swal.fire({
                            position: "center",
                            icon: "info",
                            title: "No se encontraron registros",
                            showConfirmButton: false,
                            timer: 1500
                        });


                    } else if (result.lenght != 0) {
                        formulario.reset();

                        if (Aux === "SI") {
                            OcultarBotones();
                            var boton2 = document.getElementById("new-account-btn");
                            boton2.style.display = "none";
                        } else {
                            OcultarBotonesRGA();
                            var boton2 = document.getElementById("new-account-btn");
                            boton2.style.display = "block";
                        }

                        //para el pdf
                        document.getElementById("idpdf").value = 1;

                        console.log(document.getElementById("idpdf").value);

                        var colu
                        var columnas = Object.keys(result[0]);

                        // Crea la cabecera de la tabla
                        var tablaHTML = "<thead><tr>";
                        for (var i = 0; i < columnas.length; i++) {

                            tablaHTML += "<th>" + columnas[i] + "</th>";


                        }
                        tablaHTML += "</tr></thead>";

                        // Crea el cuerpo de la tabla
                        tablaHTML += "<tbody  id='content-table'>";
                        for (var i = 0; i < result.length; i++) {
                            tablaHTML += "<tr>";
                            for (var j = 0; j < columnas.length; j++) {

                                var valor = result[i][columnas[j]];
                                tablaHTML += "<td>" + (valor !== null ? valor : "") + "</td>";

                            }
                            tablaHTML += "</tr>";
                        }
                        tablaHTML += "</tbody>";

                        // Inserta la tabla en el elemento con el ID 'tablaBusqueda'
                        var body = document.getElementById('admin-table');
                        body.innerHTML = tablaHTML;

                        var boton2 = document.getElementById("Compartir");
                        boton2.style.display = "block";
                        var boton22 = document.getElementById("verBotones");
                        boton22.style.display = "block";
                    } else {
                        alert('Error');
                    }
                }
            });
        } else {
            F1.value = fechaInicial;
            F2.value = "";
            $.ajax({

                url: '/Bib/public/BusquedaRGAComputo',
                type: 'POST',
                data: {
                    "PrimeraFecha": fechaInicial
                },
                success: function(result) {
                    result = JSON.parse(result);
                    console.log(result);
                    if (result.length == 0) {
                        Swal.fire({
                            position: "center",
                            icon: "info",
                            title: "No se encontraron registros",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    } else if (result.lenght != 0) {
                        formulario.reset();

                        //para el pdf
                        document.getElementById("idpdf").value = 1;

                        console.log(document.getElementById("idpdf").value);
                        if (Aux === "SI") {
                            OcultarBotones();
                            var boton2 = document.getElementById("new-account-btn");
                            boton2.style.display = "none";
                        } else {
                            OcultarBotonesRGA();
                            var boton2 = document.getElementById("new-account-btn");
                            boton2.style.display = "block";
                        }
                        var columnas = Object.keys(result[0]);
                        var tablaHTML = "<thead><tr>";
                        for (var i = 0; i < columnas.length; i++) {

                            tablaHTML += "<th>" + columnas[i] + "</th>";
                        }
                        tablaHTML += "</tr></thead>";
                        tablaHTML += "<tbody  id='content-table'>";
                        for (var i = 0; i < result.length; i++) {
                            tablaHTML += "<tr>";
                            for (var j = 0; j < columnas.length; j++) {

                                var valor = result[i][columnas[j]];
                                tablaHTML += "<td>" + (valor !== null ? valor : "") + "</td>";

                            }
                            tablaHTML += "</tr>";
                        }
                        tablaHTML += "</tbody>";
                        var body = document.getElementById('admin-table');
                        body.innerHTML = tablaHTML;
                        var boton22 = document.getElementById("verBotones");
                        boton22.style.display = "block";
                    } else {
                        alert('Error');
                    }
                }
            });
        }
        var formulario = document.getElementById('newAccountFormRGA');

        // Resetea el formulario


        CerrarModalRGA();
    }

    function abrirModalRGA() {
        var body = document.getElementById('Titulo');
        body.innerHTML = "Registro general de asistencias";
        // Agrega la clase 'active' al modal
        document.getElementById('ModalRGA').classList.add('show');

        var Aux = document.getElementById("OcutalBonotes");
        Aux.value = "NO";
    }

    function CerrarModalRGA() {
        // Agrega la clase 'active' al modal
        document.getElementById('ModalRGA').classList.remove('show');

    }
</script>
<script>
    function elimiAlumno(id) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Cancelar',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, Salir!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/Bib/public/dropSalaComputo',
                    type: 'POST',
                    data: {
                        "id": id
                    },
                    success: function(result) {
                        //console.log(result);
                        result = JSON.parse(result);

                        console.log(result != null);

                        if (result != null) {
                            Swal.fire({
                                position: "center",
                                icon: "success",
                                title: "¡Expulsado!",
                                showConfirmButton: false,
                                timer: 1500,
                                timerProgressBar: true // Esto muestra una barra de progreso durante el temporizador
                            });

                        } else {
                            Swal.fire(
                                '¡Error!',
                                'El registro no ha sido eliminado.',
                                'error'
                            );
                        }
                    }
                });
            }
        });
    }

    function Computadoras() {
        $.ajax({
            url: '/Bib/public/ObtenerAsientos2',
            type: 'GET',
            success: function(response) {
                var asientos = JSON.parse(response);

                asientos.forEach(function(asientos) {
                    console.log(asientos.Asiento)
                    var checkboxId = 'C-' + asientos.Asiento.substr(2); // Obtener el ID del checkbox
                    if (['C-1', 'C-2', 'C-3', 'C-4', 'C-5', 'C-6'].includes(asientos.Asiento) && ['1', '2', '3', '4', '5', '6'].includes(asientos.NoCuenta)) {
                        console.log("Bloqueados");
                        // Desmarcar el checkbox correspondiente
                        $('#' + checkboxId).prop('checked', false);
                    }
                });


            },
            error: function(xhr, status, error) {
                console.error("Error en la solicitud AJAX:", error);
            }
        });
    }

    function HDComputadoras() {
        var checkboxesMarcados = $('.checkbox-computadora:not(:checked)');
        var checkboxesMarcados2 = $('.checkbox-computadora:checked');
        console.log('Número de checkboxes no marcados: ' + checkboxesMarcados.length);
        console.log('Número de checkboxes marcados: ' + checkboxesMarcados2.length);
        var ids = [],
            ids2 = [];
        var alts = [],
            alts2 = [];
        checkboxesMarcados.each(function(index, checkbox) {
            var id = $(checkbox).attr('id');
            var alt = $(checkbox).attr('alt');
            console.log('Checkbox no marcado: ' + id);
            ids.push(id);
            alts.push(alt);
            /*console.log(ids);
            console.log(alts);*/
        });
        i = 0;
        checkboxesMarcados2.each(function(index, checkbox) {
            var id = $(checkbox).attr('id');
            var alt = $(checkbox).attr('alt');
            console.log('Checkbox marcado: ' + alt);
            ids2.push(id);
            alts2.push(alt);
            i++;
            //console.log(ids2);
            //console.log(alts2);
        })

        var asientos2 = [];
        var cuentas = [];

        $.ajax({
            url: '/Bib/public/ObtenerAsientos2',
            type: 'GET',
            success: function(response) {
                var asientos = JSON.parse(response);

                asientos.forEach(function(asientos) {
                    asientos2.push(asientos.Asiento);
                    cuentas.push(asientos.NoCuenta);
                    console.log(asientos2);
                });

                var elementosNoCoincidentes = ids.filter(function(elemento) {
                    return !asientos2.includes(elemento);
                });

                elementosNoCoincidentes.forEach(function(item) {
                    $.ajax({
                        url: '/Bib/public/AgregarAsiento2',
                        type: 'POST',
                        data: {
                            "NoCuenta": parseInt(item.substr(2), 10),
                            "asiento": item,
                        },
                        success: function(result) {
                            Swal.fire({
                                position: "center",
                                icon: "success",
                                title: "Computadoras actualizadas",
                                showConfirmButton: false,
                                timer: 1500
                            });
                        },
                        error: function(xhr, status, error) {
                            alert('Error en la base de datos');
                        }
                    });
                });

                var elementosComunes = alts2.filter(function(elemento) {
                    return cuentas.includes(elemento);
                });


                console.log("Elementos comunes entre cuentas y alts2:", elementosComunes);
                elementosComunes.forEach(function(item) {
                    var as = "C-" + item;
                    $.ajax({
                        url: '/Bib/public/BorrarRegistro2',
                        type: 'POST',
                        data: {
                            "NoCuenta": item,
                            "asiento": as,
                        },
                        success: function(result) {
                            Swal.fire({
                                position: "center",
                                icon: "success",
                                title: "Computadoras actualizadas",
                                showConfirmButton: false,
                                timer: 1500
                            });

                        },
                        error: function(xhr, status, error) {
                            alert('Error en la base de datos');
                        }
                    });
                    //console.log("cuentas " + item);
                });
            },
            error: function(xhr, status, error) {
                console.error("Error en la solicitud AJAX:", error);
            }
        });


    }
</script>

<script src="<?= base_url("js/search-monitoreoComputo.js") ?>"></script>
<?= $layout_js ?>