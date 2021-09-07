//json
const usuarios = [
    {
        nombre: "Lina Granados",
        identificacion: 1002558966,
        direccion: "cll 11 B #17-13",
        telefono: 3168927391,
        ciudad: "Sogamoso"
    },
    {
        nombre: "john Granados",
        identificacion: 1057610935,
        direccion: "crr 11 #17-13",
        telefono: 3168467802,
        ciudad: "Sogamoso"
    },
    {
        nombre: "luisa Guzman",
        identificacion: 12344567890,
        direccion: "av 11 16-13",
        telefono: 123456778,
        ciudad: "Sogamoso"
    },
  ]


function showClientesId(){
    var DatosJson = JSON.parse(JSON.stringify(usuarios));
    var id = document.getElementById("id").value;
    for (i = 0; i < DatosJson.length; i++){
        if(id == ""){
            document.getElementById("id").focus();
        }else{
            if(id == DatosJson[i].identificacion){
                $("#table").append('<table class="table caption-top">'+
                '<thead class="table-secondary">'+
                '<tr>'+'<th colspan=3">'+"Cliente encontrado "+DatosJson[i].nombre+'</th>'+'</tr>'+
                '<tr>'+
                '<th scope="col">'+"Identificacion"+'</th>'+
                '<th scope="col">'+"direccion"+'</th>'+
                '<th scope="col">'+"telefono"+'</th>'+
                '<th scope="col">'+"ciudad"+'</th>'+
                '</tr>'+
                '</thead>'+
                '<tbody>'+
                '<tr>'+
                '<td>'+DatosJson[i].identificacion+'</td>'+
                '<td>'+DatosJson[i].direccion+'</td>'+
                '<td>'+DatosJson[i].telefono+'</td>'+
                '<td>'+DatosJson[i].ciudad+'</td>'+
                '</tr>'+
                '</tr>'+'</tbody>'+'</table>');
                document.getElementById("id").value = "";
            }
            
        }
      
      
    }
  
  }

  function cargarDatos(){
    var DatosJson = JSON.parse(JSON.stringify(usuarios));
    for (i = 0; i < DatosJson.length; i++){
        $("#table2").append('<tr>' +'<td>'+' Cliente No '+i+'<br>'+'</td>'+
        '<td align="center" style="dislay: none;">' + DatosJson[i].identificacion +'<br>'+ '</td>'+
        '<td align="center" style="dislay: none;">' + DatosJson[i].nombre +'<br>'+ '</td>'+
        '<td align="center" style="dislay: none;">' + DatosJson[i].direccion + '<br>'+'</td>'+'<br> '+
        '<td align="center" style="dislay: none;">' + DatosJson[i].telefono + '<br>'+'</td>'+'<br> '+
        '<td align="center" style="dislay: none;">' + DatosJson[i].ciudad + '<br>'+'</td>'+'<br>'+
        '</tr>'+'<br>');
    }
}
  