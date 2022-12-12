
const api_url = "http://agrodronesdelcampo.000webhostapp.com/productos.php";
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
                        <td>${item.PRODUCTO}</td>
                        <td>
                        <button class="btn" item = "${item.PRODUCTO}"><i class="fa-solid fa-trash" item = "${item.PRODUCTO}"></i></button>
                        </td>
                    </tr>`;
        table.innerHTML += row
    }
}



function delete_product(item) {
    const formData = new FormData();
    formData.append('prod', item);

    return fetch('http://agrodronesdelcampo.000webhostapp.com/eliminar_producto.php', {
        method: 'POST',
        body: formData
    }).then(response => response.json())
}


const onClick = (event) => {
    if (event.target.hasAttribute("item")) {
        delete_product(event.target.getAttribute("item"))
            .then((json) => {
                location.reload()
                alert(json.response)
            })
            .catch(error => error);
    }
}
window.addEventListener('click', onClick);



function agregar_producto() {
    product_name = document.getElementById('producto').value
    const formData = new FormData();
    formData.append('prod', product_name);

    return fetch('http://agrodronesdelcampo.000webhostapp.com/insertar_producto.php', {
        method: 'POST',
        body: formData
    }).then(response => response.json())
        .then((json) => {
            location.reload()
            alert(json.response)
        })
        .catch(error => error);

}