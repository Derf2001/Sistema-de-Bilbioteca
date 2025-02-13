<?= $layout ?>

<section class="cont2">
    <div class="tabla-header">
        <p>Usuario/Tabla Administrativo</p>
        <p><strong>Tabla Administrativo</strong></p>
        <div class="searchbar">
            <form class="search-form">
                <i class="fas fa-search"></i>
                <input type="text" id="search" placeholder="Buscar..." oninput="buscadorPro()">
            </form>
        </div>
    </div>

    <div class="admin-table">
        <!-- Contenido de la tabla aquí -->
        <h3>Administrativo</h3>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Cuenta</th>
                        <th>Nombre</th>
                        <th>Área</th>
                        <th>Cargo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="content-table">
                    <?php foreach ($administ as $administ) :
                        extract($administ);
                        echo "<tr>";
                        echo "<td>$NoCuenta</td>";
                        echo "<td>$Nombre</td>";
                        echo "<td>$area</td>";
                        echo "<td>$cargo</td>";
                        echo "<td>";
                        echo "<a class='edit-icon' onclick='editAdministrativo($NoCuenta)'><i class='fas fa-user-pen'></i></a>";
                        echo "<a class='delete-icon'><i class='fas fa-trash' onclick='eliminarAdministrativo($NoCuenta)'></i></a>";
                        echo "</td>";
                        echo "</tr>";

                    endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>
    <div class="bottom-button">
        <button id="new-account-btn" onclick="add()"><strong>Cuenta nueva</strong></button>
    </div>
</section>
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
    <p>¿Eliminar administrativo?</p>
    <button id="accept">Aceptar</button>
    <button id="cancel">Cancelar</button>

</div>
<div class="new-account-panel">
    <div class="cont3">
        <h3 id = "auxedit">Cuenta nueva</h3>
        <form class="newAccountForm" onsubmit="return false;" id="newAccountForm">

            <label for="new-account-name" id="new-account-name-label"><strong>Cuenta</strong></label>
            <input type="number" id="new-account-name" name="NoCuenta" placeholder="Ingrese cuenta" maxlength="10" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">

            <label for="name"><strong>Nombre</strong></label>
            <input type="text" id="name" name="name" placeholder="Ingrese nombre">

            <label for="area"><strong>Área</strong></label>
            <select id="area" name="area" class="selectStyle" onchange="showCargoOptions()">
                <option value="Operativos">Operativos</option>
                <option value="Administrativos">Administrativos</option>
                <option value="Intendencia">Intendencia</option>
            </select>

            <label for="cargo"><strong>Cargo</strong></label>
            <select id="cargo" name="cargo" class="selectStyle">
                <!-- Opciones generadas dinámicamente -->
            </select>

            <div class="btns">
                <div class="row">
                    <input type="hidden" id="aux" value="0">
                    <button type="submit" class="new-account-btn2" onclick="verificar()"><strong>Guardar</strong></button>
                    <button type="button" class="cancel-btn"><strong>Cancelar</strong></button>
                </div>
                <button type="submit" class="limpiar-btn" onclick="limpiarform()"><strong>Limpiar</strong></button>
            </div>

        </form>

    </div>
