/**
 * Archivo: Assets/js/comun.js
 * Descripción: Funciones comunes y utilitarias compartidas por todos los módulos
 * Dependencias: jQuery, SweetAlert2, Select2
 */

// Variables globales de tablas (inicializadas en módulos)

/**
 * Mostrar alertas personalizadas con SweetAlert2
 * @param {string} msg - Mensaje a mostrar
 * @param {string} icono - Tipo de icono: 'success', 'warning', 'error', 'info'
 */
function alertas(msg, icono) {
    Swal.fire({
        title: msg,
        icon: icono,
        position: 'top-end',
        toast: true,
        showConfirmButton: false,
        timer: 3000
    });
}

/**
 * Preview de imagen antes de subir
 * @param {Event} e - Evento del input file
 */
function preview(e) {
    var input = document.getElementById('imagen');
    var filePath = input.value;
    var extension = /(\.png|\.jpeg|\.jpg)$/i;
    if (!extension.exec(filePath)) {
        alertas('Seleccione un archivo válido', 'warning');
        deleteImg();
        return false;
    }else{
        const url = e.target.files[0];
        const urlTmp = URL.createObjectURL(url);
        document.getElementById("img-preview").src = urlTmp;
        document.getElementById("icon-image").classList.add("d-none");
        document.getElementById("icon-cerrar").innerHTML = `
        <button class="btn btn-danger" onclick="deleteImg()"><i class="fa fa-times-circle"></i></button>
        `;
    }
}

/**
 * Eliminar imagen del preview
 */
function deleteImg() {
    document.getElementById("icon-cerrar").innerHTML = '';
    document.getElementById("icon-image").classList.remove("d-none");
    document.getElementById("img-preview").src = '';
    document.getElementById("imagen").value = '';
    document.getElementById("foto_actual").value = '';
}

/**
 * Obtener nuevo token CSRF desde el servidor
 * @returns {Promise} Retorna el token
 */
function obtenerTokenCSRF() {
    return fetch(base_url + "Usuarios/getCsrfToken")
        .then(res => res.json());
}

/**
 * Configurar Select2 para búsquedas dinámicas
 */
document.addEventListener("DOMContentLoaded", function(){
    // Select2 para Estudiantes
    if (document.querySelector('.estudiante')) {
        $('.estudiante').select2({
            placeholder: 'Buscar Estudiante',
            minimumInputLength: 2,
            ajax: {
                url: base_url + 'Estudiantes/buscarEstudiante',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            }
        });
    }

    // Select2 para Autores
    if (document.querySelector('.autor')) {
        $('.autor').select2({
            placeholder: 'Buscar Autor',
            minimumInputLength: 2,
            ajax: {
                url: base_url + 'Autor/buscarAutor',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            }
        });
    }

    // Select2 para Editoriales
    if (document.querySelector('.editorial')) {
        $('.editorial').select2({
            placeholder: 'Buscar Editorial',
            minimumInputLength: 2,
            ajax: {
                url: base_url + 'Editorial/buscarEditorial',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            }
        });
    }

    // Select2 para Materias
    if (document.querySelector('.materia')) {
        $('.materia').select2({
            placeholder: 'Buscar Materia',
            minimumInputLength: 2,
            ajax: {
                url: base_url + 'Materia/buscarMateria',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            }
        });
    }

    // Evento para cambiar contraseña
    if (document.querySelector("#modalPass")) {
        document.querySelector("#modalPass").addEventListener("click", function () {
            document.querySelector('#frmCambiarPass').reset();
            $('#cambiarClave').modal('show');
        });
    }

    // Verificar préstamos pendientes (notificaciones)
    if (document.getElementById('nombre_estudiante')) {
        const http = new XMLHttpRequest();
        const url = base_url + 'Prestamos/verificar';
        http.open("GET", url);
        http.send();
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                let html = '';
                res.forEach(row => {
                    html += `
                    <a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-primary"></i><i class="fa fa-user-o fa-stack-1x fa-inverse"></i></span></span>
                        <div>
                            <p class="app-notification__message" id="nombre_estudiante">${row.nombre}</p>
                            <p class="app-notification__meta" id="fecha_entrega">${row.fecha_devolucion}</p>
                        </div>
                    </a>
                    `;
                });
                document.getElementById('nombre_estudiante').innerHTML = html;
            }
        }
    }
});
