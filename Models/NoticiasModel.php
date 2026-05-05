<?php
class NoticiasModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getNoticias()
    {
        $sql = "SELECT * FROM noticias ORDER BY id DESC";
        $res = $this->selectAll($sql);
        return $res;
    }
    public function getNoticiasActivas()
    {
        $sql = "SELECT * FROM noticias WHERE estado = 1 ORDER BY id DESC";
        $res = $this->selectAll($sql);
        return $res;
    }
    public function insertarNoticia($titulo, $contenido, $img)
    {
        $query = "INSERT INTO noticias(titulo, contenido, imagen) VALUES (?, ?, ?)";
        $datos = array($titulo, $contenido, $img);
        $data = $this->save($query, $datos);
        if ($data == 1) {
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function editNoticia($id)
    {
        $sql = "SELECT * FROM noticias WHERE id = ?";
        $res = $this->select($sql, array($id));
        return $res;
    }
    public function actualizarNoticia($titulo, $contenido, $img, $id)
    {
        if ($img != "") {
            $query = "UPDATE noticias SET titulo = ?, contenido = ?, imagen = ? WHERE id = ?";
            $datos = array($titulo, $contenido, $img, $id);
        } else {
            $query = "UPDATE noticias SET titulo = ?, contenido = ? WHERE id = ?";
            $datos = array($titulo, $contenido, $id);
        }
        $data = $this->save($query, $datos);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function estadoNoticia($estado, $id)
    {
        $query = "UPDATE noticias SET estado = ? WHERE id = ?";
        $datos = array($estado, $id);
        $data = $this->save($query, $datos);
        return $data;
    }
    public function verificarPermisos($id_user, $permiso)
    {
        $tiene = false;
        $sql = "SELECT p.*, d.* FROM permisos p INNER JOIN detalle_permisos d ON p.id = d.id_permiso WHERE d.id_usuario = ? AND p.nombre = ?";
        $existe = $this->select($sql, array($id_user, $permiso));
        if (!empty($existe) || $id_user == 1) {
            $tiene = true;
        }
        return $tiene;
    }
}