</div>
<?= $layout_js ?>
<script>
    function actualizarCargos() {
        var areaSeleccionada = document.getElementById("area").value;
        var cargosSelect = document.getElementById("cargo");
        
        // Limpiar las opciones actuales
        cargosSelect.innerHTML = "";
        
        // Agregar opciones según el área seleccionada
        switch(areaSeleccionada) {
            case "Operativos":
                cargarCargos(["Jardinero", "Chofer", "Auxiliar general", "Auxiliar de mantenimiento", "Jefe de área", "Oficial de mantenimiento"]);
                break;
            case "Intendencia":
                cargarCargos(["Intendente"]);
                break;
            case "Administrativos":
                cargarCargos(["Secretaria", "Técnico", "Jefe de área", "Jefe de departamento", "Auxiliar administrativo", "Técnico asistente", "Enfermero", "Auditor interno", "Secretario particular de Rector", "Vice-Rector", "Abogado general"]);
                break;
            default:
                cargarCargos([]); // No se seleccionó un área válida, limpiar los cargos
                break;
        }
    }

    function cargarCargos(cargos) {
        var cargosSelect = document.getElementById("cargo");
        cargos.forEach(function(cargo) {
            var option = document.createElement("option");
            option.text = cargo;
            //option.value = cargo.replace(/\s/g, ''); // Eliminar espacios en blanco de los valores de los cargos
            cargosSelect.add(option);
        });
    }

    // Llamar a la función actualizarCargos cuando se cambie el área seleccionada
    document.getElementById("area").addEventListener("change", actualizarCargos);
    
    // Llamar a la función actualizarCargos al cargar la página para cargar los cargos por defecto
    window.onload = actualizarCargos;
</script>



