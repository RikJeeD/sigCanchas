<?php
session_start();

include_once(realpath(dirname(__FILE__)) . "/../models/usuarios.php");
$id = $_GET['id'];
$usuarios = new usuarios();
$usuarios->eliminarUsuario($id);
if ((int)$id === (int)$_SESSION["user"]["id"]) {
    session_destroy();
    echo json_encode(array("location" => "/"));
    return;
}else{
    echo json_encode(array("location" => "/?page=administracion"));
    return;
}
?>