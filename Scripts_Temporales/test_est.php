<?php
session_start();
$_SESSION['id_usuario'] = 1; // Admin
$_SESSION['activo'] = true;
require_once "Config/Config.php";
require_once "Libraries/Core/Conexion.php";
require_once "Libraries/Core/Mysql.php";
require_once "Libraries/Core/Query.php";
require_once "Libraries/Core/Controllers.php";
require_once "Models/EstudiantesModel.php";
require_once "Controllers/Estudiantes.php";

$est = new Estudiantes();
ob_start();
$est->listar();
$output = ob_get_clean();
echo $output;
