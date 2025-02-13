<?= $layout ?>
<section class="cont2">
    <div class="tabla-header">
        <p>Usuarios/Profesor - Investigador</p>
        <p><strong>Profesor - Investigador</strong></p>
        <div class="searchbar">
            <form class="search-form">
                <i class="fas fa-search"></i>
                <input type="text" id="search" placeholder="Buscar..." oninput="detectarLetra()">
            </form>
        </div>
    </div>
    <section>

    </section>
    <div class="admin-table">
        <!-- Contenido de la tabla aquí -->

        <h3>Profesor - Investigador</h3>
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
                    <?php foreach ($profesores as $profesores) :
                        extract($profesores);
                        echo "<tr>";
                        echo "<td>$NoCuenta</td>";
                        echo "<td>$Nombre</td>";
                        echo "<td>$area</td>";
                        echo "<td>$cargo</td>";
                        echo "<td>";
                        echo "<a href='#' class='edit-icon' onclick='editProfesor($NoCuenta)'><i class='fas fa-user-pen'></i></a>";
                        echo "<a href='#' class='delete-icon'><i class='fas fa-trash' onclick='elimAlumno($NoCuenta)'></i></a>";
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

.newAccountForm select {
    margin-bottom: 10px;
    padding: 13px;
    border: none;
    border-radius: 5px;
    margin-right: 0px;
    box-sizing: border-box;
    background-color: #1B254B;
    color: #A0AEC0;
    transition: color 0.3s;
    font-weight: bold;
    font-size: 15px;
}
</style>
<div id="overlay"></div>
<div id="dialog" class="modal">
    <p>¿Eliminar Profesor - Investigador?</p>
    <button id="accept">Aceptar</button>
    <button id="cancel">Cancelar</button>
</div>

<div class="new-account-panel">
    <div class="cont3">
        <h3 id="auxedit">Cuenta nueva</h3>
        <form class="newAccountForm" onsubmit="return false;" id="newAccountForm">
            <div id ="NoC"style = "display:none">
                <label for="new-account-name"><strong>Cuenta</strong></label>
                <input type="number" id="NoCuenta" name="NoCuenta" placeholder="Ingrese Cuenta"
                    oninput="limitarCaracteres(this, 10)">
            </div>

            <label for="name"><strong>Nombre</strong></label>
            <input type="text" id="Nombre" name="Nombre" placeholder="Ingrese Nombre">


            <label for="Area"><strong>Área</strong></label>
            <select id="Area" name="Area">
                <option value="">Seleccione un área</option>
                <option value="Licenciatura en enfermería">Licenciatura en enfermería</option>
                <option value="Licenciatura en nutrición">Licenciatura en nutrición</option>
                <option value="Idiomas">Idiomas</option>
            </select>

            <label for="Cargo"><strong>Cargo</strong></label>
            <select id="Cargo" name="Cargo">
                <option value="">Seleccione un cargo</option>
                <option value="Profesor-Investigador">Profesor-Investigador</option>
                <option value="Jefe de carrera">Jefe de carrera</option>
            </select>

            <div class="btns">
                <div class="row">
                    <input type="hidden" id="aux" value="0">
                    <button type="submit" class="new-account-btn2"
                        onclick="agregarProfesor()"><strong>Guardar</strong></button>
                    <button type="button" class="cancel-btn"><strong>Cancelar</strong></button>
                </div>
                <button type="submit" class="limpiar-btn" onclick="limpiarform()"><strong>Limpiar</strong></button>
            </div>

        </form>
    </div>
</div>
<script>
document.getElementById('search').addEventListener('keydown', function(event) {
    // Verificar si la tecla presionada es "Enter" (código 13)
    if (event.keyCode === 13) {
        event.preventDefault(); // Prevenir la acción predeterminada asociada con "Enter"
    }
});

// function togglePasswordVisibility() {
//     const passwordInput = document.getElementById("Contrasena");
//     const eyeIcon = document.getElementById("eye-icon");

//     if (passwordInput.type === "password") {
//         passwordInput.type = "text";
//         eyeIcon.classList.remove("fa-eye");
//         eyeIcon.classList.add("fa-eye-slash");
//     } else {
//         passwordInput.type = "password";
//         eyeIcon.classList.remove("fa-eye-slash");
//         eyeIcon.classList.add("fa-eye");
//     }
// }

