const api_url = "http://agrodronesdelcampo.000webhostapp.com/usuarios.php";
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
        if(item.TYPE == 'P'){
        var row = `<tr>
                        <td>${item.USERNAME}</td>
                        <td>${item.NAME}</td>
                        
                    </tr>`;
    table.innerHTML += row
    }
    }
}






