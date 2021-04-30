<?php
require_once '../layout/electlayout.php';
require_once '../helpers/utilities.php';
require_once '../candidatos/candidatos.php';
require_once '../helpers/utilities.php';
require_once '../FileHandler/IFileHandler.php';
require_once '../FileHandler/FileHandlerBase.php';
require_once '../FileHandler/JsonFileHandler.php';
require_once '../database/EleccionesContext.php';
require_once '../candidatos/ServiceDatabaseCandidato.php';
require_once '../puesto_electivo/puesto_electivo.php';
require_once '../puesto_electivo/ServiceDatabasePuesto.php';
require_once '../partidos/partidos.php';
require_once '../partidos/ServiceDatabasePartidos.php';

$layout = new ElectLayout(true);
$service = new ServiceDatabaseCandidato();
$servicePuesto = new ServiceDatabasePuesto();
$servicePartidos = new ServiceDatabasePartidos();
$utilities = new Utilities();

$puestos = $servicePuesto->GetList();
$partidos = $servicePartidos->GetList();

$candidato= null; 

if(isset($_GET['Id'])){

    $idCandidato = $_GET['Id'];
    $candidato = $service->GetById($idCandidato);
}


?>
<?php $layout->printHeader2(); ?>

<h1 class="page-title"><p align="center" style="margin-bottom:0px;font-size:31px">Sistema de voto automatizado </p>
<span style="font-size: 20px;"><p align="center" style="margin-top:0px;"></p></span></h1>
<div id="recommended-stories">
  <div class="row">
    <div class="col-sm-12 margin-izquierda-3" style="height: 50px; background-color:#072F5F;  padding-top: 10px;">                                    
      <h3><span style="font-size:22px; color:#fff; font-family:verdana;"><p align="center"><?php echo $candidato->PuestoNombre?></p></span></h3>
    </div>
  </div>
                                
  <div class="row margin-izquierda-3">                                
    <a class="col-sm-3 bg-danger boton_nav boton_enlace text-white" href="../elector.php">
      REGRESAR 
    </a>
    <div class="col-sm-6 bg-dark boton_nav text-white">
      TOQUE NUEVAMENTE EL RECUADRO PARA CONFIRMAR 
    </div>
    <a class="col-sm-3 bg-danger boton_nav boton_enlace text-white" href="listadoCandidatos.php?Id=<?php echo $candidato->Id?>">
      CONFIRMAR 
    </a>
  </div>                                                               
  <br>   		    
					
                               
<div class="container" >
 
  <?php if(empty($candidatos) && empty($partidos)):?>

    <h3 class="text-center">No hay Candidatos registrados</h3>

  <?php else: ?>

    <div class="row">

       
      <div class="col-md-3 margin-izquierda-8 margin-bottom-3" >
        <?php if($candidato->Estado ===1):?>
          <div class="card" style="width: 18rem;" > 
            <a href="../elector/listadoCandidatos.php?Id=<?php echo $candidato->Id?>">
        <?php else: ?>
          <div class="card inactivo" style="width: 18rem;">
           
        <?php endif; ?>
   
          <div class="ml-6 margin-izquierda-8" >
            <?php if($candidato->FotoPerfil == null || $candidato->FotoPerfil == ''):?>
              <img  src="<?php echo '../assets/img/default.png'; ?>" width="100%" height="225" aria-label="Placeholder: Thumbnail">
            <?php else: ?>
              <img  src="<?php echo '../assets/img/candidatos/'.$candidato->FotoPerfil; ?>" alt="Lights" class="img-thumbnail" style="border: 0px;">
            <?php endif;?>
              </div>
            </div>
            <div class="card-body">
              <h5 class="card-title"><?php echo $candidato->Nombre . " " . $candidato->Apellido; ?></h5>
              <h6 class="card-text">Puesto: <span style="font-weight:normal"><?php echo $candidato->PuestoNombre;?><span></h6>
              <h6 class="card-text">Partido: <span style="font-weight:normal"><?php echo $candidato->PartidoNombre;?><span></h6>
        

            </div>
           
         </div>
         </a>
       </div>
 
    </div>
  <?php endif;?>

</div>
                                  



<?php $layout->printFooter2()?>