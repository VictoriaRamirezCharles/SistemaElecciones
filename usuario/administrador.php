<?php
require_once 'usuario.php';
require_once '../layout/layout.php';
require_once '../helpers/utilities.php';
require_once '../FileHandler/IFileHandler.php';
require_once '../FileHandler/FileHandlerBase.php';
require_once '../FileHandler/JsonFileHandler.php';
require_once '../database/EleccionesContext.php';
require_once 'ServiceDatabase.php';

$layout = new Layout(true);
$service = new ServiceDatabase();
$user = "";
if(isset($_POST["Nombre_Usuario"]) && isset($_POST["Password"]))
{
    $user = $service->Login($_POST["Nombre_Usuario"],$_POST["Password"]);
    if($user!= null)
    {
        if($user->Estado === 1)
        {
            if($user->Rol === 1)
            {
                header("Location: ../index.php");
                exit();
            }
        }
      
    }
    else 
    {

    }
    
  
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>
</head>

<body>
<?php echo $layout->printHeader() ?>
<div class="wrapper fadeInDown">
  <div id="formContent">

    <h2> Iniciar Sesión</h2>
 
    <br>
    <br>
    <br>
    <form action="administrador.php" method="POST">
      <input type="text" id="login" class="fadeIn second" name="Nombre_Usuario" placeholder="Usuario Administrador">
      <input type="password" id="password" class="fadeIn third" name="Password" placeholder="Contraseña">
      <br/>
      <?php if ($user===null) : ?>
      <label class="text-center text-error">Usuario o contraseña incorrectos.</label>
      <?php endif; ?>
      <?php if ($user!=null || $user!="" ) : ?>

      <?php if ($user->Estado!=1) : ?>
      <label class="text-center text-error">Este usuario esta inactivo, contacte al administrador.</label>
      <?php endif; ?>
      <?php if ($user->Rol!=1) : ?>
      <label class="text-center text-error">Este usuario no es administrador</label>
      <?php endif; ?>
      <?php endif; ?>
      <input type="submit" class="fadeIn fourth" value="Iniciar">
    </form>

 
    <div id="formFooter">
     
    </div>

  </div>
</div>
<?php echo $layout->printFooter() ?>

</body>

</html>