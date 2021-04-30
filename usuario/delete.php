<?php
require_once '../helpers/utilities.php';
require_once 'usuario.php';
require_once '../helpers/utilities.php';
require_once '../FileHandler/IFileHandler.php';
require_once '../FileHandler/FileHandlerBase.php';
require_once '../FileHandler/JsonFileHandler.php';
require_once '../database/EleccionesContext.php';
require_once 'ServiceDatabaseUsuario.php';

session_start();
$service = new ServiceDatabaseUsuario();

$containId = isset($_GET["id"]);
$isLogged = false;

if(isset($_SESSION['adminUser']) && $_SESSION['adminUser']!=null)
{
  $isLogged = true;

}
if($isLogged)
{
    if($containId){

        $service->Delete($_GET["id"]);
    }
    
    header("Location: index.php");
    exit();
}
else
{

}

?>