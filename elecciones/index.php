<?php
require_once '../layout/adminlayout.php';
require_once 'elecciones.php';
require_once '../FileHandler/IFileHandler.php';
require_once '../FileHandler/FileHandlerBase.php';
require_once '../FileHandler/JsonFileHandler.php';
require_once '../helpers/utilities.php';
require_once '../database/EleccionesContext.php';
require_once 'ServiceDatabaseElecciones.php';
require_once '../helpers/utilities.php';
require_once '../candidatos/candidatos.php';
require_once '../candidatos/ServiceDatabaseCandidato.php';


$layout = new AdminLayout(true);
$service = new ServiceDatabaseElecciones();
$serviceCandidato = new ServiceDatabaseCandidato();

$elecciones = $service->GetList();
$candidatos = $serviceCandidato->GetList();
$cantidad_candidatos = count($candidatos);
$count = 0;
$state = false;
foreach($elecciones as $elect)
{
    if($elect->Estado==1)
    {
        $state=true;
        break;
    }
}
if($cantidad_candidatos>=2)
{
    foreach($candidatos as $c)
    {
        if($c->Estado==1)
        {
            $count = $count+1;
        }
    }
}

?>

<?php echo $layout->printHeader2() ;?>

    <div class="container-fluid py-4">
      <div class="row">
      <div class="text-right margin-arriba-3">
      <?php if(!$state):?>
        <?php if($candidatos==null):?>
        <a href="#" class="btn btn-success menu-bar" id="iniciar">Iniciar proceso de eleccion</a>
        <?php else: ?>
            <?php if($candidatos!=null):?>
                <?php if($cantidad_candidatos<2):?>
                    <a href="#" class="btn btn-success menu-bar" id="iniciar">Iniciar proceso de eleccion</a>
                    <?php elseif($count<2 && $cantidad_candidatos>=2): ?>
                        <a href="#" class="btn btn-success menu-bar" id="iniciar2">Iniciar proceso de eleccion</a>
                    <?php else: ?>
                    <a href="add.php" class="btn btn-success menu-bar">Iniciar proceso de eleccion</a>
                    <?php endif;?>
                    <?php endif;?>
                    <?php endif;?>
                    <?php endif;?>
      </div>
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Elecciones</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Id</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nombre</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Fecha</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Estado</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Accion</th>
                 
                    </tr>
                  </thead>
                  <tbody>
                  <?php if(empty($elecciones)):?>
                <tr>
                    <td colspan="3">
                        <h3>No existen elecciones registradas</h3>
                    </td>
                </tr>
                <?php else: ?>

                <?php foreach ($elecciones as $eleccion):?>
           
                <tr>
                    <th class="text-xs font-weight-bold mb-0"><?php echo $eleccion->Id; ?></th>
                    <td class="text-xs font-weight-bold mb-0"><?php echo $eleccion->Nombre; ?></td>
                    <td class="text-xs font-weight-bold mb-0"><?php echo $eleccion->Fecha; ?></td>
                    <?php if($eleccion->Estado ===1):?>
                    <td class="text-xs font-weight-bold mb-0">Activo</td>
                    <?php elseif($eleccion->Estado ===2) : ?>
                        <td class="text-xs font-weight-bold mb-0">Finalizada</td>
                        <?php elseif($eleccion->Estado ===0) : ?>
                        <td class="text-xs font-weight-bold mb-0">Inactivo</td>
                        <?php endif;?>
                   
                    <td>
                       <?php if($eleccion->Estado ===1 || $eleccion->Estado==0):?>
                        <a href="edit.php?Id=<?php echo $eleccion->Id; ?>"class="btn btn-info btn-sm">Editar</a>
                        <a  href="#" data-id="<?= $eleccion->Id ?>" data-name="eleccion" class="btn btn-danger btn-sm btn-delete">Eliminar</a>
                        <?php endif;?>
                        <?php if($eleccion->Estado ===2):?>
                        <a  href="../elector/resultadoCandidatos.php?Id=<?php echo $eleccion->Id ?>"  class="btn btn-success btn-sm btn-delete">Ver Resultados</a>
                        <?php endif;?>
                        <?php if($eleccion->Estado ===1):?>
                        <a  href="#" data-id="<?= $eleccion->Id ?>" data-name="eleccion" class="btn btn-warning btn-sm " id="finalizar">Finalizar</a>
                        <?php endif;?>
                    </td>
                </tr>
                <?php endforeach?>
                <?php endif ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
     
     
    </div>

<?php echo $layout->printFooter2() ?>

<script src="../assets/js/site/index/index.js"></script>

<script>
  
  $(document).ready(function(){

$("#iniciar").on("click",function(){
 debugger

 swal("Advertencia!", "Debe tener minimo dos candidatos registrados.", "warning");
});

$("#iniciar2").on("click",function(){
 debugger
 swal("Advertencia!", "Debe tener minimo dos candidatos activos.", "warning");
 
});

})
</script>