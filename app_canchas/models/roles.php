<?php
include_once(realpath(dirname(__FILE__)) . "/../config/conexion.php");

class roles
{
    var $id, $rol;

    public function getRoles()
    {
        $rol = $_SESSION['user']['rol'];
        if($rol === "admin"){
            $sql = "SELECT *"
                . " FROM roles;";
        }else{
            $sql = "SELECT *"
                . " FROM roles"
                . " WHERE rol <> 'admin';";
        }
        $query = sprintf($sql);
        $conexion = new Conexion();
        $result = pg_fetch_all($conexion->ejecutar($query));
        $conexion->cerrar();
        $roles = [];
        for ($i = 0; $i < count($result); $i++) {
            $rol = new roles();
            $rol->id = $result[$i]["id"];
            $rol->rol = $result[$i]["rol"];
            $roles[] = $rol;
        }
        return $roles;
    }
}