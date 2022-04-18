<?php
$title = "Administracion";
$rol = $_SESSION['user']['rol'];
include(realpath(dirname(__FILE__)) . "/../views/administracion/$rol/index.php");
?>