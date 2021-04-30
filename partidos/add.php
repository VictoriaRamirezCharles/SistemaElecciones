<?php
require_once '../layout/adminlayout.php';
require_once '../helpers/utilities.php';
require_once 'partidos.php';
require_once '../helpers/utilities.php';
require_once '../FileHandler/IFileHandler.php';
require_once '../FileHandler/FileHandlerBase.php';
require_once '../FileHandler/JsonFileHandler.php';
require_once '../database/EleccionesContext.php';
require_once 'ServiceDatabasePartidos.php';
session_start();

$layout = new AdminLayout(true);
$service = new ServiceDatabasePartidos();
$utilities = new Utilities();

$partidos = $service->GetList();

$partido = null; 

if(isset($_POST["Nombre"]) && isset($_POST["Descripcion"]) )
{
        $partido = new Partido();

        $status = ($_POST["Estado"] == "activo") ? true : false;

        $partido-> initializeData(0,$_POST["Nombre"],$_POST["Descripcion"],$status);
        $service->Add($partido);
    
        header("Location: index.php");
        exit();
    
  
}
$isLogged = false;

if(isset($_SESSION['adminUser']) && $_SESSION['adminUser']!=null)
{
  $isLogged = true;

}

?>

<?php $layout->printHeader2(); ?>
<?php if($isLogged):?>
<main role="main">
<div class="row margin-arriba-3 " id="formulario">
    <div class="col-md-3"></div>
    <div class="col-md-5">
        <div class="card">
            <div class="card-header bg-dark text-light">
                Nuevo Partido
            </div>
            <div class="card-body">
                <form enctype="multipart/form-data" action="add.php" method="POST">
                    <div class="form-group">
                        <label for="nombre">Nombre: </label>
                        <input type="text" class="form-control" id="nombre" name="Nombre" >
                    </div>
                
                    <div class="form-group">
                        <label for="escripcion">Descripcion: </label>
                        <input type="text" class="form-control" id="descripcion" name="Descripcion" >
                    </div>


                    <div class="form-group">
                        <label for="logo">Logo: </label>
                        <input type="file" class="form-control-file" id="logo" name="Logo">
                    </div>

                    <div class="form-group">
                    <label class="form-check-label" for="flexCheckChecked">Activo</label>
                        <input class="form-check-input" type="checkbox" name="Estado" value="activo" id="flexCheckChecked" checked>
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
<?php else:?>
    <label class="text-center text-error mt-6" style="display:flex;justify-content:center">No puede acceder, no ha iniciado sesion.</label>
<?php endif;?>
<?php $layout->printFooter2()?>