function validarFormulario() {
    var form = document.getElementById("newAccountForm");

    // Validar NoCuenta (número positivo)
    if (!form.NoCuenta.value || form.NoCuenta.value <= 0) {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Ingrese un número de cuenta válido!",
        });
        return false;
    }

    // Validar Nombre (texto no vacío)
    if (!form.Nombre.value.trim()) {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Ingrese un nombre válido!",
        });
        return false;
    }


    // Validar Area (texto no vacío)
    if (form.Area.value == '') {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Ingrese un área válida!",
        });
        return false;
    }
    // Validar Area (texto no vacío)
    if (form.Cargo.value == '') {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Ingrese un cargo válida!",
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
    var form = document.getElementById("NoC");
    form.style.display = "block";
}

function limpiarform() {
    var form = document.getElementById("newAccountForm");
    form.reset();

}


function agregarProfesor() {
    
    // console.log('Agregar Profesor');
    aux = document.getElementById('aux').value;
    if (validarFormulario()) {
        var formData = new FormData($('#newAccountForm')[0]); // Cambia a jQuery selector
        var Event = []
        Event.push(formData.get('NoCuenta'));
        Event.push(formData.get('Nombre'));
        Event.push(formData.get('Area'));
        Event.push(formData.get(''));
        Event.push(formData.get('Cargo'));

        if (aux == 0) {
            console.log('Agregar Profesor');
            $.ajax(
                // console.log('ajax');
                {

                    url: '/Bib/public/AgregarProfesor',
                    type: 'POST',
                    data: {
                        "NoCuenta": Event[0],
                        "Nombre": Event[1],
                        "Area": Event[2],
                        "Contrasena": '',
                        "Cargo": Event[4]
                    },
                    success: function(result) {

                        result = JSON.parse(result);
                        if (result.status === "Error") {
                            alert("Cambie el NoCuenta del Profesor")
                        }
                        console.log(result);
                        if (result.lenght != 0) {
                            Swal.fire({
                                position: "center",
                                icon: "success",
                                title: "Profesor - Investigador agregado",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            var body = document.getElementById('content-table');
                            var text = "";
                            for (var i = 0; i < result.length; i++) {
                                text += "<tr><td>" + result[i].NoCuenta +
                                    "</td><td>" + result[i].Nombre +
                                    "</td><td>" + result[i].area + "</td><td>" + result[i].cargo +
                                    "<td><a class='edit-icon' onclick='editProfesor(" + result[i].NoCuenta +
                                    ")'><i class='fas fa-user-pen'></i></a><a class='delete-icon'><i class='fas fa-trash' onclick='elimAlumno(" +
                                    result[i].NoCuenta + ")'></i></a></td></tr>";
                            }
                            body.innerHTML = text;
                            closepanel();
                        } else {
                            alert('Error');
                        }
                    },
                    error: function(xhr, status, error) {
                        // Se ejecuta si hay un error en la solicitud AJAX
                        Swal.fire({
                            position: "center",
                            icon: "info",
                            title: "Cuenta duplicada, Introduzca otra cuenta",
                            showConfirmButton: false,
                            timer: 2000
                        });
                    }
                });

        } else {
            $.ajax({
                url: '/Bib/public/ActualizarProfesor',
                type: 'POST',
                data: {
                    "NoCuenta": Event[0],
                    "Nombre": Event[1],
                    "Area": Event[2],
                    "Contrasena": '',
                    "Cargo": Event[4]
                },
                success: function(result) {
                    result = JSON.parse(result);
                    console.log(result);

                    if (result[0].NoCuenta != 0) {
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "Profesor - Investigador actualizado",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        var body = document.getElementById('content-table');
                        var text = "";
                        for (var i = 0; i < result.length; i++) {
                            text += "<tr><td>" + result[i].NoCuenta +
                                "</td><td>" + result[i].Nombre +
                                "</td><td>" + result[i].area + "</td><td>" + result[i].cargo +
                                "</td><td><a class='edit-icon' onclick='editProfesor(" + result[i]
                                .NoCuenta +
                                ")'><i class='fas fa-user-pen'></i></a><a class='delete-icon'><i class='fas fa-trash' onclick='elimAlumno(" +
                                result[i].NoCuenta + ")'></i></a></td></tr>";
                        }
                        body.innerHTML = text;
                        closepanel();
                    } else {
                        alert('Error');
                    }

                }
            });

        }
        var form = document.getElementById("newAccountForm");
        form.reset();
        document.getElementById('aux').value = 0;
        var inputValue = document.getElementById("search");
        inputValue.value = '';
    }
}

function elimAlumno(id) {
    dialog.style.display = 'block';
    console.log(dialog);
    var accept = document.getElementById('accept');
    accept.addEventListener('click', function() {
        dialog.style.display = 'none';
        deleteAlumno(id);
    });
}

function deleteAlumno(id) {
    xml = new XMLHttpRequest();
    xml.open('GET', '/Bib/public/DeleteProfesor/' + id, true);
    xml.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xml.send();
    xml.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var datos = JSON.parse(this.responseText);
            var body = document.getElementById('content-table');
            if (datos.length != 0) {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Profesor - Investigador eliminado",
                    showConfirmButton: false,
                    timer: 1500
                });
                var text = "";
                for (var i = 0; i < datos.length; i++) {
                    text += "<tr><td>" + datos[i].NoCuenta +
                        "</td><td>" + datos[i].Nombre +
                        "</td><td>" + datos[i].area + "</td><td>" + datos[i].cargo +
                        "</td><td><a class='edit-icon' onclick='editProfesor(" + datos[i].NoCuenta +
                        ")'><i class='fas fa-user-pen'></i></a><a class='delete-icon'><i class='fas fa-trash' onclick='elimAlumno(" +
                        datos[i].NoCuenta + ")'></i></a></td></tr>";
                }
                console.log(text);
                body.innerHTML = text;
            } else {
                body.innerHTML = "";
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Profesor-Investigador eliminado",
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        }
    }
    var inputValue = document.getElementById("search");
    inputValue.value = '';
}

