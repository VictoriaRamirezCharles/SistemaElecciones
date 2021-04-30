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
session_start();
$layout = new AdminLayout(true);
$service = new ServiceDatabase();

$ciudadano= null; 

$isLogged = false;

if(isset($_SESSION['adminUser']) && $_SESSION['adminUser']!=null)
{
  $isLogged = true;

}
if(isset($_POST["Documento_Identidad"]) && isset($_POST["Nombre"]) && isset($_POST["Apellido"]) && isset($_POST["Email"]))
{
 
        $status = ($_POST["Estado"] == "activo") ? true : false;
     
    
        $ciudadano = new Ciudadano(0,$_POST["Documento_Identidad"],$_POST["Nombre"],$_POST["Apellido"],$_POST["Email"],$status);
        $service->Add($ciudadano);
    
        header("Location: index.php");
        exit();
    
  
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
                Nuevo Ciudadano
            </div>
            <div class="card-body">
                <form  action="add.php" method="POST">

                <div class="row">
                    <div class="col">
                    <div class="form-group">
                        <label for="documento_identidad">Documento de Identidad: </label>
                        <input type="text" class="form-control" id="documento_identidad" name="Documento_Identidad" >
                    </div>
                    </div>
                    <div class="col">
                    <div class="form-group">
                        <label for="nombre">Nombre: </label>
                        <input type="text" class="form-control" id="nombre" name="Nombre" >
                    </div>
                  </div>
            </div>

            <div class="row">
                    <div class="col">
                    <div class="form-group">
                        <label for="apellido">Apellido: </label>
                        <input type="text" class="form-control" id="apellido" name="Apellido" >
                    </div>
                    </div>
                    <div class="col">
                    <div class="form-group">
                        <label for="email">Email: </label>
                        <input type="text" class="form-control" id="email" name="Email" >
                    </div>
                  </div>
            </div>

            <div class="row">
                    <div class="col">
                    <div class="form-group">
                       <label class="form-check-label" for="flexCheckChecked">Activo</label>
                        <input class="form-check-input" type="checkbox" name="Estado" value="activo" id="flexCheckChecked" checked>
                       
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
<?php else:?>
    <label class="text-center text-error mt-6" style="display:flex;justify-content:center">No puede acceder, no ha iniciado sesion.</label>
 
<?php endif;?>
<?php $layout->printFooter2()?>