/**
 * Módulo: Reportes
 * Archivo: Assets/js/modulos/reportes.js
 * Descripción: Funciones de reportes y exportación
 * Dependencias: jQuery, SweetAlert2, comun.js
 */

document.addEventListener("DOMContentLoaded", function(){
    if (document.getElementById('btnGenerarReporte')) {
        initReporteEventos();
    }
});

function initReporteEventos() {
    document.getElementById('btnGenerarReporte').addEventListener('click', function(e) {
        e.preventDefault();
        generarReporte();
    });
}

function generarReporte() {
    const tipo = document.getElementById('tipo_reporte');
    const fechaInicio = document.getElementById('fecha_inicio');
    const fechaFin = document.getElementById('fecha_fin');

    if (!tipo.value || !fechaInicio.value || !fechaFin.value) {
        alertas('Seleccione tipo y rango de fechas', 'warning');
        return;
    }

    const url = base_url + 'Reportes/generar';
    const frm = new FormData();
    frm.append('tipo_reporte', tipo.value);
    frm.append('fecha_inicio', fechaInicio.value);
    frm.append('fecha_fin', fechaFin.value);

    const http = new XMLHttpRequest();
    http.open('POST', url, true);
    http.send(frm);
    http.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            if (res.status) {
                window.open(base_url + res.url, '_blank');
            } else {
                alertas(res.msg, res.icono || 'error');
            }
        }
    }
}

function exportarReporte(tipoExportacion) {
    const url = base_url + 'Reportes/exportar/' + tipoExportacion;
    window.location.href = url;
}
