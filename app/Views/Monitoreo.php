<?= $layout ?>

<section class="cont2">
    <div class="tabla-header">
        <p>Administrador/Monitoreo sala de estudios</p>
        <p><strong>Monitoreo sala de estudios</strong></p>
        <div class="searchbar">
            <form class="search-form" onsubmit="return false;">
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
                    <?php foreach ($monitoreo as $monitoreos):
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
        <button id="BusquedaAvanzada" onclick="abrirModal()" style="display:block"><strong>Buscador
                avanzado</strong></button>
        <button id="RGA" onclick="abrirModalRGA()" style="display:block"><strong>Reporte general de
                asistencias</strong></button>
        <a id="Compartir" style="display:none">
            <button onclick="imprimir()" id="new-account-btn"><strong id="pdff">PDF</strong></button>
        </a>
        <button id="EliminarRegistrosBTN" onclick="EliminarRegistros()" style="display:block"><strong>Eliminar
                registros</strong></button>

        <button id="Eliminar" onclick="Eliminar()" style="display:none"><strong>Eliminar</strong></button>
        <button id="verBotones" onclick="VisualizarBotones()" style="display:none"><strong>Cancelar</strong></button>
        <input type="hidden" name="OcutalBonotes" value="NO" id="OcutalBonotes">
        <input type="hidden" name="ValorF1" value="" id="ValorF1">
        <input type="hidden" name="ValorF2" value="" id="ValorF2">
    </div>
</section>

<div class="new-modal" id="Modal">

    <h3 style="text-align: center">Buscador avanzado</h3>
    <form class="new-form" onsubmit="return false;" id="newAccountForm">

        <div class="form-group">
            <label for="noCuenta">Número de cuenta:</label>
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
                <option value="enfermería">Licenciatura en enfermería</option>
                <option value="nutrición">Licenciatura en nutrición</option>
                <option value="Servicio social">Servicio social</option>
                <option value="Curso propedéutico">Curso propedéutico</option>
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
            <!-- <input type="text" id="Semestre" name="Semestre"><br> -->
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
            <!-- <input type="text" id="Asiento" name="Asiento"><br> -->
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
                <option value="A10">A10</option>
                <option value="A11">A11</option>
                <option value="A12">A12</option>
                <option value="A13">A13</option>
                <option value="A14">A14</option>
                <option value="A15">A15</option>
                <option value="A16">A16</option>
                <option value="A17">A17</option>
                <option value="A18">A18</option>
                <option value="A19">A19</option>
                <option value="A20">A20</option>
                <option value="B1">B1</option>
                <option value="B2">B2</option>
                <option value="B3">B3</option>
                <option value="B4">B4</option>
                <option value="B5">B5</option>
                <option value="B6">B6</option>
                <option value="B7">B7</option>
                <option value="B8">B8</option>
                <option value="B9">B9</option>
                <option value="B10">B10</option>
                <option value="B11">B11</option>
                <option value="B12">B12</option>
                <option value="B13">B13</option>
                <option value="B14">B14</option>
                <option value="B15">B15</option>
                <option value="B16">B16</option>
                <option value="B17">B17</option>
                <option value="B18">B18</option>
                <option value="B19">B19</option>
                <option value="B20">B20</option>
                <option value="C1">C1</option>
                <option value="C2">C2</option>
                <option value="C3">C3</option>
                <option value="C4">C4</option>
                <option value="C5">C5</option>
                <option value="C6">C6</option>
                <option value="C7">C7</option>
                <option value="C8">C8</option>
                <option value="C9">C9</option>
                <option value="C10">C10</option>
                <option value="C11">C11</option>
                <option value="C12">C12</option>
                <option value="C13">C13</option>
                <option value="C14">C14</option>
                <option value="C15">C15</option>
                <option value="C16">C16</option>
                <option value="C17">C17</option>
                <option value="C18">C18</option>
                <option value="C19">C19</option>
                <option value="C20">C20</option>
                <option value="D1">D1</option>
                <option value="D2">D2</option>
                <option value="D3">D3</option>
                <option value="D4">D4</option>
                <option value="D5">D5</option>
                <option value="D6">D6</option>
                <option value="D7">D7</option>
                <option value="D8">D8</option>
                <option value="D9">D9</option>
                <option value="D10">D10</option>
                <option value="D11">D11</option>
                <option value="D12">D12</option>
                <option value="D13">D13</option>
                <option value="D14">D14</option>
                <option value="D15">D15</option>
                <option value="D16">D16</option>
                <option value="D17">D17</option>
                <option value="D18">D18</option>
                <option value="D19">D19</option>
                <option value="D20">D20</option>
                <option value="E1">E1</option>
                <option value="E2">E2</option>
                <option value="E3">E3</option>
                <option value="E4">E4</option>
                <option value="E5">E5</option>
                <option value="E6">E6</option>
                <option value="E7">E7</option>
                <option value="E8">E8</option>
                <option value="E9">E9</option>
                <option value="E10">E10</option>
                <option value="E11">E11</option>
                <option value="E12">E12</option>
                <option value="E13">E13</option>
                <option value="E14">E14</option>
                <option value="E15">E15</option>
                <option value="E16">E16</option>
                <option value="E17">E17</option>
                <option value="E18">E18</option>
                <option value="E19">E19</option>
                <option value="E20">E20</option>
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

