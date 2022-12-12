const api_url = "http://agrodronesdelcampo.000webhostapp.com/drones.php";
async function getData(){
    const response = await fetch(api_url, {method: 'POST'});
    console.log(response);
    const data = await response.json();
    console.log(data);
    buildTable(data);
}
getData();


function buildTable(data){
    var table = document.getElementById('myTable')

    for(let item of data){
        var row = `<tr>
                        <td>${item.ALIAS}</td>
                        <td>${item.MODELO}</td>
                        <td>
                        <button class="btn" item = "${item.ALIAS}"><i class="fa-solid fa-trash" item = "${item.ALIAS}"></i></button>
                        </td>
                    </tr>`;
        table.innerHTML +=row
    }
}
function delete_dron(item) {
    const formData = new FormData();
    formData.append('alias', item);

    return fetch('http://agrodronesdelcampo.000webhostapp.com/eliminar_dron.php', {
        method: 'POST',
        body: formData
    }).then(response => response.json())
}


const onClick = (event) => {
    if (event.target.hasAttribute("item")) {
        delete_dron(event.target.getAttribute("item"))
            .then((json) => {
                location.reload()
                alert(json.response)
            })
            .catch(error => error);
    }
}
window.addEventListener('click', onClick);

function agregar_dron() {
    dron_alias = document.getElementById('alias').value
    dron_model = document.getElementById('model').value
    const formData = new FormData();
    formData.append('alias', dron_alias);
    formData.append('model', dron_model);

    return fetch('http://agrodronesdelcampo.000webhostapp.com/insertar_drones.php', {
        method: 'POST',
        body: formData
    }).then(response => response.json())
        .then((json) => {
            location.reload()
            alert(json.response)
        })
        .catch(error => error);

}

