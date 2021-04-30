<?php
require_once '../layout/electlayout.php';
require_once '../helpers/utilities.php';
require_once '../FileHandler/IFileHandler.php';
require_once '../FileHandler/FileHandlerBase.php';
require_once '../FileHandler/JsonFileHandler.php';
require_once '../database/EleccionesContext.php';
require_once '../plugin/PhpMailer/Exception.php';
require_once '../plugin/PhpMailer/PHPMailer.php';
require_once '../plugin/PhpMailer/SMTP.php';
require_once '../EmailHandler/EmailHandler.php';
require_once '../votos/votos.php';
require_once '../votos/ServiceDatabaseVotos.php';
require_once '../ciudadanos/ciudadanos.php';
require_once '../ciudadanos/ServiceDatabase.php';
require_once '../elecciones/ServiceDatabaseElecciones.php';



session_start();

$service = new ServiceDatabaseVotos();
$serviceCiudadano = new ServiceDatabase();




if (isset($_GET['Id'])) {

    $IdCandidato=$_GET['Id'];
    $Ide=$_GET['eleccionId'];
    $ciudadano = $serviceCiudadano->GetById($_SESSION["IdVotante"]);
    $voto = new Voto(0,$IdCandidato, $_SESSION["IdVotante"], 0, "",$Ide);
        
    $service->Add($voto,$ciudadano->Email);

    header("Location: ../elector.php");
    exit();
}

?>