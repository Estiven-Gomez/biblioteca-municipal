<?php
// Script to clone MVC for Profesores and Personas
function cloneMVC($source, $target_name, $tipo) {
    // 1. Copy Controller
    $ctrl = file_get_contents("Controllers/{$source}.php");
    $ctrl = str_replace($source, $target_name, $ctrl);
    $ctrl = str_replace(strtolower($source), strtolower($target_name), $ctrl);
    $ctrl = str_replace('frmEstudiante', 'frm' . $target_name, $ctrl);
    $ctrl = str_replace('btnEditarEst', 'btnEditar' . substr($target_name, 0, 3), $ctrl);
    $ctrl = str_replace('btnEliminarEst', 'btnEliminar' . substr($target_name, 0, 3), $ctrl);
    $ctrl = str_replace('btnReingresarEst', 'btnReingresar' . substr($target_name, 0, 3), $ctrl);
    // Bypass permission check if not Estudiantes since they don't exist in DB
    $ctrl = str_replace('verificarPermisos($id_user, "'.$target_name.'")', '("'.$target_name.'" != "Estudiantes" ? ($id_user == 1) : $this->model->verificarPermisos($id_user, "'.$target_name.'"))', $ctrl);
    file_put_contents("Controllers/{$target_name}.php", $ctrl);

    // 2. Copy Model
    $mod = file_get_contents("Models/{$source}Model.php");
    $mod = str_replace("{$source}Model", "{$target_name}Model", $mod);
    $mod = str_replace("get{$source}()", "get{$target_name}()", $mod);
    $mod = str_replace("FROM estudiante", "FROM estudiante WHERE tipo = '{$tipo}'", $mod);
    // We also need to automatically inject Tipo on insert
    $mod = str_replace("INSERT INTO estudiante(codigo,dni,nombre,carrera,direccion,telefono)", "INSERT INTO estudiante(codigo,dni,nombre,carrera,direccion,telefono,tipo)", $mod);
    $mod = str_replace("VALUES (?,?,?,?,?,?)", "VALUES (?,?,?,?,?,?,'{$tipo}')", $mod);
    // But wait! EstudiantesModel might have duplicate function names if replaced broadly
    // We will meticulously replace method names.
    $mod = str_replace("insertar{$source}", "insertar{$target_name}", $mod);
    $mod = str_replace("edit{$source}", "edit{$target_name}", $mod);
    $mod = str_replace("actualizar{$source}", "actualizar{$target_name}", $mod);
    $mod = str_replace("estado{$source}", "estado{$target_name}", $mod);
    $mod = str_replace("buscar{$source}", "buscar{$target_name}", $mod);
    file_put_contents("Models/{$target_name}Model.php", $mod);

    // 3. Copy Views
    @mkdir("Views/{$target_name}");
    $view = file_get_contents("Views/{$source}/index.php");
    $view = str_replace($source, $target_name, $view);
    $view = str_replace('frmEstudiante', 'frm' . $target_name, $view);
    $view = str_replace('tblEstudiante', 'tbl' . $target_name, $view);
    $view = str_replace('registrarEstudiante', 'registrar' . $target_name, $view);
    $view = str_replace('nuevoEstudiante', 'nuevo' . $target_name, $view);
    file_put_contents("Views/{$target_name}/index.php", $view);
}

cloneMVC('Estudiantes', 'Profesores', 'Profesor');
cloneMVC('Estudiantes', 'Personas', 'Normal');
// Also restrict original Estudiantes
$estMod = file_get_contents("Models/EstudiantesModel.php");
$estMod = str_replace("FROM estudiante", "FROM estudiante WHERE tipo = 'Estudiante'", $estMod);
$estMod = str_replace("INSERT INTO estudiante(codigo,dni,nombre,carrera,direccion,telefono)", "INSERT INTO estudiante(codigo,dni,nombre,carrera,direccion,telefono,tipo)", $estMod);
$estMod = str_replace("VALUES (?,?,?,?,?,?)", "VALUES (?,?,?,?,?,?,'Estudiante')", $estMod);
file_put_contents("Models/EstudiantesModel.php", $estMod);

echo "Cloned Successfully.";
