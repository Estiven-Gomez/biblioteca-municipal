<?php
class ConfiguracionModel extends Query{
    protected $id, $nombre, $telefono, $direccion, $correo, $img;
    public function __construct()
    {
        parent::__construct();
    }
    public function selectConfiguracion()
    {
        $sql = "SELECT * FROM configuracion";
        $res = $this->select($sql);
        return $res;
    }
    public function actualizarConfig($nombre, $telefono, $direccion, $correo, $img, $id)
    {
        $this->telefono =$telefono;
        $this->nombre = $nombre;
        $this->direccion = $direccion;
        $this->correo = $correo;
        $this->img = $img;
        $this->id = $id;
        $sql = "UPDATE configuracion SET nombre = ?, telefono = ?, direccion = ?, correo = ?, foto = ? WHERE id = ?";
        $datos = array($this->nombre, $this->telefono, $this->direccion, $this->correo, $this->img, $this->id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function selectDatos($nombre)
    {
        $sql = "SELECT COUNT(*) AS total FROM $nombre WHERE estado = 1";
        $res = $this->select($sql);
        return $res;
    }
    public function selectDatosTipo($nombre, $tipo)
    {
        $sql = "SELECT COUNT(*) AS total FROM $nombre WHERE estado = 1 AND tipo = ?";
        $res = $this->select($sql, array($tipo));
        return $res;
    }
    public function selectNoticias()
    {
        $sql = "SELECT * FROM noticias WHERE estado = 1 ORDER BY fecha DESC LIMIT 5";
        $res = $this->selectAll($sql);
        return $res;
    }
    public function getReportes()
    {
        $sql = "SELECT titulo, cantidad FROM libro WHERE estado = 1";
        $res = $this->selectAll($sql);
        return $res;
    }
    public function getVerificarPrestamos($date)
    {
        $sql = "SELECT p.id, p.id_estudiante, p.fecha_prestamo,p.fecha_devolucion, p.cantidad,p.estado, e.id, e.nombre, l.id, l.titulo FROM prestamo p INNER JOIN estudiante e ON p.id_estudiante = e.id INNER JOIN libro l ON p.id_libro = l.id WHERE p.fecha_devolucion < ? AND p.estado = 1";
        $res = $this->selectAll($sql, array($date));
        return $res;
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
