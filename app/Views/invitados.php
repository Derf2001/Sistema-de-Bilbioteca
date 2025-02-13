<?= $layout ?>

<section class="cont2">
    <div class="tabla-header">
        <p>Administrador/Tabla Invitados</p>
        <p><strong>Tabla Invitados</strong></p>
        <div class="searchbar">
            <form class="search-form">
                <i class="fas fa-search"></i>
                <input type="text" id="search" placeholder="Buscar...">
            </form>
        </div>
    </div>

    <div class="admin-table">
        <!-- Contenido de la tabla aquí -->
        <h3>Invitados</h3>
        <div class="table-container">

            <table>
                <thead>
                    <tr>
                        <th>Cuenta</th>
                        <th>Nombre</th>
                        <th>Área</th>
                        <th>Dependencia</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="content-table">
                    <?php foreach ($invitado as $invitados) :
                        extract($invitados);
                        echo "<tr>";
                        echo "<td>$NoCuenta</td>";
                        echo "<td>$Nombre</td>";
                        echo "<td>$area</td>";
                        echo "<td>$dependencia</td>";
                        echo "<td>";
                        echo "<a class='edit-icon' onclick='editInvitado(`$NoCuenta`)'><i class='fas fa-user-pen'></i></a>";
                        echo "<a class='delete-icon'><i class='fas fa-trash' onclick='elimInvitado(`$NoCuenta`)'></i></a>";
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
    <p>¿Eliminar invitado?</p>
    <button id="accept">Aceptar</button>
    <button id="cancel">Cancelar</button>