<script>
    document.getElementById('search').addEventListener('keydown', function(event) {
        // Verificar si la tecla presionada es "Enter" (código 13)
        if (event.keyCode === 13) {
            event.preventDefault(); // Prevenir la acción predeterminada asociada con "Enter"
        }
    });

    var dialog = document.getElementById('dialog');


    function validarFormulario(au) {
        var form = document.getElementById("newAccountForm");

        // Validar NoCuenta (número positivo)
        if (au == 0) {
            if (!form.NoCuenta.value || form.NoCuenta.value <= 0) {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Ingrese un número de cuenta válido!",
                });
                return false;
            }
        }

        // Validar Nombre (texto no vacío)
        if (!form.name.value.trim()) {
            aSwal.fire({
                icon: "error",
                title: "Oops...",
                text: "Ingrese un nombre válido!",
            });
            return false;
        }

        // Validar Área (texto no vacío)
        if (!form.area.value.trim()) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Ingrese un área válida!",
            });
            return false;
        }

        // Validar Semestre (texto no vacío)
        if (!form.cargo.value.trim()) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Ingrese un semestre válido!",
            });
            return false;
        }
        // Si todos los campos son válidos, devuelve true para enviar el formulario
        return true;
    }


    function add() {
	var edit = document.getElementById("auxedit");
        edit.innerHTML = "Cuenta nueva";
        limpiarform();
        showpanel();

        document.getElementById("new-account-name-label").style.display = "block";
        document.getElementById("new-account-name").style.display = "block";
    }

    function limpiarform() {
        var form = document.getElementById("newAccountForm");
        form.reset();

    }
    function AgregarAdministrativo() {
        aux = document.getElementById('aux').value;
        if (validarFormulario(aux)) {
            var formData = new FormData($('#newAccountForm')[0]); // Cambia a jQuery selector
            var Event = [];
            Event.push(formData.get('NoCuenta'));
            Event.push(formData.get('name'));
            Event.push(formData.get('area'));
            Event.push(formData.get('cargo'));
            console.log(document.getElementById('area').value)
            console.log(Event);

            if (aux == 0) {

                console.log("Buenas Noches:" );
                $.ajax({
                    url: '/Bib/public/AgregarAdministrativo',
                    type: 'POST',

                    data: {
                        "NoCuenta": Event[0],
                        "Name": Event[1],
                        "Area": Event[2],
                        "Cargo": Event[3],

                    },
                    success: function(result) {
                        result = JSON.parse(result);
                        console.log("Esto es el result" + result);
                        if (result[0].NoCuenta != 0) {

                            console.log("En teoria " + formData.get('cargo'));
                            Swal.fire({
                                position: "center",
                                icon: "success",
                                title: "Administrativo agregado",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            var body = document.getElementById('content-table');
                            var text = "";

                            for (var i = 0; i < result.length; i++) {
                                text += "<tr><td>" + result[i].NoCuenta +
                                    "</td><td>" + result[i].Nombre + "</td><td>" + result[i].area + "</td><td>" + result[i].cargo + "</td>" +
                                    "<td><a class='edit-icon' onclick='editAdministrativo(" + result[i].NoCuenta + ")'><i class='fas fa-user-pen'></i></a>" +
                                    "<a class='delete-icon'><i class='fas fa-trash' onclick='eliminarAdministrativo(" + result[i].NoCuenta + ")'></i></a></td></tr>";
                            }
                            document.getElementById('search').value = '';

                            body.innerHTML = text;
                            closepanel();

                        } else {

                            alert('Error');
                        }
                    },
                    error: function(result) {
                        Swal.fire({
                            position: "center",
                            icon: "error",
                            title: "Cuenta existente",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }

                });
            } else {
                console.log("entra actualizar");

                $.ajax({
                    url: '/Bib/public/ActualizarAdministrativo',
                    type: 'POST',
                    data: {
                        "NoCuenta": aux,
                        "Name": Event[1],
                        "Area": Event[2],
                        "Cargo": Event[3],
                    },
                    success: function(result) {
                        result = JSON.parse(result);
                        console.log(aux + "esto esta el idddddd");
                        if (result[0].NoCuenta != 0) {
                            Swal.fire({
                                position: "center",
                                icon: "success",
                                title: "Administrativo actualizado",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            var body = document.getElementById('content-table');
                            var text = "";
                            for (var i = 0; i < result.length; i++) {
                                text += "<tr><td>" + result[i].NoCuenta +
                                    "</td><td>" + result[i].Nombre + "</td><td>" + result[i].area + "</td><td>" + result[i].cargo + "</td>" +
                                    "<td><a class='edit-icon' onclick='editAdministrativo(" + result[i].NoCuenta + ")'><i class='fas fa-user-pen'></i></a>" +
                                    "<a class='delete-icon'><i class='fas fa-trash' onclick='eliminarAdministrativo(" + result[i].NoCuenta + ")'></i></a></td></tr>";
                            }
                            document.getElementById('search').value = '';

                            body.innerHTML = text;
                            closepanel();
                        } else {
                            alert('Error');

                        }

                    }
                });

            }


            document.getElementById('aux').value = 0;
        }
    }
    function eliminarAdministrativo(id) {
        dialog.style.display = 'block';
        console.log(dialog);
        var accept = document.getElementById('accept');
        accept.addEventListener('click', function() {
            dialog.style.display = 'none';
            deleteAdmin(id);
        });
    }

    function deleteAdmin(id) {
        xml = new XMLHttpRequest();
        xml.open('GET', '/Bib/public/DeleteAdministrativo/' + id, true);
        xml.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xml.send();
        xml.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var result = JSON.parse(this.responseText);
                var body = document.getElementById('content-table');
                if (result.length != 0) {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Administrativo eliminado",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    var body = document.getElementById('content-table');
                    var text = "";

                    for (var i = 0; i < result.length; i++) {
                        text += "<tr><td>" + result[i].NoCuenta +
                            "</td><td>" + result[i].Nombre + "</td><td>" + result[i].area + "</td><td>" + result[i].cargo + "</td>" +
                            "<td><a class='edit-icon' onclick='editAdministrativo(" + result[i].NoCuenta + ")'><i class='fas fa-user-pen'></i></a>" +
                            "<a class='delete-icon'><i class='fas fa-trash' onclick='eliminarAdministrativo(" + result[i].NoCuenta + ")'></i></a></td></tr>";
                    }
                    document.getElementById('search').value = '';
                    body.innerHTML = text;
                } else {
                    body.innerHTML = "";
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Administrativo eliminado",
                        showConfirmButton: false,
                        timer: 1500
                    });

                }

                var body = document.getElementById('content-table');
            }
        }
    }

    function editAdministrativo(id) {
    var edit = document.getElementById("auxedit");
    edit.innerHTML = "Editar";
    document.getElementById('aux').value = id;
    var xml = new XMLHttpRequest();
    xml.open('GET', '/Bib/public/ObtenerAdministrativo/' + id, true);
    xml.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xml.send();
    xml.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var datos = JSON.parse(this.responseText);
            console.log(datos);
            document.getElementById('name').value = datos.Nombre;
            document.getElementById('area').value = datos.area;


            var cargoSelect = document.getElementById('cargo');

            // Limpiar las opciones actuales
            cargoSelect.innerHTML = "";

            // Agregar opciones según el área seleccionada
            switch(datos.area) {
                case "Operativos":
                    cargarCargos(["Jardinero", "Chofer", "Auxiliar general", "Auxiliar de mantenimiento", "Jefe de área", "Oficial de mantenimiento"]);
                    break;
                case "Intendencia":
                    cargarCargos(["Intendente"]);
                    break;
                case "Administrativos":
                    cargarCargos(["Secretaria", "Técnico", "Jefe de área", "Jefe de departamento", "Auxiliar administrativo", "Técnico asistente", "Enfermero", "Auditor interno", "Secretario particular de Rector", "Vice-Rector", "Abogado general"]);
                    break;
                default:
                    // No se seleccionó un área válida, limpiar los cargos
                    cargarCargos([]);
                    break;
            }

            // Seleccionar el cargo correspondiente
            for (var i = 0; i < cargoSelect.options.length; i++) {
                if (cargoSelect.options[i].value === datos.cargo) {
                    cargoSelect.options[i].selected = true;
                    break;
                }
            }
  
            document.getElementById("new-account-name-label").style.display = "none";
            document.getElementById("new-account-name").style.display = "none";

            showpanel();
        }
    }
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
</script>
<script>
    function buscadorPro() {
        var busqueda = document.getElementById('search').value;
        console.log(busqueda);
        $.ajax({
            url: "/Bib/public/busquedaSuperAd",
            type: 'POST',
            data: {
                "busqueda": busqueda
            },
            success: function(response) {
                var res = JSON.parse(response);
                var content = document.getElementById('content-table');
                var text = "";
                content.innerHTML = '';
                console.log("que es esto: " + response);
                console.log(res);
                res.forEach(element => {
                    content.innerHTML += '<tr>' +
                        '<td>' + element.NoCuenta + '</td>' +
                        '<td>' + element.Nombre + '</td>' +
                        '<td>' + element.area + '</td>' +
                        '<td>' + element.cargo + '</td>' +
                        '<td>' +
                        '<a class="edit-icon" onclick="editAdministrativo(' + "'" + element.NoCuenta + "'" + ')"><i class="fas fa-user-pen"></i></a>' +
                        '<a class="delete-icon" onclick="eliminarAdministrativo(' + "'" + element.NoCuenta + "'" + ')"><i class="fas fa-trash"></i></a>' +
                        '</td>' +
                        '</tr>';
                });
            }
        });
    }
    function verificar() {
        var formData = new FormData($('#newAccountForm')[0]); // Cambia a jQuery selector
        var noCuenta = formData.get('NoCuenta');
        console.log("Este es el numero de cuenta" + noCuenta);

        $.ajax({
            url: '/Bib/public/VerificarAdministrativo',
            type: 'POST',
            data: {
                "NoCuenta": noCuenta
            },
            success: function(result) {
                result = JSON.parse(result);
                var size = result.length;
                console.log("Buneas Noches:" + size);
                if(size==0) {
                    console.log("No hay cuenta repetida")
                    AgregarAdministrativo()
                }else {
                    console.log("cuenta repetida")
                    Swal.fire({
                            position: "center",
                            icon: "error",
                            title: "Cuenta existente",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        closepanel()
                }
            }
        });
    }
</script>