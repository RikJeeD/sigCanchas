<?php

include_once(realpath(dirname(__FILE__)) . "/../config/conexion.php");

class usuarios
{
    var $id, $nombre, $apellido, $email, $telefono, $rol, $id_rol, $empresa, $id_empresa;

    public function emailUsuario($email)
    {
        $sql = "SELECT usuario.id, usuario.nombre, usuario.apellido, usuario.email, usuario.telefono, usuario.id_rol, rol.rol, empresa.nombre empresa, usuario.id_empresa"
            . " FROM usuarios usuario"
            . " INNER JOIN roles rol ON rol.id = usuario.id_rol"
            . " LEFT JOIN empresas empresa ON usuario.id_empresa = empresa.id"
            . " WHERE usuario.email = '%s';";
        $query = sprintf($sql, $email);
        $conexion = new Conexion();
        $result = pg_fetch_assoc($conexion->ejecutar($query));
        $conexion->cerrar();
        if (empty($result)) {
            return false;
        }
        $this->id = $result["id"];
        $this->nombre = $result["nombre"];
        $this->apellido = $result["apellido"];
        $this->email = $result["email"];
        $this->telefono = $result["telefono"];
        $this->id_rol = $result["id_rol"];
        $this->rol = $result["rol"];
        $this->empresa = $result["empresa"];
        $this->id_empresa = $result["id_empresa"];
        return true;
    }

    public function getUsuario($id)
    {
        $sql = "SELECT usuario.id, usuario.nombre, usuario.apellido, usuario.email, usuario.telefono, usuario.id_rol, rol.rol, empresa.nombre empresa, usuario.id_empresa"
            . " FROM usuarios usuario"
            . " INNER JOIN roles rol ON rol.id = usuario.id_rol"
            . " LEFT JOIN empresas empresa ON usuario.id_empresa = empresa.id"
            . " WHERE usuario.id = '%s';";
        $query = sprintf($sql, $id);
        $conexion = new Conexion();
        $result = pg_fetch_assoc($conexion->ejecutar($query));
        $conexion->cerrar();
        if (empty($result)) {
            return false;
        }
        $usuario = new usuarios();
        $usuario->id = $result["id"];
        $usuario->nombre = $result["nombre"];
        $usuario->apellido = $result["apellido"];
        $usuario->email = $result["email"];
        $usuario->telefono = $result["telefono"];
        $usuario->id_rol = $result["id_rol"];
        $usuario->rol = $result["rol"];
        $usuario->empresa = $result["empresa"];
        $usuario->id_empresa = $result["id_empresa"];
        return $usuario;
    }


    public function getUsuarios()
    {
        $rol = $_SESSION['user']['rol'];
        if ($rol === "admin" || $rol === "empresa") {
            $sql = "SELECT usuario.id, usuario.nombre, usuario.apellido, usuario.email, usuario.telefono, rol.rol, usuario.id_rol, empresa.nombre empresa, usuario.id_empresa"
                . " FROM usuarios usuario"
                . " INNER JOIN roles rol ON rol.id = usuario.id_rol"
                . " LEFT JOIN empresas empresa ON usuario.id_empresa = empresa.id";
            if ($rol === "empresa") {
                $sql .= " WHERE usuario.id_empresa = '%s'";
            }
            $sql .= " ORDER BY usuario.id asc;";
            $query = sprintf($sql, $_SESSION['user']['id_empresa']);
            $conexion = new Conexion();
            $result = pg_fetch_all($conexion->ejecutar($query));
            $conexion->cerrar();
            $usuarios = [];
            for ($i = 0; $i < count($result); $i++) {
                $usuario = new usuarios();
                $usuario->id = $result[$i]["id"];
                $usuario->nombre = $result[$i]["nombre"];
                $usuario->apellido = $result[$i]["apellido"];
                $usuario->email = $result[$i]["email"];
                $usuario->telefono = $result[$i]["telefono"];
                $usuario->id_rol = $result[$i]["id_rol"];
                $usuario->rol = $result[$i]["rol"];
                $usuario->empresa = $result[$i]["empresa"];
                $usuario->id_empresa = $result[$i]["id_empresa"];
                $usuarios[] = $usuario;
            }
            return $usuarios;
        } else {
            return [];
        }
    }

    public function crearUsuario($password)
    {
        $rol = $_SESSION['user']['rol'];
        if ($rol === "admin" || $rol === "empresa") {
            $sql = "INSERT INTO usuarios"
                . " (nombre, apellido, email, telefono, id_rol, id_empresa, password)"
                . " VALUES ('%s', '%s', '%s', '%s', %s, %s, MD5('%s'));";
            $id_empresa = "NULL";
            if ((int)$this->id_rol === $_SESSION["parameters"]["ID_EMPRESA"]) {
                $id_empresa = $this->id_empresa;
            }
            $query = sprintf($sql, $this->nombre, $this->apellido, $this->email, $this->telefono, $this->id_rol, $id_empresa, $password);
            $conexion = new Conexion();
            if ($conexion->ejecutar($query)) {
                $conexion->cerrar();
                return true;
            } else {
                $conexion->cerrar();
                return false;
            }
        } else {
            return false;
        }
    }

    public function modificarUsuario($password)
    {
        $rol = $_SESSION['user']['rol'];
        if ($rol === "admin" || $rol === "empresa" || (int)$_SESSION['user']['id'] === (int)$this->id) {
            $id_empresa = "NULL";
            if($rol === "usuario"){
                $this->id_rol = $_SESSION['user']['id_rol'];
            }
            if ((int)$this->id_rol === (int)$_SESSION["parameters"]["ID_EMPRESA"]) {
                $id_empresa = $this->id_empresa;
            }
            if (empty($password)) {
                $sql = "UPDATE usuarios"
                    . " SET nombre = '%s', apellido = '%s', email = '%s', telefono = '%s', id_rol = %s, id_empresa = %s"
                    . " WHERE id = '%s';";
                $query = sprintf($sql, $this->nombre, $this->apellido, $this->email, $this->telefono, $this->id_rol, $id_empresa, $this->id);
            } else {
                $sql = "UPDATE usuarios"
                    . " SET nombre = '%s', apellido = '%s', email = '%s', telefono = '%s', id_rol = %s, id_empresa = %s, password = MD5('%s')"
                    . " WHERE id = '%s';";
                $query = sprintf($sql, $this->nombre, $this->apellido, $this->email, $this->telefono, $this->id_rol, $id_empresa, $password, $this->id);
            }
            $conexion = new Conexion();
            if ($conexion->ejecutar($query)) {
                $conexion->cerrar();
                return true;
            } else {
                $conexion->cerrar();
                return false;
            }
        } else {
            $usuario = new usuarios();
            return $usuario;
        }
    }
	
	public function eliminarUsuario($id)
    {
        $rol = $_SESSION['user']['rol'];
        $sql = "DELETE FROM usuarios WHERE id = %s;";
        $query = sprintf($sql, $id);
        if ($rol === "admin" || $rol === "empresa" || (int)$_SESSION['user']['id'] === (int)$id) {
            $conexion = new Conexion();
            if ($conexion->ejecutar($query)) {
                $conexion->cerrar();
                return true;
            } else {
                $conexion->cerrar();
                return false;
            }
        } else {
            return false;
        }
    }

}