<?php
require_once '../layout/adminlayout.php';
require_once 'puesto_electivo.php';
require_once '../FileHandler/IFileHandler.php';
require_once '../FileHandler/FileHandlerBase.php';
require_once '../FileHandler/JsonFileHandler.php';
require_once '../helpers/utilities.php';
require_once '../database/EleccionesContext.php';
require_once 'ServiceDatabasePuesto.php';
require_once '../elecciones/elecciones.php';
require_once '../elecciones/ServiceDatabaseElecciones.php';
session_start();
$layout = new AdminLayout(true);
$service = new ServiceDatabasePuesto();

$puestos = $service->GetList();
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
$isLogged = false;
if(isset($_SESSION['adminUser']) && $_SESSION['adminUser']!=null)
{
  $isLogged = true;

}
?>

<?php echo $layout->printHeader2() ?>
<?php if($isLogged):?>
    <div class="container-fluid py-4">
      <div class="row">
      <div class="text-right margin-arriba-3">
      <?php if($state==0):?>
        <a href="add.php" class="btn btn-success menu-bar">Puesto Electivo</a>
        <?php endif; ?>
      </div>
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Puestos Electivos</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Id</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nombre</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Descripcion</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Estado</th>
                    <th class="text-secondary opacity-7">Accion</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php if(empty($puestos)):?>
                <tr>
                    <td colspan="3">
                        <h3>No existen puestos electivos registrados</h3>
                    </td>
                </tr>
                <?php else: ?>

                <?php foreach ($puestos as $puesto):?>
           
                <tr>
                    <th><?php echo $puesto->Id; ?></th>
                    <td><?php echo $puesto->Nombre; ?></td>
                    <td><?php echo $puesto->Descripcion; ?></td>
                    <?php if($puesto->Estado ===1):?>
                    <td>Activo</td>
                    <?php else : ?>
                        <td>Inactivo</td>
                        <?php endif;?>
                   
                    <td>
                    <?php if($state==0):?>
                       
                        <a href="edit.php?Id=<?php echo $puesto->Id; ?>"class="btn btn-info btn-sm">Editar</a>

                        <a  href="#" data-id="<?= $puesto->Id ?>" data-name="puesto electivo" class="btn btn-danger btn-sm btn-delete">Eliminar</a>
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
    <?php else:?>
    <label class="text-center text-error mt-6" style="display:flex;justify-content:center">No puede acceder, no ha iniciado sesion.</label>
 
<?php endif;?>
<?php echo $layout->printFooter2() ?>

<script src="../assets/js/site/index/index.js"></script>