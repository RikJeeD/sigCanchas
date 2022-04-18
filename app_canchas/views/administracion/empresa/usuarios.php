<?php
include_once(realpath(dirname(__FILE__)) . "/../../../models/usuarios.php");
$usuarios = new usuarios();
$result = $usuarios->getUsuarios();
?>

<div id="gestionUsuarios">
    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-id="crear" data-target="#editUsuario">
        <span class="fa fa-building fa-lg"></span> Crear
    </button>
    <table id="UsuariosTable" class="table table-bordered">
        <thead>
        <tr>
            <th>Nombres</th>
            <th>Email</th>
            <th>Telefono</th>
            <th>Opciones</th>
        </tr>
        </thead>
        <tbody>
        <?php
        for ($i = 0; $i < count($result); $i++) {
            $usuario = $result[$i];
            ?>
            <tr>
                <td><?= $usuario->nombre . " " . $usuario->apellido ?></td>
                <td><?= $usuario->email ?></td>
                <td><?= $usuario->telefono ?></td>
                <td><a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editUsuario"
                       data-id=<?= $usuario->id ?>>Editar <span class="fa fa-pencil fa-lg"></span></a>
					<a href="#" class="btn btn-sm btn-danger"
                       data-id=<?= $usuario->id ?>>Eliminar <span class="fa fa-trash fa-lg"></span></a></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<div id="editUsuario" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" id="contenedor">
        </div>
    </div>
</div>

<script>
    let frm2 = $('#gestionUsuarios');
    frm2.on("click", ".btn-primary", function () {
        let id = $(this).data('id');
        $.get("/views/administracion/empresa/modalUsuario.php?id=" + id, function (data) {
            $("#editUsuario").find("#contenedor").html(data);
        });
    });
    frm2.on("click", ".btn-danger", function () {
        let id = $(this).data('id');
        $.get("/Controllers/usuarioEliminarController.php?id=" + id, function (data) {
            let json = JSON.parse(data);
            window.location = json.location;
        });
    });
</script>