<?php
require_once '../layout/adminlayout.php';
require_once '../helpers/utilities.php';
require_once 'usuario.php';
require_once '../helpers/utilities.php';
require_once '../FileHandler/IFileHandler.php';
require_once '../FileHandler/FileHandlerBase.php';
require_once '../FileHandler/JsonFileHandler.php';
require_once '../database/EleccionesContext.php';
require_once 'ServiceDatabaseUsuario.php';
session_start();
$layout = new AdminLayout(true);
$service = new ServiceDatabaseUsuario();

$usuario= null; 
$pass= null; 
$cpass= null; 
$isLogged = false;

if(isset($_SESSION['adminUser']) && $_SESSION['adminUser']!=null)
{
  $isLogged = true;

}
if(isset($_POST["Nombre_Usuario"]) && isset($_POST["Password"]) && isset($_POST["Nombre"]) && isset($_POST["Apellido"]) && isset($_POST["Email"]))
{
    $pass =$_POST["Password"];
    $cpass =$_POST["CPassword"];
    if($_POST["Password"]!=$_POST["CPassword"])
    {

    }
    else
    {
        $status = ($_POST["Estado"] == "activo") ? true : false;
        $rol = ($_POST["Rol"] == "activo") ? true : false;
    
        $usuario = new Usuario(0,$_POST["Nombre"],$_POST["Apellido"],$_POST["Email"],$_POST["Nombre_Usuario"],$_POST["Password"],$status,$rol);
        $service->Add($usuario);
    
        header("Location: index.php");
        exit();
    }
  
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
                Nuevo Usuario
            </div>
            <div class="card-body">
                <form  action="add.php" method="POST">

                <div class="row">
                    <div class="col">
                    <div class="form-group">
                        <label for="nombre">Nombre: </label>
                        <input type="text" class="form-control" id="nombre" name="Nombre" >
                    </div>
                    </div>
                    <div class="col">
                    <div class="form-group">
                        <label for="apellido">Apellido: </label>
                        <input type="text" class="form-control" id="apellido" name="Apellido" >
                    </div>
                  </div>
            </div>

            <div class="row">
                    <div class="col">
                    <div class="form-group">
                        <label for="email">Email: </label>
                        <input type="text" class="form-control" id="email" name="Email" >
                    </div>
                    </div>
                    <div class="col">
                    <div class="form-group">
                        <label for="nombre_usuario">Nombre Usuario: </label>
                        <input type="text" class="form-control" id="nombre_usuario" name="Nombre_Usuario" >
                    </div>
                  </div>
            </div>
            <div class="row">
                    <div class="col">
                    <div class="form-group">
                        <label for="email">Contraseña: </label>
                        <input type="password" class="form-control" id="email" name="Password" >
                    </div>
                    </div>
                    <div class="col">
                    <div class="form-group">
                        <label for="cPassword">Confirmar Contraseña: </label>
                        <input type="password" class="form-control" id="cPassword" name="CPassword" >

                     
                    </div>
                  
                  </div>
            </div>
            <?php if($pass!=$cpass):?>
                        <label class="text-center text-error">Las contraseñas no coinciden, intente de nuevo</label>
                        <?php endif;?>
            <div class="row">
                    <div class="col">
                    <div class="form-group">
                       <label class="form-check-label" for="flexCheckChecked">Activo</label>
                        <input class="form-check-input" type="checkbox" name="Estado" value="activo" id="flexCheckChecked" checked>
                       
                    </div>
               
                   
                    <div class="form-group">
                        <label for="nombre_usuario">Administrador:</label>
                        <input class="form-check-input" type="checkbox" name="Rol" value="activo" id="flexCheckChecked">
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