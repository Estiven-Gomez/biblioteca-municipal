<?php
class UsuariosModel extends Query{
    private $usuario, $nombre, $clave, $id, $estado;
    public function __construct()
    {
        parent::__construct();
    }
    public function getUsuario($usuario, $clave)
    {
        $sql = "SELECT * FROM usuarios WHERE usuario = ? AND estado = 1";
        $datos = array($usuario);
        $data = $this->select($sql, $datos);
        if ($data && password_verify($clave, $data['clave'])) {
            return $data;
        }
        return null;
    }
    public function getUsuarios()
    {
        $sql = "SELECT * FROM usuarios";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function registrarUsuario($usuario, $nombre, $clave, $rol)
    {
        $this->usuario = $usuario;
        $this->nombre = $nombre;
        $this->clave = $clave;
        $vericar = "SELECT * FROM usuarios WHERE usuario = ?";
        $existe = $this->select($vericar, array($this->usuario));
        if (empty($existe)) {
            $sql = "INSERT INTO usuarios(usuario, nombre, clave) VALUES (?,?,?)";
            $datos = array($this->usuario, $this->nombre, $this->clave);
            $data = $this->save($sql, $datos);
            if ($data == 1) {
                // Recuperar el id del usuario insertado
                $sql_id = "SELECT id FROM usuarios WHERE usuario = ?";
                $user_data = $this->select($sql_id, array($this->usuario));
                
                if (!empty($user_data)) {
                    $id_usuario = $user_data['id'];
                    
                    // Insertar su perfil virtual paralelo en la tabla de lectores (estudiante)
                    $codigo_virtual = "U" . $id_usuario;
                    $dni_virtual = "DNI" . $id_usuario;
                    $sql_est = "INSERT INTO estudiante(codigo, dni, nombre, carrera, direccion, telefono, tipo, usuario_id) VALUES (?,?,?,?,?,?,?,?)";
                    $this->save($sql_est, array($codigo_virtual, $dni_virtual, $this->nombre, 'N/A', 'N/A', 'N/A', $rol, $id_usuario));

                    // Permisos por defecto (Privados): 1 (Libros), 7 (Materias), 9 (Prestamos)
                    $permisos_default = [1, 7, 9];
                    foreach ($permisos_default as $id_permiso) {
                        $sql_permiso = "INSERT INTO detalle_permisos(id_usuario, id_permiso) VALUES (?,?)";
                        $this->save($sql_permiso, array($id_usuario, $id_permiso));
                    }
                }
                
                $res = "ok";
            }else{
                $res = "error";
            }
        }else{
            $res = "existe";
        }
        return $res;
    }
    public function modificarUsuario($usuario, $nombre, $id)
    {
        $this->usuario = $usuario;
        $this->nombre = $nombre;
        $this->id = $id;
        $sql = "UPDATE usuarios SET usuario = ?, nombre = ? WHERE id = ?";
        $datos = array($this->usuario, $this->nombre, $this->id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        }
        return $res;
    }
    public function editarUser($id)
    {
        $sql = "SELECT * FROM usuarios WHERE id = ?";
        $datos = array($id);
        $data = $this->select($sql, $datos);
        return $data;
    }
    public function accionUser($estado, $id)
    {
        $this->id = $id;
        $this->estado = $estado;
        $sql = "UPDATE usuarios SET estado = ? WHERE id = ?";
        $datos = array($this->estado, $this->id);
        $data = $this->save($sql, $datos);
        return $data;
    }
    public function getPermisos()
    {
        $sql = "SELECT * FROM permisos";
        $data = $this->selectAll($sql);
        return $data;
    }
    public function getDetallePermisos($id)
    {
        $sql = "SELECT * FROM detalle_permisos WHERE id_usuario = ?";
        $datos = array($id);
        $data = $this->selectAll($sql, $datos);
        return $data;
    }
    public function deletePermisos($id)
    {
        $sql = "DELETE FROM detalle_permisos WHERE id_usuario = ?";
        $datos = array($id);
        $data = $this->save($sql, $datos);
        return $data;
    }
    public function actualizarPermisos($usuario, $permiso)
    {
        $sql = "INSERT INTO detalle_permisos(id_usuario, id_permiso) VALUES (?,?)";
            $datos = array($usuario, $permiso);
            $data = $this->save($sql, $datos);
            if ($data == 1) {
                $res = "ok";
            } else {
                $res = "error";
            }
        return $res;
    }
    public function verificarPermisos($id_user, $permiso)
    {
        $tiene = false;
        $sql = "SELECT p.*, d.* FROM permisos p INNER JOIN detalle_permisos d ON p.id = d.id_permiso WHERE d.id_usuario = ? AND p.nombre = ?";
        $datos = array($id_user, $permiso);
        $existe = $this->select($sql, $datos);
        if ($existe != null || $existe != "") {
            $tiene = true;
        }
        return $tiene;
    }
    public function actualizarPass($clave, $id)
    {
        $sql = "UPDATE usuarios SET clave = ? WHERE id = ?";
        $datos = array($clave, $id);
        $data = $this->save($sql, $datos);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        }
        return $res;
    }
}
?>