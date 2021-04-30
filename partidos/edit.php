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

$isLogged = false;

if(isset($_SESSION['adminUser']) && $_SESSION['adminUser']!=null)
{
  $isLogged = true;

}

$partido= null; 

if(isset($_GET['Id'])){

    $idPartido = $_GET['Id'];
    $partido = $service->GetById($idPartido);
}

if(isset($_POST["Nombre"]) && isset($_POST["Descripcion"]))
{
        $partido = new Partido();

        $status = ($_POST["Estado"] == "activo") ? true : false;

        $partido-> initializeData($idPartido,$_POST["Nombre"],$_POST["Descripcion"],$status);
        $service->Edit($partido);
    
        header("Location: index.php");
        exit();
    
  
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
                Editar Partido
            </div>
            <div class="card-body">
                <form enctype="multipart/form-data" action="edit.php?Id=<?php echo $partido->Id?>"  method="POST">
                    <div class="form-group">
                        <label for="nombre">Nombre: </label>
                        <input type="text" class="form-control" id="nombre" name="Nombre" value="<?php echo $partido->Nombre ?>" >
                    </div>
                
                    <div class="form-group">
                        <label for="descripcion">Descripcion: </label>
                        <input type="text" class="form-control" id="descripcion" name="Descripcion" value="<?php echo $partido->Descripcion ?>" >
                    </div>


                    <div class="form-group">
                        <label for="fotoPerfil">Logo: </label>
                        <div class="card" style="width: 15rem;">
                        <?php if($partido->Logo == null || $partido->Logo == ''):?>
                            <img class="bd-placeholder-img card-img-top" src="<?php echo '../assets/img/default.jpg'; ?>" width="100%" height="225" aria-label="Placeholder: Thumbnail">
                        <?php else: ?>
                            <img class="bd-placeholder-img card-img-top" src="<?php echo '../assets/img/partidos/' . $partido->Logo; ?>" width="100%" height="225" aria-label="Placeholder: Thumbnail">
                        <?php endif;?>
                    </div>
                    <br>
                    <div class="form-group">
                        <input type="file" class="form-control-file" id="logo" name="Logo">
                    </div>
                    </div>

                    <div class="form-group">
                    <label class="form-check-label" for="flexCheckChecked">Activo</label>
                      
                        <?php if($partido->Estado==1): ?>
                        <input class="form-check-input" type="checkbox" name="Estado" value="activo" id="flexCheckChecked" checked>
                        <?php else: ?>
                            <input class="form-check-input" type="checkbox" name="Estado" value="activo" id="flexCheckChecked">
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
<?php else:?>
    <label class="text-center text-error mt-6" style="display:flex;justify-content:center">No puede acceder, no ha iniciado sesion.</label>
 
<?php endif;?>
<?php $layout->printFooter2()?>