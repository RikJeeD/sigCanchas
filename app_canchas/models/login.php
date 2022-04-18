<?php

include_once(realpath(dirname(__FILE__)) . "/../config/conexion.php");
include_once("usuarios.php");

class login
{
    var $email;
    var $password;
    var $user;

    /**
     * login constructor.
     * @param $email
     * @param $password
     */
    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }


    public function iniciar()
    {
        $sql = "SELECT usuario.id, usuario.nombre, usuario.apellido, usuario.email, usuario.telefono, usuario.id_rol, rol.rol, empresa.nombre empresa, usuario.id_empresa"
            . " FROM usuarios usuario"
            . " INNER JOIN roles rol ON rol.id = usuario.id_rol"
            . " LEFT JOIN empresas empresa ON usuario.id_empresa = empresa.id"
            . " WHERE usuario.email = '%s' AND password = md5('%s');";
        $query = sprintf($sql, $this->email, $this->password);
        $conexion = new Conexion();
        $result = pg_fetch_assoc($conexion->ejecutar($query));
        $conexion->cerrar();
        if (!empty($result)) {
            $user = new usuarios();
            $user->id = $result["id"];
            $user->nombre = $result["nombre"];
            $user->apellido = $result["apellido"];
            $user->email = $result["email"];
            $user->telefono = $result["telefono"];
            $user->rol = $result["rol"];
            $user->id_rol = $result["id_rol"];
            $user->empresa = $result["empresa"];
            $user->id_empresa = $result["id_empresa"];
            $this->user = $user;
            return true;
        } else {
            return false;
        }
    }
}