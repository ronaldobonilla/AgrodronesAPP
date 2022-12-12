var ready = (callback) => {
    if (document.readyState != "loading") callback();
    else document.addEventListener("DOMContentLoaded", callback);
}
/* ready(() => {
    document.querySelector(".header").style.height = window.innerHeight + "px";
})
 */


function getNewData(mode, nick, month) {
    const formData = new FormData();
    formData.append('mode', mode);
    formData.append('nick', nick);
    formData.append('month', month);

    return fetch('https://agrodronesdelcampo.000webhostapp.com/mostrar_data_drones.php', {
        method: 'POST',
        body: formData
    }).then(response => response.json())
}

getNewData('0', 'no', '0').then((json) => {
    options = ""
    select_drone = document.getElementById('datalistOptions')
    json['nicknames'].forEach(element => {

        nickname = element['NICKNAME']
        options = options + `<option value="${nickname}">${nickname}</option>`

    });

    select_drone.innerHTML = options
})
    .catch(error => error);

let clear_dash = document.getElementById('clear_single_info')
clear_dash.addEventListener('click', () => { location.reload() })

let select_drone = document.getElementById('search_single_info')
select_drone.addEventListener('click', () => {
    debugger
    nick = document.getElementById('drone_name').value
    month = document.getElementById('month').value
    getNewData('1', nick, month).then((json) => {
        if (json.sum_area.hasOwnProperty('fail')) {
            // mostrar notificación de error
            document.getElementById('toast_message').innerText = 'No se encontró información para los criterios de búsqueda.'

            var toastElList = [].slice.call(document.querySelectorAll('.toast'))
            var toastList = toastElList.map(function (toastEl) {
                return new bootstrap.Toast(toastEl)
            })
            toastList.forEach(toast => toast.show())
            // mostrar notificación de error
        } else {


            sum_time = sum_t(nick, json['sum_time'], month)
            sum_area = sum_a(nick, json['sum_area'], month)
            avg_spray = sum_s(nick, json['sum_spray'], month)


            let myChart1 = new Chart(
                document.getElementById('myChart1'),
                avg_spray
            );
            myChart1.update()

            let myChart2 = new Chart(
                document.getElementById('myChart2'),
                sum_time
            );
            myChart2.update()

            let myChart3 = new Chart(
                document.getElementById('myChart3'),
                sum_area
            );
            myChart3.update()
            console.log(json)

        }
    })
        .catch(error => error);
})





function sum_s(nick, data, month) {
    let dates = []
    let time = []
    let info = {}
    let config = {}

    data.forEach(e => {
        // d = new Date(e.DATE)
        dates = [
            ...dates,
            month == 0 ? e.DATE.substr(5, 2) : e.DATE.substr(8)
        ]
        spray = [
            ...spray,
            e.SUM_SPRAY
        ]
    });
    // debugger
    info = {
        labels: dates,
        datasets: [{
            label: nick,
            backgroundColor: 'rgb(51, 144, 255)',
            borderColor: 'rgb(51, 144, 255)',
            data: spray,
        }]
    };

    config = {
        type: 'line',
        data: info,
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'Spray usado por día'
                }
            },
        }
    };
    return config
}


/* function avg_s(nick, data) {
    let dates = []
    let spray = {}
    let info = {}
    let config = {}
    nick.forEach(e => {
        spray = {
            ...spray,
            [e]: {
                label: e,
                data: []
            }
        }
    });
    // debugger
    data.forEach(e => {
        d = new Date(e.DATE)
        debugger
        if (d.getMonth() == 6) {
            nick.forEach(n => {
                if (e.nickname == n) {
                    dates = [
                        ...dates,
                        e.DATE.substr(5)
                    ]
                    spray = {
                        ...spray,
                        [n]: {
                            ...spray[n],
                            label: n,
                            data: [...spray[n]['data'], parseFloat(e.AVG_SPRAY).toFixed(2)]
                        }
                    }
                }
            })
        }
    });
    spray = Object.values(spray);
    info = {
        labels: dates,
        datasets: [{
            label: spray[0]['label'],
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: spray[0]['data'],
        },
        {
            label: spray[1]['label'],
            backgroundColor: 'rgb(54, 162, 235)',
            borderColor: 'rgb(54, 162, 235)',
            data: spray[1]['data'],
        },
        {
            label: spray[2]['label'],
            backgroundColor: 'rgb(255, 205, 86)',
            borderColor: 'rgb(255, 205, 86)',
            data: spray[2]['data'],
        },
        ]
    };
    config = {
        type: 'line',
        data: info,
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'Spray usado por día'
                }
            },
        }
    };
    return config
}
 */
function sum_t(nick, data, month) {
    let dates = []
    let time = []
    let info = {}
    let config = {}

    data.forEach(e => {
        // d = new Date(e.DATE)
        dates = [
            ...dates,
            month == 0 ? e.DATE.substr(5, 2) : e.DATE.substr(8)
        ]
        time = [
            ...time,
            e.SUM_WORK_SECONDS
        ]
    });
    // debugger
    info = {
        labels: dates,
        datasets: [{
            label: nick,
            backgroundColor: 'rgb(255, 82, 51)',
            borderColor: 'rgb(255, 82, 51)',
            data: time,
        }]
    };

    config = {
        type: 'bar',
        data: info,
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'Tiempo trabajado por día en (s)'
                }
            },
        }
    };
    return config
}

function sum_a(nick, data, month) {
    let dates = []
    let time = []
    let info = {}
    let config = {}

    data.forEach(e => {
        d = new Date(e.DATE)
        dates = [
            ...dates,
            month == 0 ? e.DATE.substr(5, 2) : e.DATE.substr(8)
        ]
        time = [
            ...time,
            e.SUM_WORK_AREA
        ]
    });
    info = {
        labels: dates,
        datasets: [{
            label: nick,
            backgroundColor: 'rgb(249, 255, 51)',
            borderColor: 'rgb(249, 255, 51)',
            data: time,
        }]
    };

    config = {
        type: 'line',
        data: info,
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'Área trabajada por día en (s)'
                }
            },
        }
    };
    return config
}