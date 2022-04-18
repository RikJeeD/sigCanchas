<?php
$title = "Iniciar Sesion";
if (isset($_SESSION['user'])) {
    header("location: /?page=administracion");
}
?>

<div class="login">
    <div class="container">
        <div class="row main">
            <div class="panel-heading">
                <div class="panel-title text-center">
                    <h1 class="title"><?= $_SESSION["parameters"]["COMPANY_NAME"] ?></h1>
                    <hr/>
                </div>
            </div>
            <div class="main-login main-center">
                <form action="/Controllers/loginController.php" method="post" class="form-horizontal"
                      data-toggle="validator"
                      id="loginform">
                    <div class="form-group">
                        <label for="email" class="cols-sm-2 control-label">Correo Electronico</label>
                        <div class="cols-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope fa-lg"
                                                                   aria-hidden="true"></i></span>
                                <input type="email" class="form-control" id="email" name="email"
                                       placeholder="Ingrese su correo electronico"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="cols-sm-2 control-label">Contraseña</label>
                        <div class="cols-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock fa-lg"
                                                                   aria-hidden="true"></i></span>
                                <input type="password" class="form-control" id="password" name="password"
                                       placeholder="Ingrese su contraseña"/>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="btn-group">
                            <button type="submit" class="btn btn-success btn-lg" id="submit" value="Submit">Iniciar
                                Sesion
                            </button>
                        </div>
                    </div>
                </form>
                <div id="alert-message" class="cols-sm-12 alert alert-danger hidden">
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    <span class="sr-only">Error:</span>
                    <span id="error-text"></span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let frm = $('#loginform');
    frm.submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: frm.attr('method'),
            url: frm.attr('action'),
            data: frm.serialize(),
            success: function (data){
                $('#error-text').text("");
                $('#alert-message').addClass('hidden');
                location.href = "/?page=administracion";
            },
            error: function (data) {
                data = JSON.parse(data.responseText);
                $('#error-text').text(data.error);
                $('#alert-message').removeClass('hidden');
            }
        });
    });
</script>