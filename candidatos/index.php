<?php
require_once '../layout/adminlayout.php';
require_once 'candidatos.php';
require_once '../FileHandler/IFileHandler.php';
require_once '../FileHandler/FileHandlerBase.php';
require_once '../FileHandler/JsonFileHandler.php';
require_once '../helpers/utilities.php';
require_once '../database/EleccionesContext.php';
require_once 'ServiceDatabase.php';
require_once '../puesto_electivo/puesto_electivo.php';
require_once '../puesto_electivo/ServiceDatabasePuesto.php';

$layout = new AdminLayout(true);
$service = new ServiceDatabase();
$servicePuesto = new ServiceDatabasePuesto();
$puestos = $servicePuesto->GetList();
$candidatos = $service->GetList();

?>

<?php echo $layout->printHeader() ?>

<main role="main">

<section class="text-right">
  <div class="container">
 
    <p>
      <a href="add.php" class="btn btn-success my-2"></i> Nuevo Candidato</a>
    </p>
  </div>
</section>
<br>

<br>
<div>
  <div class="container">
 
      <?php if(empty($candidatos)):?>

        <h3 class="text-center">No hay Candidatos registrados</h3>

      <?php else: ?>

        <div class="row">
          <?php foreach($candidatos as $candidato):?>

            
            
            <div class="col-md-3 margin-izquierda-8 margin-bottom-3">
              <?php if($candidato->Estado ===1):?>
                <div class="card " style="width: 18rem;">
              <?php else: ?>
                <div class="card inactivo" style="width: 18rem;">
              <?php endif; ?>

            
                <?php if($candidato->FotoPerfil == null || $candidato->FotoPerfil == ''):?>
                  <img  src="<?php echo '../assets/img/default.png'; ?>" width="100%" height="225" aria-label="Placeholder: Thumbnail">
                <?php else: ?>
                  <img  src="<?php echo '../assets/img/candidatos/'.$candidato->FotoPerfil; ?>" width="100%" height="225" aria-label="Placeholder: Thumbnail">
                <?php endif;?>

                <div class="card-body">
                  <h5 class="card-title"><?php echo $candidato->Nombre . " " . $candidato->Apellido; ?></h5>
                  <h6 class="card-text">Puesto: <span style="font-weight:normal"><?php echo $candidato->PuestoNombre;?><span></h6>
                  <h6 class="card-text">Partido: <span style="font-weight:normal"><?php echo $candidato->PartidoNombre;?><span></h6>
                  <?php if($candidato->Estado ===1):?>
                  <h6 class="card-text"> <h6>Estado: <span class="statusActivo">Activo</span></h6>
                  <?php else: ?>
                 <h6 class="card-text"> <h6>Estado: <span class="statusInactivo">Inactivo</span></h6>
                 <?php endif; ?>
                  <div class="card-body">
                    <a href="edit.php?Id=<?php echo $candidato->Id?>" class="btn btn-primary btn-sm"></i> Editar</a>

                    <a class="btn btn-danger btn-sm text-light btn-delete" data-name="candidato" data-id="<?= $candidato->Id ?>"></i> Eliminar</a>
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

<?php echo $layout->printFooter() ?>

<script src="../assets/js/site/index/index.js"></script>