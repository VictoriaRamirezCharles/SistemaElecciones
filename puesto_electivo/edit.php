<?php
require_once '../layout/adminlayout.php';
require_once '../helpers/utilities.php';
require_once 'puesto_electivo.php';
require_once '../helpers/utilities.php';
require_once '../FileHandler/IFileHandler.php';
require_once '../FileHandler/FileHandlerBase.php';
require_once '../FileHandler/JsonFileHandler.php';
require_once '../database/EleccionesContext.php';
require_once 'ServiceDatabasePuesto.php';

$layout = new AdminLayout(true);
$service = new ServiceDatabasePuesto();

$puesto= null; 

if (isset($_GET["Id"])) {

    $puesto = $service->GetById($_GET["Id"]);
}
if(isset($_POST["Nombre"]) && isset($_POST["Descripcion"]))
{
 
   
        $status = ($_POST["Estado"] == "activo") ? true : false;

        $puesto = new Puesto_Electivo($_POST["Id"],$_POST["Nombre"],$_POST["Descripcion"],$status);
        $service->Edit($puesto);
    
        header("Location: index.php");
        exit();
    
}  

?>
<?php $layout->printHeader(); ?>
<?php if ($puesto == null) : ?>
        <h2>No existe este heroe</h2>
    <?php else : ?>
<main role="main">
<div class="row margin-arriba-3 " id="formulario">
    <div class="col-md-2"></div>
    <div class="col-md-7">
        <div class="card">
            <div class="card-header bg-dark text-light">
                Nuevo Puesto Electivo
            </div>
            <div class="card-body">
                <form  action="edit.php" method="POST">
                <input type="hidden" name="Id" value="<?= $puesto->Id ?>">
                    <div class="form-group">
                        <label for="nombre">Nombre: </label>
                        <input type="text" class="form-control" id="nombre" name="Nombre" value="<?= $puesto->Nombre ?>">
                    </div>
               
              
                    <div class="form-group">
                        <label for="descripcion">Descripcion: </label>
                        <input type="text" class="form-control" id="descripcion" name="Descripcion" value="<?= $puesto->Descripcion ?>">
                    </div>

                    <div class="form-group">
                       <label class="form-check-label" for="flexCheckChecked">Activo</label>
                       <?php if($puesto->Estado===1): ?>
                        <input class="form-check-input" type="checkbox" name="Estado" value="activo" id="flexCheckChecked" checked>
                        <?php else: ?>
                            <input class="form-check-input" type="checkbox" name="Estado" value="activo" id="flexCheckChecked" >
                            <?php endif;?>
                       
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
<?php endif;?>
<?php $layout->printFooter()?>