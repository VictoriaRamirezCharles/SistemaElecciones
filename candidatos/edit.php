<?php
require_once '../layout/adminlayout.php';
require_once '../helpers/utilities.php';
require_once 'candidatos.php';
require_once '../helpers/utilities.php';
require_once '../FileHandler/IFileHandler.php';
require_once '../FileHandler/FileHandlerBase.php';
require_once '../FileHandler/JsonFileHandler.php';
require_once '../database/EleccionesContext.php';
require_once 'ServiceDatabase.php';
require_once '../puesto_electivo/puesto_electivo.php';
require_once '../puesto_electivo/ServiceDatabasePuesto.php';
require_once '../partidos/partidos.php';
require_once '../partidos/ServiceDatabasePartidos.php';

$layout = new AdminLayout(true);
$service = new ServiceDatabase();
$servicePuesto = new ServiceDatabasePuesto();
$servicePartidos = new ServiceDatabasePartidos();
$utilities = new Utilities();

$puestos = $servicePuesto->GetList();
$partidos = $servicePartidos->GetList();

$candidato= null; 

if(isset($_GET['Id'])){

    $idCandidato = $_GET['Id'];
    $candidato = $service->GetById($idCandidato);
}

if(isset($_POST["Nombre"]) && isset($_POST["Apellido"]) && isset($_POST["PartidoId"]) && isset($_POST["PuestoId"]))
{
        $candidato = new Candidato();

        $status = ($_POST["Estado"] == "activo") ? true : false;

        $candidato-> initializeData($idCandidato,$_POST["Nombre"],$_POST["Apellido"],$_POST["PartidoId"],$_POST["PuestoId"],$status);
        $service->Edit($candidato);
    
        header("Location: index.php");
        exit();
    
  
}
?>
<?php $layout->printHeader(); ?>

<main role="main">
<div class="row margin-arriba-3 " id="formulario">
    <div class="col-md-3"></div>
    <div class="col-md-5">
        <div class="card">
            <div class="card-header bg-dark text-light">
                Editar Candidato
            </div>
            <div class="card-body">
                <form enctype="multipart/form-data" action="edit.php?Id=<?php echo $candidato->Id?>"  method="POST">
                    <div class="form-group">
                        <label for="nombre">Nombre: </label>
                        <input type="text" class="form-control" id="nombre" name="Nombre" value="<?php echo $candidato->Nombre ?>" >
                    </div>
                
                    <div class="form-group">
                        <label for="apellido">Apellido: </label>
                        <input type="text" class="form-control" id="apellido" name="Apellido" value="<?php echo $candidato->Apellido ?>" >
                    </div>

                    <div class="form-group">
                        <label for="partidoId">Partido</label>
                        <select class="form-control" id="partidoId" name="PartidoId">
                            <option value="">Seleccione el partido</option>
                             <?php foreach ($partidos as $partido) : ?>
                                <?php if($candidato->PartidoId==$partido->Id):?>
                                    <option selected value="<?php echo $partido->Id; ?>"> <?= $partido->Nombre ?> </option>
                                <?php else: ?>
                                    <option value="<?php echo $partido->Id; ?>"> <?= $partido->Nombre ?> </option>
                                    <?php endif; ?>
                            <?php endforeach;?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="puestoId">Puesto</label>
                        <select class="form-control" id="partidoId" name="PuestoId">
                            <option value="">Seleccione el puesto</option>
                             <?php foreach ($puestos as $puesto) : ?>
                                <?php if($candidato->PuestoId == $puesto->Id):?>
                                    <option selected value="<?php echo $puesto->Id; ?>"> <?= $puesto->Nombre ?> </option>
                                <?php else: ?>
                                    <option value="<?php echo $puesto->Id; ?>"> <?= $puesto->Nombre ?> </option>
                                    <?php endif; ?>
                            <?php endforeach;?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="fotoPerfil">Foto de Perfil: </label>
                        <div class="card" style="width: 15rem;">
                        <?php if($candidato->FotoPerfil == null || $candidato->FotoPerfil == ''):?>
                            <img class="bd-placeholder-img card-img-top" src="<?php echo '../assets/img/default.jpg'; ?>" width="100%" height="225" aria-label="Placeholder: Thumbnail">
                        <?php else: ?>
                            <img class="bd-placeholder-img card-img-top" src="<?php echo '../assets/img/candidatos/' . $candidato->FotoPerfil; ?>" width="100%" height="225" aria-label="Placeholder: Thumbnail">
                        <?php endif;?>
                    </div>
                    <br>
                    <div class="form-group">
                        <input type="file" class="form-control-file" id="FotoPerfil" name="FotoPerfil">
                    </div>
                    </div>

                    <div class="form-group">
                    <label class="form-check-label" for="flexCheckChecked">Activo</label>
                      
                        <?php if($puesto->Estado==1): ?>
                        <input class="form-check-input" type="checkbox" name="Estado" value="activo" id="flexCheckChecked" checked>
                        <?php else: ?>
                            <input class="form-check-input" type="checkbox" name="Estado" value="activo" id="flexCheckChecked">
                            <?php endif;?>
                    </div>

                    <div class="text-right">
                        <button class="btn btn-success" type="submit">Guardar</button>
                    </div>
                </form>                              
            </div>
        </div>
    </div>
</div>
</main>
<?php $layout->printFooter()?>