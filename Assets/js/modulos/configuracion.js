/**
 * Módulo: Configuración
 * Archivo: Assets/js/modulos/configuracion.js
 * Descripción: Gestión de la página de configuración y panel de gráficos
 * Dependencias: jQuery, Chart.js, comun.js
 */

document.addEventListener("DOMContentLoaded", function() {
    if (document.getElementById('reportePrestamo')) {
        initGraficoPrestamos();
    }
});

function frmConfig(e) {
    e.preventDefault();
    const nombre = document.getElementById("nombre");
    const telefono = document.getElementById("telefono");
    const direccion = document.getElementById("direccion");
    const correo = document.getElementById("correo");

    if (nombre.value == "" || telefono.value == "" || direccion.value == "" || correo.value == "") {
        alertas('Todos los campos son requeridos', 'warning');
    } else {
        const url = base_url + "Configuracion/actualizar";
        const frm = document.getElementById("frmConfig");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                alertas(res.msg, res.icono);
            }
        }
    }
}

function initGraficoPrestamos() {
    const url = base_url + 'Configuracion/grafico';
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const data = JSON.parse(this.responseText);
            const nombres = data.map(item => item.titulo);
            const cantidades = data.map(item => item.cantidad);
            const ctx = document.getElementById("reportePrestamo");
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: nombres,
                    datasets: [{
                        label: 'Libros',
                        data: cantidades,
                        backgroundColor: ['#dc143c']
                    }]
                }
            });
        }
    }
}
