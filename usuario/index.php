<?php
require_once '../layout/adminlayout.php';
require_once 'usuario.php';
require_once '../FileHandler/IFileHandler.php';
require_once '../FileHandler/FileHandlerBase.php';
require_once '../FileHandler/JsonFileHandler.php';
require_once '../helpers/utilities.php';
require_once '../database/EleccionesContext.php';
require_once 'ServiceDatabaseUsuario.php';

$layout = new AdminLayout(true);
$service = new ServiceDatabaseUsuario();

$usuarios = $service->GetList();
$isLogged = false;

if(isset($_SESSION['adminUser']) && $_SESSION['adminUser']!=null)
{
  $isLogged = true;

}

?>

<?php echo $layout->printHeader2() ?>

    <?php if(!$isLogged):?>
    <div class="container-fluid py-4">
      <div class="row">
      <div class="text-right margin-arriba-3">
        <a href="add.php" class="btn btn-success menu-bar">Nuevo Usuario</a>
      </div>
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Usuarios</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Id</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nombre</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Apellido</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nombre Usuario</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Password</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Estado</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Rol</th>
                    <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
            <?php if(empty($usuarios)):?>
                <tr>
                    <td colspan="3">
                        <h3>No existen usuarios registrados</h3>
                    </td>
                </tr>
                <?php else: ?>

                <?php foreach ($usuarios as $usuario):?>
           
                <tr>
                    <td class="text-xs font-weight-bold mb-0" ><?php echo $usuario->Id; ?></td>
                    <td class="text-xs font-weight-bold mb-0"><?php echo $usuario->Nombre; ?></td>
                    <td class="text-xs font-weight-bold mb-0"><?php echo $usuario->Apellido; ?></td>
                    <td class="text-xs font-weight-bold mb-0"><?php echo $usuario->Email; ?></td>
                    <td class="text-xs font-weight-bold mb-0"><?php echo $usuario->Nombre_Usuario; ?></td>
                    <td class="text-xs font-weight-bold mb-0"><?php echo $usuario->Password; ?></td>
                    <?php if($usuario->Estado ===1):?>
                    <td class="text-xs font-weight-bold mb-0">Activo</td>
                    <?php else : ?>
                        <td class="text-xs font-weight-bold mb-0">Inactivo</td>
                        <?php endif;?>
                    <?php if($usuario->Rol ===1):?>
                        <td class="text-xs font-weight-bold mb-0">Administrador</td>
                        <?php else : ?>
                            <td class="text-xs font-weight-bold mb-0">Usuario</td>
                            <?php endif;?>
                    <td>
                       
                        <a href="edit.php?Id=<?php echo $usuario->Id; ?>"class="btn btn-info">Editar</a>

                        <a  href="#" data-id="<?= $usuario->Id ?>" data-name="usuario" class="btn btn-danger btn-delete">Eliminar</a>
                    </td>
                </tr>
                <?php endforeach?>
                <?php endif; ?>
          
    
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
     
     
    </div>
    <?php else: ?>
    <label class="text-center text-error">No puede acceder, no ha iniciado sesion.</label>
    <?php endif; ?>
    </main>
<?php echo $layout->printFooter2() ?>
  
<script src="../assets/js/site/index/index.js"></script>