</div>
<div class="new-modal" id="ModalRGA">

    <h3 style="text-align: center" id="Titulo">Registro general de asistencias</h3>
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
<p style="display:none;" id="idpdf" value="0"></p>
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
    function CancelarBorrar() {
        var modal = document.getElementById('ConfirmarBorrar');
        modal.style.display = 'none';
    }



    var dialog = document.getElementById('dialog');
    var cancel = document.getElementById('cancel');

    cancel.addEventListener('click', function () {
        dialog.style.display = 'none';
    });

    window.addEventListener('click', function (event) {
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
        var mapInput3 = document.createElement("input");
        mapInput1.type = "text";
        mapInput1.name = "rows";
        mapInput1.value = dataString;
        mapInput2.type = "text";
        mapInput2.name = "columns";
        mapInput2.value = columns;
        mapInput3.type = "text";
        mapInput3.name = "sala";
        mapInput3.value = 1;
        mapForm.appendChild(mapInput1);
        mapForm.appendChild(mapInput2);
        mapForm.appendChild(mapInput3);
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

    cancel.addEventListener('click', function () {
        dialog.style.display = 'none';
    });


    openMainModalBtn.addEventListener('click', function () {
        dialog.style.display = 'block';
    });

    closeMainModalBtn.addEventListener('click', function () {
        dialog.style.display = 'none';
    });

    window.addEventListener('click', function (event) {
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

                url: '/Bib/public/Borrar2Campos',
                type: 'POST',
                data: {
                    "PrimeraFecha": F1.value,
                    "SegundaFecha": F2.value
                },
                success: function (result) {
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

                url: '/Bib/public/Borrar1Campo',
                type: 'POST',
                data: {
                    "PrimeraFecha": F1.value
                },
                success: function (result) {
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
        var BusquedaAvanzada = document.getElementById("BusquedaAvanzada");
        var RGA = document.getElementById("RGA");
        var Compartir = document.getElementById("Compartir");
        var EliminarRegistrosBTN = document.getElementById("EliminarRegistrosBTN");
        var Eliminar = document.getElementById("Eliminar");
        var VerBotones = document.getElementById("verBotones");

        BusquedaAvanzada.style.display = "none";
        RGA.style.display = "none";
        Compartir.style.display = "none";
        EliminarRegistrosBTN.style.display = "none";
        Eliminar.style.display = "block";
        VerBotones.style.display = "block";
    }

    function OcultarBotonesRGA() {
        var BusquedaAvanzada = document.getElementById("BusquedaAvanzada");
        var RGA = document.getElementById("RGA");
        var Compartir = document.getElementById("Compartir");
        var EliminarRegistrosBTN = document.getElementById("EliminarRegistrosBTN");
        var Eliminar = document.getElementById("Eliminar");
        var VerBotones = document.getElementById("verBotones");

        BusquedaAvanzada.style.display = "none";
        RGA.style.display = "none";
        Compartir.style.display = "block";
        EliminarRegistrosBTN.style.display = "none";
        Eliminar.style.display = "none";
        VerBotones.style.display = "block";
    }

    function VisualizarBotones() {
	hilo();
        var BusquedaAvanzada = document.getElementById("BusquedaAvanzada");
        var RGA = document.getElementById("RGA");
        var Compartir = document.getElementById("Compartir");
        var EliminarRegistrosBTN = document.getElementById("EliminarRegistrosBTN");
        var Eliminar = document.getElementById("Eliminar");
        var VerBotones = document.getElementById("verBotones");

        BusquedaAvanzada.style.display = "block";
        RGA.style.display = "block";
        Compartir.style.display = "none";
        EliminarRegistrosBTN.style.display = "block";
        Eliminar.style.display = "none";
        VerBotones.style.display = "none";
        $.ajax({

            url: '/Bib/public/MostrarMonitoreo',
            type: 'POST',
            data: {},
            success: function (result) {
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
                            //tablaHTML += "<td>" + (valor !== null ? valor : "") + "</td>";
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
    function Buscar() {
	detenerHilo();
	document.getElementById("idpdf").value = 0;
        var campos = ["NoCuenta", "Nombre", "Area", "Cargo", "Semestre", "Grupo", "Asiento", "Fecha", "Hora"];
        var camposBD = ["r.NoCuenta", "Nombre", "u.area", "p.cargo", "a.semestre", "a.grupo", "r.asiento", "r.salida", "r.salida"];
        var columnaGuia;
        var valorColumna;
        var segundoCampo;
        var segundaFecha = 0;
        var comprovadorVacio = true;
        var condiciones = '';
        var CondicionesFecha = '';
        var Bandera2Fechas = false;
        for (var i = 0; i < campos.length; i++) {
            var campo = campos[i];
            var valorCampo = document.getElementById(campo).value;
            if (valorCampo !== "") {
                columnaGuia = campo;
                valorColumna = valorCampo;
                comprovadorVacio = false;
                
                break;
            }
        }
        // Auxiliar busqueda multiple
        var auxFecha = '';
        for (var i = 0; i < campos.length; i++) {
            var campo = campos[i];
            var valorCampo = document.getElementById(campo).value;
            if (valorCampo !== "" && campo=="Fecha") {
                auxFecha = 'Fecha';
                break;
            }
        }

        if (comprovadorVacio == true) {
            Swal.fire({
                position: "center",
                icon: "info",
                title: "Agregar datos para poder buscar",
                showConfirmButton: false,
                timer: 1500
            });
        }
        // if (columnaGuia == 'Fecha') {
        //     // // console.log(valorColumna);
        //     var fechaObj = new Date(valorColumna);
        //     var fechaUnix = Math.floor(fechaObj.getTime() / 1000);
        //     console.log("Fecha en formato UNIX:", fechaUnix);
        //     valorColumna = fechaUnix;


        //     var valorCampo = document.getElementById('Fecha2').value;
        //     console.log("fecha 2:" + valorCampo);
        //     if (valorCampo !== "") {
        //         segundoCampo = true;
        //         var fechaObj = new Date(valorCampo);
        //         var fechaUnix = Math.floor(fechaObj.getTime() / 1000);
        //         fechaUnix += (24 * 3600)
        //         console.log("Fecha en formato UNIX:", fechaUnix);
        //         segundaFecha = fechaUnix;
        //     }

        // }
        if (columnaGuia == 'Fecha' || auxFecha == 'Fecha') {
            // // console.log(valorColumna);
            var valorCampo = document.getElementById('Fecha').value;
            valorColumna = valorCampo;
            var fechaObj = new Date(valorColumna);
            var fechaUnix = Math.floor(fechaObj.getTime() / 1000);
            console.log("Fecha en formato UNIX:", fechaUnix);
            valorColumna = fechaUnix;
            
            var fechaExtra = fechaObj.toISOString().slice(0, 10);
            // console.log(fechaExtra);

            CondicionesFecha = ` DATE(FROM_UNIXTIME(r.entrada)) = '${fechaExtra}' AND `;
            var valorCampo = document.getElementById('Fecha2').value;
            console.log("fecha 2:" + valorCampo);
            if (valorCampo !== "") {
                segundoCampo = true;
                var fechaObj = new Date(valorCampo);
                var fechaUnix = Math.floor(fechaObj.getTime() / 1000);
                fechaUnix += (24 * 3600)
                console.log("Fecha en formato UNIX:", fechaUnix);
                segundaFecha = fechaUnix;
                CondicionesFecha = `r.entrada between  '${valorColumna}' and '${segundaFecha}' AND `;
                Bandera2Fechas = true;
            }
        }
        // if (columnaGuia == 'Hora') {
        //     var horaInput = document.getElementById(columnaGuia).value;

        //     // Obtener la fecha actual
        //     var fechaActual = new Date();

        //     // Establecer la hora desde el campo de entrada
        //     fechaActual.setHours(parseInt(horaInput.split(':')[0], 10));
        //     fechaActual.setMinutes(parseInt(horaInput.split(':')[1], 10));
        //     fechaActual.setSeconds(0);

        //     console.log("Hora en formato UNIX:", valorColumna);
        //     // Obtener el tiempo en milisegundos y convertirlo a segundos (formato UNIX)
        //     var horaUnix = Math.floor(fechaActual.getTime() / 1000);

        //     // Mostrar el resultado en la consola (puedes hacer lo que desees con este valor)
        //     valorColumna = horaUnix;
        // }

        if (columnaGuia == 'Hora') {
            var horaInput = document.getElementById(columnaGuia).value;

            // Obtener la fecha actual
            var fechaActual = new Date();

            // Establecer la hora desde el campo de entrada
            fechaActual.setHours(parseInt(horaInput.split(':')[0], 10));
            fechaActual.setMinutes(parseInt(horaInput.split(':')[1], 10));
            fechaActual.setSeconds(0);

            console.log("Hora en formato UNIX:", valorColumna);
            // Obtener el tiempo en milisegundos y convertirlo a segundos (formato UNIX)
            var horaUnix = Math.floor(fechaActual.getTime() / 1000);

            // Mostrar el resultado en la consola (puedes hacer lo que desees con este valor)
            valorColumna = horaUnix;
        }


        for (var i = 0; i < campos.length; i++) {
            var campo = campos[i];
            var valorCampo = document.getElementById(campo).value;
            if (valorCampo !== "") {
                if(Bandera2Fechas = true && campo == 'Fecha'){
                    // console.log(CondicionesFecha);
                    condiciones += CondicionesFecha;
                }else if(Bandera2Fechas = false && campo == 'Fecha'){
                    // console.log(CondicionesFecha);
                    condiciones += CondicionesFecha;
                }else if(campo == 'Hora'){
                    condiciones +=  `HOUR(FROM_UNIXTIME(r.entrada)) = '${valorCampo}' AND`;
                }else if(campo == 'Asiento'){
                    var campoBD = camposBD[i];
                    condiciones += `${campoBD} LIKE '${valorCampo}' AND `;
                }else{
                    var campoBD = camposBD[i];
                    condiciones += `${campoBD} LIKE '%${valorCampo}%' AND `;
                }
            }
        }
        console.log(condiciones);
        console.log(condiciones);
        var Event = []
        Event.push(columnaGuia);
        Event.push(valorColumna);
        Event.push('Fecha2');
        Event.push(segundaFecha);
        Event.push(condiciones);
        // console.log(condiciones);
        // console.log(Event);
        $.ajax({

            url: '/Bib/public/Busqueda',
            type: 'POST',
            data: {
                "NombreColumna": Event[0],
                "ValorColumna": Event[1],
                "Consulta2Fechas": Event[2],
                "SegundaFecha": Event[3],
                "Condiciones": Event[4]
            },
            success: function (result) {
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

                    //para el pdf
                   // document.getElementById("idpdf").value = 0;

                    var columnas = Object.keys(result[0]);

                    // Crea la cabecera de la tabla
                    var tablaHTML = "<thead><tr>";
                    for (var i = 0; i < columnas.length; i++) {
                        if (i == 0) {

                            tablaHTML += "<th style= 'color: green'>" + columnas[i] + "</th>";
                        } else {
                            tablaHTML += "<th>" + columnas[i] + "</th>";
                        }

                    }
                    tablaHTML += "</tr></thead>";

                    // Crea el cuerpo de la tabla
                    tablaHTML += "<tbody  id='content-table'>";
                    for (var i = 0; i < result.length; i++) {
                        tablaHTML += "<tr>";
                        for (var j = 0; j < columnas.length; j++) {
                            if (j == 0) {
                                tablaHTML += "<td style= 'color: green' >" + result[i][columnas[j]] + "</td>";
                            } else {
                                var valor = result[i][columnas[j]];
                                tablaHTML += "<td>" + (valor !== null ? valor : "") + "</td>";
                            }
                        }
                        tablaHTML += "</tr>";
                    }
                    tablaHTML += "</tbody>";

                    // Inserta la tabla en el elemento con el ID 'tablaBusqueda'
                    var body = document.getElementById('admin-table');
                    body.innerHTML = tablaHTML;
                    OcultarBotonesRGA();
                } else {
                    alert('Error');
                }
            }
        });

        var formulario = document.getElementById('newAccountForm');


        // Resetea el formulario
        formulario.reset();
        CerrarModal()
    }
    // function Buscar() {
	// document.getElementById("idpdf").value = 0;
    //     var campos = ["NoCuenta", "Nombre", "Area", "Cargo", "Semestre", "Grupo", "Asiento", "Fecha", "Hora"];
    //     var camposBD = ["r.NoCuenta", "u.Nombre", "u.area", "p.cargo", "a.semestre", "a.grupo", "r.asiento", "r.salida", "r.salida"];
    //     var columnaGuia;
    //     var valorColumna;
    //     var segundoCampo;
    //     var segundaFecha = 0;
    //     var comprovadorVacio = true;
    //     var condiciones = '';
    //     var CondicionesFecha = '';
    //     var Bandera2Fechas = false;
    //     for (var i = 0; i < campos.length; i++) {
    //         var campo = campos[i];
    //         var valorCampo = document.getElementById(campo).value;
    //         if (valorCampo !== "") {
    //             columnaGuia = campo;
    //             valorColumna = valorCampo;
    //             comprovadorVacio = false;
                
    //             break;
    //         }
    //     }
    //     // Auxiliar busqueda multiple
    //     var auxFecha = '';
    //     for (var i = 0; i < campos.length; i++) {
    //         var campo = campos[i];
    //         var valorCampo = document.getElementById(campo).value;
    //         if (valorCampo !== "" && campo=="Fecha") {
    //             auxFecha = 'Fecha';
    //             break;
    //         }
    //     }
    //     // console.log(auxFecha);

    //     if (comprovadorVacio == true) {
    //         Swal.fire({
    //             position: "center",
    //             icon: "info",
    //             title: "Agregar datos para poder buscar",
    //             showConfirmButton: false,
    //             timer: 1500
    //         });
    //     }
    //     if (columnaGuia == 'Fecha' || auxFecha == 'Fecha') {
    //         // // console.log(valorColumna);
    //         var valorCampo = document.getElementById('Fecha').value;
    //         valorColumna = valorCampo;
    //         var fechaObj = new Date(valorColumna);
    //         var fechaUnix = Math.floor(fechaObj.getTime() / 1000);
    //         console.log("Fecha en formato UNIX:", fechaUnix);
    //         valorColumna = fechaUnix;
            
    //         var fechaExtra = fechaObj.toISOString().slice(0, 10);
    //         // console.log(fechaExtra);

    //         CondicionesFecha = ` DATE(FROM_UNIXTIME(r.entrada)) = '${fechaExtra}' AND `;
    //         var valorCampo = document.getElementById('Fecha2').value;
    //         console.log("fecha 2:" + valorCampo);
    //         if (valorCampo !== "") {
    //             segundoCampo = true;
    //             var fechaObj = new Date(valorCampo);
    //             var fechaUnix = Math.floor(fechaObj.getTime() / 1000);
    //             fechaUnix += (24 * 3600)
    //             console.log("Fecha en formato UNIX:", fechaUnix);
    //             segundaFecha = fechaUnix;
    //             CondicionesFecha = `r.entrada between  '${valorColumna}' and '${segundaFecha}' AND `;
    //             Bandera2Fechas = true;
    //         }



    //     }

    //     if (columnaGuia == 'Hora') {
    //         var horaInput = document.getElementById(columnaGuia).value;

    //         // Obtener la fecha actual
    //         var fechaActual = new Date();

    //         // Establecer la hora desde el campo de entrada
    //         fechaActual.setHours(parseInt(horaInput.split(':')[0], 10));
    //         fechaActual.setMinutes(parseInt(horaInput.split(':')[1], 10));
    //         fechaActual.setSeconds(0);

    //         console.log("Hora en formato UNIX:", valorColumna);
    //         // Obtener el tiempo en milisegundos y convertirlo a segundos (formato UNIX)
    //         var horaUnix = Math.floor(fechaActual.getTime() / 1000);

    //         // Mostrar el resultado en la consola (puedes hacer lo que desees con este valor)
    //         valorColumna = horaUnix;
    //     }


    //     for (var i = 0; i < campos.length; i++) {
    //         var campo = campos[i];
    //         var valorCampo = document.getElementById(campo).value;
    //         if (valorCampo !== "") {
    //             if(Bandera2Fechas = true && campo == 'Fecha'){
    //                 // console.log(CondicionesFecha);
    //                 condiciones += CondicionesFecha;
    //             }else if(Bandera2Fechas = false && campo == 'Fecha'){
    //                 // console.log(CondicionesFecha);
    //                 condiciones += CondicionesFecha;
    //             }else if(campo == 'Hora'){
    //                 condiciones +=  HOUR(FROM_UNIXTIME(r.entrada)) = '${valorCampo}' AND;
    //             }else{
    //                 var campoBD = camposBD[i];
    //                 condiciones += `${campoBD} LIKE '%${valorCampo}%' AND `;
    //             }
    //         }
    //     }
    //     console.log(condiciones);

    //     var Event = []
    //     Event.push(columnaGuia);
    //     Event.push(valorColumna);
    //     Event.push('Fecha2');
    //     Event.push(segundaFecha);
    //     Event.push(condiciones);
    //     // console.log(condiciones);
    //     // console.log(Event);
    //     $.ajax({

    //         url: '/Bib/public/Busqueda',
    //         type: 'POST',
    //         data: {
    //             "NombreColumna": Event[0],
    //             "ValorColumna": Event[1],
    //             "Consulta2Fechas": Event[2],
    //             "SegundaFecha": Event[3],
    //             "Condiciones": Event[4]
    //         },
    //         success: function (result) {
    //             result = JSON.parse(result);
    //             console.log(result);
    //             if (result.length == 0) {
    //                 Swal.fire({
    //                     position: "center",
    //                     icon: "info",
    //                     title: "No se encontraron registros",
    //                     showConfirmButton: false,
    //                     timer: 1500
    //                 });
    //             } else if (result.lenght != 0) {

    //                 //para el pdf
    //                // document.getElementById("idpdf").value = 0;

    //                 var columnas = Object.keys(result[0]);

    //                 // Crea la cabecera de la tabla
    //                 var tablaHTML = "<thead><tr>";
    //                 for (var i = 0; i < columnas.length; i++) {
    //                     if (i == 0) {

    //                         tablaHTML += "<th style= 'color: green'>" + columnas[i] + "</th>";
    //                     } else {
    //                         tablaHTML += "<th>" + columnas[i] + "</th>";
    //                     }

    //                 }
    //                 tablaHTML += "</tr></thead>";

    //                 // Crea el cuerpo de la tabla
    //                 tablaHTML += "<tbody  id='content-table'>";
    //                 for (var i = 0; i < result.length; i++) {
    //                     tablaHTML += "<tr>";
    //                     for (var j = 0; j < columnas.length; j++) {
    //                         if (j == 0) {
    //                             tablaHTML += "<td style= 'color: green' >" + result[i][columnas[j]] + "</td>";
    //                         } else {
    //                             var valor = result[i][columnas[j]];
    //                             tablaHTML += "<td>" + (valor !== null ? valor : "") + "</td>";
    //                         }
    //                     }
    //                     tablaHTML += "</tr>";
    //                 }
    //                 tablaHTML += "</tbody>";

    //                 // Inserta la tabla en el elemento con el ID 'tablaBusqueda'
    //                 var body = document.getElementById('admin-table');
    //                 body.innerHTML = tablaHTML;
    //                 OcultarBotonesRGA();
    //             } else {
    //                 alert('Error');
    //             }
    //         }
    //     });

    //     var formulario = document.getElementById('newAccountForm');


    //     // Resetea el formulario
    //     formulario.reset();
    //     CerrarModal()
    // }

    function EliminarRegistros() {
        abrirModalRGA();
        CerrarModal();
        var body = document.getElementById('Titulo');
        body.innerHTML = "Borrar registros";

        var Aux = document.getElementById("OcutalBonotes");
        Aux.value = "SI";
    }

    function BuscarRGA() {
	detenerHilo();
	document.getElementById("idpdf").value = 1;
        var Aux = document.getElementById("OcutalBonotes").value;
        console.log(Aux);
        var fechaInicial = document.getElementById('FechaRGA').value;
        var fechaPosterior = document.getElementById('Fecha2RGA').value;

        if(fechaInicial === "" && fechaPosterior === ""){
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

                url: '/Bib/public/BusquedaRGA2Campos',
                type: 'POST',
                data: {
                    "PrimeraFecha": fechaInicial,
                    "SegundaFecha": fechaPosterior
                },
                success: function (result) {
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
                       // document.getElementById("idpdf").value = 1;

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

                url: '/Bib/public/BusquedaRGA',
                type: 'POST',
                data: {
                    "PrimeraFecha": fechaInicial
                },
                success: function (result) {
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
                       // document.getElementById("idpdf").value = 1;

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


    // Modal
    function abrirModal() {
        // Agrega la clase 'active' al modal
        document.getElementById('Modal').classList.add('show');
        CerrarModalRGA();
    }

    function CerrarModal() {
        // Agrega la clase 'active' al modal
        document.getElementById('Modal').classList.remove('show');
    }
</script>
<script src="<?= base_url("js/search-monitoreo.js") ?>"></script>
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
                    url: '/Bib/public/dropSala',
                    type: 'POST',
                    data: {
                        "id": id
                    },
                    success: function (result) {
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
                                'El registro no ha sido expulsado.',
                                'error'
                            );
                        }
                    }
                });
            }
        });
    }
</script>
<?= $layout_js ?>