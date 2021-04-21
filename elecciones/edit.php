<?php
require_once '../layout/adminlayout.php';
require_once '../helpers/utilities.php';
require_once 'elecciones.php';
require_once '../helpers/utilities.php';
require_once '../FileHandler/IFileHandler.php';
require_once '../FileHandler/FileHandlerBase.php';
require_once '../FileHandler/JsonFileHandler.php';
require_once '../database/EleccionesContext.php';
require_once 'ServiceDatabase.php';

$layout = new AdminLayout(true);
$service = new ServiceDatabase();

$eleccion= null; 

if (isset($_GET["Id"])) {

    $eleccion = $service->GetById($_GET["Id"]);
}
if(isset($_POST["Nombre"]) && isset($_POST["Fecha"]))
{
 
   
        $status = ($_POST["Estado"] == "activo") ? true : false;

        $eleccion = new Elecciones($_POST["Id"],$_POST["Nombre"],$_POST["Fecha"],$status);
        $service->Edit($eleccion);
    
        header("Location: index.php");
        exit();
    
}  

?>
<?php $layout->printHeader(); ?>
<?php if ($eleccion == null) : ?>
        <h2>No existe esta eleccion</h2>
    <?php else : ?>
<main role="main">
<div class="row margin-arriba-3 " id="formulario">
    <div class="col-md-2"></div>
    <div class="col-md-7">
        <div class="card">
            <div class="card-header bg-dark text-light">
                Editar Eleccion
            </div>
            <div class="card-body">
                <form  action="edit.php" method="POST">
                <input type="hidden" name="Id" value="<?= $eleccion->Id ?>">
                    <div class="form-group">
                        <label for="nombre">Nombre: </label>
                        <input type="text" class="form-control" id="nombre" name="Nombre" value="<?= $eleccion->Nombre ?>">
                    </div>
               
    
                    <div class="form-group">
                        <label for="descripcion">Fecha: </label>
                        <input type="date" class="form-control" id="descripcion" name="Fecha" value="<?php echo date('Y-m-d', strtotime($eleccion->Fecha)); ?>">
                    </div>

                    <div class="form-group">
                       <label class="form-check-label" for="flexCheckChecked">Activo</label>
                       <?php if($eleccion->Estado===1): ?>
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