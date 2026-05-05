/**
 * Módulo: Materias
 * Archivo: Assets/js/modulos/materias.js
 * Descripción: Gestión de materias
 * Dependencias: jQuery, SweetAlert2, comun.js
 */

document.addEventListener("DOMContentLoaded", function() {
    if (document.getElementById('tblMateria')) {
        initTablaMaterias();
    }
});

function initTablaMaterias() {
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
            title: 'Materias',
            filename: 'Reporte_Materias',
            text: '<button class="btn btn-success"><i class="fa fa-file-excel-o"></i></button>'
        },
        {
            extend: 'pdf',
            footer: true,
            title: 'Materias',
            filename: 'Reporte_Materias',
            text: '<button class="btn btn-danger"><i class="fa fa-file-pdf-o"></i></button>'
        },
        {
            extend: 'print',
            footer: true,
            title: 'Materias',
            text: '<button class="btn btn-info"><i class="fa fa-print"></i></button>'
        }
    ];

    tblMateria = $('#tblMateria').DataTable({
        ajax: {
            url: base_url + "Materia/listar",
            dataSrc: ''
        },
        columns: [
                        {
                'data': null,
                'render': function (data, type, row, meta) {
                    return meta.row + 1;
                }
            },
            {'data': 'materia'},
            {'data': 'estado'},
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
        buttons: isAdmin ? buttons : []
    });
}

function frmMateria() {
    document.getElementById("title").textContent = "Nueva Materia";
    document.getElementById("btnAccion").textContent = "Registrar";
    document.getElementById("frmMateria").reset();
    document.getElementById("id").value = "";
    $("#nuevoMateria").modal("show");
}

function registrarMateria(e) {
    e.preventDefault();
    const materia = document.getElementById("materia");
    if (materia.value == "") {
        alertas('La materia es requerida', 'warning');
    } else {
        const url = base_url + "Materia/registrar";
        const frm = document.getElementById("frmMateria");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                $("#nuevoMateria").modal("hide");
                frm.reset();
                tblMateria.ajax.reload();
                alertas(res.msg, res.icono);
            }
        }
    }
}

function btnEditarMat(id) {
    document.getElementById("title").textContent = "Actualizar Materia";
    document.getElementById("btnAccion").textContent = "Modificar";
    const url = base_url + "Materia/editar/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("id").value = res.id;
            document.getElementById("materia").value = res.materia;
            $("#nuevoMateria").modal("show");
        }
    }
}

function btnEliminarMat(id) {
    Swal.fire({
        title: '¿Estás seguro de eliminar?',
        text: "La materia no se eliminará de forma permanente, solo cambiará el estado a inactivo",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Materia/eliminar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblMateria.ajax.reload();
                    alertas(res.msg, res.icono);
                }
            }
        }
    });
}

function btnReingresarMat(id) {
    Swal.fire({
        title: '¿Estás seguro de reingresar?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Materia/reingresar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblMateria.ajax.reload();
                    alertas(res.msg, res.icono);
                }
            }
        }
    });
}
