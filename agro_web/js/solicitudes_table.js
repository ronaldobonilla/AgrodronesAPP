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
        if(item.ESTADO == 'P'){
        var row = `<tr>
                        
                        <td>${item.ID}</td>
                        <td>${item.USERNAME}</td>
                        <td>${item.FECHA}</td>
                        <td>${item.HORA}</td>
                        <td>${item.CULTIVO}</td>
                        <td>${item.AREA}</td>
                        <td>${item.VOLUMEN} litros</td>
                        <td>
                            <a href="https://www.google.com/maps/search/?api=1&query=${item.LATITUD}%2C${item.LONGITUD}">Ubicación</a>
                        </td>
                        <td>${item.ESTADO} </td>
                        <td>
                            <button id="${'but-item-' + item.USERNAME}" type="button" class="btn" data-toggle="modal" data-target="#detallesCita" item = "${JSON.stringify(item)}">
                                <i class="fa-solid fa-eye" id="${'icon-item-' + item.USERNAME}" item = '${JSON.stringify(item)}'></i>
                                </button>
                        </td>
                    </tr>`;
        //dataModal(item)
        table.innerHTML += row
        }
    }
}

const onClick = (event) => {
    if (event.target.hasAttribute("item")) {
        console.log(event.target)        
        let x = JSON.parse(event.target.getAttribute("item"))
        dataModal(x)
    }
}
window.addEventListener('click', onClick);


function dataModal(item) {
    // console.log(item)
    if (item == undefined) {
        console.log('item undefined')
    } else {
        var form = document.getElementById('modalForm')
        var label = `<div class="form-group">
                    <label style="font-weight: bold;">ID: </label>
                    <label id="id_soli"  >${item.ID}</label>
                    </div>
                    <div class="form-group">
                        <label style="font-weight: bold;">Usuario: </label>
                        <label id="usuario_soli">${item.USERNAME}</label>
                    </div>
                    <div class="form-group">
                        <label style="font-weight: bold;">Fecha: </label>
                        <label id="fecha_soli">${item.FECHA}</label>
                    </div>
                    <div class="form-group">
                        <label style="font-weight: bold;">Piloto: </label>
                        <input type="text" class="form-control" id="piloto" name="piloto" aria-describedby="pilotoHelp" placeholder="Nombre del Piloto">
                    </div>
                    <div class="form-group">
                        <label style="font-weight: bold;">Dron: </label>
                        <input type="text" class="form-control" id="dron" name="dron" aria-describedby="dronHelp" placeholder="Nombre del Dron">
                    </div>`
                    
        form.innerHTML = label
    }

}

function aceptar_solicitud() {
    soli_id = document.getElementById('id_soli').innerText;
    soli_usuario = document.getElementById('usuario_soli').innerText;
    soli_piloto = document.getElementById('piloto').value;
    soli_dron = document.getElementById('dron').value;
    //console.log('id es:');
    //console.log(soli_id);
    //soli_id = '4';
    est='A';
    const formData = new FormData();
    formData.append('id', soli_id);
    formData.append('user', soli_usuario);
    formData.append('estado', est);
    formData.append('piloto', soli_piloto);
    formData.append('dron', soli_dron);

    return fetch('http://agrodronesdelcampo.000webhostapp.com/modificar_solicitud.php', {
        method: 'POST',
        body: formData
    }).then(response => response.json())
        .then((json) => {
            location.reload()
            alert(json.response)
        })
        .catch(error => error);

}

function rechazar_solicitud() {
    soli_id = document.getElementById('id_soli').innerText;    
    est='R';
    const formData = new FormData();
    formData.append('id', soli_id);
    formData.append('user', '');
    formData.append('estado', est);
    formData.append('piloto', '');
    formData.append('dron', '');

    return fetch('http://agrodronesdelcampo.000webhostapp.com/modificar_solicitud.php', {
        method: 'POST',
        body: formData
    }).then(response => response.json())
        .then((json) => {
            location.reload()
            alert(json.response)
        })
        .catch(error => error);

}

