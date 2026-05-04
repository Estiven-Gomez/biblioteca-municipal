/**
 * Módulo: Préstamos
 * Archivo: Assets/js/modulos/prestamos.js
 * Descripción: Gestión de préstamos de libros
 * Dependencias: jQuery, SweetAlert2, comun.js
 */

document.addEventListener("DOMContentLoaded", function(){
    // Inicializar DataTable de Préstamos
    if (document.getElementById('tblPrestar')) {
        initTablaPrestamos();
    }
});

/**
 * Configuración y inicialización de DataTable Préstamos
 */
function initTablaPrestamos() {
    const language = {
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Entradas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "Sin resultados encontrados",
        "paginate": {
            "first": "Primero",
            "last": "Ultimo",
            "next": "Siguiente",
            "previous": "Anterior"
        }
    };

    const buttons = [
        {
            extend: 'excel',
            footer: true,
            title: 'Préstamos',
            filename: 'Reporte_Prestamos',
            text: '<button class="btn btn-success"><i class="fa fa-file-excel-o"></i></button>'
        },
        {
            extend: 'pdf',
            footer: true,
            title: 'Préstamos',
            filename: 'Reporte_Prestamos',
            text: '<button class="btn btn-danger"><i class="fa fa-file-pdf-o"></i></button>'
        }
    ];

    tblPrestar = $('#tblPrestar').DataTable({
        ajax: {
            url: base_url + "Prestamos/listar",
            dataSrc: ''
        },
        columns: [
            {'data': 'id'},
            {'data': 'estudiante'},
            {'data': 'libro'},
            {'data': 'cantidad'},
            {'data': 'fecha_prestamo'},
            {'data': 'fecha_devolucion'},
            {'data': 'acciones'}
        ],
        responsive: true,
        bDestroy: true,
        iDisplayLength: 10,
        order: [[0, "desc"]],
        language,
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons
    });
}

/**
 * Abrir modal para registrar nuevo préstamo
 */
function frmPrestar() {
    document.getElementById("title").textContent = "Nuevo Préstamo";
    document.getElementById("btnAccion").textContent = "Registrar";
    document.getElementById("frmPrestamo").reset();
    document.getElementById("id").value = "";
    $("#nuevoPrestamo").modal("show");
}

/**
 * Registrar préstamo
 */
function registrarPrestamo(e) {
    e.preventDefault();
    const estudiante = document.getElementById("estudiante");
    const libro = document.getElementById("libro");
    const cantidad = document.getElementById("cantidad");
    
    if (estudiante.value == "" || libro.value == "" || cantidad.value == "") {
        alertas('Todos los campos son requeridos', 'warning');
    } else {
        const url = base_url + "Prestamos/registrar";
        const frm = document.getElementById("frmPrestamo");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                $("#nuevoPrestamo").modal("hide");
                frm.reset();
                tblPrestar.ajax.reload();
                alertas(res.msg, res.icono);
            }
        }
    }
}

/**
 * Entregar libro (marcar préstamo como devuelto)
 */
function btnEntregar(id) {
    Swal.fire({
        title: '¿Confirmar entrega del libro?',
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, Entregar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Prestamos/entregar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblPrestar.ajax.reload();
                    alertas(res.msg, res.icono);
                }
            }
        }
    });
}

/**
 * Generar reporte en PDF
 */
function reportePDF() {
    const url = base_url + "Prestamos/pdf";
    window.open(url, '_blank');
}
