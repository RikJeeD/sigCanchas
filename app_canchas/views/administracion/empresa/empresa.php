<?php
include_once(realpath(dirname(__FILE__)) . "/../../../models/empresas.php");
$empresas = new empresas();
$id = $_SESSION['user']['id_empresa'];
$empresa = $empresas->getEmpresa($id);
?>

<form id="modificarEmpresa" name="modificarEmpresa" method="post" action="/Controllers/empresaController.php"
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
                           placeholder="Ingrese el nombre del Usuario" value="<?= $empresa->nombre ?>" required/>
                </div>
            </div>
            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            <div class="help-block with-errors"></div>
        </div>
        <div class="form-group">
            <label for="cantidad" class="cols-sm-2 control-label">Numero de Canchas</label>
            <div class="cols-sm-10">
                <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-hashtag fa-lg"
                                                                   aria-hidden="true"></i></span>
                    <input type="number" class="form-control" id="cantidad" name="cantidad"
                           placeholder="Ingrese la cantidad de canchas de la Empresa"
                           value="<?= $empresa->cantidad ?>" min="0"/>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="precio" class="cols-sm-2 control-label">Precio</label>
            <div class="cols-sm-10">
                <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-usd fa-lg"
                                                                   aria-hidden="true"></i></span>
                    <input type="number" class="form-control" id="precio" name="precio"
                           placeholder="Ingrese el precio de las canchas de la Empresa"
                           value="<?= $empresa->precio ?>" min="0"/>
                </div>
            </div>
        </div>
        <div class="form-group has-feedback">
            <label for="telefono" class="cols-sm-2 control-label">Telefono</label>
            <div class="cols-sm-10">
                <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-phone fa-lg"
                                                           aria-hidden="true"></i></span>
                    <input type="tel" class="form-control" id="telefono" name="telefono" minlength="3" maxlength="100"
                           placeholder="Ingrese el telefono del Usuario" value="<?= $empresa->telefono ?>" required/>
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
                           value="<?= $empresa->email ?>" required/>
                </div>
            </div>
            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            <div class="help-block with-errors"></div>
        </div>
        <div class="form-group">
            <label for="propietario" class="cols-sm-2 control-label">Propietario</label>
            <div class="cols-sm-10">
                <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user fa-lg"
                                                                   aria-hidden="true"></i></span>
                    <input type="text" class="form-control" id="propietario" name="propietario"
                           placeholder="Ingrese el nombre del propietario de la Empresa"
                           value="<?= $empresa->propietario ?>"/>
                </div>
            </div>
        </div>
        <div class="btn-group">
            <button type="submit" class="btn btn-primary" id="submit" value="Submit">
                Editar
            </button>
        </div>
    </div>
</form>