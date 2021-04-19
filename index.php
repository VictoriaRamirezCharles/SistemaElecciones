<?php
require_once 'usuario/usuario.php';
require_once 'FileHandler/IFileHandler.php';
require_once 'FileHandler/FileHandlerBase.php';
require_once 'FileHandler/JsonFileHandler.php';
require_once 'helpers/utilities.php';
require_once './layout/layout.php';
require_once 'database/EleccionesContext.php';
require_once 'usuario/ServiceDatabase.php';

$layout = new Layout(false);
$service = new ServiceDatabase(true);

// $prueba = $service->Login('vicky','123');
// var_dump($prueba)

?>

<?php $layout->printHeader();?>



<?php $layout->printFooter()?>
