<?= $layout ?>

<section class="cont2">
    <div class="tabla-header">
        <p>Usuario/Tabla Alumnos</p>
        <p><strong>Tabla Alumnos</strong></p>
        <div class="searchbar">
            <form class="search-form" onsubmit="return false;">
                <i class="fas fa-search"></i>
                <input type="text" id="search" placeholder="Buscar..." oninput="buscadorPro()">
            </form>
        </div>
    </div>

    <div class="admin-table">
        <!-- Contenido de la tabla aquí -->
        <h3>Alumnos</h3>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Cuenta</th>
                        <th>Nombre</th>
                        <th>Área</th>
                        <th>Semestre</th>
                        <th>Grupo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="content-table">
                    <?php foreach ($alumnos as $alumno):
                        extract($alumno);
                        echo "<tr>";
                        echo "<td>$NoCuenta</td>";
                        echo "<td>$Nombre</td>";
                        /*if ($area == 'Enfermería') {
                            $area = 'Licenciatura en enfermería';
                        } else if ($area == 'Nutrición') {
                            $area = 'Licenciatura en nutrición';
                        } else if ($area == 'Propedéutico') {
                            $area = 'Curso propedéutico';
                        }*/
                        echo "<td>$area</td>";
                        echo "<td>$semestre</td>";
                        echo "<td>$grupo</td>";
                        echo "<td>";
                        $NoCuenta = strtolower($NoCuenta);
                        echo "<a class='edit-icon' onclick=\"editAlumno('$NoCuenta')\"><i class='fas fa-user-pen'></i></a>";
                        echo "<a class='delete-icon' onclick=\"elimAlumno('$NoCuenta')\"><i class='fas fa-trash'></i></a>";
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
    <p>¿Eliminar alumno?</p>
    <button id="accept">Aceptar</button>
    <button id="cancel">Cancelar</button>
</div>

<div class="new-account-panel">
    <div class="cont3">
        <h3 id="auxedit">Cuenta nueva</h3>
        <form class="newAccountForm" onsubmit="return false;" id="newAccountForm">

            <label for="new-account-name" id="no_cuenta"><strong>Cuenta</strong></label>
            <input type="text" id="new-account-name" name="NoCuenta" placeholder="Ingrese cuenta" maxlength="15">

            <label for="name"><strong>Nombre</strong></label>
            <input type="text" id="name" name="name" placeholder="Ingrese nombre">

            <label for="area"><strong>Área</strong></label>
            <select id="area" name="area" onchange="selec()">
                <option value="">Seleccione área</option>
                <option value="Licenciatura en enfermería">Licenciatura en enfermería</option>
                <option value="Licenciatura en nutrición">Licenciatura en nutrición</option>
                <option value="Curso propedéutico">Curso propedéutico</option>
                <option value="Servicio social">Servicio social</option>
            </select>

            <label for="semester" style="display: none;" id="semester2"><strong>Semestre</strong></label>
            <select style="display: none;" id="semester" name="semester">
            </select>

            <label style="display: none;" id="grupo2" for="grupo"><strong>Grupo</strong></label>
            <input type="text" id="grupo" style="display: none;" name="grupo" placeholder="Ingrese grupo" maxlength="5">

            <!--<label for="new-account-password"><strong>Contraseña</strong></label>
            <div class="password-container">
                <input type="password" id="new-account-password" name="new-account-password"
                    placeholder="Ingrese Contraseña">
                <button id="togglePassword" onclick="togglePasswordVisibility()">
                    <i class="fas fa-eye" id="eye-icon"></i>
                </button>
            </div>-->

            <div class="btns">
                <div class="row">
                    <input type="hidden" id="aux" value="0">
                    <button type="submit" class="new-account-btn2"
                        onclick="agregarAlumno()"><strong>Guardar</strong></button>
                    <button type="button" class="cancel-btn"><strong>Cancelar</strong></button>
                </div>
                <button type="submit" class="limpiar-btn" onclick="limpiarform()"><strong>Limpiar</strong></button>
            </div>

        </form>

    </div>
