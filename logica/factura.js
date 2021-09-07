const facturas = [
    {
        nombre: "Lina Granados",
        identificacion: 1002558966,
        direccion: "cll 11 B #17-13",
        fecha: "2020-01-01",
        telefono: 3168927391,
        ciudad: "Sogamoso",
        NFactura: 1000
    },
    {
        nombre: "john Granados",
        identificacion: 1057610935,
        direccion: "crr 11 #17-13",
        fecha: "2020-02-01",
        telefono: 3168467802,
        ciudad: "Sogamoso",
        NFactura: 998
    },
    {
        nombre: "luisa Guzman",
        identificacion: 12344567890,
        direccion: "av 11 16-13",
        fecha: "2010-01-05",
        telefono: 123456778,
        ciudad: "Sogamoso",
        NFactura: 999
    },
  ]

function registrar(){
    var nombre = document.getElementById("nombre").value;
    var identificacion = document.getElementById("id").value;
    var fecha = document.getElementById("fecha").value;
    var direccion = document.getElementById("direccion").value;
    var telefono = document.getElementById("telefono").value;
    var ciudad = document.getElementById("ciudad").value;
    if(nombre == ""){
        document.getElementById("nombre").focus();
    }else{
        if(identificacion == ""){
            document.getElementById("id").focus();
        }else{
            if(fecha == ""){
                document.getElementById("fecha").focus();
            }else{
                $("#table").append('<table class="table caption-top">'+
              '<thead class="table-secondary">'+
              '<tr>'+'<th colspan=3">'+"Cliente registrado "+nombre+'</th>'+'</tr>'+
              '<tr>'+
              '<th scope="col">'+"Identificacion"+'</th>'+
              '<th scope="col">'+"fecha"+'</th>'+
              '<th scope="col">'+"direccion"+'</th>'+
              '<th scope="col">'+"telefono"+'</th>'+
              '<th scope="col">'+"ciudad"+'</th>'+
              '</tr>'+
              '</thead>'+
              '<tbody>'+
              '<tr>'+
              '<td>'+identificacion+'</td>'+
              '<td>'+fecha+'</td>'+
              '<td>'+direccion+'</td>'+
              '<td>'+telefono+'</td>'+
              '<td>'+ciudad+'</td>'+
              '</tr>'+
              '</tr>'+'</tbody>'+'</table>');
              document.getElementById("nombre").value = "";
              document.getElementById("id").value = "";
              document.getElementById("fecha").value = "";
              document.getElementById("direccion").value = "";
              document.getElementById("telefono").value = "";
              document.getElementById("ciudad").value = "";
            }
        }
        }
        
    
}

function showFacturaId(){
    var idCliente = document.getElementById("id").value;
    var idFactura = document.getElementById("id").value;
    var DatosJson = JSON.parse(JSON.stringify(facturas));
    var valor = $('#criterioBusqueda').val();
    if(valor != null){
        if(valor == 0){
            if(idCliente == ""){
                document.getElementById("id").focus();
                
            }else{
                for (i = 0; i < DatosJson.length; i++){
                    if(idCliente == DatosJson[i].identificacion){
                        $("#table").append('<table class="table caption-top">'+
                        '<thead class="table-secondary">'+
                        '<tr>'+'<th colspan=3">'+"Factura encontrada "+DatosJson[i].NFactura+'</th>'+'</tr>'+
                        '<tr>'+
                        '<th scope="col">'+"Nombre cliente"+'</th>'+
                        '<th scope="col">'+"direccion"+'</th>'+
                        '<th scope="col">'+"fecha"+'</th>'+
                        '<th scope="col">'+"telefono"+'</th>'+
                        '<th scope="col">'+"ciudad"+'</th>'+
                        '</tr>'+
                        '</thead>'+
                        '<tbody>'+
                        '<tr>'+
                        '<td>'+DatosJson[i].nombre+'</td>'+
                        '<td>'+DatosJson[i].direccion+'</td>'+
                        '<td>'+DatosJson[i].fecha+'</td>'+
                        '<td>'+DatosJson[i].telefono+'</td>'+
                        '<td>'+DatosJson[i].ciudad+'</td>'+
                        '</tr>'+
                        '</tr>'+'</tbody>'+'</table>');
                        document.getElementById("id").value = "";


                    }
                }
            }
        }else{
            if(idFactura == ""){
                document.getElementById("id").focus();
                
            }else{
                for (i = 0; i < DatosJson.length; i++){
                    if(idFactura == DatosJson[i].NFactura){
                        $("#table").append('<table class="table caption-top">'+
                        '<thead class="table-secondary">'+
                        '<tr>'+'<th colspan=3">'+"Factura del cliente encontrada No "+DatosJson[i].NFactura+'</th>'+'</tr>'+
                        '<tr>'+
                        '<th scope="col">'+"Nombre cliente"+'</th>'+
                        '<th scope="col">'+"direccion"+'</th>'+
                        '<th scope="col">'+"fecha"+'</th>'+
                        '<th scope="col">'+"telefono"+'</th>'+
                        '<th scope="col">'+"ciudad"+'</th>'+
                        '</tr>'+
                        '</thead>'+
                        '<tbody>'+
                        '<tr>'+
                        '<td>'+DatosJson[i].nombre+'</td>'+
                        '<td>'+DatosJson[i].direccion+'</td>'+
                        '<td>'+DatosJson[i].fecha+'</td>'+
                        '<td>'+DatosJson[i].telefono+'</td>'+
                        '<td>'+DatosJson[i].ciudad+'</td>'+
                        '</tr>'+
                        '</tr>'+'</tbody>'+'</table>');
                        document.getElementById("id").value = "";


                    }
                }
            }
        }
    }else{
        document.getElementById("criterioBusqueda").focus();
    }

  }
