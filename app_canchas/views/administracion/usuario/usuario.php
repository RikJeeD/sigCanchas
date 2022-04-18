<?php
include_once(realpath(dirname(__FILE__)) . "/../../../models/usuarios.php");
$usuarios = new usuarios();
$id = $_SESSION['user']['id'];
$usuario = $usuarios->getUsuario($id);
?>

<form id="modificarUsuario" name="modificarUsuario" method="post" action="/Controllers/usuarioController.php"
      data-toggle="validator">
    <div class="container">
        <input type='hidden' value="<?= $id ?>" name='id'/>
        <div class="form-group has-feedback">
            <label for="nombre" class="cols-sm-2 control-label">Nombres</label>
            <div class="cols-sm-10">
                <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user-circle fa-lg"
                                                                   aria-hidden="true"></i></span>
                    <input type="text" class="form-control" id="nombre" name="nombre" minlength="3" maxlength="100"
                           placeholder="Ingrese el nombre del Usuario" value="<?= $usuario->nombre ?>" required/>
                </div>
            </div>
            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            <div class="help-block with-errors"></div>
        </div>
        <div class="form-group has-feedback">
            <label for="apellido" class="cols-sm-2 control-label">Apellidos</label>
            <div class="cols-sm-10">
                <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user-circle fa-lg"
                                                                   aria-hidden="true"></i></span>
                    <input type="text" class="form-control" id="apellido" name="apellido" minlength="3" maxlength="100"
                           placeholder="Ingrese el apellido del Usuario" value="<?= $usuario->apellido ?>" required/>
                </div>
            </div>
            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            <div class="help-block with-errors"></div>
        </div>
        <div class="form-group has-feedback">
            <label for="email" class="cols-sm-2 control-label">Correo Electronico</label>
            <div class="cols-sm-10">
                <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope fa-lg"
                                                                   aria-hidden="true"></i></span>
                    <input type="email" class="form-control" id="email" name="email"
                           placeholder="Ingrese el correo electronico del Usuario" minlength="3" maxlength="100"
                           value="<?= $usuario->email ?>" required/>
                </div>
            </div>
            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            <div class="help-block with-errors"></div>
        </div>
        <div class="form-group has-feedback">
            <label for="telefono" class="cols-sm-2 control-label">Telefono</label>
            <div class="cols-sm-10">
                <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-phone fa-lg"
                                                           aria-hidden="true"></i></span>
                    <input type="tel" class="form-control" id="telefono" name="telefono" minlength="3" maxlength="100"
                           placeholder="Ingrese el telefono del Usuario" value="<?= $usuario->telefono ?>" required/>
                </div>
            </div>
            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            <div class="help-block with-errors"></div>
        </div>
        <div class="form-group has-feedback">
            <label for="password" class="cols-sm-2 control-label">Contraseña</label>
            <div class="cols-sm-10">
                <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock fa-lg"
                                                                   aria-hidden="true"></i></span>
                    <input type="password" class="form-control" id="password" name="password" minlength="3"
                           maxlength="100" placeholder="Ingrese el contraseña del Usuario"/>
                </div>
            </div>
            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            <div class="help-block with-errors"></div>
        </div>
        <div class="btn-group">
            <button type="submit" class="btn btn-primary" id="submit" value="Submit">
                Editar
            </button>
			<a href="#" class="btn btn-sm btn-danger"
                       data-id=<?= $id ?>>Eliminar <span class="fa fa-trash fa-lg"></span></a>
        </div>
    </div>
</form>
<script>
    let frm = $('#modificarUsuario');
    frm.submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: frm.attr('method'),
            url: frm.attr('action'),
            data: frm.serialize(),
            success: function (data) {
                location.href = "/?page=administracion";
            },
            error: function (data) {
                data = JSON.parse(data);
                console.log(data);
            }
        });
    });
</script>
<script>
    let frm2 = $('#modificarUsuario');
    frm2.on("click", ".btn-danger", function () {
        let id = $(this).data('id');
        $.get("/Controllers/usuarioEliminarController.php?id=" + id, function (data) {
            let json = JSON.parse(data);
            window.location = json.location;
        });
    });
</script>