</div>
<script>

    /*function togglePasswordVisibility() {
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
    }*/

    function selec() {
        var area = document.getElementById('area').value;
        if (area == 'Licenciatura en enfermería') {
            var semestre = document.getElementById('semester');
            semestre.innerHTML = '' +
                '<option value="114">114</option>' +
                '<option value="214">214</option>' +
                '<option value="314">314</option>' +
                '<option value="414">414</option>' +
                '<option value="514">514</option>' +
                '<option value="614">614</option>' +
                '<option value="714">714</option>' +
                '<option value="814">814</option>' +
                '<option value="914">914</option>' +
                '<option value="1014">1014</option>';
            semestre.style.display = "block";
            document.getElementById('semester2').style.display = "block";
            document.getElementById('grupo').style.display = "none";
            document.getElementById('grupo2').style.display = "none";
        } else if (area == 'Licenciatura en nutrición') {
            var semestre = document.getElementById('semester');
            semestre.innerHTML = '' +
                '<option value="115">115</option>' +
                '<option value="215">215</option>' +
                '<option value="315">315</option>' +
                '<option value="415">415</option>' +
                '<option value="515">515</option>' +
                '<option value="615">615</option>' +
                '<option value="715">715</option>' +
                '<option value="815">815</option>' +
                '<option value="915">915</option>' +
                '<option value="1015">1015</option>';
            semestre.style.display = "block";
            document.getElementById('semester2').style.display = "block";
            document.getElementById('grupo').style.display = "none";
            document.getElementById('grupo2').style.display = "none";
        } else if (area == 'Curso propedéutico') {
            document.getElementById('grupo').style.display = "block";
            document.getElementById('grupo2').style.display = "block";
            document.getElementById('semester').style.display = "none";
            document.getElementById('semester2').style.display = "none";
        } else if (area == 'Servicio social') {
            document.getElementById('semester').style.display = "none";
            document.getElementById('grupo').style.display = "none";
            document.getElementById('semester2').style.display = "none";
            document.getElementById('grupo2').style.display = "none";
        }
    }
</script>
<script src="<?= base_url('js/add-alumno.js') ?>"></script>
<script>
    var cancel = document.getElementById('cancel');
    var confirmModal = document.getElementById('confirmModal');

    cancel.addEventListener('click', function () {
        dialog.style.display = 'none';
    });

    window.addEventListener('click', function (event) {
        if (event.target == dialog) {
            dialog.style.display = 'none';
        } else if (event.target == confirmModal) {
            confirmModal.style.display = 'none';
        }
    });
</script>
<script>
    function reset() {
        document.getElementById('semester').style.display = "none";
        document.getElementById('grupo').style.display = "none";
        document.getElementById('semester2').style.display = "none";
        document.getElementById('grupo2').style.display = "none";
    }
</script>

<script>
    function buscadorPro() {
        var busqueda = document.getElementById('search').value;
        $.ajax({
            url: "/Bib/public/busquedaSuper",
            type: 'POST',
            data: {
                "busqueda": busqueda
            },
            success: function (response) {
                var res = JSON.parse(response);
                var content = document.getElementById('content-table');
                content.innerHTML = '';;
                res.forEach(element => {
                    content.innerHTML += '<tr>' +
                        '<td>' + element.NoCuenta + '</td>' +
                        '<td>' + element.Nombre + '</td>' +
                        '<td>' + element.area + '</td>' +
                        '<td>' + element.semestre + '</td>' +
                        '<td>' + element.grupo + '</td>' +
                        '<td>' +
                        '<a class="edit-icon" onclick="editAlumno(' + "'" + element.NoCuenta + "'" + ')"><i class="fas fa-user-pen"></i></a>' +
                        '<a class="delete-icon" onclick="elimAlumno(' + "'" + element.NoCuenta + "'" + ')"><i class="fas fa-trash"></i></a>' +
                        '</td>' +
                        '</tr>';
                });
            }
        });
    }
</script>
<?= $layout_js ?>