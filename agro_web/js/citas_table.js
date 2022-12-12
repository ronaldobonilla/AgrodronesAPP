const api_url = "http://agrodronesdelcampo.000webhostapp.com/citas.php?";

async function getData() {
    const formData = new FormData();
    formData.append('user', 'all');
    formData.append('piloto', 'x');
    const response = await fetch(api_url, { method: 'POST',body: formData });
    const data = await response.json();
    buildTable(data);
}

getData();


function buildTable(data) {

    var table = document.getElementById('myTable')


    for (let item of data) {
        //console.log(item)
        if(item.FECHA_FIN == null){

            var row = `<tr>
                            
                            <td>${item.ID}</td>
                            <td>${item.USERNAME}</td>
                            <td>${item.SOLI_ID}</td>
                            <td>${item.PILOTO}</td>
                            <td>${item.FECHA}</td>
                            <td>${item.HORA}</td>
                            <td>${item.FECHA_INICIO}</td>
                            <td>${item.FECHA_FIN} </td>
                            <td>${item.CULTIVO}</td>
                            <td>${item.AREA}</td>
                            <td>${item.VOLUMEN} litros</td>
                            <td>                        
                                <a href="https://www.google.com/maps/search/?api=1&query=${item.LATITUD}%2C${item.LONGITUD}">Ubicación</a>
                            </td>
                            <td>
                            <i class='fas fa-user-clock'></i> 
                            </td>
                        </tr>`;
            //dataModal(item)
            table.innerHTML += row

        }else{

            var row = `<tr>
                            
                            <td>${item.ID}</td>
                            <td>${item.USERNAME}</td>
                            <td>${item.SOLI_ID}</td>
                            <td>${item.PILOTO}</td>
                            <td>${item.FECHA}</td>
                            <td>${item.HORA}</td>
                            <td>${item.FECHA_INICIO}</td>
                            <td>${item.FECHA_FIN} </td>
                            <td>${item.CULTIVO}</td>
                            <td>${item.AREA}</td>
                            <td>${item.VOLUMEN} litros</td>
                            <td>                        
                                <a href="https://www.google.com/maps/search/?api=1&query=${item.LATITUD}%2C${item.LONGITUD}">Ubicación</a>
                            </td>
                            <td>
                            <i class='fas fa-user-check'></i>  
                            </td>
                        </tr>`;
            //dataModal(item)
            table.innerHTML += row
        }
    }
}