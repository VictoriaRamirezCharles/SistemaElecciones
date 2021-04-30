<?php
session_start();
require_once 'usuario.php';
require_once '../layout/layout.php';
require_once '../helpers/utilities.php';
require_once '../plugin/PhpMailer/Exception.php';
require_once '../plugin/PhpMailer/PHPMailer.php';
require_once '../plugin/PhpMailer/SMTP.php';
require_once '../EmailHandler/EmailHandler.php';
require_once '../FileHandler/IFileHandler.php';
require_once '../FileHandler/FileHandlerBase.php';
require_once '../FileHandler/JsonFileHandler.php';
require_once '../database/EleccionesContext.php';
require_once '../ciudadanos/ciudadanos.php';
require_once 'ServiceDatabaseUsuario.php';
require_once '../elecciones/elecciones.php';
require_once '../elecciones/ServiceDatabaseElecciones.php';
require_once '../votos/ServiceDatabaseVotos.php';
require_once '../ciudadanos/ServiceDatabase.php';

$layout = new Layout(true);

$service = new ServiceDatabaseUsuario();
$serviceVotos = new ServiceDatabaseVotos();
$ciudadano = "";

$serviceelecciones = new ServiceDatabaseElecciones();
$elecciones = $serviceelecciones->GetList();

$state = 0;
$idEleccion = 0;
$valid = Array();
foreach($elecciones as $elect)
{
    if($elect->Estado==1)
    {
      $idEleccion = $elect->Id;
       $state++;
        break;
    }
}

$ciudadano = "";
$ejercido = false;
if(isset($_POST["documento"]))
{
    $ciudadano = $service->LoginElector($_POST["documento"]);
    if($ciudadano!=null){
      $valid = $serviceVotos->validarElectorVotacion($ciudadano->Id,$idEleccion);
      if(in_array('Senador',$valid) && in_array('Presidente',$valid) && in_array('Diputado',$valid) && in_array('Alcalde',$valid) )
      {
        $ejercido =true;
      }
      else
      {
        if($ciudadano!= null)
        {
            if($ciudadano->Estado === 1)
            {
              $_SESSION["IdVotante"] = $ciudadano->Id;
              $_SESSION['user'] = $ciudadano;
                    header("Location: ../elector.php");
                    exit();
            }
          
        }
        else 
        {
    
        } 
      }
    }else
    {
      if($ciudadano!= null)
      {
          if($ciudadano->Estado === 1)
          {
            $_SESSION["IdVotante"] = $ciudadano->Id;
            $_SESSION['user'] = $ciudadano;
                  header("Location: ../elector.php");
                  exit();
          }
        
      }
      else 
      {
  
      }

    }
  
 
  
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Elector</title>
</head>

<body>
<?php echo $layout->printHeader();?>
<div class="wrapper fadeInDown">
  <div id="formContent">

    <h2> Iniciar proceso de Votación</h2>
 
    <br>
    <br>
    <br>
    <form action="loginElector.php" method="POST">
      <input type="text" id="login" class="fadeIn second" name="documento" placeholder="Documento de Indentidad">

      <br/>
      <?php if ($ciudadano===null) : ?>
      <label class="text-center text-error">Documento de identidad incorrecto.</label>
      <?php endif; ?>
      <?php if ($ciudadano!=null || $ciudadano!="" ) : ?>

      <?php if ($ciudadano->Estado!=1) : ?>
      <label class="text-center text-error">Este ciudadano esta inactivo, contacte al administrador.</label>
      <?php endif; ?>
      <?php endif; ?>
      <?php if($state==0):?>
      <input type="button" class="fadeIn fourth" value="Iniciar" id="iniciar">
      <?php else : ?>
      <input type="submit" class="fadeIn fourth" value="Iniciar">
      <?php if($ejercido):?>
                   
      <label class="text-center text-error">Usted ya ha ejercido su derecho al voto.</label>
      <?php endif; ?>
      <?php endif; ?>
    </form>

 
    <div id="formFooter">
     
    </div>

  </div>
</div>
<?php echo $layout->printFooter() ?>

<script>
  
  $(document).ready(function(){

$("#iniciar").on("click",function(){
 debugger

 swal("Advertencia!", "No existe una eleccion activa", "warning");
});



})
</script>

</body>

</html>