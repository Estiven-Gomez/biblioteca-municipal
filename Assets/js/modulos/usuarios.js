/**
 * Módulo: Usuarios
 * Archivo: Assets/js/modulos/usuarios.js
 * Descripción: Gestión de usuarios del sistema
 * Dependencias: jQuery, SweetAlert2, comun.js
 */

document.addEventListener("DOMContentLoaded", function(){
    // Inicializar DataTable de Usuarios
    if (document.getElementById('tblUsuarios')) {
        initTablaUsuarios();
    }
});

/**
 * Configuración y inicialización de DataTable Usuarios
 */
function initTablaUsuarios() {
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
            title: 'Usuarios',
            filename: 'Reporte_Usuarios',
            text: '<button class="btn btn-success"><i class="fa fa-file-excel-o"></i></button>'
        },
        {
            extend: 'pdf',
            footer: true,
            title: 'Usuarios',
            filename: 'Reporte_Usuarios',
            text: '<button class="btn btn-danger"><i class="fa fa-file-pdf-o"></i></button>'
        },
        {
            extend: 'print',
            footer: true,
            title: 'Usuarios',
            text: '<button class="btn btn-info"><i class="fa fa-print"></i></button>'
        }
    ];

    tblUsuarios = $('#tblUsuarios').DataTable({
        ajax: {
            url: base_url + "Usuarios/listar",
            dataSrc: ''
        },
        columns: [
                        {
                'data': null,
                'render': function (data, type, row, meta) {
                    return meta.row + 1;
                }
            },
            {'data': 'usuario'},
            {'data': 'nombre'},
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

/**
 * Abrir modal para crear nuevo usuario
 */
function frmUsuario() {
    document.getElementById("title").textContent = "Nuevo Usuario";
    document.getElementById("btnAccion").textContent = "Registrar";
    document.getElementById("claves").classList.remove("d-none");
    document.getElementById("frmUsuario").reset();
    document.getElementById("id").value = "";
    
    // Obtener nuevo token CSRF
    obtenerTokenCSRF().then(res => {
        document.querySelector("input[name='csrf_token']").value = res.token;
    });
    
    $("#nuevo_usuario").modal("show");
}

/**
 * Registrar o actualizar usuario
 */
function registrarUser(e) {
    e.preventDefault();
    const usuario = document.getElementById("usuario");
    const nombre = document.getElementById("nombre");
    const clave = document.getElementById("clave");
    const confirmar = document.getElementById("confirmar");
    
    if (usuario.value == "" || nombre.value == "") {
        alertas('Todos los campos son requeridos', 'warning');
    } else {
        const url = base_url + "Usuarios/registrar";
        const frm = document.getElementById("frmUsuario");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                $("#nuevo_usuario").modal("hide");
                frm.reset();
                tblUsuarios.ajax.reload();
                alertas(res.msg, res.icono);
            }
        }
    }
}

/**
 * Cargar datos para editar usuario
 */
function btnEditarUser(id) {
    document.getElementById("title").textContent = "Actualizar Usuario";
    document.getElementById("btnAccion").textContent = "Modificar";
    
    const url = base_url + "Usuarios/editar/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("id").value = res.id;
            document.getElementById("usuario").value = res.usuario;
            document.getElementById("nombre").value = res.nombre;
            document.getElementById("claves").classList.add("d-none");
            $("#nuevo_usuario").modal("show");
        }
    }
}

/**
 * Eliminar usuario (cambiar a inactivo)
 */
function btnEliminarUser(id) {
    Swal.fire({
        title: '¿Estás seguro de eliminar?',
        text: "El usuario no se eliminará de forma permanente, solo cambiará el estado a inactivo",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Usuarios/eliminar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblUsuarios.ajax.reload();
                    alertas(res.msg, res.icono);
                }
            }
        }
    });
}

/**
 * Reingresar usuario (cambiar a activo)
 */
function btnReingresarUser(id) {
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
            const url = base_url + "Usuarios/reingresar/" + id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    const res = JSON.parse(this.responseText);
                    tblUsuarios.ajax.reload();
                    alertas(res.msg, res.icono);
                }
            }
        }
    });
}

/**
 * Abrir modal para asignar permisos
 */
function btnRolesUser(id) {
    const url = base_url + "Usuarios/obtenerPermisos/" + id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.getElementById("id_usuario").value = res.id;
            let permisos = res.permisos.map(p => `
                <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" id="permiso_${p.id}" type="checkbox" name="permiso" 
                        value="${p.id}" ${res.tienePermiso.includes(p.id) ? 'checked' : ''}>
                    <label class="custom-control-label" for="permiso_${p.id}">${p.nombre}</label>
                </div>
            `).join('');
            document.getElementById("frmPermisos").innerHTML = permisos + `
                <button class="btn btn-primary mt-3 btn-block" type="button" onclick="registrarPermisos(event);">Actualizar</button>
            `;
            $("#permisos").modal("show");
        }
    }
}

/**
 * Registrar permisos del usuario
 */
function registrarPermisos(event) {
    event.preventDefault();
    const id_usuario = document.getElementById("id_usuario").value;
    const permisos = [];
    document.querySelectorAll("input[name='permiso']:checked").forEach(p => {
        permisos.push(p.value);
    });
    
    const url = base_url + "Usuarios/registrarPermisos";
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    http.send(`id_usuario=${id_usuario}&permisos=${permisos.join(',')}`);
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            $("#permisos").modal("hide");
            alertas('Permisos actualizados', 'success');
        }
    }
}
