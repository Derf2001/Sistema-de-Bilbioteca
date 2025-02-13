<?= $layout ?>

<section class="cont2">
    <div class="tabla-header">
        <p>Administrador/Tabla Administrador</p>
        <p><strong>Tabla Administrador</strong></p>
        <div class="searchbar">
            <form class="search-form">
                <i class="fas fa-search"></i>
                <input type="text" id="search" placeholder="Buscar...">
            </form>
        </div>
    </div>

    <div class="admin-table">
        <!-- Contenido de la tabla aquí -->
        <h3>Administradores</h3>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Cuenta</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="content-table">
                    <?php foreach ($admin as $admin) :
                        extract($admin);
                        if ($NoCuenta != 1) {
                            echo "<tr>";
                            echo "<td>$NoCuenta</td>";
                            echo "<td>$Nombre</td>";
                            echo "<td>";
                            echo "<a class='edit-icon' onclick='editAdmin($NoCuenta)'><i class='fas fa-user-pen'></i></a>";
                            echo "<a class='delete-icon'><i class='fas fa-trash' onclick='elimAdmin($NoCuenta)'></i></a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="bottom-button">
        <button id="new-account-btn" onclick="add()"><strong>Cuenta nueva</strong></button>
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
    <p>¿Eliminar administrador?</p>
    <button id="accept">Aceptar</button>
    <button id="cancel">Cancelar</button>
</div>
<div class="new-account-panel">
    <div class="cont3">
        <h3 id="auxedit">Cuenta nueva</h3>
        <form class="newAccountForm" onsubmit="return false;" id="newAccountForm">

            <label for="new-account-name" id="new-account-name-label"><strong>Cuenta</strong></label>
            <input type="num" id="new-account-name" name="NoCuenta" placeholder="Ingrese cuenta"
                oninput="validateNoCuenta(this)">

            <label for="name"><strong>Nombre</strong></label>
            <input type="text" id="name" name="name" placeholder="Ingrese nombre">

            <label for="new-account-password"><strong>Contraseña</strong></label>
            <div class="password-container">
                <input type="password" id="new-account-password" name="new-account-password"
                    placeholder="Ingrese contraseña">
                <button id="togglePassword" onclick="togglePasswordVisibility()">
                    <i class="fas fa-eye" id="eye-icon"></i>
                </button>
            </div>
            <!--<input type="password" id="new-account-password" name="new-account-password" placeholder="Ingrese Contraseña">-->

            <div class="btns">
                <div class="row">
                    <input type="hidden" id="aux" value="0">
                    <button type="submit" class="new-account-btn2"
                        onclick="agregarAdmin()"><strong>Guardar</strong></button>
                    <button type="button" class="cancel-btn"><strong>Cancelar</strong></button>
                </div>
                <button type="submit" class="limpiar-btn" onclick="limpiarform()"><strong>Limpiar</strong></button>
            </div>

        </form>
    </div>
</div>
<?= $layout_js ?>
<script>
var dialog = document.getElementById('dialog');

function togglePasswordVisibility() {
    const passwordInput = document.getElementById("new-account-password");
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

function validateNoCuenta(input) {
    // Filtrar caracteres no permitidos (dejar solo letras, números y símbolos)

    // Limitar la longitud a 10 caracteres
    if (input.value.length > 10) {
        input.value = input.value.slice(0, 10);
    }
}

document.getElementById('search').addEventListener('keydown', function(event) {
    // Verificar si la tecla presionada es "Enter" (código 13)
    if (event.keyCode === 13) {
        event.preventDefault(); // Prevenir la acción predeterminada asociada con "Enter"
    }
});

document.getElementById('search').addEventListener('input', function() {
    // Llama a la función de búsqueda aquí o realiza la acción deseada
    realizarAccionDeBusqueda(this.value);
});

function realizarAccionDeBusqueda(value) {
    // Realiza la acción de búsqueda aquí
    var Event = []
    Event.push('%' + value + '%');

    console.log(value);
    $.ajax({
        url: '/Bib/public/SearchAdmin',
        type: 'POST',
        data: {
            "Valor1": Event[0],
            "Valor2": Event[0]
        },
        success: function(result) {
            result = JSON.parse(result);
            console.log(result);
            //if (result[0].NoCuenta != 0) {
            /*Swal.fire({
                position: "center",
                icon: "success",
                title: "Invitado Agregado",
                showConfirmButton: false,
                timer: 1500
            });*/
            var body = document.getElementById('content-table');
            var text = "";
            for (var i = 0; i < result.length; i++) {
                if (result[i].NoCuenta != 1) {
                    text += "<tr><td>" + result[i].NoCuenta +
                        "</td><td>" + result[i].Nombre +
                        "</td><td><a class='edit-icon' onclick='editAdmin(" + result[i].NoCuenta +
                        ")'><i class='fas fa-user-pen'></i></a><a class='delete-icon'><i class='fas fa-trash' onclick='elimAdmin(" +
                        result[i].NoCuenta + ")'></i></a></td></tr>";
                }
            }
            console.log(text);
            body.innerHTML = text;
            /*} else {
                alert('Error');
            }*/
        }
    });
}

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
    if (!form.name.value.trim()) {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Ingrese un nombre válido!",
        });
        return false;
    }

    // Validar Contraseña (al menos 6 caracteres)
    if (form['new-account-password'].value.length < 6) {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "La contraseña debe tener al menos 6 caracteres!",
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
    document.getElementById("new-account-name").style.display = "block";
    document.getElementById("new-account-name-label").style.display = "block";
}

