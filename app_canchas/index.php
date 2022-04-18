<html>
<head>
    <title></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap.min.css"/>
	<link rel="stylesheet" href="css/leaflet.css" />
	<link rel="stylesheet" href="css/leaflet.groupedlayercontrol.min.css" />
	<link rel="stylesheet" href="css/easy-button.css" />
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/validator.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/leaflet.js"></script>
	<script src="js/leaflet.groupedlayercontrol.min.js"></script>
	<script src="js/easy-button.js"></script>
	<script src="js/bootbox.min.js"></script>
</head>
<body>
<?php
session_start();
if(!isset($_SESSION["parameters"])){
    include_once("config/conexion.php");
    $sql = "SELECT * FROM parameters;";
    $conexion = new Conexion();
    $results = pg_fetch_all($conexion->ejecutar($sql));
    $conexion->cerrar();
    $parameters = [];
    for($i = 0; $i < count($results); $i++){
        $parameters[$results[$i]["name"]] = $results[$i]["parameter"];
    }
    $_SESSION["parameters"] = $parameters;
}

$public = array('login', 'mapa');
$private = array('administracion');
$page = (isset($_GET['page'])) ? $_GET['page'] : 'login';
if (in_array($page, $public)) {
    include("views/$page.php");
} elseif (in_array($page, $private)) {
    if (isset($_SESSION['user'])) {
        include("views/$page.php");
    } else {
        header('location: /');
    }
} else {
    include("views/404.php");
}
?>
</body>
</html>

<script>
    document.title = "<?=$title;?>";
</script>