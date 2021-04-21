<?php
require_once '../layout/adminlayout.php';
require_once 'ciudadanos.php';
require_once '../FileHandler/IFileHandler.php';
require_once '../FileHandler/FileHandlerBase.php';
require_once '../FileHandler/JsonFileHandler.php';
require_once '../helpers/utilities.php';
require_once '../database/EleccionesContext.php';
require_once 'ServiceDatabase.php';

$layout = new AdminLayout(true);
$service = new ServiceDatabase();

$ciudadanos = $service->GetList();

?>

<?php echo $layout->printHeader() ?>
<div class="container margin-arriba-3">
    
    <div class="text-right margin-arriba-3">
        <a href="add.php" class="btn btn-success menu-bar">Nuevo Ciudadano</a>
    </div>
    <hr>
   
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>Id</th>
                    <th>Documento Identidad</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                    <th>Estado</th>
                    <th>Accion</th>
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
                    <th><?php echo $ciudadano->Id; ?></th>
                    <td><?php echo $ciudadano->Documento_Identidad; ?></td>
                    <td><?php echo $ciudadano->Nombre; ?></td>
                    <td><?php echo $ciudadano->Apellido; ?></td>
                    <td><?php echo $ciudadano->Email; ?></td>
                    <?php if($ciudadano->Estado ===1):?>
                    <td>Activo</td>
                    <?php else : ?>
                        <td>Inactivo</td>
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


<?php echo $layout->printFooter() ?>

<script src="../assets/js/site/index/index.js"></script>