<?php
session_start();
$_SESSION['activo'] = true;
$_SESSION['id_usuario'] = 1; // Admin user
$_SESSION['nombre'] = 'Admin';
$_SESSION['usuario'] = 'admin';

require_once 'Config/Config.php';
require_once 'Config/App/Conexion.php';
require_once 'Config/App/Query.php';
require_once 'Config/App/Controller.php';

require_once 'Controllers/Libros.php';

class MockLibrosAdmin extends Libros {
    public function __construct() {
        require_once 'Models/LibrosModel.php';
        $this->model = new LibrosModel();
        
        require_once 'Config/App/Views.php';
        $this->views = new Views();
        
        parent::__construct();
    }
}

$libros = new MockLibrosAdmin();
$libros->listar();
