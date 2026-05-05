/**
 * Módulo: Autores
 * Archivo: Assets/js/modulos/autores.js
 * Descripción: Gestión de autores
 * Dependencias: jQuery, SweetAlert2, comun.js
 */

document.addEventListener("DOMContentLoaded", function() {
    if (document.getElementById('tblAutor')) {
        initTablaAutores();
    }
});

function initTablaAutores() {
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
            title: 'Autores',
            filename: 'Reporte_Autores',
            text: '<button class="btn btn-success"><i class="fa fa-file-excel-o"></i></button>'
        },
        {
            extend: 'pdf',
            footer: true,
            title: 'Autores',
            filename: 'Reporte_Autores',
            text: '<button class="btn btn-danger"><i class="fa fa-file-pdf-o"></i></button>'
        },
        {
            extend: 'print',
            footer: true,
            title: 'Autores',
            text: '<button class="btn btn-info"><i class="fa fa-print"></i></button>'
        }
    ];

    tblAutor = $('#tblAutor').DataTable({
        ajax: {
            url: base_url + "Autor/listar",
            dataSrc: ''
        },
        columns: [
                        {
                'data': null,
                'render': function (data, type, row, meta) {
                    return meta.row + 1;
                }
            },
            {'data': 'imagen'},
            {'data': 'autor'},
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
        buttons
    });
}

function frmAutor() {
    document.getElementById("title").textContent = "Nuevo Autor";
    document.getElementById("btnAccion").textContent = "Registrar";
    document.getElementById("frmAutor").reset();
    document.getElementById("id").value = "";
    deleteImg();
    $("#nuevoAutor").modal("show");
}

function registrarAutor(e) {
    e.preventDefault();
    const autor = document.getElementById("autor");
    if (autor.value == "") {
        alertas('El nombre es requerido', 'warning');
    } else {
        const url = base_url + "Autor/registrar";
        const frm = document.getElementById("frmAutor");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                $("#nuevoAutor").modal("hide");
                frm.reset();
                tblAutor.ajax.reload();
                alertas(res.msg, res.icono);
            }
        }
    }
}

function btnEditarAutor(id) {
    document.getElementById("title").textContent = "Actualizar Autor";
    document.getElementById("btnAccion").textContent = "Modificar";
    const url = base_url + "Autor/editar/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("id").value = res.id;
            document.getElementById("autor").value = res.autor;
            document.getElementById("foto_actual").value = res.imagen;
            document.getElementById("img-preview").src = base_url + 'Assets/img/autor/' + res.imagen;
            document.getElementById("icon-image").classList.add("d-none");
            document.getElementById("icon-cerrar").innerHTML = `
            <button class="btn btn-danger" onclick="deleteImg()"><i class="fa fa-times-circle"></i></button>`;
            $("#nuevoAutor").modal("show");
        }
    }
}

function btnEliminarAutor(id) {
    Swal.fire({
        title: '¿Estás seguro de eliminar?',
        text: "El autor no se eliminará de forma permanente, solo cambiará el estado a inactivo",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Autor/eliminar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblAutor.ajax.reload();
                    alertas(res.msg, res.icono);
                }
            }
        }
    });
}

function btnReingresarAutor(id) {
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
            const url = base_url + "Autor/reingresar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblAutor.ajax.reload();
                    alertas(res.msg, res.icono);
                }
            }
        }
    });
}
