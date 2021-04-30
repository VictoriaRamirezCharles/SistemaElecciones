<?php
require_once '../layout/adminlayout.php';
require_once 'ciudadanos.php';
require_once '../FileHandler/IFileHandler.php';
require_once '../FileHandler/FileHandlerBase.php';
require_once '../FileHandler/JsonFileHandler.php';
require_once '../helpers/utilities.php';
require_once '../database/EleccionesContext.php';
require_once 'ServiceDatabase.php';
session_start();
$layout = new AdminLayout(true);
$service = new ServiceDatabase();

$ciudadanos = $service->GetList();

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
        <a href="add.php" class="btn btn-success menu-bar">Nuevo Ciudadano</a>
      </div>
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Ciudadanos</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Id</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Documento Identidad</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nombre</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Apellido</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Estado</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Accion</th>
                 
                    </tr>
                  </thead>
                  <tbody>
                  <?php if(empty($ciudadanos)):?>
                <tr>
                    <td colspan="3">
                        <h3>No existen ciudadanos registrados</h3>
                    </td>
                </tr>
                <?php else: ?>

                <?php foreach ($ciudadanos as $ciudadano):?>
           
                <tr>
                    <th class="text-xs font-weight-bold mb-0"><?php echo $ciudadano->Id; ?></th>
                    <td class="text-xs font-weight-bold mb-0"><?php echo $ciudadano->Documento_Identidad; ?></td>
                    <td class="text-xs font-weight-bold mb-0"><?php echo $ciudadano->Nombre; ?></td>
                    <td class="text-xs font-weight-bold mb-0"><?php echo $ciudadano->Apellido; ?></td>
                    <td class="text-xs font-weight-bold mb-0"><?php echo $ciudadano->Email; ?></td>
                    <?php if($ciudadano->Estado ===1):?>
                    <td class="text-xs font-weight-bold mb-0">Activo</td>
                    <?php else : ?>
                        <td class="text-xs font-weight-bold mb-0">Inactivo</td>
                        <?php endif;?>
                   
                    <td>
                       
                        <a href="edit.php?Id=<?php echo $ciudadano->Id; ?>"class="btn btn-info btn-sm">Editar</a>

                        <a  href="#" data-id="<?= $ciudadano->Id ?>" data-name="ciudadano" class="btn btn-danger btn-sm btn-delete">Eliminar</a>
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