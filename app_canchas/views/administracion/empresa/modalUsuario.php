<?php
session_start();
include_once(realpath(dirname(__FILE__)) . "/../../../models/usuarios.php");
include_once(realpath(dirname(__FILE__)) . "/../../../models/roles.php");
include_once(realpath(dirname(__FILE__)) . "/../../../models/empresas.php");
$usuarios = new usuarios();
$id = $_GET['id'];
$rolesAux = new roles();
$roles = $rolesAux->getRoles();
$empresaAux = new empresas();
$empresas = $empresaAux->getEmpresas();
if ($id === 'crear') {
    $mensaje = "Crear Usuario";
    $usuario = $usuarios;
} else {
    $mensaje = "Actualizar Usuario";
    $usuario = $usuarios->getUsuario($id);
}
?>

<form id="crearModificarUsuario" name="crearModificarUsuario" method="post" action="/Controllers/usuarioController.php"
      data-toggle="validator">
    <div class="modal-header">
        <button type='button' class='close' data-dismiss='modal'>&times;</button>
        <h4 class='modal-title'><?= $mensaje ?></h4>
    </div>
    <div class="modal-body">
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
        <div class="form-group has-feedback">
            <label for="id_rol" class="cols-sm-2 control-label">Rol</label>
            <div class="cols-sm-10">
                <select name="id_rol" id="id_rol" class="form-control" required>
                    <option value="" hidden></option>
                    <?php
                    for ($i = 0; $i < count($roles); $i++) {
                        ?>
                        <option value="<?= $roles[$i]->id ?>" <?= $usuario->id_rol === $roles[$i]->id ? "selected='true'" : "" ?>><?= $roles[$i]->rol ?></option>
                    <?php } ?>
                </select>
            </div>
            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="submit" value="Submit">
            <?= $id === "crear" ? "Crear" : "Editar" ?>
        </button>
    </div>
</form>

<script>
    let frm = $('#crearModificarUsuario');
    frm.submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: frm.attr('method'),
            url: frm.attr('action'),
            data: frm.serialize(),
            success: function (data) {
                location.href = "/?page=administracion";
                $('a').click(function () {
                    $(".tabs").tabs("option", "active", 2);
                });
            },
            error: function (data) {
                data = JSON.parse(data);
                console.log(data);
            }
        });
    });
</script>