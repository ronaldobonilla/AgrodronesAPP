
const api_url = "http://agrodronesdelcampo.000webhostapp.com/cultivos.php";
async function getData(){
    const response = await fetch(api_url, {method: 'POST'});
    console.log(response);
    const data = await response.json();
    console.log(data);
    buildTable(data);
}
getData();


function buildTable(data){
    var table = document.getElementById('myTablecult')

    for(let item of data){
        var row = `<tr>
                        <td>${item.CULTIVO}</td>
                        <td>
                        <button class="btn" item = "${item.CULTIVO}"><i class="fa-solid fa-trash" item = "${item.CULTIVO}"></i></button>
                        </td>
                    </tr>`;
        table.innerHTML += row
    }
}

function delete_cultivo(item) {
    const formData = new FormData();
    formData.append('cult', item);

    return fetch('http://agrodronesdelcampo.000webhostapp.com/eliminar_cultivo.php', {
        method: 'POST',
        body: formData
    }).then(response => response.json())
}


const onClick = (event) => {
    if (event.target.hasAttribute("item")) {
        
        delete_cultivo(event.target.getAttribute("item"))
            .then((json) => {
                location.reload()
                alert(json.response)
            })
            .catch(error => error);
    }
}
window.addEventListener('click', onClick);



function agregar_cultivo() {
    dron_name = document.getElementById('dron').value
    const formData = new FormData();
    formData.append('dron', product_name);

    return fetch('http://agrodronesdelcampo.000webhostapp.com/insertar_cultivo.php', {
        method: 'POST',
        body: formData
    }).then(response => response.json())
        .then((json) => {
            location.reload()
            alert(json.response)
        })
        .catch(error => error);

}