<?php
require_once '../layout/adminlayout.php';
require_once '../helpers/utilities.php';
require_once 'candidatos.php';
require_once '../helpers/utilities.php';
require_once '../FileHandler/IFileHandler.php';
require_once '../FileHandler/FileHandlerBase.php';
require_once '../FileHandler/JsonFileHandler.php';
require_once '../database/EleccionesContext.php';
require_once 'ServiceDatabaseCandidato.php';
require_once '../puesto_electivo/puesto_electivo.php';
require_once '../puesto_electivo/ServiceDatabasePuesto.php';
require_once '../partidos/partidos.php';
require_once '../partidos/ServiceDatabasePartidos.php';
session_start();
$layout = new AdminLayout(true);
$service = new ServiceDatabaseCandidato();
$servicePuesto = new ServiceDatabasePuesto();
$servicePartidos = new ServiceDatabasePartidos();
$utilities = new Utilities();

$puestos = $servicePuesto->GetList();
$partidos = $servicePartidos->GetList();
$isLogged = false;

if(isset($_SESSION['adminUser']) && $_SESSION['adminUser']!=null)
{
  $isLogged = true;

}

$candidato= null; 
$puesto = null;
$partido =null;

if(isset($_POST["Nombre"]) && isset($_POST["Apellido"]) && isset($_POST["PartidoId"]) && isset($_POST["PuestoId"]))
{
    $puesto = $servicePuesto->GetById($_POST["PuestoId"]);
    $partido = $servicePartidos->GetById($_POST["PartidoId"]);
       if($puesto!=null || $puestos!=null){
        if($puesto->Estado==1)
        {
            if($partido->Estado==1){
            $candidato = new Candidato();

            $status = ($_POST["Estado"] == "activo") ? true : false;
    
            $candidato-> initializeData(0,$_POST["Nombre"],$_POST["Apellido"],$_POST["PartidoId"],$_POST["PuestoId"],$status);
            $service->Add($candidato);
        
            header("Location: index.php");
            exit();
        }
        }
    }
      
    
  
}
?>
<?php $layout->printHeader2(); ?>

<?php if($isLogged):?>
<main role="main">
<div class="row margin-arriba-3 " id="formulario">
    <div class="col-md-3"></div>
    <div class="col-md-5">
        <div class="card">
            <div class="card-header bg-dark text-light">
                Nuevo Candidato
            </div>
            <div class="card-body">
                <form enctype="multipart/form-data" action="add.php" method="POST">
                    <div class="form-group">
                        <label for="nombre">Nombre: </label>
                        <input type="text" class="form-control" id="nombre" name="Nombre" >
                    </div>
                
                    <div class="form-group">
                        <label for="apellido">Apellido: </label>
                        <input type="text" class="form-control" id="apellido" name="Apellido" >
                    </div>

                    <div class="form-group">
                        <label for="partidoId">Partido</label>
                        <select class="form-control" id="partidoId" name="PartidoId">
                            <option value="">Seleccione el partido</option>
                             <?php foreach ($partidos as $partido) : ?>
                                <option value="<?php echo $partido->Id; ?>"> <?= $partido->Nombre ?> </option>
                            <?php endforeach;?>
                        </select>
                        <?php if($partido!=null):?>
                        <?php if($partido->Estado==0):?>
                            <label class="text-center text-error">Este partido esta inactivo</label>
                            <?php endif; ?>
                            <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="puestoId">Puesto</label>
                        <select class="form-control" id="puestoId" name="PuestoId">
                            <option value="">Seleccione el puesto</option>
                             <?php foreach ($puestos as $puesto) : ?>
                                <option value="<?php echo $puesto->Id; ?>"> <?= $puesto->Nombre ?> </option>
                            <?php endforeach;?>
                        </select>
                        <?php if($puesto!=null):?>
                        <?php if($puesto->Estado==0):?>
                            <label class="text-center text-error">Este puesto esta inactivo</label>
                            <?php endif; ?>
                            <?php endif; ?>

                    </div>

                    <div class="form-group">
                        <label for="fotoPerfil">Foto de Perfil: </label>
                        <input type="file" class="form-control-file" id="fotoPerfil" name="FotoPerfil">
                    </div>

                    <div class="form-group">
                    <label class="form-check-label" for="flexCheckChecked">Activo</label>
                        <input class="form-check-input" type="checkbox" name="Estado" value="activo" id="flexCheckChecked" checked>
                    </div>

                    <div class="text-right">
                        <button class="btn btn-success" type="submit">Guardar</button>
                    </div>
                    <?php if($puestos==null):?>
                   
                     <label class="text-center text-error">Debe tener al menos un puesto registrado para continuar.</label>
                    <?php endif; ?>
                    <?php if($partidos==null):?>
                   
                   <label class="text-center text-error">Debe tener al menos un partido registrado para continuar.</label>
                  <?php endif; ?>
                       
                </form>                              
            </div>
        </div>
    </div>
</div>
</main>
<?php else:?>
    <label class="text-center text-error mt-6" style="display:flex;justify-content:center">No puede acceder, no ha iniciado sesion.</label>
 
<?php endif;?>
<?php $layout->printFooter2()?>