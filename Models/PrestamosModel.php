<?php
class PrestamosModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getPrestamos()
    {
        $sql = "SELECT e.id, e.nombre, l.id, l.titulo, p.id, p.id_estudiante, p.id_libro, p.fecha_prestamo, p.fecha_devolucion, p.cantidad, p.observacion, p.estado FROM estudiante e INNER JOIN libro l INNER JOIN prestamo p ON p.id_estudiante = e.id WHERE p.id_libro = l.id";
        $res = $this->selectAll($sql);
        return $res;
    }
    public function getPrestamosUser($id_usuario)
    {
        $sql = "SELECT e.id, e.nombre, l.id, l.titulo, p.id, p.id_estudiante, p.id_libro, p.fecha_prestamo, p.fecha_devolucion, p.cantidad, p.observacion, p.estado FROM estudiante e INNER JOIN libro l INNER JOIN prestamo p ON p.id_estudiante = e.id WHERE p.id_libro = l.id AND e.usuario_id = ?";
        $res = $this->selectAll($sql, array($id_usuario));
        return $res;
    }
    public function getEstudianteIdByUsuario($id_usuario)
    {
        $sql = "SELECT id FROM estudiante WHERE usuario_id = ?";
        $res = $this->select($sql, array($id_usuario));
        return empty($res) ? null : $res['id'];
    }
    public function insertarPrestamo($estudiante,$libro, $cantidad, string $fecha_prestamo, string $fecha_devolucion, string $observacion)
    {
        $verificar = "SELECT * FROM prestamo WHERE id_libro = ? AND id_estudiante = ? AND estado = 1";
        $existe = $this->select($verificar, array($libro, $estudiante));
        if (empty($existe)) {
            $query = "INSERT INTO prestamo(id_estudiante, id_libro, fecha_prestamo, fecha_devolucion, cantidad, observacion) VALUES (?,?,?,?,?,?)";
            $datos = array($estudiante, $libro, $fecha_prestamo, $fecha_devolucion, $cantidad, $observacion);
            $data = $this->insert($query, $datos);
            if ($data > 0) {
                $lib = "SELECT * FROM libro WHERE id = ?";
                $resLibro = $this->select($lib, array($libro));
                $total = $resLibro['cantidad'] - $cantidad;
                $libroUpdate = "UPDATE libro SET cantidad = ? WHERE id = ?";
                $datosLibro = array($total, $libro);
                $this->save($libroUpdate, $datosLibro);
                $res = $data;
            } else {
                $res = 0;
            }
        } else {
            $res = "existe";
        }
        return $res;
    }
    public function actualizarPrestamo($estado, $id)
    {
        $sql = "UPDATE prestamo SET estado = ? WHERE id = ?";
        $datos = array($estado, $id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $lib = "SELECT * FROM prestamo WHERE id = ?";
            $resLibro = $this->select($lib, array($id));
            $id_libro = $resLibro['id_libro'];
            $lib = "SELECT * FROM libro WHERE id = ?";
            $residLibro = $this->select($lib, array($id_libro));
            $total = $residLibro['cantidad'] + $resLibro['cantidad'];
            $libroUpdate = "UPDATE libro SET cantidad = ? WHERE id = ?";
            $datosLibro = array($total, $id_libro);
            $this->save($libroUpdate, $datosLibro);
            $res = "ok";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function selectDatos()
    {
        $sql = "SELECT * FROM configuracion";
        $res = $this->select($sql);
        return $res;
    }
    public function getCantLibro($libro)
    {
        $sql = "SELECT * FROM libro WHERE id = ?";
        $res = $this->select($sql, array($libro));
        return $res;
    }
    public function selectPrestamoDebe()
    {
        $sql = "SELECT e.id, e.nombre, l.id, l.titulo, p.id, p.id_estudiante, p.id_libro, p.fecha_prestamo, p.fecha_devolucion, p.cantidad, p.observacion, p.estado FROM estudiante e INNER JOIN libro l INNER JOIN prestamo p ON p.id_estudiante = e.id WHERE p.id_libro = l.id AND p.estado = 1 ORDER BY e.nombre ASC";
        $res = $this->selectAll($sql);
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
    public function getPrestamoLibro($id_prestamo)
    {
        $sql = "SELECT e.id, e.codigo, e.nombre, e.carrera, l.id, l.titulo, p.id, p.id_estudiante, p.id_libro, p.fecha_prestamo, p.fecha_devolucion, p.cantidad, p.observacion, p.estado FROM estudiante e INNER JOIN libro l INNER JOIN prestamo p ON p.id_estudiante = e.id WHERE p.id_libro = l.id AND p.id = ?";
        $res = $this->select($sql, array($id_prestamo));
        return $res;
    }
}
