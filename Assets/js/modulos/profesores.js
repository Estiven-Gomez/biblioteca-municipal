document.addEventListener("DOMContentLoaded", function() {
    if (document.getElementById('tblProfesores')) {
        initTablaProfesores();
    }
});

let tblProfesores;

function initTablaProfesores() {
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

    tblProfesores = $('#tblProfesores').DataTable({
        ajax: {
            url: base_url + "Profesores/listar",
            dataSrc: ''
        },
        columns: [
                        {
                'data': null,
                'render': function (data, type, row, meta) {
                    return meta.row + 1;
                }
            },
            {'data': 'codigo'},
            {'data': 'dni'},
            {'data': 'nombre'},
            {'data': 'carrera'},
            {'data': 'direccion'},
            {'data': 'telefono'},
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

function frmProfesores() {
    document.getElementById("title").textContent = "Nuevo Profesor";
    document.getElementById("btnAccion").textContent = "Registrar";
    document.getElementById("frmProfesores").reset();
    document.getElementById("id").value = "";
    $("#nuevoProfesores").modal("show");
}

function registrarProfesores(e) {
    e.preventDefault();
    const codigo = document.getElementById("codigo");
    const dni = document.getElementById("dni");
    const nombre = document.getElementById("nombre");
    const carrera = document.getElementById("carrera");
    const telefono = document.getElementById("telefono");
    const direccion = document.getElementById("direccion");
    
    if (codigo.value == "" || dni.value == "" || nombre.value == "" || telefono.value == "" || direccion.value == "" || carrera.value == "") {
        alertas('Todos los campos son requeridos', 'warning');
    } else {
        const url = base_url + "Profesores/registrar";
        const frm = document.getElementById("frmProfesores");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                $("#nuevoProfesores").modal("hide");
                frm.reset();
                tblProfesores.ajax.reload();
                alertas(res.msg, res.icono);
            }
        }
    }
}

function btnEditarProfesor(id) {
    document.getElementById("title").textContent = "Actualizar Profesor";
    document.getElementById("btnAccion").textContent = "Modificar";
    const url = base_url + "Profesores/editar/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("id").value = res.id;
            document.getElementById("codigo").value = res.codigo;
            document.getElementById("dni").value = res.dni;
            document.getElementById("nombre").value = res.nombre;
            document.getElementById("carrera").value = res.carrera;
            document.getElementById("telefono").value = res.telefono;
            document.getElementById("direccion").value = res.direccion;
            $("#nuevoProfesores").modal("show");
        }
    }
}

function btnEliminarProfesor(id) {
    Swal.fire({
        title: 'Esta seguro de eliminar?',
        text: "El profesor no se eliminará de forma permanente, solo cambiará el estado a inactivo!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Profesores/eliminar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblProfesores.ajax.reload();
                    alertas(res.msg, res.icono);
                }
            }
        }
    })
}

function btnReingresarProfesor(id) {
    Swal.fire({
        title: 'Esta seguro de reingresar?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Profesores/reingresar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblProfesores.ajax.reload();
                    alertas(res.msg, res.icono);
                }
            }
        }
    })
}
