<?php

 class ServiceDatabase{   

    private $context;
    private $directory;

    public function __construct($isRoot = false){

        $prefijo = ($isRoot) ? "" : "../";
        $this->directory = "{$prefijo}database";   
        $this->utilities = new Utilities();
        $this->context = new EleccionesContext($this->directory);
      
    }

    public function Add($item)
    {

        $candidatos = $this->GetList();
        $id = 1;
        if(!empty($candidatos)){
            $lastElement  = $this->utilities->getLastElement($candidatos);
            $id = $lastElement->Id + 1;
       
        }
       
        $item->FotoPerfil = '';

        if(isset($_FILES['FotoPerfil']))
        {
            $photoFile = $_FILES['FotoPerfil'];
         

            if($photoFile['error'] == 4)
            {
                $item->FotoPerfil = '';
            } 
            else
            {
                $typeReplace = str_replace("image/","",$photoFile['type']);
                $type = $photoFile['type'];
                $size = $photoFile['size'];
                $tmp = $photoFile['tmp_name'];
                $name = $id  . '.' . $typeReplace; 
                $isSuccess = $this->utilities->UploadImage('../assets/img/candidatos/',$name,$tmp,$type,$size);

                if($isSuccess)
                {
                    $item->FotoPerfil = $name;
                }
            }

        }
        $stmt = $this->context->db->prepare("insert into candidatos (Nombre,Apellido,PartidoId,PuestoId,FotoPerfil,Estado) values(?,?,?,?,?,?)");
        $stmt->bind_param("ssiisi", $item->Nombre, $item->Apellido,$item->PartidoId,$item->PuestoId,$item->FotoPerfil,$item->Estado);
        $stmt->execute();
        $stmt->close();

    }

    public function Edit($item){      

        $candidatos = $this->GetList();

        $candidato = $this->GetById($item->Id);

        $index = $this->utilities->getIndexElement($candidatos,"Id",$item->Id);

        if(isset($_FILES['FotoPerfil']))
        {

           $photoFile = $_FILES['FotoPerfil'];

           if($photoFile['error'] == 4)
           {

               $item->FotoPerfil = $candidato->FotoPerfil;
           } 
           else
           {
               $typeReplace = str_replace("image/","",$photoFile['type']);
               $type = $photoFile['type'];
               $size = $photoFile['size'];
               $tmp = $photoFile['tmp_name'];
               $name = $item->Id . '.' . $typeReplace; 
               $isSuccess = $this->utilities->UploadImage('../assets/img/candidatos/',$name,$tmp,$type,$size);

               if($isSuccess)
               {
                   $item->FotoPerfil = $name;
               }
           }
           
       }

        $stmt = $this->context->db->prepare("update candidatos set Nombre = ?,Apellido = ?,PartidoId = ?,PuestoId = ?,FotoPerfil = ?, Estado = ? where Id = ?");
        $stmt->bind_param("ssiisii", $item->Nombre, $item->Apellido,$item->PartidoId,$item->PuestoId,$item->FotoPerfil,$item->Estado,$item->Id);
        $stmt->execute();
        $stmt->close();           
    }

    public function Delete($id){
        $stmt = $this->context->db->prepare("delete from candidatos where Id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();  
    }

    public function GetById($id){

          $listadoCandidatos = $this->GetList();
        
                  
          $candidato = $this->utilities->searchProperty($listadoCandidatos,"Id",$id);
        
        return $candidato[0];
    }

    public function GetList(){

        $listadoCandidatos = array();

        $stmt = $this->context->db->prepare("select c.*, p.Nombre as PuestoNombre,pa.Nombre as PartidoNombre from candidatos c inner join puesto p on c.PuestoId = p.Id inner join partidos pa on c.PartidoId = pa.Id");
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return array();
        } else {

            while ($row = $result->fetch_object()) {
                $element = new Candidato();
                $element->Set($row);
                array_push($listadoCandidatos, $element);
            }
        }

        return $listadoCandidatos;
    }  


   
}