function limpiarform() {
    var form = document.getElementById("newAccountForm");
    form.reset();
}

function agregarAdmin() {
    aux = document.getElementById('aux').value;
    if (validarFormulario()) {
        var formData = new FormData($('#newAccountForm')[0]); // Cambia a jQuery selector
        var Event = []
        Event.push(formData.get('name'));
        Event.push(formData.get('new-account-password'));
        Event.push(formData.get('NoCuenta'));

        if (aux == 0) {
            console.log(aux);
            $.ajax({
                url: '/Bib/public/add2',
                type: 'POST',
                data: {
                    "NoCuenta": Event[2],
                    "name": Event[0],
                    "new-account-password": Event[1],
                },
                success: function(result) {
                    result = JSON.parse(result);
                    console.log(result);
                    if (result[0].NoCuenta != 0) {
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "Administrador agregado",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        var body = document.getElementById('content-table');
                        var text = "";
                        for (var i = 0; i < result.length; i++) {
                            if (result[i].NoCuenta != 1) {
                                text += "<tr><td>" + result[i].NoCuenta +
                                    "</td><td>" + result[i].Nombre +
                                    "</td><td><a class='edit-icon' onclick='editAdmin(" + result[i]
                                    .NoCuenta +
                                    ")'><i class='fas fa-user-pen'></i></a><a class='delete-icon'><i class='fas fa-trash' onclick='elimAdmin(" +
                                    result[i].NoCuenta + ")'></i></a></td></tr>";
                            }
                        }
                        console.log(text);
                        body.innerHTML = text;
                        closepanel();
                    }
                },
                    error: function() {
                        Swal.fire({
                            position: "center",
                            icon: "error",
                            title: "Cuenta Ocupada",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        document.getElementById("new-account-name").value = "";

                    }
            });
        } else {
            $.ajax({
                url: '/Bib/public/ActualizarAdmin',
                type: 'POST',
                data: {
                    "name": Event[0],
                    "new-account-password": Event[1],
                    "NoCuenta": Event[2],
                },
                success: function(result) {
                    result = JSON.parse(result);
                    console.log(result);
                    if (result[0].NoCuenta != 0) {
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "Administrador actualizado",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        var body = document.getElementById('content-table');
                        var text = "";
                        for (var i = 0; i < result.length; i++) {
                            if (result[i].NoCuenta != 1) {
                                text += "<tr><td>" + result[i].NoCuenta +
                                    "</td><td>" + result[i].Nombre +
                                    "</td><td><a class='edit-icon' onclick='editAdmin(" + result[i]
                                    .NoCuenta +
                                    ")'><i class='fas fa-user-pen'></i></a><a class='delete-icon'><i class='fas fa-trash' onclick='elimAdmin(" +
                                    result[i].NoCuenta + ")'></i></a></td></tr>";
                            }
                        }
                        console.log(text);
                        body.innerHTML = text;
                        closepanel();
                    } else {
                        alert('Error update');
                    }

                }
            });

        }
        document.getElementById('aux').value = 0;
    }
}

function elimAdmin(id) {
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
    xml.open('GET', '/Bib/public/DeleteAdmin/' + id, true);
    xml.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xml.send();
    xml.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var result = JSON.parse(this.responseText);
            var body = document.getElementById('content-table');
            /*console.log(this.responseText);*/
            var datos = JSON.parse(this.responseText);
            if (result.length != 0) {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Administrador eliminado",
                    showConfirmButton: false,
                    timer: 1500
                });
                var text = "";
                for (var i = 0; i < result.length; i++) {
                    if (result[i].NoCuenta != 1) {
                        text += "<tr><td>" + result[i].NoCuenta +
                            "</td><td>" + result[i].Nombre +
                            "</td><td><a class='edit-icon' onclick='editAdmin(" + result[i].NoCuenta +
                            ")'><i class='fas fa-user-pen'></i></a><a class='delete-icon'><i class='fas fa-trash' onclick='elimAdmin(" +
                            result[i].NoCuenta + ")'></i></a></td></tr>";
                    }
                }
                body.innerHTML = text;
            } else {
                body.innerHTML = "";
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Administrador eliminado",
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        }
    }
}

function editAdmin(id) {
    var edit = document.getElementById("auxedit");
    edit.innerHTML = "Editar";
    document.getElementById('aux').value = id;
    xml = new XMLHttpRequest();
    xml.open('GET', '/Bib/public/ObtenerAdmin/' + id, true);
    xml.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xml.send();
    xml.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            var datos = JSON.parse(this.responseText);
            document.getElementById('new-account-name').value = datos.NoCuenta;
            document.getElementById('name').value = datos.Nombre;
            document.getElementById('new-account-password').value = datos.Contrasena;
            document.getElementById("new-account-name").style.display = "none";
            document.getElementById("new-account-name-label").style.display = "none";
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