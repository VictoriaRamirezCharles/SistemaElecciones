<?php
require_once '../layout/electlayout.php';
require_once '../helpers/utilities.php';
require_once '../candidatos/candidatos.php';
require_once '../helpers/utilities.php';
require_once '../plugin/PhpMailer/Exception.php';
require_once '../plugin/PhpMailer/PHPMailer.php';
require_once '../plugin/PhpMailer/SMTP.php';
require_once '../EmailHandler/EmailHandler.php';
require_once '../FileHandler/IFileHandler.php';
require_once '../FileHandler/FileHandlerBase.php';
require_once '../FileHandler/JsonFileHandler.php';
require_once '../database/EleccionesContext.php';
require_once '../puesto_electivo/puesto_electivo.php';
require_once '../puesto_electivo/ServiceDatabasePuesto.php';
require_once '../partidos/partidos.php';
require_once '../partidos/ServiceDatabasePartidos.php';
require_once '../votos/ServiceDatabaseVotos.php';
require_once '../candidatos/ServiceDatabaseCandidato.php';
require_once '../elecciones/elecciones.php';
require_once '../elecciones/ServiceDatabaseElecciones.php';
require_once '../ciudadanos/ServiceDatabase.php';
session_start();
$layout = new ElectLayout(true);
$service = new ServiceDatabaseCandidato();
$serviceelecciones = new ServiceDatabaseElecciones();
$isLogged = false;
if(isset($_SESSION['user']) && $_SESSION['user']!=null)
{
    $isLogged = true;
$idCandidato = 0;
$candidato= null; 

$elecciones = $serviceelecciones->GetList();

$state = 0;
$eleccionId=0;
$elecc=null;
foreach($elecciones as $elect)
{
    if($elect->Estado==1)
    {
       $elecc =  $serviceelecciones->GetById($elect->Id);
       $state++;
        break;
    }
}

if(isset($_GET['Id'])){

    $idCandidato = $_GET['Id'];
    $candidato = $service->GetById($idCandidato);
}
}

?>
<?php $layout->printHeader2(); ?>

<?php if($isLogged):?>

<div class="container">
 
    <?php if(empty($candidato)):?>

        <h3 class="text-center">No hay Candidatos registrados</h3>

      <?php else: ?>

        <h1 class="page-title"><p align="center" style="margin-bottom:0px;font-size:31px">Sistema de voto automatizado </p>
            <span style="font-size: 20px;"><p align="center" style="margin-top:0px;">Elecciones del 30 Abril 2021</p></span></h1>

            <div class="profile-tabs">
                <div class="warrior-tab post-lists">
                    <div class="warrior-tab-content">
                        <div id="fullwidth">
                            <div id="recommended-stories" style="background-color:#072F5F;">
                                
                                   
		                      <h3><span style="font-size:22px; color:#fff; font-family:verdana;"><p align="center">CONFIRMAR RESULTADOS</p></span></h3>
                                
                                  
			                     </div>
                             
                              <div class="row">
                                     <div class="col-md-12 " align="center">
                                       <strong>DEMARCACION: &nbsp;</strong> 
                                          DISTRITO NACIONAL | DISTRITO NACIONAL | CIRCUNSCRIPCION 1                                    
                                    </div>
                                </div>
                             <div class="row">
                                     <div class="col-md-12 " align="center">
                                       <br>
                                    </div>
                                </div>


                             <div class="row">
                                 <br>
                                <div class="col-md-12 ">
                                    <table width="95%" align="center" style="border:#fff 0px solid;">
                                        <tbody
                                            ><tr>
                                                <td width="33%"><strong>CARGO(s)</strong></td>
                                                <td width="33%"><strong>PARTIDO</strong></td>
                                                <td width="33%"><strong>CANDIDATO(S)</strong></td>
                                            </tr>
                                            <tr>
                                                <td valign="middle" style="border-bottom:#ccc 1px solid; padding-bottom: 15px; vertical-align: baseline;"> <?php echo $candidato->PuestoNombre;?></td>
                                                <td style="border-bottom:#ccc 1px solid;"><?php echo $candidato->PartidoNombre;?></td>
                                                <td style="border-bottom:#ccc 1px solid;"><img src="<?php echo '../assets/img/candidatos/'.$candidato->FotoPerfil; ?>" class="img-thumbnail" style="border: 0px; width:20%;">  <?php echo $candidato->Nombre . " " . $candidato->Apellido; ?></td>
                                            </tr>                                        
                                        </tbody>
                                    </table>                                                                   

                                </div>
                            </div>
                            <br><br>
                            <div class="text-center">
                   
                               
                                <a  href="#" data-eleccion="<?= $elecc->Id ?>" data-id="<?= $candidato->Id ?>" id="guardar-votos"  class="btn btn-success">Confirmar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        
    <?php endif;?>
    
</div>

<?php else:?>
    <label class="text-center text-error mt-6" style="display:flex;justify-content:center">No puede acceder, no ha iniciado sesion.</label>
 
<?php endif;?>



<?php $layout->printFooter2()?>
<script src="../assets/js/site/addVotos.js"></script>