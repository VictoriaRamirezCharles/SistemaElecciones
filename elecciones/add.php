<?php
require_once '../layout/adminlayout.php';
require_once '../helpers/utilities.php';
require_once 'elecciones.php';
require_once '../helpers/utilities.php';
require_once '../FileHandler/IFileHandler.php';
require_once '../FileHandler/FileHandlerBase.php';
require_once '../FileHandler/JsonFileHandler.php';
require_once '../database/EleccionesContext.php';
require_once 'ServiceDatabaseElecciones.php';
session_start();
$layout = new AdminLayout(true);
$service = new ServiceDatabaseElecciones();
$utilities = new Utilities();

$eleccion= null; 
$state= false; 

if(isset($_POST["Nombre"]) && isset($_POST["Fecha"]))
{
    $status = ($_POST["Estado"] == "activo") ? true : false;
        $elecciones= $service->GetList();
       
        foreach($elecciones as $elect)
        {
            if($elect->Estado==1)
            {
                $state=true;
                break;
            }
        }
        if($state==false)
        {

       
            $eleccion = new Elecciones(0,$_POST["Nombre"],$_POST["Fecha"],$status);
            $service->Add($eleccion);
        
            header("Location: index.php");
            exit();
        }
      
        elseif($status==false && $state==true)
        {
          
    
            $eleccion = new Elecciones(0,$_POST["Nombre"],$_POST["Fecha"],$status);
            $service->Add($eleccion);
        
            header("Location: index.php");
            exit();
        }
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
    <div class="col-md-2"></div>
    <div class="col-md-7">
        <div class="card">
            <div class="card-header bg-dark text-light">
                Nueva Eleccion
            </div>
            <div class="card-body">
                <form  action="add.php" method="POST">

                    <div class="form-group">
                        <label for="nombre">Nombre: </label>
                        <input type="text" class="form-control" id="nombre" name="Nombre" >
                    </div>
               
              
                    <div class="form-group">
                        <label for="fecha">Fecha: </label>
                        <input type="date" class="form-control" id="fecha" name="Fecha" value="<?php echo date('Y-m-d'); ?>">
                    </div>

                    <div class="form-group">
                       <label class="form-check-label" for="flexCheckChecked">Activo</label>
                        <input class="form-check-input" type="checkbox" name="Estado" value="activo" id="flexCheckChecked" checked>
                       
                    </div>
                    <?php if($state):?>
                        <label class="text-center text-error">Ya existe una eleccion activa.</label>
                        <?php endif; ?>
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