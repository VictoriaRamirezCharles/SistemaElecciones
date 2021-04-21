<?php
require_once '../layout/adminlayout.php';
require_once 'usuario.php';
require_once '../FileHandler/IFileHandler.php';
require_once '../FileHandler/FileHandlerBase.php';
require_once '../FileHandler/JsonFileHandler.php';
require_once '../helpers/utilities.php';
require_once '../database/EleccionesContext.php';
require_once 'ServiceDatabase.php';

$layout = new AdminLayout(true);
$service = new ServiceDatabase();

$usuarios = $service->GetList();

?>

<?php echo $layout->printHeader() ?>
<div class="container margin-arriba-3">
    
    <div class="text-right margin-arriba-3">
        <a href="add.php" class="btn btn-success menu-bar">Nuevo Usuario</a>
    </div>
    <hr>
   
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                    <th>Nombre Usuario</th>
                    <th>Password</th>
                    <th>Estado</th>
                    <th>Rol</th>
                    <th>Accion</th>
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
                    <th><?php echo $usuario->Id; ?></th>
                    <td><?php echo $usuario->Nombre; ?></td>
                    <td><?php echo $usuario->Apellido; ?></td>
                    <td><?php echo $usuario->Email; ?></td>
                    <td><?php echo $usuario->Nombre_Usuario; ?></td>
                    <td><?php echo $usuario->Password; ?></td>
                    <?php if($usuario->Estado ===1):?>
                    <td>Activo</td>
                    <?php else : ?>
                        <td>Inactivo</td>
                        <?php endif;?>
                    <?php if($usuario->Rol ===1):?>
                        <td>Administrador</td>
                        <?php else : ?>
                            <td>Usuario</td>
                            <?php endif;?>
                    <td>
                       
                        <a href="edit.php?Id=<?php echo $usuario->Id; ?>"class="btn btn-info btn-sm">Editar</a>

                        <a  href="#" data-id="<?= $usuario->Id ?>" data-name="usuario" class="btn btn-danger btn-sm btn-delete">Eliminar</a>
                    </td>
                </tr>
                <?php endforeach?>
                <?php endif ?>
          
            </tbody>
        </table>
    </div>


<?php echo $layout->printFooter() ?>

<script src="../assets/js/site/index/index.js"></script>