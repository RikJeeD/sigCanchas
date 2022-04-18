<?php

include_once(realpath(dirname(__FILE__)) . "/../config/conexion.php");

class empresas
{
    var $id, $nombre, $telefono, $cantidad, $email, $precio, $coordenadas, $propietario;

    public function getEmpresas()
    {
        $rol = $_SESSION['user']['rol'];
        if ($rol === "admin") {
            $sql = "SELECT *"
                . " FROM empresas"
                . " ORDER BY id asc;";
            $query = sprintf($sql);
            $conexion = new Conexion();
            $result = pg_fetch_all($conexion->ejecutar($query));
            $conexion->cerrar();
            $empresas = [];
            for ($i = 0; $i < count($result); $i++) {
                $empresa = new empresas();
                $empresa->id = $result[$i]["id"];
                $empresa->nombre = $result[$i]["nombre"];
                $empresa->telefono = $result[$i]["telefono"];
                $empresa->cantidad = $result[$i]["cantidad"];
                $empresa->email = $result[$i]["email"];
                $empresa->precio = $result[$i]["precio"];
                $empresa->coordenadas = $result[$i]["coordenadas"];
                $empresa->propietario = $result[$i]["propietario"];
                $empresas[] = $empresa;
            }
            return $empresas;
        } else {
            return [];
        }
    }

    public function getEmpresa($id)
    {
        $rol = $_SESSION['user']['rol'];
        if ($rol === "admin" || ($rol === "empresa" && (int)$_SESSION['user']['id_empresa'] === (int)$id)) {
            $sql = "SELECT *"
                . " FROM empresas"
                . " WHERE id = '%s';";
            $query = sprintf($sql, $id);
            $conexion = new Conexion();
            $result = pg_fetch_assoc($conexion->ejecutar($query));
            $conexion->cerrar();
            $empresa = new empresas();
            $empresa->id = $result["id"];
            $empresa->nombre = $result["nombre"];
            $empresa->telefono = $result["telefono"];
            $empresa->cantidad = $result["cantidad"];
            $empresa->email = $result["email"];
            $empresa->precio = $result["precio"];
            $empresa->coordenadas = $result["coordenadas"];
            $empresa->propietario = $result["propietario"];
            return $empresa;
        } else {
            $empresa = new empresas();
            return $empresa;
        }
    }

    public function crearEmpresa()
    {
        $rol = $_SESSION['user']['rol'];
        if ($rol === "admin") {
            $sql = "INSERT INTO empresas"
                . " (nombre, telefono, cantidad, email, precio, propietario)"
                . " VALUES ('%s', '%s', '%s', '%s', '%s', '%s');";
            $query = sprintf($sql, $this->nombre, $this->telefono, $this->cantidad, $this->email, $this->precio, $this->propietario);
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

    public function modificarEmpresa()
    {
        $rol = $_SESSION['user']['rol'];
        if ($rol === "admin" || ($rol === "empresa" && (int)$_SESSION['user']['id_empresa'] === (int)$this->id)) {
            $sql = "UPDATE empresas"
                . " SET nombre = '%s', telefono = '%s', cantidad = '%s', email = '%s', precio = '%s', propietario = '%s'"
                . " WHERE id = '%s';";
            $query = sprintf($sql, $this->nombre, $this->telefono, $this->cantidad, $this->email, $this->precio, $this->propietario, $this->id);
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