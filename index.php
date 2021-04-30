<?php
require_once 'usuario/usuario.php';
require_once 'FileHandler/IFileHandler.php';
require_once 'FileHandler/FileHandlerBase.php';
require_once 'FileHandler/JsonFileHandler.php';
require_once 'helpers/utilities.php';
require_once './layout/layout.php';
require_once 'database/EleccionesContext.php';
require_once 'usuario/ServiceDatabaseUsuario.php';

$layout = new Layout(false);
$service = new ServiceDatabaseUsuario(true);
?>

<?php $layout->printHeader();?>



<?php $layout->printFooter()?>