</div>
<div class="new-account-panel">
    <div class="cont3">
        <h3 id="auxedit">Cuenta nueva</h3>
        <form class="newAccountForm" onsubmit="return false;" id="newAccountForm">

            <label for="new-account-name" id="new-account-name-label"><strong>Cuenta</strong></label>
            <input type="text" id="new-account-name" name="NoCuenta" placeholder="Ingrese cuenta" oninput="validateNoCuenta(this)">

            <label for="name"><strong>Nombre</strong></label>
            <input type="text" id="name" name="name" placeholder="Ingrese nombre">

            <label for="area"><strong>Área</strong></label>
            <input type="text" id="area" name="area" placeholder="Ingrese área">

            <label for="depend"><strong>Dependencia</strong></label>
            <input type="text" id="depend" name="depend" placeholder="Ingrese dependencia">

            <!-- <label for="new-account-password"><strong>Contraseña</strong></label>
            <div class="password-container">
                <input type="password" id="new-account-password" name="new-account-password" placeholder="Ingrese Contraseña">
                <button id="togglePassword" onclick="togglePasswordVisibility()">
                    <i class="fas fa-eye" id="eye-icon"></i>
                </button>
            </div>-->

            <div class="btns">
                <div class="row">
                    <input type="hidden" id="aux" value="0">
                    <button type="submit" class="new-account-btn2" onclick="agregarInvitado()"><strong>Guardar</strong></button>
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
        input.value = input.value.replace(/[^a-zA-Z0-9!@#$%^&*()_+{}\[\]:;<>,.?~\\/-]/g, '');

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
            url: '/Bib/public/Search',
            type: 'POST',
            data: {
                "Valor1": Event[0],
                "Valor2": Event[0],
                "Valor3": Event[0],
                "Valor4": Event[0],
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
                    text += "<tr><td>" + result[i].NoCuenta +
                        "</td><td>" + result[i].Nombre + "</td><td>" + result[i].area + "</td><td>" + result[i].dependencia +
                        "</td><td><a class='edit-icon' onclick='editInvitado(`" + result[i].NoCuenta + "`)'><i class='fas fa-user-pen'></i></a><a class='delete-icon'><i class='fas fa-trash' onclick='elimInvitado(`" + result[i].NoCuenta + "`)'></i></a></td></tr>";
                }
                console.log(text);
                body.innerHTML = text;
                /*} else {
                    alert('Error');
                }*/
            }
        });
    }

    function validarFormulario(au) {
        var form = document.getElementById("newAccountForm");

        if (au == 0) {
            // Validar NoCuenta (número positivo)
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
            Swal.fire({
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
        if (!form.depend.value.trim()) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Ingrese una dependencia válido!",
            });
            return false;
        }
        /*
                // Validar Contraseña (al menos 6 caracteres)
                if (form['new-account-password'].value.length < 6) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "La contraseña debe tener al menos 6 caracteres!",
                    });
                    return false;
                }*/

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

    function agregarInvitado() {
        aux = document.getElementById('aux').value;
        if (validarFormulario(aux)) {
            var formData = new FormData($('#newAccountForm')[0]); // Cambia a jQuery selector
            var Event = []
            Event.push(formData.get('NoCuenta').toUpperCase());
            Event.push(formData.get('name'));
            Event.push(formData.get('area'));
            Event.push(0);
            Event.push(formData.get('depend'));
            console.log(aux + " otrooooosss  " + formData.get('depend'))

            if (aux == 0) {
                console.log("Probando " + Event[0]);
                $.ajax({
                    url: '/Bib/public/add3',
                    type: 'POST',
                    data: {
                        "NoCuenta": Event[0],
                        "name": Event[1],
                        "area": Event[2],
                        "new-account-password": 0,
                        "depend": Event[4],
                    },
                    success: function(result) {
                        result = JSON.parse(result);
                        console.log(result);
                        if (result[0].NoCuenta != 0) {
                            Swal.fire({
                                position: "center",
                                icon: "success",
                                title: "Invitado agregado",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            var body = document.getElementById('content-table');
                            var text = "";
                            for (var i = 0; i < result.length; i++) {
                                text += "<tr><td>" + result[i].NoCuenta +
                                    "</td><td>" + result[i].Nombre + "</td><td>" + result[i].area + "</td><td>" + result[i].dependencia +
                                    "</td><td><a class='edit-icon' onclick='editInvitado(`" + result[i].NoCuenta + "`)'><i class='fas fa-user-pen'></i></a><a class='delete-icon'><i class='fas fa-trash' onclick='elimInvitado(`" + result[i].NoCuenta + "`)'></i></a></td></tr>";
                            }
                            console.log(text);
                            body.innerHTML = text;
                            closepanel();
                        } else {
                            alert('Error');
                        }
                    },
                    error: function() {
                        Swal.fire({
                            position: "center",
                            icon: "error",
                            title: "Cuenta en uso",
                            text: "Esta cuenta ya esta siendo usada",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        closepanel();
                    }
                });
            } else {
                $.ajax({
                    url: '/Bib/public/ActualizarInvitado',
                    type: 'POST',
                    data: {
                        "NoCuenta": aux,
                        "name": Event[1],
                        "area": Event[2],
                        "new-account-password": Event[3],
                        "depend": Event[4],

                    },
                    success: function(result) {
                        result = JSON.parse(result);
                        console.log(result);
                        if (result[0].NoCuenta != 0) {
                            Swal.fire({
                                position: "center",
                                icon: "success",
                                title: "Invitado actualizado",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            var body = document.getElementById('content-table');
                            var text = "";
                            for (var i = 0; i < result.length; i++) {
                                text += "<tr><td>" + result[i].NoCuenta +
                                    "</td><td>" + result[i].Nombre + "</td><td>" + result[i].area + "</td><td>" + result[i].dependencia +
                                    "</td><td><a class='edit-icon' onclick='editInvitado(`" + result[i].NoCuenta + "`)'><i class='fas fa-user-pen'></i></a><a class='delete-icon'><i class='fas fa-trash' onclick='elimInvitado(`" + result[i].NoCuenta + "`)'></i></a></td></tr>";
                            }
                            body.innerHTML = text;
                            closepanel();
                        } else {
                            alert('Error');
                        }

                    }
                });

            }
            document.getElementById('aux').value = 0;
            document.getElementById('search').value = '';
        }
    }

    function elimInvitado(id) {
        dialog.style.display = 'block';
        console.log(dialog);
        var accept = document.getElementById('accept');
        accept.addEventListener('click', function() {
            dialog.style.display = 'none';
            deleteInvitado(id);
        });
    }

    function deleteInvitado(id) {

        $.ajax({
            url: '/Bib/public/DeleteInvitado',
            type: 'POST',
            data: {
                "NoCuenta": id,
            },
            success: function(result) {
                result = JSON.parse(result);
                console.log(result);
                //if (result.length != 0) {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Invitado eliminado",
                    showConfirmButton: false,
                    timer: 1500
                });
                var body = document.getElementById('content-table');
                var text = "";
                for (var i = 0; i < result.length; i++) {
                    text += "<tr><td>" + result[i].NoCuenta +
                        "</td><td>" + result[i].Nombre + "</td><td>" + result[i].area + "</td><td>" + result[i].dependencia +
                        "</td><td><a class='edit-icon' onclick='editInvitado(`" + result[i].NoCuenta + "`)'><i class='fas fa-user-pen'></i></a><a class='delete-icon'><i class='fas fa-trash' onclick='elimInvitado(`" + result[i].NoCuenta + "`)'></i></a></td></tr>";
                }
                body.innerHTML = text;
                /*} else {
                    body.innerHTML = "";
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Invitado Eliminado",
                        showConfirmButton: false,
                        timer: 1500
                    });
                }*/
            },
            error: function() {
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "Error",
                    text: "No se pudo eliminar el invitado",
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });
        document.getElementById('search').value = '';
    }

    function editInvitado(id) {
        var edit = document.getElementById("auxedit");
        edit.innerHTML = "Editar";
        document.getElementById('aux').value = id;
        xml = new XMLHttpRequest();
        xml.open('GET', '/Bib/public/ObtenerInvitado/' + id, true);
        xml.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xml.send();
        xml.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                var datos = JSON.parse(this.responseText);
                //document.getElementById('new-account-name').value = datos.NoCuenta;
                document.getElementById('name').value = datos.Nombre;
                document.getElementById('area').value = datos.area;
                document.getElementById('depend').value = datos.dependencia;
                //document.getElementById('new-account-password').value = datos.Contrasena;
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