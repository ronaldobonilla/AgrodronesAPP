const api_url = "http://agrodronesdelcampo.000webhostapp.com/solicitudes.php";
async function getData() {
    const response = await fetch(api_url, { method: 'POST' });
    const data = await response.json();
    buildTable(data);
}
getData();


function buildTable(data) {

    var table = document.getElementById('myTable')


    for (let item of data) {
        //console.log(item)
        
        var row = `<tr>
                        
                        <td>${item.ID}</td>
                        <td>${item.USERNAME}</td>
                        <td>${item.FECHA}</td>
                        <td>${item.HORA}</td>
                        <td>${item.CULTIVO}</td>
                        <td>${item.PRODUCTO}</td>
                        <td>${item.AREA}</td>
                        <td>${item.VOLUMEN} litros</td>
                        <td>
                            <a href="https://www.google.com/maps/search/?api=1&query=${item.LATITUD}%2C${item.LONGITUD}">Ubicación</a>
                        </td>
                        <td>${item.ESTADO} </td>
                        <td>${item.OBSERVACIONES} </td>
                        <td>${item.CREATED_AT} </td>

                        
                    </tr>`;
        //dataModal(item)
        table.innerHTML += row
        
    }
}