function editProfesor(id) {
    var edit = document.getElementById("auxedit");
    edit.innerHTML = "Editar";
    var form = document.getElementById("NoC");
    form.style.display = "none";
    document.getElementById('aux').value = id;
    xml = new XMLHttpRequest();
    xml.open('GET', '/Bib/public/ObtenerProfesor/' + id, true);
    xml.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xml.send();
    xml.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            var datos = JSON.parse(this.responseText);
            document.getElementById('NoCuenta').value = datos[0].NoCuenta;
            document.getElementById('Nombre').value = datos[0].Nombre;
            document.getElementById('Area').value = datos[0].area;
            document.getElementById('Cargo').value = datos[0].cargo;
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

function detectarLetra() {
    var inputValue = document.getElementById("search").value;
    console.log("Se introdujo una letra:", inputValue);
    $.ajax({
        url: '/Bib/public/BuscarProfesorNombre',
        type: 'POST',
        data: {
            "Nombre": inputValue
        },
        success: function(result) {
            result = JSON.parse(result);
            console.log(result);

            if (result.length > 0) {

                var body = document.getElementById('content-table');
                var text = "";
                for (var i = 0; i < result.length; i++) {
                    text += "<tr><td>" + result[i].NoCuenta +
                        "</td><td>" + result[i].Nombre +
                        "</td><td>" + result[i].area + "</td><td>" + result[i].cargo +
                        "</td><td><a class='edit-icon' onclick='editProfesor(" + result[i]
                        .NoCuenta +
                        ")'><i class='fas fa-user-pen'></i></a><a class='delete-icon'><i class='fas fa-trash' onclick='elimAlumno(" +
                        result[i].NoCuenta + ")'></i></a></td></tr>";
                }
                body.innerHTML = text;
                // closepanel();
            }

        }
    });
}

function limitarCaracteres(elemento, maximoCaracteres) {
    if (elemento.value.length > maximoCaracteres) {
        elemento.value = elemento.value.slice(0, maximoCaracteres);
    }
}
</script>
<?= $layout_js ?>