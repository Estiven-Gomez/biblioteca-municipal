<?php
class LibrosModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getLibros()
    {
        $sql = "SELECT l.*, m.materia, a.autor, e.editorial FROM libro l INNER JOIN materia m ON l.id_materia = m.id INNER JOIN autor a ON l.id_autor = a.id INNER JOIN editorial e ON l.id_editorial = e.id";
        $res = $this->selectAll($sql);
        return $res;
    }
    public function insertarLibros($titulo,$id_autor,$id_editorial,$id_materia,$cantidad,$num_pagina,$anio_edicion,$descripcion,$imgNombre)
    {
        $verificar = "SELECT * FROM libro WHERE titulo = ?";
        $existe = $this->select($verificar, array($titulo));
        if (empty($existe)) {
            $query = "INSERT INTO libro(titulo, id_autor, id_editorial, id_materia, cantidad, num_pagina, anio_edicion, descripcion, imagen) VALUES (?,?,?,?,?,?,?,?,?)";
            $datos = array($titulo, $id_autor, $id_editorial, $id_materia, $cantidad, $num_pagina, $anio_edicion, $descripcion, $imgNombre);
            $data = $this->save($query, $datos);
            if ($data == 1) {
                $res = "ok";
            } else {
                $res = "error";
            }
        } else {
            $res = "existe";
        }
        return $res;
    }
    public function editLibros($id)
    {
        $sql = "SELECT * FROM libro WHERE id = ?";
        $res = $this->select($sql, array($id));
        return $res;
    }
    public function actualizarLibros($titulo, $id_autor, $id_editorial, $id_materia, $cantidad, $num_pagina, $anio_edicion, $descripcion, $imgNombre, $id)
    {
        $query = "UPDATE libro SET titulo = ?, id_autor=?, id_editorial=?, id_materia=?, cantidad=?, num_pagina=?, anio_edicion=?, descripcion=?, imagen=? WHERE id = ?";
        $datos = array($titulo, $id_autor, $id_editorial, $id_materia, $cantidad, $num_pagina, $anio_edicion, $descripcion, $imgNombre, $id);
        $data = $this->save($query, $datos);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function estadoLibros($estado, $id)
    {
        $query = "UPDATE libro SET estado = ? WHERE id = ?";
        $datos = array($estado, $id);
        $data = $this->save($query, $datos);
        return $data;
    }
    public function buscarLibro($valor)
    {
        $sql = "SELECT id, titulo AS text FROM libro WHERE titulo LIKE ? AND estado = 1 LIMIT 10";
        $datos = array('%'.$valor.'%');
        $data = $this->selectAll($sql, $datos);
        return $data;
    }
    public function verificarPermisos($id_user, $permiso)
    {
        $tiene = false;
        $sql = "SELECT p.*, d.* FROM permisos p INNER JOIN detalle_permisos d ON p.id = d.id_permiso WHERE d.id_usuario = ? AND p.nombre = ?";
        $existe = $this->select($sql, array($id_user, $permiso));
        if ($existe != null || $existe != "") {
            $tiene = true;
        }
        return $tiene;
    }
}
