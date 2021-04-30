<?php
require_once '../layout/adminlayout.php';
require_once 'partidos.php';
require_once '../FileHandler/IFileHandler.php';
require_once '../FileHandler/FileHandlerBase.php';
require_once '../FileHandler/JsonFileHandler.php';
require_once '../helpers/utilities.php';
require_once '../database/EleccionesContext.php';
require_once 'ServiceDatabasePartidos.php';
require_once '../elecciones/elecciones.php';
require_once '../elecciones/ServiceDatabaseElecciones.php';

$layout = new AdminLayout(true);
$service = new ServiceDatabasePartidos();
$partidos = $service->GetList();
$serviceelecciones = new ServiceDatabaseElecciones();


$elecciones = $serviceelecciones->GetList();

$state = 0;
foreach($elecciones as $elect)
{
    if($elect->Estado==1)
    {
       $state++;
        break;
    }
}

?>

<?php echo $layout->printHeader2() ?>

<main role="main">

<section class="text-right">
  <div class="container">
 
    <p>
    <?php if($state==0):?>
      <a href="add.php" class="btn btn-success my-2"></i> Nuevo Partido</a>
      <?php endif; ?>
    </p>
  </div>
</section>
<br>

<br>
<div>
  <div class="container">
 
      <?php if(empty($partidos)):?>
      
        <h3 class="text-center">No hay Partidos registrados</h3>
       
      <?php else: ?>

        <div class="row">
          <?php foreach($partidos as $partido):?>

            
            
            <div class="col-md-3 margin-izquierda-8 margin-bottom-3">
              <?php if($partido->Estado ===1):?>
                <div class="card " style="width: 18rem;">
              <?php else: ?>
                <div class="card inactivo" style="width: 18rem;">
              <?php endif; ?>

            
                <?php if($partido->Logo == null || $partido->Logo == ''):?>
                  <img  src="<?php echo '../assets/img/default.png'; ?>" width="100%" height="225" aria-label="Placeholder: Thumbnail">
                <?php else: ?>
                  <img  src="<?php echo '../assets/img/partidos/'.$partido->Logo; ?>" width="100%" height="225" aria-label="Placeholder: Thumbnail">
                <?php endif;?>

                <div class="card-body">
                  <h5 class="card-title"><?php echo $partido->Nombre ?></h5>
                  <h6 class="card-text">Descripcion: <span style="font-weight:normal"><?php echo $partido->Descripcion;?><span></h6>
                  <?php if($partido->Estado ===1):?>
                  <h6 class="card-text"> <h6>Estado: <span class="statusActivo">Activo</span></h6>
                  <?php else: ?>
                 <h6 class="card-text"> <h6>Estado: <span class="statusInactivo">Inactivo</span></h6>
                 <?php endif; ?>
                  <div class="card-body">
                  <?php if($state==0):?>
                    <a href="edit.php?Id=<?php echo $partido->Id?>" class="btn btn-success btn-sm"></i> Editar</a>

                    <a class="btn btn-danger btn-sm text-light btn-delete" data-name="partido" data-id="<?= $partido->Id ?>"></i> Eliminar</a>
                    <?php endif; ?>
                  </div>

                </div>
              </div>
            </div>

          <?php endforeach; ?>
        </div>
      <?php endif;?>
    
  </div>
</div>

</main>

<?php echo $layout->printFooter2() ?>

<script src="../assets/js/site/index/index.js"></script>