<?php
require_once '../layout/adminlayout.php';
require_once '../helpers/utilities.php';
require_once 'ciudadanos.php';
require_once '../helpers/utilities.php';
require_once '../FileHandler/IFileHandler.php';
require_once '../FileHandler/FileHandlerBase.php';
require_once '../FileHandler/JsonFileHandler.php';
require_once '../database/EleccionesContext.php';
require_once 'ServiceDatabase.php';

$layout = new AdminLayout(true);
$service = new ServiceDatabase();

$ciudadano= null; 


if (isset($_GET["Id"])) {

    $ciudadano = $service->GetById($_GET["Id"]);
}
if(isset($_POST["Documento_Identidad"]) && isset($_POST["Nombre"]) && isset($_POST["Apellido"]) && isset($_POST["Email"]))
{
 
        $status = ($_POST["Estado"] == "activo") ? true : false;
     
    
        $ciudadano = new Ciudadano($_POST["Id"],$_POST["Documento_Identidad"],$_POST["Nombre"],$_POST["Apellido"],$_POST["Email"],$status);
        $service->Edit($ciudadano);
    
        header("Location: index.php");
        exit();
    
  
}
?>
<?php $layout->printHeader2(); ?>

<main role="main">
<div class="row margin-arriba-3 " id="formulario">
    <div class="col-md-2"></div>
    <div class="col-md-7">
        <div class="card">
            <div class="card-header bg-dark text-light">
                Editar Ciudadano
            </div>
            <div class="card-body">
                <form  action="edit.php" method="POST">
                <input type="hidden" name="Id" value="<?= $ciudadano->Id ?>">
                <div class="row">
                    <div class="col">
                    <div class="form-group">
                        <label for="documento_identidad">Documento de Identidad: </label>
                        <input type="text" class="form-control" id="documento_identidad" name="Documento_Identidad" value="<?= $ciudadano->Documento_Identidad ?>">
                    </div>
                    </div>
                    <div class="col">
                    <div class="form-group">
                        <label for="nombre">Nombre: </label>
                        <input type="text" class="form-control" id="nombre" name="Nombre" value="<?= $ciudadano->Nombre ?>">
                    </div>
                  </div>
            </div>

            <div class="row">
                    <div class="col">
                    <div class="form-group">
                        <label for="apellido">Apellido: </label>
                        <input type="text" class="form-control" id="apellido" name="Apellido" value="<?= $ciudadano->Apellido ?>">
                    </div>
                    </div>
                    <div class="col">
                    <div class="form-group">
                        <label for="email">Email: </label>
                        <input type="text" class="form-control" id="email" name="Email" value="<?= $ciudadano->Email ?>">
                    </div>
                  </div>
            </div>

            <div class="row">
                    <div class="col">
                    <div class="form-group">
                       <label class="form-check-label" for="flexCheckChecked">Activo</label>
                       <?php if($ciudadano->Estado===1): ?>
                        <input class="form-check-input" type="checkbox" name="Estado" value="activo" id="flexCheckChecked" checked>
                        <?php else: ?>
                            <input class="form-check-input" type="checkbox" name="Estado" value="activo" id="flexCheckChecked" >
                            <?php endif;?>
                    </div>
                  </div>
                  </div>
                    <div class="text-right">
                        <button class="btn btn-success" type="submit">Guardar</button>
                    </div>
                </form>                              
            </div>
        </div>
    </div>
</div>
</main>
<?php $layout->printFooter2()?>