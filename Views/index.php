<?php require_once __DIR__ . "/../Config/Config.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url; ?>Assets/css/font-awesome.min.css">
    <title>Iniciar | Sesión</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&display=swap');

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background-image: url('<?php echo base_url; ?>Assets/img/login-bg.png');
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }

        h1 {
            font-weight: 700;
            margin: 0 0 20px 0;
            color: #4da6ff;
            font-size: 28px;
            text-align: center;
        }

        .prompt-panel h1 {
            color: #ffffff;
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        p {
            font-size: 14px;
            font-weight: 400;
            line-height: 20px;
            letter-spacing: 0.5px;
            margin: 0 0 30px;
            color: #ffffff;
            text-align: center;
        }

        /* El contenedor estructural (transparente) */
        .container {
            position: relative;
            width: 900px;
            max-width: 95%;
            min-height: 580px;
        }

        /* Capa inferior azul translúcido (menos alta que el contenedor) */
        .blue-underlay {
            position: absolute;
            top: 10%;
            left: 0;
            width: 100%;
            height: 80%;
            background-color: rgba(69, 149, 235, 0.25);
            backdrop-filter: blur(6px);
            border-radius: 15px;
            box-shadow: 0 14px 28px rgba(0,0,0,0.25), 
                        0 10px 10px rgba(0,0,0,0.22);
            z-index: 0;
            overflow: hidden;
        }

        /* Contenedor de Textos al fondo (Se empareja con la altura del underlay azul) */
        .prompt-container {
            position: absolute;
            top: 10%;
            left: 0;
            width: 100%;
            height: 80%;
            display: flex;
            justify-content: space-between;
            z-index: 1;
        }

        .prompt-panel {
            width: 50%; /* 50/50 para que el blanco sea menos ancho */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 0 30px;
        }

        /* Tarjeta Blanca Externa Deslizante (Toma el 100% de la altura) */
        .sliding-white-panel {
            position: absolute;
            top: 0;
            left: 0;
            width: 50%; /* 50/50 Proporción */
            height: 100%;
            background-color: #fff;
            border-radius: 15px;
            z-index: 5;
            transition: transform 0.6s ease-in-out;
            box-shadow: 0 0 25px rgba(0,0,0,0.3);
            overflow: hidden;
        }

        .container.right-panel-active .sliding-white-panel {
            /* Mueve Panel a la derecha */
            transform: translateX(100%);
        }

        .forms-wrapper {
            position: relative;
            width: 100%;
            height: 100%;
        }

        /* Formularios Estructura Base */
        .form-panel {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            padding: 0 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background-color: #fff;
            transition: transform 0.6s ease-in-out, opacity 0.6s ease-in-out;
            text-align: left;
        }

        /* Form 1: Sign In */
        .sign-in-panel {
            z-index: 2;
            opacity: 1;
            transform: translateX(0);
        }

        .container.right-panel-active .sign-in-panel {
            transform: translateX(-100%);
            opacity: 0;
            z-index: 1;
        }

        /* Form 2: Sign Up */
        .sign-up-panel {
            z-index: 1;
            opacity: 0;
            transform: translateX(100%);
        }

        .container.right-panel-active .sign-up-panel {
            transform: translateX(0);
            opacity: 1;
            z-index: 5;
        }

        /* Componentes de Formulario */
        input {
            background-color: #f6f5f7;
            border: none;
            padding: 12px 15px;
            margin: 8px 0;
            width: 100%;
            font-family: 'Montserrat', sans-serif;
            font-size: 13px;
            outline: none;
            color: #555;
            border-radius: 4px;
        }
        
        .form-panel label {
            font-size: 11px;
            font-weight: 600;
            color: #444;
            margin-top: 5px;
            text-align: left;
            width: 100%;
        }

        button {
            border-radius: 4px;
            border: 1px solid #4da6ff;
            background-color: #4da6ff;
            color: #FFFFFF;
            font-size: 13px;
            font-weight: bold;
            padding: 12px 30px;
            letter-spacing: 1px;
            transition: transform 80ms ease-in;
            cursor: pointer;
            margin-top: 15px;
            font-family: 'Montserrat', sans-serif;
            align-self: flex-start;
        }

        button:active {
            transform: scale(0.95);
        }

        button:focus {
            outline: none;
        }

        button.ghost {
            background-color: transparent;
            border-color: #FFFFFF;
            align-self: center;
        }
        
        .alert {
            width: 100%;
            text-align: left;
            color: #d9534f;
            font-size: 12px;
            margin-top: 5px;
            font-weight: 600;
        }
        .alert.alert-success {
            color: #5cb85c;
        }
        .d-none {
            display: none !important;
        }

        @media (max-width: 768px) {
            .prompt-panel {
                padding: 0 15px;
            }
            .form-panel {
                padding: 0 30px;
            }
        }
    </style>
</head>
<body>

<div class="container" id="container">
    
    <!-- Capa de fondo azul recortado en altura -->
    <div class="blue-underlay"></div>

    <!-- Textos estáticos detrás en el fondo azul transparente -->
    <div class="prompt-container">
        <!-- Textos lado izquierdo (debajo del login cuando arranca) -->
        <div class="prompt-panel">
            <h1>¿Ya tienes una cuenta?</h1>
            <p>Inicia sesion para entrar en la pagina</p>
            <button class="ghost" id="signIn">Iniciar sesion</button>
        </div>
        <!-- Textos lado derecho (debajo de registro cuando arranca) -->
        <div class="prompt-panel">
            <h1>¿Aun no tienes cuenta?</h1>
            <p>Registrate para que puedas iniciar sesion</p>
            <button class="ghost" id="signUp">Registrarse</button>
        </div>
    </div>

    <!-- La gran tarjeta blanca que flota y desliza por encima -->
    <div class="sliding-white-panel">
        <div class="forms-wrapper">
            
            <!-- Formulario de Iniciar Sesión (Arranca visible lado izquierdo) -->
            <form class="form-panel sign-in-panel" id="frmLogin" onsubmit="frmLogin(event);">
                <h1>Iniciar Sesion</h1>
                <label>USUARIO</label>
                <input type="text" placeholder="Usuario de acceso" id="usuario" name="usuario" autofocus required>
                <label>CONTRASEÑA</label>
                <input type="password" placeholder="Contraseña" id="clave" name="clave" required>
                
                <div class="alert d-none" id="alerta"></div>
                <button type="submit">Entrar</button>
            </form>

            <!-- Formulario de Registro (Arranca oculto para el lado derecho) -->
            <form class="form-panel sign-up-panel" id="frmRegister" onsubmit="frmRegister(event);">
                <h1>Registrarse</h1>
                <input type="hidden" name="id" id="id" value="">
                <input type="hidden" name="csrf_token" id="csrf_token" value="<?php echo generate_csrf_token(); ?>">
                
                <label>NOMBRES Y APELLIDOS</label>
                <input type="text" placeholder="Ej: Juan Perez" id="nombre" name="nombre" required>
                <label>TIPO DE PERFIL</label>
                <select id="rol_registro" name="rol_registro" required style="background-color: #f6f5f7; border: none; padding: 12px 15px; margin: 8px 0; width: 100%; font-family: 'Montserrat', sans-serif; font-size: 13px; outline: none; color: #555; border-radius: 4px;">
                    <option value="Estudiante">Estudiante</option>
                    <option value="Profesor">Profesor</option>
                    <option value="Lector">Lector Externo</option>
                </select>
                <label>USUARIO</label>
                <input type="text" placeholder="Usuario" id="reg_usuario" name="usuario" required>
                <label>CONTRASEÑA</label>
                <input type="password" placeholder="Contraseña" id="reg_clave" name="clave" required>
                <label>CONFIRMAR</label>
                <input type="password" placeholder="Repite contraseña" id="confirmar" name="confirmar" required>
                
                <div class="alert d-none" id="alerta-register"></div>
                <button type="submit">Registrarse</button>
            </form>

        </div>
    </div>
    
</div>

<script src="<?php echo base_url; ?>Assets/js/jquery-3.6.0.min.js"></script>
<script>
    const base_url = '<?php echo base_url; ?>';
    
    // Sliders Logic
    const signUpButton = document.getElementById('signUp');
    const signInButton = document.getElementById('signIn');
    const container = document.getElementById('container');

    signUpButton.addEventListener('click', () => {
        container.classList.add("right-panel-active");
    });

    signInButton.addEventListener('click', () => {
        container.classList.remove("right-panel-active");
    });
</script>
<script src="<?php echo base_url; ?>Assets/js/login.js?v=<?php echo uniqid(); ?>"></script>
</body>
</html>