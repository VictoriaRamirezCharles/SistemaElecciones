<?php
require_once '../layout/adminlayout.php';
require_once 'puesto_electivo.php';
require_once '../FileHandler/IFileHandler.php';
require_once '../FileHandler/FileHandlerBase.php';
require_once '../FileHandler/JsonFileHandler.php';
require_once '../helpers/utilities.php';
require_once '../database/EleccionesContext.php';
require_once 'ServiceDatabasePuesto.php';

$layout = new AdminLayout(true);
$service = new ServiceDatabasePuesto();

$puestos = $service->GetList();

?>

<?php echo $layout->printHeader() ?>
<div class="container margin-arriba-3">
    
    <div class="text-right margin-arriba-3">
        <a href="add.php" class="btn btn-success menu-bar">Nuevo Puesto Electivo</a>
    </div>
    <hr>
   
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Estado</th>
                    <th>Accion</th>
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
                       
                        <a href="edit.php?Id=<?php echo $puesto->Id; ?>"class="btn btn-info btn-sm">Editar</a>

                        <a  href="#" data-id="<?= $puesto->Id ?>" data-name="puesto electivo" class="btn btn-danger btn-sm btn-delete">Eliminar</a>
                    </td>
                </tr>
                <?php endforeach?>
                <?php endif ?>
          
            </tbody>
        </table>
    </div>


<?php echo $layout->printFooter() ?>

<script src="../assets/js/site/index/index.js"></script>