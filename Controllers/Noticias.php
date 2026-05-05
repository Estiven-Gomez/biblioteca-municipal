<?php
class Noticias extends Controller
{
    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (empty($_SESSION['activo'])) {
            header("location: " . base_url);
        }
        parent::__construct();
        $id_user = $_SESSION['id_usuario'];
        // Require Super Admin strictly for management
        if ($id_user != 1) {
            $this->views->getView($this, "permisos");
            exit;
        }
    }
    public function index()
    {
        $this->views->getView($this, "index");
    }
    public function listar()
    {
        $data = $this->model->getNoticias();
        for ($i = 0; $i < count($data); $i++) {
            $id = $data[$i]['id'];
            if ($data[$i]['estado'] == 1) {
                $data[$i]['estado'] = '<span class="badge badge-success">Activo</span>';
                $data[$i]['acciones'] = '<button class="btn btn-primary btn-sm" onclick="btnEditarNoticia(' . $id . ')"><i class="fa fa-pencil-square-o"></i></button> <button class="btn btn-danger btn-sm" onclick="btnEliminarNoticia(' . $id . ')"><i class="fa fa-trash-o"></i></button>';
            } else {
                $data[$i]['estado'] = '<span class="badge badge-danger">Inactivo</span>';
                $data[$i]['acciones'] = '<button class="btn btn-success btn-sm" onclick="btnReingresarNoticia(' . $id . ')"><i class="fa fa-reply-all"></i></button>';
            }
        }
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT);
        die();
    }
    public function registrar()
    {
        $titulo = strClean($_POST['titulo']);
        $contenido = strClean($_POST['contenido']);
        $id = strClean($_POST['id']);
        
        $img = $_FILES['imagen'];
        $name = $img['name'];
        $tmpName = $img['tmp_name'];
        $fecha = date('YmdHis');
        if (!empty($name)) {
            $imgName = $fecha . "_" . $name;
            $destino = 'Assets/img/noticias/' . $imgName;
        } else {
            $imgName = "";
        }
        
        if (empty($titulo) || empty($contenido)) {
            $msg = array('msg' => 'Todo los campos son requeridos', 'icono' => 'warning');
        } else {
            // Upload Check
            if (!empty($name)) {
                $formatos_permitidos =  array('png', 'jpeg', 'jpg');
                $extension = pathinfo($name, PATHINFO_EXTENSION);
                if (!in_array($extension, $formatos_permitidos)) {
                    echo json_encode(array('msg' => 'Archivo no permitido', 'icono' => 'warning'), JSON_UNESCAPED_UNICODE);
                    die();
                }
            }

            if ($id == "") {
                $data = $this->model->insertarNoticia($titulo, $contenido, $imgName);
                if ($data == "ok") {
                    if (!empty($name)) { move_uploaded_file($tmpName, $destino); }
                    $msg = array('msg' => 'Noticia registrada con éxito', 'icono' => 'success');
                } else if ($data == "existe") {
                    $msg = array('msg' => 'La noticia ya existe', 'icono' => 'warning');
                } else {
                    $msg = array('msg' => 'Error al registrar la noticia', 'icono' => 'error');
                }
            } else {
                $data = $this->model->actualizarNoticia($titulo, $contenido, $imgName, $id);
                if ($data == "modificado") {
                    if (!empty($name)) { move_uploaded_file($tmpName, $destino); }
                    $msg = array('msg' => 'Noticia modificada con éxito', 'icono' => 'success');
                } else {
                    $msg = array('msg' => 'Error al modificar la noticia', 'icono' => 'error');
                }
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function editar($id)
    {
        $data = $this->model->editNoticia($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function eliminar($id)
    {
        $data = $this->model->estadoNoticia(0, $id);
        if ($data == 1) {
            $msg = array('msg' => 'Noticia dada de baja', 'icono' => 'success');
        } else {
            $msg = array('msg' => 'Error al eliminar la noticia', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    public function reingresar($id)
    {
        $data = $this->model->estadoNoticia(1, $id);
        if ($data == 1) {
            $msg = array('msg' => 'Noticia reingresada con éxito', 'icono' => 'success');
        } else {
            $msg = array('msg' => 'Error al reingresar la noticia', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
}
