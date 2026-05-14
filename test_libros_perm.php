<?php
session_start();
$_SESSION['activo'] = true;
$_SESSION['id_usuario'] = 2; // Simulate a non-admin user
$_SESSION['nombre'] = 'Test';
$_SESSION['usuario'] = 'test';

require_once 'Config/Config.php';
require_once 'Config/App/Conexion.php';
require_once 'Config/App/Query.php';
require_once 'Config/App/Controller.php';

require_once 'Controllers/Libros.php';

class MockLibros extends Libros {
    public function __construct() {
        require_once 'Models/LibrosModel.php';
        $this->model = new class extends LibrosModel {
            public function verificarPermisos($id_user, $permiso) {
                return true;
            }
        };
        require_once 'Config/App/Views.php';
        $this->views = new Views();
        $id_user = $_SESSION['id_usuario'];
        $perm = $this->model->verificarPermisos($id_user, "Libros");
        if (!$perm && $id_user != 1) {
            $this->views->getView($this, "permisos");
            exit;
        }
    }
}

$libros = new MockLibros();
ob_start();
$libros->listar();
$output = ob_get_clean();
file_put_contents('output_perm.txt', substr($output, 0, 100));
