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

$isLogged = false;

if(isset($_SESSION['adminUser']) && $_SESSION['adminUser']!=null)
{
  $isLogged = true;

}

$usuario= null; 
$pass= null; 
$cpass= null; 
if (isset($_GET["Id"])) {

    $usuario = $service->GetById($_GET["Id"]);
}

if(isset($_POST["Id"]) && isset($_POST["Nombre_Usuario"]) && isset($_POST["Password"]) && isset($_POST["Nombre"]) && isset($_POST["Apellido"]) && isset($_POST["Email"]))
{
 
        $status = ($_POST["Estado"] == "activo") ? true : false;
        $rol = ($_POST["Rol"] == "activo") ? true : false;
    
        $usuario = new Usuario($_POST["Id"],$_POST["Nombre"],$_POST["Apellido"],$_POST["Email"],$_POST["Nombre_Usuario"],$_POST["Password"],$status,$rol);
        $service->Edit($usuario);
    
        header("Location: index.php");
        exit();
    
  
}
?>
<?php $layout->printHeader2(); ?>
<?php if ($isLogged) : ?>
<?php if ($usuario == null) : ?>
        <h2>No existe este usuario</h2>
    <?php else : ?>
    
<main role="main">
<div class="row margin-arriba-3 " id="formulario">
    <div class="col-md-2"></div>
    <div class="col-md-7">
        <div class="card">
            <div class="card-header bg-dark text-light">
                Nuevo Usuario
            </div>
            <div class="card-body">
                <form  action="edit.php" method="POST">
                <input type="hidden" name="Id" value="<?= $usuario->Id ?>">
                <div class="row">
                    <div class="col">
                    <div class="form-group">
                        <label for="nombre">Nombre: </label>
                        <input type="text" class="form-control" id="nombre" name="Nombre" value="<?php echo $usuario->Nombre ?>">
                    </div>
                    </div>
                    <div class="col">
                    <div class="form-group">
                        <label for="apellido">Apellido: </label>
                        <input type="text" class="form-control" id="apellido" name="Apellido" value="<?php echo $usuario->Apellido ?>">
                    </div>
                  </div>
            </div>

            <div class="row">
                    <div class="col">
                    <div class="form-group">
                        <label for="email">Email: </label>
                        <input type="text" class="form-control" id="email" name="Email" value="<?php echo $usuario->Email ?>">
                    </div>
                    </div>
                    <div class="col">
                    <div class="form-group">
                        <label for="nombre_usuario">Nombre Usuario: </label>
                        <input type="text" class="form-control" id="nombre_usuario" name="Nombre_Usuario" value="<?php echo $usuario->Nombre_Usuario ?>">
                    </div>
                  </div>
            </div>
            <div class="row">
                    <div class="col">
                    <div class="form-group">
                        <label for="email">Contraseña: </label>
                        <input type="password" class="form-control" id="email" name="Password" value="<?php echo $usuario->Password ?>">
                    </div>
                    </div>
                    <div class="col">
                    <div class="form-group">
                        <label for="cPassword">Confirmar Contraseña: </label>
                        <input type="password" class="form-control" id="cPassword" name="CPassword" value="<?php echo $usuario->Password ?>" >

                     
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
                       <?php if($usuario->Estado===1): ?>
                        <input class="form-check-input" type="checkbox" name="Estado" value="activo" id="flexCheckChecked" checked>
                        <?php else: ?>
                            <input class="form-check-input" type="checkbox" name="Estado" value="activo" id="flexCheckChecked" >
                            <?php endif;?>
                    </div>
               
                   
                    <div class="form-group">
                        <label for="nombre_usuario">Administrador:</label>
                        <?php if($usuario->Rol===1): ?>
                        <input class="form-check-input" type="checkbox" name="Rol" value="activo" id="flexCheckChecked" checked>
                        <?php else: ?>
                            <input class="form-check-input" type="checkbox" name="Rol" value="activo" id="flexCheckChecked">
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

    <?php endif;?>
    <?php else : ?>
        <label class="text-center text-error mt-6" style="display:flex;justify-content:center">No puede acceder, no ha iniciado sesion.</label>
<?php endif;?>
<?php $layout->printFooter2()?>