function frmLogin(e) {
    e.preventDefault();
    const usuario = document.getElementById("usuario");
    const clave = document.getElementById("clave");
    if (usuario.value == "") {
        clave.classList.remove("is-invalid");
        usuario.classList.add("is-invalid");
        usuario.focus();
    } else if (clave.value == "") {
        usuario.classList.remove("is-invalid");
        clave.classList.add("is-invalid");
        clave.focus();
    } else {
        const url = base_url + "Usuarios/validar";
        const frm = document.getElementById("frmLogin");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if (res.icono == "success") {
                    window.location.href = base_url + "Configuracion/admin";
                } else {
                    document.getElementById("alerta").classList.remove("d-none");
                    document.getElementById("alerta").innerHTML = res.msg;
                }
            }
        }
    }
}

function frmRegister(e) {
    e.preventDefault();
    const nombre = document.getElementById("nombre");
    const usuario = document.getElementById("reg_usuario");
    const clave = document.getElementById("reg_clave");
    const confirmar = document.getElementById("confirmar");
    const alerta = document.getElementById("alerta-register");
    
    if (nombre.value == "" || usuario.value == "" || clave.value == "" || confirmar.value == "") {
        alerta.classList.remove("d-none");
        alerta.innerHTML = "Todos los campos son obligatorios";
        return;
    }
    if (clave.value !== confirmar.value) {
        alerta.classList.remove("d-none");
        alerta.innerHTML = "Las contraseñas no coinciden";
        return;
    }

    const url = base_url + "Usuarios/registrar";
    const frm = document.getElementById("frmRegister");
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    /* Set id field to blank explicitly so model knows it's an insert */
    document.getElementById("id").value = "";
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            if (res.icono == "success") {
                alerta.classList.add("d-none");
                // Pre-fill username to login
                document.getElementById("usuario").value = usuario.value;
                // Flip back to login and show success
                document.getElementById('frmRegister').reset();
                document.getElementById('container').classList.remove('right-panel-active');
                const loginAlerta = document.getElementById("alerta");
                loginAlerta.classList.remove("d-none");
                loginAlerta.classList.remove("alert-danger");
                loginAlerta.classList.add("alert-success");
                loginAlerta.innerHTML = "Registro exitoso. Ahora puedes iniciar sesión.";
                document.getElementById("clave").focus();
            } else {
                alerta.classList.remove("d-none");
                alerta.innerHTML = res.msg;
            }
        }
    }
}