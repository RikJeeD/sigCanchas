<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navAdministracion">
                <span class="sr-only">Menu Navegacion</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="hyh navbar-brand hidden-xs" href="#"><?= $_SESSION["parameters"]["COMPANY_NAME"] ?></a>
            <a class="hyh navbar-brand visible-xs-block"
               href="#"><?= $_SESSION["parameters"]["COMPANY_ABBREVIATION"] ?></a>
        </div>
        <div class="collapse navbar-collapse" id="navAdministracion">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a class="nav-link" data-toggle="tab" href="#empresa">Empresa</a>
                </li>
                <li>
                    <a class="nav-link" data-toggle="tab" href="#usuarios">Usuarios</a>
                </li>
				<li>
                    <a class="nav-link" data-toggle="tab" href="#mapa">Mapa</a>
                </li>
                <li>
                    <a class="nav-link" href="/Controllers/logoutController.php">Cerrar Sesion</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="tab-content">
    <div id="empresa" class="tab-pane fade in active">
        <?php include "empresa.php"; ?>
    </div>
    <div id="usuarios" class="tab-pane fade in">
        <?php include "usuarios.php"; ?>
    </div>
	<div id="mapa" class="tab-pane fade in">
		<div class="container wrapper">
			<iframe src="/?page=mapa" style="{width: 100%; height: 100%;}" frameborder="0"></iframe>
		</div>
    </div>
</div>