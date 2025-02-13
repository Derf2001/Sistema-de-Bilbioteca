function buscadorPro() {
    var busqueda = document.getElementById("search").value;
    console.log(busqueda);
    $.ajax({
        url: "/Bib/public/busquedaSuper_recordComputo",
        type: "POST",
        data: {
        busqueda: busqueda,
        },
        success: function (response) {
            var res = JSON.parse(response);
            console.log(res);
            var content = document.getElementById("content-table");
            content.innerHTML = "";
            res.forEach((element) => {
                content.innerHTML += `
                <tr>
                    <td>${element.NoCuenta}</td>
                    <td>${element.nombre_completo}</td>
                    <td>${element.area}</td>
                    <td>${element.cargo}</td>
                    <td>${element.semestre}</td>
                    <td>${element.grupo}</td>
                    <td>${element.asiento}</td>
                    <td>${element.fecha}</td>
                    <td>${element.hora_entrada}</td>
                    <td>
                        <a class='edit-icon' onclick="elimiAlumno('${element.NoCuenta}')"><i class='fa-solid fa-right-from-bracket'></i></a>
                    </td>
                </tr>
                `;
            });
        },
    });
}
var tamano = 0; //tamaño bd asientos
var hiloInterval;
window.onload = function () {
  $.ajax({
    url: "/Bib/public/ObtenerAsientos",
    type: "GET",
    success: function (response) {
      var asientos = JSON.parse(response);
      tamano = asientos.length;
      console.log("primer paso" + tamano);
    },
    error: function (xhr, status, error) {
      console.error("Error en la solicitud AJAX:", error);
    },
  });
  hilo();
};

function hilo() {
  hiloInterval = setInterval(function () {
    $.ajax({
      url: "/Bib/public/ObtenerAsientos_hilo2",
      type: "POST",
      success: function (response) {
        var ocupados = JSON.parse(response);
        //console.log(ocupados);
        if (ocupados.size[0].size > tamano) {
          console.log("entro if");
            var content = document.getElementById("content-table");
            content.innerHTML = "";
            var res = ocupados.list;
            res.forEach((element) => {
              content.innerHTML += `
                      <tr>
                          <td>${element.NoCuenta}</td>
                          <td>${element.nombre_completo}</td>
                          <td>${element.area}</td>
                          <td>${element.cargo}</td>
                          <td>${element.semestre}</td>
                          <td>${element.grupo}</td>
                          <td>${element.asiento}</td>
                          <td>${element.fecha}</td>
                          <td>${element.hora_entrada}</td>
                          <td>
                              <a class='edit-icon' onclick="elimiAlumno('${element.NoCuenta}')"><i class='fa-solid fa-right-from-bracket'></i></a>
                          </td>
                      </tr>
                      `;
            });
          tamano = ocupados.size[0].size;
        } else if (ocupados.size[0].size  < tamano) {
          console.log("entro al else");
            var content = document.getElementById("content-table");
            content.innerHTML = "";
            var res = ocupados.list;
            res.forEach((element) => {
              content.innerHTML += `
                      <tr>
                          <td>${element.NoCuenta}</td>
                          <td>${element.nombre_completo}</td>
                          <td>${element.area}</td>
                          <td>${element.cargo}</td>
                          <td>${element.semestre}</td>
                          <td>${element.grupo}</td>
                          <td>${element.asiento}</td>
                          <td>${element.fecha}</td>
                          <td>${element.hora_entrada}</td>
                          <td>
                              <a class='edit-icon' onclick="elimiAlumno('${element.NoCuenta}')"><i class='fa-solid fa-right-from-bracket'></i></a>
                          </td>
                      </tr>
                      `;
            });
            tamano = ocupados.size[0].size;
        }
      },
      error: function (xhr, status, error) {
        console.error("Error en la solicitud AJAX:", error);
      },
    });
    // console.log("segundo paso" + tamano);
  }, 1000);
}

function detenerHilo() {
  clearInterval(hiloInterval);
}