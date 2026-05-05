<?php
session_start();
$_SESSION['id_usuario'] = 2; // Simulate normal user
require_once "Config/Config.php";
require_once "Libraries/Core/Conexion.php";
require_once "Libraries/Core/Mysql.php";
require_once "Libraries/Core/Query.php";
require_once "Libraries/Core/Controllers.php";
require_once "Controllers/Materia.php";

$materia = new Materia();
// Capture stdout
ob_start();
$materia->listar();
$output = ob_get_clean();
echo $output;