<?php
require_once 'Config/Config.php';
require_once 'Libraries/Core/Conexion.php';
require_once 'Libraries/Core/Mysql.php';
require_once 'Libraries/Core/Query.php';
require_once 'Models/LibrosModel.php';

$model = new LibrosModel();
$data = $model->getLibros();
for ($i = 0; $i < count($data); $i++) {
    $img_src = base_url . "Assets/img/libros/" . $data[$i]['imagen'];
    $data[$i]['foto'] = '<img class="img-thumbnail" src="' . $img_src . '" width="100">';
    $data[$i]['estado'] = '<span class="badge badge-success">Activo</span>';
    $data[$i]['acciones'] = '';
}
echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT);
