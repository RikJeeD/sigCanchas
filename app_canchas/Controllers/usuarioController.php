<?php
session_start();

include_once(realpath(dirname(__FILE__)) . "/../models/usuarios.php");
$id = $_POST['id'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$password = $_POST['password'];
$id_rol = $_POST['id_rol'];
$id_empresa = $_POST['id_empresa'];
$rol = $_SESSION['user']['rol'];
if ($rol === "empresa") {
    $rol = $_SESSION['user']['id_empresa'];
}

if (empty($nombre)) {
    http_response_code(400);
    echo json_encode(array("error" => "Nombre requerido.", "input" => "nombre"));
    return;
}
if (empty($apellido)) {
    http_response_code(400);
    echo json_encode(array("error" => "Apellido requerido.", "input" => "apellido"));
    return;
}
if (empty($email)) {
    http_response_code(400);
    echo json_encode(array("error" => "Correo electronico requerido.", "input" => "email"));
    return;
}
if (empty($telefono)) {
    http_response_code(400);
    echo json_encode(array("error" => "Telefono requerido.", "input" => "telefono"));
    return;
}
$rol = $_SESSION["user"]["rol"];
if ($rol === "empresa" || $rol === "admin") {
    if (empty($id_rol)) {
        http_response_code(400);
        echo json_encode(array("error" => "Rol requerido.", "input" => "id_rol"));
        return;
    }

    if (empty($id_empresa) && $id_rol === $_SESSION["parameters"]["ID_EMPRESA"] && $rol === "admin") {
        http_response_code(400);
        echo json_encode(array("error" => "Empresa requerida.", "input" => "id_empresa"));
        return;
    }
}

$usuario = new usuarios();
$usuario->id = $id;
$usuario->nombre = $nombre;
$usuario->apellido = $apellido;
$usuario->email = $email;
$usuario->telefono = $telefono;
$usuario->id_rol = $id_rol;
$usuario->id_empresa = $id_empresa;
if ($id !== "crear") {
    $usuario->modificarUsuario($password);
    echo json_encode(array("msg" => "Exito", "tab" => "usuarios"));
    return;
} else {
    $usuario->crearUsuario($password);
    echo json_encode(array("msg" => "Exito", "tab" => "usuarios"));
    return;
}
?>