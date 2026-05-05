/**
 * Módulo: Libros
 * Archivo: Assets/js/modulos/libros.js
 * Descripción: Gestión de libros del sistema
 * Dependencias: jQuery, SweetAlert2, comun.js
 */

document.addEventListener("DOMContentLoaded", function(){
    if (document.getElementById('tblLibros')) {
        initTablaLibros();
    }
});

function initTablaLibros() {
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
            title: 'Libros',
            filename: 'Reporte_Libros',
            text: '<button class="btn btn-success"><i class="fa fa-file-excel-o"></i></button>'
        },
        {
            extend: 'pdf',
            footer: true,
            title: 'Libros',
            filename: 'Reporte_Libros',
            text: '<button class="btn btn-danger"><i class="fa fa-file-pdf-o"></i></button>'
        },
        {
            extend: 'print',
            footer: true,
            title: 'Libros',
            filename: 'Reporte_Libros',
            text: '<button class="btn btn-info"><i class="fa fa-print"></i></button>'
        }
    ];

    tblLibros = $('#tblLibros').DataTable({
        ajax: {
            url: base_url + "Libros/listar",
            dataSrc: ''
        },
        columns: [
                        {
                'data': null,
                'render': function (data, type, row, meta) {
                    return meta.row + 1;
                }
            },
            {'data': 'titulo'},
            {'data': 'cantidad'},
            {'data': 'autor'},
            {'data': 'editorial'},
            {'data': 'materia'},
            {'data': 'foto', 'visible': false},
            {'data': 'descripcion'},
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

function frmLibros() {
    document.getElementById("title").textContent = "Nuevo Libro";
    document.getElementById("btnAccion").textContent = "Registrar";
    document.getElementById("frmLibro").reset();
    document.getElementById("id").value = "";
    deleteImg();
    $("#nuevoLibro").modal("show");
}

function registrarLibro(e) {
    e.preventDefault();
    const titulo = document.getElementById("titulo");
    const autor = document.getElementById("autor");
    const editorial = document.getElementById("editorial");
    const materia = document.getElementById("materia");
    const cantidad = document.getElementById("cantidad");
    const num_pagina = document.getElementById("num_pagina");

    if (titulo.value == '' || autor.value == '' || editorial.value == '' || materia.value == '' || cantidad.value == '' || num_pagina.value == '') {
        alertas('Todos los campos son requeridos', 'warning');
    } else {
        const url = base_url + "Libros/registrar";
        const frm = document.getElementById("frmLibro");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                $("#nuevoLibro").modal("hide");
                tblLibros.ajax.reload();
                frm.reset();
                alertas(res.msg, res.icono);
            }
        }
    }
}

function btnEditarLibro(id) {
    document.getElementById("title").textContent = "Actualizar Libro";
    document.getElementById("btnAccion").textContent = "Modificar";
    const url = base_url + "Libros/editar/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("id").value = res.id;
            document.getElementById("titulo").value = res.titulo;
            document.getElementById("autor").value = res.id_autor;
            document.getElementById("editorial").value = res.id_editorial;
            document.getElementById("materia").value = res.id_materia;
            document.getElementById("cantidad").value = res.cantidad;
            document.getElementById("num_pagina").value = res.num_pagina;
            document.getElementById("anio_edicion").value = res.anio_edicion;
            document.getElementById("descripcion").value = res.descripcion;
            document.getElementById("img-preview").src = base_url + 'Assets/img/libros/' + res.imagen;
            document.getElementById("icon-image").classList.add("d-none");
            document.getElementById("icon-cerrar").innerHTML = `
            <button class="btn btn-danger" onclick="deleteImg()"><i class="fa fa-times-circle"></i></button>`;
            document.getElementById("foto_actual").value = res.imagen;
            $("#nuevoLibro").modal("show");
        }
    }
}

function btnEliminarLibro(id) {
    Swal.fire({
        title: '¿Estás seguro de eliminar?',
        text: "El libro no se eliminará de forma permanente, solo cambiará el estado a inactivo",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Libros/eliminar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblLibros.ajax.reload();
                    alertas(res.msg, res.icono);
                }
            }
        }
    });
}

function btnReingresarLibro(id) {
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
            const url = base_url + "Libros/reingresar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblLibros.ajax.reload();
                    alertas(res.msg, res.icono);
                }
            }
        }
    });
}
