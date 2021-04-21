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
$utilities = new Utilities();

$eleccion= null; 

if(isset($_POST["Nombre"]) && isset($_POST["Fecha"]))
{
 
    
        $status = ($_POST["Estado"] == "activo") ? true : false;

        $eleccion = new Elecciones(0,$_POST["Nombre"],$_POST["Fecha"],$status);
        $service->Add($eleccion);
    
        header("Location: index.php");
        exit();
    
}  

?>
<?php $layout->printHeader(); ?>

<main role="main">
<div class="row margin-arriba-3 " id="formulario">
    <div class="col-md-2"></div>
    <div class="col-md-7">
        <div class="card">
            <div class="card-header bg-dark text-light">
                Nuevo Puesto Electivo
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
               
                    <div class="text-right">
                        <button class="btn btn-success" type="submit">Guardar</button>
                    </div>
                </form>                              
            </div>
        </div>
    </div>
</div>
</main>
<?php $layout->printFooter()?>