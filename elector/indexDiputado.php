<?php
require_once '../layout/electlayout.php';
require_once '../candidatos/candidatos.php';
require_once '../FileHandler/IFileHandler.php';
require_once '../FileHandler/FileHandlerBase.php';
require_once '../FileHandler/JsonFileHandler.php';
require_once '../helpers/utilities.php';
require_once '../plugin/PhpMailer/Exception.php';
require_once '../plugin/PhpMailer/PHPMailer.php';
require_once '../plugin/PhpMailer/SMTP.php';
require_once '../EmailHandler/EmailHandler.php';
require_once '../database/EleccionesContext.php';
require_once '../partidos/partidos.php';
require_once '../partidos/ServiceDatabasePartidos.php';
require_once '../candidatos/ServiceDatabaseCandidato.php';
require_once '../puesto_electivo/puesto_electivo.php';
require_once '../puesto_electivo/ServiceDatabasePuesto.php';
require_once '../votos/ServiceDatabaseVotos.php';
require_once '../elecciones/elecciones.php';
require_once '../elecciones/ServiceDatabaseElecciones.php';
require_once '../ciudadanos/ciudadanos.php';
require_once '../ciudadanos/ServiceDatabase.php';
session_start();

$layout = new ElectLayout(true);
$service = new ServiceDatabaseCandidato();
$servicePuesto = new ServiceDatabasePuesto();
$servicePartido = new ServiceDatabasePartidos();
$serviceelecciones = new ServiceDatabaseElecciones();
$serviceVotos = new ServiceDatabaseVotos();
$elecciones = $serviceelecciones->GetList();
$puestos = $servicePuesto->GetList();
$candidatos = $service->GetList();
$partidos = $servicePartido->GetList();

$isLogged = false;
if(isset($_SESSION['user']) && $_SESSION['user']!=null)
{
  $isLogged = true;
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
$valid = $serviceVotos->validarElectorVotacion($_SESSION["IdVotante"],$idEleccion);

if(in_array('Diputado',$valid))
{
  $ejercido =true;
}
}

?>

<?php echo $layout->printHeader2();?>
<?php if($isLogged):?>
<main role="main">


<br>

<br>
<div>
  <div class="container">
 
      <?php if(empty($candidatos) && empty($partidos)):?>

        <h3 class="text-center">No hay Candidatos registrados</h3>

      <?php else: ?>
        <h1 class="page-title"><p align="center" style="margin-bottom:0px;font-size:31px">Sistema de voto automatizado </p>
        <!-- <span style="font-size: 20px;"><p align="center" style="margin-top:0px;">Elecciones del 30 Abril 2021</p></span></h1> -->
        <br>
        <div id="recommended-stories">
          <div style="height: 60px; background-color:#072F5F;  padding-top: 10px; border-bottom:#ccc 1px solid;">
            <center><span style="font-zize:10px; color:#fff;"><h4 style="color:#fff">LISTADO DE CANDIDATOS(AS) </h4></span></center>          
          </div> 
        </div>
        </br>

        <div class="row">
        <?php if(!$ejercido):?>
          <?php foreach($candidatos as $candidato):?>

            <?php if($candidato->Estado ===1 && $candidato->PuestoNombre === 'Diputado'):?>
            <div class="col-md-3 margin-bottom-3">
              <?php if($candidato->Estado ===1 && $candidato->PuestoNombre === 'Diputado'):?>
                <div class="card " style="width: 10rem;">
                <a href="../elector/confirmarElector.php?Id=<?php echo $candidato->Id?>">
              <?php else: ?>
                <div class="card inactivo" style="width: 10rem;">
                
              <?php endif; ?>
   

                
                <?php if($candidato->FotoPerfil == null || $candidato->FotoPerfil == ''):?>
                  <img  src="<?php echo '../assets/img/default.png'; ?>" width="100%" height="225" aria-label="Placeholder: Thumbnail">
                <?php else: ?>
                  <img  src="<?php echo '../assets/img/candidatos/'.$candidato->FotoPerfil; ?>" alt="Lights" class="img-thumbnail" style="border: 0px;">
                <?php endif;?>
                
                
                <div class="card-body">
                  <h6 class="card-text"><?php echo $candidato->Nombre . " " . $candidato->Apellido; ?></h6>
                  <h6 class="card-text">Puesto: <span style="font-weight:normal"><?php echo $candidato->PuestoNombre;?><span></h6>
                  <h6 class="card-text">Partido: <span style="font-weight:normal"><?php echo $candidato->PartidoNombre;?><span></h6>
    
                </div>
                
              </div>
              </a>
            </div>
            <?php endif;?>
          <?php endforeach; ?>
          <?php else: ?>
            <center><h3 class="page-title text-center"><p class="text-center" style="margin-bottom:0px;">Usted ya ha votado por esta candidatura. </p></h3></center>   
            <?php endif;?>
        </div>
      <?php endif;?>
    
  </div>
</div>

</main>
<?php else:?>
    
    <label class="text-center text-error mt-6" style="display:flex;justify-content:center">No puede acceder, no ha iniciado sesion.</label>
 
<?php endif;?>
<?php echo $layout->printFooter2() ?>

<script src="../assets/js/site/index/index.js"></script>