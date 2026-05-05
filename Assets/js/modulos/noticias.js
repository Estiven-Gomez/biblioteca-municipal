document.addEventListener("DOMContentLoaded", function() {
    if (document.getElementById('tblNoticias')) {
        initTablaNoticias();
    }
});

let tblNoticias;
function initTablaNoticias() {
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
    tblNoticias = $('#tblNoticias').DataTable({
        ajax: {
            url: base_url + "Noticias/listar",
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
            {'data': 'contenido'},
            {'data': 'fecha'},
            {'data': 'estado'},
            {'data': 'acciones'}
        ],
        responsive: true,
        bDestroy: true,
        iDisplayLength: 10,
        order: [[0, "desc"]],
        language
    });
}
function frmNoticia() {
    document.getElementById("title").textContent = "Nueva Noticia";
    document.getElementById("btnAccion").textContent = "Registrar";
    document.getElementById("frmNoticia").reset();
    document.getElementById("id").value = "";
    $("#nuevaNoticia").modal("show");
}
function registrarNoticia(e) {
    e.preventDefault();
    const titulo = document.getElementById("titulo");
    const contenido = document.getElementById("contenido");
    if (titulo.value == "" || contenido.value == "") {
        alertas('Todos los campos son requeridos', 'warning');
    } else {
        const url = base_url + "Noticias/registrar";
        const frm = document.getElementById("frmNoticia");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                $("#nuevaNoticia").modal("hide");
                frm.reset();
                tblNoticias.ajax.reload();
                alertas(res.msg, res.icono);
            }
        }
    }
}
function btnEditarNoticia(id) {
    document.getElementById("title").textContent = "Actualizar Noticia";
    document.getElementById("btnAccion").textContent = "Modificar";
    const url = base_url + "Noticias/editar/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("id").value = res.id;
            document.getElementById("titulo").value = res.titulo;
            document.getElementById("contenido").value = res.contenido;
            $("#nuevaNoticia").modal("show");
        }
    }
}
function btnEliminarNoticia(id) {
    Swal.fire({
        title: '¿Está seguro de eliminar?',
        text: "La noticia no se eliminará de forma permanente, solo cambiará el estado a inactivo!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Noticias/eliminar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblNoticias.ajax.reload();
                    alertas(res.msg, res.icono);
                }
            }
        }
    })
}
function btnReingresarNoticia(id) {
    Swal.fire({
        title: '¿Está seguro de reingresar?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Noticias/reingresar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblNoticias.ajax.reload();
                    alertas(res.msg, res.icono);
                }
            }
        }
    })
}
