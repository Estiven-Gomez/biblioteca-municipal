<?php
class PersonasModel extends Query{
    public function __construct()
    {
        parent::__construct();
    }
    public function getPersonas()
    {
        $sql = "SELECT * FROM estudiante WHERE tipo = 'Lector'";
        $res = $this->selectAll($sql);
        return $res;
    }
    public function insertarEstudiante($codigo, $dni, $nombre, $carrera, $direccion, $telefono)
    {
        $verificar = "SELECT * FROM estudiante WHERE tipo = 'Lector' AND codigo = ?";
        $existe = $this->select($verificar, array($codigo));
        if (empty($existe)) {
            $query = "INSERT INTO estudiante(codigo,dni,nombre,carrera,direccion,telefono,tipo) VALUES (?,?,?,?,?,?,'Lector')";
            $datos = array($codigo, $dni, $nombre, $carrera, $direccion, $telefono);
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
    public function editEstudiante($id)
    {
        $sql = "SELECT * FROM estudiante WHERE tipo = 'Lector' AND id = ?";
        $res = $this->select($sql, array($id));
        return $res;
    }
    public function actualizarEstudiante($codigo, $dni, $nombre, $carrera, $direccion, $telefono, $id)
    {
        $query = "UPDATE estudiante SET codigo = ?, dni = ?, nombre = ?, carrera = ?, direccion = ?, telefono = ?  WHERE id = ?";
        $datos = array($codigo, $dni, $nombre, $carrera, $direccion, $telefono, $id);
        $data = $this->save($query, $datos);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function estadoEstudiante($estado, $id)
    {
        $query = "UPDATE estudiante SET estado = ? WHERE id = ?";
        $datos = array($estado, $id);
        $data = $this->save($query, $datos);
        return $data;
    }
    public function buscarEstudiante($valor)
    {
        $sql = "SELECT id, codigo, nombre AS text FROM estudiante WHERE tipo = 'Lector' AND (codigo LIKE ? OR nombre LIKE ?) AND estado = 1 LIMIT 10";
        $datos = array('%'.$valor.'%', '%'.$valor.'%');
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
