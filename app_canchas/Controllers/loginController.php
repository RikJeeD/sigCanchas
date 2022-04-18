<?php
session_start();
include_once(realpath(dirname(__FILE__)) . "/../models/login.php");

$email = trim($_POST['email']);
$password = trim($_POST['password']);

if (empty($email) || empty($password)) {
    http_response_code(400);
    echo json_encode(array("error" => "Correo electronico y Contraseña Requeridas."));
    return;
}

$login = new login($email, $password);
$inicio = $login->iniciar();

if (!$inicio) {
    http_response_code(400);
    echo json_encode(array("error" => "Correo electronico o Contraseña incorrectas."));
    return;
}
echo json_encode(array("response" => "Exito."));
$_SESSION['user'] = (array) $login->user;
return;
?>