<?php
include_once(realpath(dirname(__FILE__)) . "/../../../models/empresas.php");
$empresas = new empresas();
$result = $empresas->getEmpresas();
?>
<div id="gestionEmpresas">
    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-id="crear" data-target="#editEmpresa">
        <span class="fa fa-building fa-lg"></span> Crear
    </button>
    <table id="empresasTable" class="table table-bordered">
        <thead>
        <tr>
            <th>Nombre</th>
            <th>Canchas</th>
            <th>Precio</th>
            <th>Telefono</th>
            <th>Email</th>
            <th>Propietario</th>
            <th>Opciones</th>
        </tr>
        </thead>
        <tbody>
        <?php
        for ($i = 0; $i < count($result); $i++) {
            $empresa = $result[$i];
            ?>
            <tr>
                <td><?= $empresa->nombre ?></td>
                <td><?= $empresa->cantidad ?></td>
                <td><?= $empresa->precio ?></td>
                <td><?= $empresa->telefono ?></td>
                <td><?= $empresa->email ?></td>
                <td><?= $empresa->propietario ?></td>
                <td><a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editEmpresa"
                       data-id=<?= $empresa->id ?>>Editar <span class="fa fa-pencil fa-lg"></span></a></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<div id="editEmpresa" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content" id="contenedor">
        </div>
    </div>
</div>

<script>
    $('#gestionEmpresas').on("click", ".btn", function () {
        let id = $(this).data('id');
        $.get("/views/administracion/admin/modalEmpresa.php?id=" + id, function (data) {
            $("#editEmpresa").find("#contenedor").html(data);
        });
    });
</script>