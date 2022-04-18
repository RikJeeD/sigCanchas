<?php

class Conexion
{

    var $conexion;
    var $host;
    var $usuario;
    var $contrasena;
    var $bd;

    public function __construct()
    {
        $this->host = 'localhost';
        $this->usuario = 'postgres';
        $this->contrasena = 'p';
        $this->bd = 'app_canchas';

        $this->conexion = pg_connect("user=" . $this->usuario . " " .
            "password=" . $this->contrasena . " " .
            "host=" . $this->host . " " .
            "dbname=" . $this->bd
        ) or die("Error al conectar: " . pg_last_error());
    }

    function ejecutar($sql)
    {
        $result = pg_query($this->conexion, $sql) or die('La consulta fallo: ' . pg_last_error());
        return $result;

    }

    function cerrar()
    {
        pg_close($this->conexion);
    }
}

?>