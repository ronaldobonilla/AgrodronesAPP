const api_url = "http://agrodronesdelcampo.000webhostapp.com/usuarios.php";
async function getData(){
    const response = await fetch(api_url, {method: 'POST'});
    console.log(response);
    const data = await response.json();
    console.log(data);
    buildTable(data);
}
getData();


function buildTable(data) {
    var table = document.getElementById('myTable')

    for (let item of data) {
        var row = `<tr>
                        <td>${item.USERNAME}</td>
                        <td>${item.PASSWORD}</td>
                        <td>${item.NAME}</td>
                        <td>${item.TYPE}</td>
                        <td>${item.CREATED_AT}</td>
                        <td>
                        <button class="btn" item = "${item.USERNAME}"><i class="fa-solid fa-trash" item = "${item.USERNAME}"></i></button>
                        </td>
                    </tr>`;
        table.innerHTML += row
    }
}

function agregar_usuario() {
    user = document.getElementById('user').value
    pass = document.getElementById('pass').value
    name = document.getElementById('name').value
    type = document.getElementById('tipo').value
    const formData = new FormData();
    formData.append('user', user);
    formData.append('pass', pass);
    formData.append('name', name);
    formData.append('type', type);


    return fetch('http://agrodronesdelcampo.000webhostapp.com/insertar_usuario.php', {
        method: 'POST',
        body: formData
    }).then(response => response.json())
        .then((json) => {
            location.reload()
            alert(json.response)
        })
        .catch(error => error);

}

function delete_usuario(item) {
    const formData = new FormData();
    formData.append('user', item);

    return fetch('http://agrodronesdelcampo.000webhostapp.com/eliminar_usuario.php', {
        method: 'POST',
        body: formData
    }).then(response => response.json())
}


const onClick = (event) => {
    if (event.target.hasAttribute("item")) {
        delete_usuario(event.target.getAttribute("item"))
            .then((json) => {
                location.reload()
                alert(json.response)
            })
            .catch(error => error);
    }
}
window.addEventListener('click', onClick);