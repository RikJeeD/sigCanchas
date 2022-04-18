<?php
session_start();

include_once(realpath(dirname(__FILE__)) . "/../models/empresas.php");
$id = $_POST['id'];
$nombre = $_POST['nombre'];
$cantidad = $_POST['cantidad'];
$precio = $_POST['precio'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$propietario = $_POST['propietario'];

$empresa = new empresas();
$empresa->id = $id;
$empresa->nombre = $nombre;
$empresa->cantidad = $cantidad;
$empresa->precio = $precio;
$empresa->telefono = $telefono;
$empresa->email = $email;
$empresa->propietario = $propietario;

if ($id !== "crear") {
    $empresa->modificarEmpresa();
    header("location: /?page=administracion");
    return;
} else {
    $empresa->crearEmpresa();
    header("location: /?page=administracion");
    return;
}
?>