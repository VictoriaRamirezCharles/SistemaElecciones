<?php
require_once '../layout/adminlayout.php';
require_once '../helpers/utilities.php';
require_once 'elecciones.php';
require_once '../helpers/utilities.php';
require_once '../FileHandler/IFileHandler.php';
require_once '../FileHandler/FileHandlerBase.php';
require_once '../FileHandler/JsonFileHandler.php';
require_once '../database/EleccionesContext.php';
require_once 'ServiceDatabaseElecciones.php';

$layout = new AdminLayout(true);
$service = new ServiceDatabaseElecciones();

$containId = isset($_GET["id"]);

if($containId){

    $service->finalizarEleccion($_GET["id"],2);
}

header("Location: index.php");
exit();
?>