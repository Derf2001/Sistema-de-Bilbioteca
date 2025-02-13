function add() {
    var edit = document.getElementById("auxedit");
    edit.innerHTML = "Cuenta nueva";
    limpiarform();
    showpanel();
    document.getElementById('new-account-name').style.display = "block";
    document.getElementById('no_cuenta').style.display = "block";
    document.getElementById('semester2').style.display = 'none';
    document.getElementById('grupo2').style.display = 'none';
    document.getElementById('semester').style.display = 'none';
    document.getElementById('grupo').style.display = 'none';
}

var dialog = document.getElementById('dialog');
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
    if (form.area.value == 'Licenciatura en nutrición' || form.area.value == 'Licenciatura en enfermería') {
        if (!form.semester.value.trim()) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Ingrese un semestre válido!",
            });
            return false;
        }
    }
    // Validar Grupo (texto no vacío)
    if (form.area.value == 'Curso propedéutico') {
        if (!form.grupo.value.trim()) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Ingrese un grupo válido!",
            });
            return false;
        }
    }


    // Validar Contraseña (al menos 6 caracteres)
    /*if (form['new-account-password'].value.length < 6) {
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


function limpiarform() {
    var form = document.getElementById("newAccountForm");
    form.reset();
}
function agregarAlumno() {
    aux = document.getElementById('aux').value;
    if (validarFormulario()) {
        var formData = new FormData($('#newAccountForm')[0]); // Cambia a jQuery selector
        var area = formData.get('area');
        var semestre = ''
        var grupo = ''
        if ((area == 'Licenciatura en enfermería' || area == 'Licenciatura en nutrición')) {
            semestre = formData.get('semester');
        } else if (area == 'Curso propedéutico') {
            grupo = formData.get('grupo');
        }
        var Event = [];
        Event.push(formData.get('NoCuenta'));
        Event.push(formData.get('name'));
        Event.push(formData.get('area'));
        Event.push(semestre);
        Event.push(grupo);
        Event.push(formData.get('new-account-password'));
        // console.log(Event);
        if (aux == 0) {
            $.ajax({
                url: '/Bib/public/validarUsuario',
                type: 'POST',
                data: {
                    "NoCuenta": Event[0],
                },
                success: function (result) {
                    result = JSON.parse(result);
                    console.log(result.length);
                    if (result.length == 0) {
                        $.ajax({
                            url: '/Bib/public/add',
                            type: 'POST',
                            data: {
                                "NoCuenta": Event[0],
                                "Name": Event[1],
                                "Area": Event[2],
                                "Semestre": Event[3],
                                "Grupo": Event[4],
                                "Pass": Event[5],
                            },
                            success: function (result) {
                                result = JSON.parse(result);
                                console.log(result);
                                if (result[0].NoCuenta != 0) {
                                    Swal.fire({
                                        position: "center",
                                        icon: "success",
                                        title: "Alumno agregado",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    var body = document.getElementById('content-table');
                                    var text = "";
                                    for (var i = 0; i < result.length; i++) {
                                        text += "<tr><td>" + result[i].NoCuenta +
                                            "</td><td>" + result[i].Nombre + "</td><td>" + result[i].area + "</td><td>" + result[i].semestre + "</td><td>" +
                                            result[i].grupo + "</td><td><a class='edit-icon' onclick=\"editAlumno('" +
                                            result[i].NoCuenta + "')\"><i class='fas fa-user-pen'></i></a><a class='delete-icon' onclick=\"elimAlumno('" +
                                            result[i].NoCuenta + "')\"><i class='fas fa-trash'></i></a></td></tr>";
                                    }
                                    body.innerHTML = text;
                                    closepanel();
                                } else {
                                    alert('Error');
                                }
                            }
                        });
                    }
                    else {
                        Swal.fire({
                            position: "center",
                            icon: "error",
                            title: "El número de cuenta ya existe",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        return;
                    }
                }
            });
        } else {
            $.ajax({
                url: '/Bib/public/ActualizarAlumno',
                type: 'POST',
                data: {
                    "NoCuenta": Event[0],
                    "Name": Event[1],
                    "Area": Event[2],
                    "Semestre": Event[3],
                    "Grupo": Event[4],
                    "Pass": Event[5],
                },
                success: function (result) {
                    result = JSON.parse(result);
                    console.log(result);
                    if (result[0].NoCuenta != 0) {
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "Alumno actualizado",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        var body = document.getElementById('content-table');
                        var text = "";
                        for (var i = 0; i < result.length; i++) {
                            text += "<tr><td>" + result[i].NoCuenta +
                                "</td><td>" + result[i].Nombre + "</td><td>" + result[i].area + "</td><td>" + result[i].semestre + "</td><td>" +
                                result[i].grupo + "</td><td><a class='edit-icon' onclick=\"editAlumno('" +
                                result[i].NoCuenta + "')\"><i class='fas fa-user-pen'></i></a><a class='delete-icon' onclick=\"elimAlumno('" +
                                result[i].NoCuenta + "')\"><i class='fas fa-trash'></i></a></td></tr>";
                        }
                        body.innerHTML = text;
                        closepanel();
                    } else {
                        alert('Error');
                    }
                }, Error: function (result) {
                    alert('Error');
                }
            });
        }
        document.getElementById('search').value = "";
        document.getElementById('aux').value = 0;
    }
}
function elimAlumno(id) {
    dialog.style.display = 'block';
    var accept = document.getElementById('accept');
    accept.addEventListener('click', function () {
        dialog.style.display = 'none';
        deleteAlumno(id);
    });
}
function deleteAlumno(id) {
    xml = new XMLHttpRequest();
    xml.open('GET', '/Bib/public/DeleteAlumno/' + id, true);
    xml.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xml.send();
    xml.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var result = JSON.parse(this.responseText);
            var body = document.getElementById('content-table');
            if (result.length != 0) {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Alumno eliminado",
                    showConfirmButton: false,
                    timer: 1500
                });
                document.getElementById('search').value = "";
                var text = "";
                for (var i = 0; i < result.length; i++) {
                    text += "<tr><td>" + result[i].NoCuenta +
                        "</td><td>" + result[i].Nombre + "</td><td>" + result[i].area + "</td><td>" + result[i].semestre + "</td><td>" +
                        result[i].grupo + "</td><td><a class='edit-icon' onclick=\"editAlumno('" +
                        result[i].NoCuenta + "')\"><i class='fas fa-user-pen'></i></a><a class='delete-icon' onclick=\"elimAlumno('" +
                        result[i].NoCuenta + "')\"><i class='fas fa-trash'></i></a></td></tr>";
                }
                body.innerHTML = text;
            } else {
                body.innerHTML = "";
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Alumno eliminado",
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        }
    }
}

function editAlumno(id) {
    var edit = document.getElementById("auxedit");
    edit.innerHTML = "Editar";
    document.getElementById('aux').value = id;
    xml = new XMLHttpRequest();
    xml.open('GET', '/Bib/public/ObtenerAlumno/' + id, true);
    xml.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xml.send();
    xml.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var datos = JSON.parse(this.responseText);
            //console.log(datos);
            var NoCuenta = document.getElementById('new-account-name');
            document.getElementById('no_cuenta').style.display = "none";
            NoCuenta.value = datos.NoCuenta;
            NoCuenta.style.display = "none";
            document.getElementById('name').value = datos.Nombre;
            if (datos.area == 'Licenciatura en enfermería') {
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
            } else if (datos.area == 'Licenciatura en nutrición') {
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
            } else if (datos.area == 'Curso propedéutico') {
                document.getElementById('grupo').style.display = "block";
                document.getElementById('grupo2').style.display = "block";
                document.getElementById('semester').style.display = "none";
                document.getElementById('semester2').style.display = "none";
            } else if (datos.area == 'Servicio social') {
                document.getElementById('semester').style.display = "none";
                document.getElementById('grupo').style.display = "none";
                document.getElementById('semester2').style.display = "none";
                document.getElementById('grupo2').style.display = "none";
            }
            document.getElementById('area').value = datos.area;
            document.getElementById('semester').value = datos.semestre;
            document.getElementById('grupo').value = datos.grupo;
            //document.getElementById('new-account-password').value = datos.Contrasena;
            showpanel();
        }
    }
}

// Obtener todos los encabezados de columna
function ordenar(id) {
    header = document.getElementById(id);
    // Obtener el tipo de orden actual de la columna
    let sortType = header.getAttribute('data-sort-type');

    // Cambiar el tipo de orden
    sortType = sortType === 'asc' ? 'desc' : 'asc';

    // Actualizar el atributo data-sort-type
    header.setAttribute('data-sort-type', sortType);

    // Cambiar el ícono de la flecha dependiendo del tipo de orden
    header.querySelector('i').className = sortType === 'asc' ? 'fas fa-sort-up' : 'fas fa-sort-down';

    // Llamar a la función de ordenar la tabla
    sortTable(header.cellIndex, sortType);
}

// Función para ordenar la tabla
function sortTable(columnIndex, sortType) {
    // Obtener el cuerpo de la tabla
    const tableBody = document.querySelector('#content-table');

    // Convertir las filas de la tabla en un arreglo
    const rows = Array.from(tableBody.querySelectorAll('tr'));

    // Ordenar las filas según el tipo de orden y el valor de la columna
    rows.sort((a, b) => {
        const aValue = a.cells[columnIndex].innerText;
        const bValue = b.cells[columnIndex].innerText;

        if (sortType === 'asc') {
            return aValue.localeCompare(bValue);
        } else {
            return bValue.localeCompare(aValue);
        }
    });

    // Vaciar el cuerpo de la tabla
    tableBody.innerHTML = '';

    // Agregar las filas ordenadas al cuerpo de la tabla
    rows.forEach(row => {
        tableBody.appendChild(row);
    });
}