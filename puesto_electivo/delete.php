<?php
require_once '../layout/adminlayout.php';
require_once '../helpers/utilities.php';
require_once 'puesto_electivo.php';
require_once '../helpers/utilities.php';
require_once '../FileHandler/IFileHandler.php';
require_once '../FileHandler/FileHandlerBase.php';
require_once '../FileHandler/JsonFileHandler.php';
require_once '../database/EleccionesContext.php';
require_once 'ServiceDatabasePuesto.php';

$layout = new AdminLayout(true);
$service = new ServiceDatabasePuesto();

$containId = isset($_GET["id"]);

if($containId){

    $service->Delete($_GET["id"]);
}

header("Location: index.php");
exit();
?>