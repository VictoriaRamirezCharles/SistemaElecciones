<?php

 class ServiceDatabaseVotos{   

    private $context;
    private $directory;
    private $emailHandler;
    private $eleccionesService;
    
    public function __construct($isRoot = false){

        $prefijo = ($isRoot) ? "" : "../";
        $this->directory = "{$prefijo}database";   
        $this->emailHandler = new EmailHandler();       
        $this->utilities = new Utilities();
        $this->context = new EleccionesContext($this->directory);
        $this->eleccionesService = new ServiceDatabaseElecciones();
        
    }

    public function Add($item,$email,$IdUser){

        $stmt = $this->context->db->prepare("insert into votos (IdCandidato,IdElector, IdEleccion) values(?,?,?)");
        $stmt->bind_param("iii", $item->IdCandidato, $item->IdElector,$item->IdEleccion);
        $stmt->execute();
        $stmt->close();

        $valid = $this->validarElectorVotacion($IdUser,$item->IdEleccion);
        $result = $this->GetResultByUser($item->IdEleccion,$IdUser);
      

  
       
        if(in_array('Senador',$valid) && in_array('Presidente',$valid) && in_array('Diputado',$valid) && in_array('Alcalde',$valid) && in_array('Regidor',$valid))
        {
            $nom = "";
            $body = "";
            $tableName="";
            $tableBody = "";
            foreach ($result as $key) {
                $nom = "<td>".$key->Puesto ."</td>";
                $body= "<td>".$key->CandidatoNombre."</td>";
                $tableName.= $nom;
                $tableBody.= $body;
            }
           
        
            
        $this->emailHandler->SendEmail($email,"Elecciones"," Resumen de proceso de eleccion:<br><table><thead><tr><th>{$tableName}</th></tr></thead><tbody><tr>{$tableBody}</tr></tbody></table>");
       
    }
}

    public function GetById($id){

        $voto = null;

        $stmt = $this->context->db->prepare("select * from votos where Id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return null;
        } else {

          $row = $result->fetch_object();
          $voto = new Voto($row->Id,$row->IdCandidato,$row->IdElector,$row->Fecha,$row->IdEleccion);           
            
        }
        return $voto;
    }

    public function GetResult($id){

        $listadoVotos= array();

        
        $stmt = $this->context->db->prepare("select count(*) Cantidad, v.Id, v.IdCandidato, v.IdElector,v.IdEleccion, c.Nombre as CandidatoNombre, p.Nombre as Puesto from votos v inner join candidatos c on v.IdCandidato = c.Id inner join puesto p on c.PuestoId = p.Id where v.IdEleccion = ? group by v.IdCandidato ");
        $stmt->bind_param("i", $id);

        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return array();
        } else {

            while ($row = $result->fetch_object()) {

                $voto = new Voto($row->Id,$row->IdCandidato,$row->IdElector, $row->Cantidad, $row->CandidatoNombre,$row->IdEleccion);
                $voto->Puesto = $row->Puesto;  
                array_push($listadoVotos, $voto);
            }
        }

        return $listadoVotos;
    }  
    public function GetResultByUser($id,$user){

        $listadoVotos= array();

        
        $stmt = $this->context->db->prepare("select count(*) Cantidad, v.Id, v.IdCandidato, v.IdElector,v.IdEleccion, c.Nombre as CandidatoNombre, p.Nombre as Puesto from votos v inner join candidatos c on v.IdCandidato = c.Id inner join puesto p on c.PuestoId = p.Id  where v.IdEleccion = ? and v.IdElector = ? group by v.IdCandidato ");
        $stmt->bind_param("ii", $id,$user);

        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return array();
        } else {

            while ($row = $result->fetch_object()) {

                $voto = new Voto($row->Id,$row->IdCandidato,$row->IdElector, $row->Cantidad, $row->CandidatoNombre,$row->IdEleccion);
                $voto->Puesto = $row->Puesto;    
                array_push($listadoVotos, $voto);
            }
        }

        return $listadoVotos;
    } 

    public function totalVotos($id){

        $stmt = $this->context->db->prepare("select count(*) Cantidad from votos Id where IdEleccion = ?");
        $stmt->bind_param("i", $id);

        $stmt->execute();

        $result = $stmt->get_result();
        $row =0;
        if ($result->num_rows === 0) {
            return null;
        } else {

          $row = $result->fetch_object();
        
            
        }

        return $row;
    }
    
    public function totalCandidatoVoto($id, $candidato){

        $stmt = $this->context->db->prepare("select count(*) Cantidad from votos Id where IdEleccion = ? and IdCandidato  =?");
        $stmt->bind_param("ii", $id,$candidato);

        $stmt->execute();

        $result = $stmt->get_result();
        $row =0;
        if ($result->num_rows === 0) {
            return null;
        } else {

          $row = $result->fetch_object();
        
            
        }

        return $row;
    }
    public function validarElectorVotacion($idelector, $ideleccion){

        $listado= array();

        $stmt = $this->context->db->prepare("select p.Nombre from votos v inner join candidatos c on v.IdCandidato = c.Id inner join puesto p on c.PuestoId = p.Id where v.IdElector = ? and v.IdEleccion = ?");
        $stmt->bind_param("ii", $idelector,$ideleccion);

        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return array();
        } else {

            while ($row = $result->fetch_object()) {

               
                array_push($listado, $row->Nombre);
            }
        }

        return $listado;
    }  


    public function GetList(){

        $listadoVotos= array();

        $stmt = $this->context->db->prepare("select * from votos");
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return array();
        } else {

            while ($row = $result->fetch_object()) {

                $voto = new Voto($row->Id,$row->IdCandidato,$row->IdElector, $row->Cantidad, $row->CandidatoNombre, $row->IdEleccion);  
                array_push($listadoVotos, $voto);
            }
        }

        return $listadoVotos;
    }  

 
   
}