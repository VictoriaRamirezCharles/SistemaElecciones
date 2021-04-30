<?php
require_once '../layout/adminlayout.php';
require_once '../helpers/utilities.php';
require_once '../plugin/PhpMailer/Exception.php';
require_once '../plugin/PhpMailer/PHPMailer.php';
require_once '../plugin/PhpMailer/SMTP.php';
require_once '../EmailHandler/EmailHandler.php';
require_once '../candidatos/candidatos.php';
require_once '../helpers/utilities.php';
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
require_once '../votos/votos.php';
require_once '../votos/ServiceDatabaseVotos.php';
require_once '../ciudadanos/ServiceDatabase.php';
require_once '../elecciones/ServiceDatabaseElecciones.php';
session_start();

$layout = new AdminLayout(true);
$service = new ServiceDatabaseCandidato();
$serviceVotos = new ServiceDatabaseVotos();

if (isset($_GET['Id'])) {

$IdEleccion=$_GET['Id'];
$votos = $serviceVotos->GetResult($IdEleccion);

}
$isLogged = false;
if(isset($_SESSION['adminUser']) && $_SESSION['adminUser']!=null)
{
  $isLogged = true;

}
?>
<?php $layout->printHeader2(); ?>

<?php if($isLogged):?>

<div class="container">
 
    <?php if(empty($votos)):?>

        <h3 class="text-center">No existen registros de esta eleccion</h3>

      <?php else: ?>
        
        <h1 class="page-title"><p align="center" style="margin-bottom:0px;">Sistema de voto automatizado </p>
            <span style="font-size: 20px;"><p align="center" style="margin-top:0px;">Elecciones del 30 Abril 2021</p></span></h1>

            <div class="profile-tabs">
                <div class="warrior-tab post-lists">
                    <div class="warrior-tab-content">
                        <div id="fullwidth">
                            <div id="recommended-stories" style="background-color:#072F5F;">
                                
                                   
		                      <h3><span style="font-size:22px; color:#fff; font-family:verdana;"><p align="center">RESULTADO ELECCIONES</p></span></h3>
                                
                                  
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

                                <?php foreach($votos as $voto):?>
                             <div class="row">
                                 <br>
                                <div class="col-md-12 ">
                                    <table width="95%" align="center" style="border:#fff 0px solid;">
                                        <tbody
                                            ><tr>
                                                <td width="33%"><strong>CANDIDATO</strong></td>
                                                <td width="33%"><strong>VOTOS</strong></td>
                                       
                                            </tr>
                                            <tr>
                                                <td valign="middle" style="border-bottom:#ccc 1px solid; padding-bottom: 15px; vertical-align: baseline;"> <?php echo $voto->CandidatoNombre;?></td>
                                                <td style="border-bottom:#ccc 1px solid;"><?php echo $voto->Cantidad;?></td>
                                              
                                            </tr>                                        
                                        </tbody>
                                    </table>                                                                   

                                </div>
                            </div>
                            <?php endforeach; ?>
                            <br><br>
                            <div class="text-center">
                       
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
