<?php
require_once '../layout/adminlayout.php';
require_once 'elecciones.php';
require_once '../FileHandler/IFileHandler.php';
require_once '../FileHandler/FileHandlerBase.php';
require_once '../FileHandler/JsonFileHandler.php';
require_once '../helpers/utilities.php';
require_once '../database/EleccionesContext.php';
require_once 'ServiceDatabase.php';
require_once '../helpers/utilities.php';

$layout = new AdminLayout(true);
$service = new ServiceDatabase();

$elecciones = $service->GetList();

?>

<?php echo $layout->printHeader() ?>
<div class="container margin-arriba-3">
    
    <div class="text-right margin-arriba-3">
        <a href="add.php" class="btn btn-success menu-bar">Nuevo registro eleccion</a>
    </div>
    <hr>
   
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Accion</th>
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
                    <th><?php echo $eleccion->Id; ?></th>
                    <td><?php echo $eleccion->Nombre; ?></td>
                    <td><?php echo $eleccion->Fecha; ?></td>
                    <?php if($eleccion->Estado ===1):?>
                    <td>Activo</td>
                    <?php else : ?>
                        <td>Inactivo</td>
                        <?php endif;?>
                   
                    <td>
                       
                        <a href="edit.php?Id=<?php echo $eleccion->Id; ?>"class="btn btn-info btn-sm">Editar</a>

                        <a  href="#" data-id="<?= $eleccion->Id ?>" data-name="eleccion" class="btn btn-danger btn-sm btn-delete">Eliminar</a>
                    </td>
                </tr>
                <?php endforeach?>
                <?php endif ?>
          
            </tbody>
        </table>
    </div>


<?php echo $layout->printFooter() ?>

<script src="../assets/js/site/index/index.js"></script>